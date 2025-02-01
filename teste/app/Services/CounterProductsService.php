<?php

namespace App\Services;

use App\Models\CounterProducts;
use App\Imports\CounterProductsImport;
use App\Respositories\CounterProductsRepository;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class CounterProductsService
{
    public function __construct(protected CounterProducts $counterProducts, protected CounterProductsRepository $counterProductsRepository)
    {
    }

    public function upload($request): JsonResponse
    {
        $counterProducts = $this->counterProductsRepository->findByFileName($request->file('file')->getClientOriginalName());

        if ($counterProducts) {
            return response()->json(['message' => 'CSV already imported'], JsonResponse::HTTP_FOUND);
        }

        try {
            Excel::import(new CounterProductsImport(
                $request->file('file')->getClientOriginalName()
            ), $request->file('file'));

            return response()->json(['message' => 'CSV imported successfully']);
        } catch (Throwable $exceptions) {
            return response()->json([
                'code' => $exceptions->getCode(),
                'error' => $exceptions->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function history($request): JsonResponse
    {
        if ($request->FileName || $request->RptDt) {
            $files = $this->counterProductsRepository->findByFileNameOrRptDt($request->FileName, $request->RptDt);

            return response()->json($files);
        }

        return response()->json(['message' => 'File not found'], JsonResponse::HTTP_NOT_FOUND);
    }

    public function search($request): JsonResponse
    {
        // É necessário passar os parametros minimos para fazer a busca
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
