<?php

namespace App\Services;

use App\Jobs\ProcessCounterProducts;
use App\Respositories\CounterProductsRepository;
use Illuminate\Bus\Batch;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

class CounterProductsService
{
    public function __construct(protected CounterProductsRepository $counterProductsRepository)
    {
    }

    public function upload($request): JsonResponse
    {
        $counterProducts = $this->counterProductsRepository->findByFileName($request->file('file')->getClientOriginalName());

        if ($counterProducts) {
            return response()->json(['message' => 'CSV already imported'], JsonResponse::HTTP_FOUND);
        }

        $pathFile = $request->file('file')->store('temp-files-imported');

        // Motivo de apagar o arquivo do storage é não gerar carga para o servidor local
        try {
            Bus::batch([
                new ProcessCounterProducts($request->file('file')->getClientOriginalName(), $pathFile)
            ])
            ->progress(fn(Batch $batch) => $batch->progress() )
            ->then( fn() => response()->json(['message' => 'CSV imported successfully']) )
            ->catch( fn(Batch $batch, Throwable $throwable) => [$batch, $throwable] )
            ->finally( fn(Batch $batch) => Storage::delete($pathFile) )
            ->dispatch();

            return response()->json(['message' => 'CSV imported successfully']);
        } catch (ValidationException $exception) {
            $failures = $exception->failures();

            return response()->json([
                'error' => $failures->errors()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function history($request): JsonResponse
    {
        if ($request->has('FileName') || $request->has('RptDt')) {
            $files = $this->counterProductsRepository->findByFileNameOrRptDt($request->FileName, $request->RptDt);

            return response()->json($files);
        }

        return response()->json(['message' => 'File not found'], JsonResponse::HTTP_NOT_FOUND);
    }

    public function search($request): JsonResponse
    {
        // É necessário passar os 2 parametros minimos para fazer a busca
        if (!!$request->collect()->toArray() && !$request->has(['TckrSymb', 'RptDt'])) {
            return response()->json([
                'message' => 'Check if the parameters TckrSymb and RptDt were passed correctly'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Buscar os dados se tiver um objeto no body
        if (!!$request->collect()->toArray() || $request->has(['TckrSymb', 'RptDt'])) {
            $counterProduct = $this->counterProductsRepository->findByParams($request->all());

            return response()->json($counterProduct);
        }

        // Retorna todos os dados se não tiver um objeto no body
        $files = $this->counterProductsRepository->getAllCounterProductsPaginate(10);

        return response()->json($files);
    }
}
