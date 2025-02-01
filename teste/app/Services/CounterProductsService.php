<?php

namespace App\Services;

use App\Models\CounterProducts;
use App\Imports\CounterProductsImport;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class CounterProductsService
{
    public function __construct(protected CounterProducts $counterProducts)
    {
    }

    public function upload($request): JsonResponse
    {
        $counterProducts = CounterProducts::where('NameFile', $request->file('file')->getClientOriginalName())->first();

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
            $files = CounterProducts::select(['id', 'NameFile', 'RptDt', 'created_at as UploadAt'])
                ->where('NameFile', '=', $request->FileName)
                ->orWhere('RptDt', '=', $request->RptDt)
                ->groupBy('NameFile')
                ->get();

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
            $query = CounterProducts::select(['RptDt', 'TckrSymb', 'MktNm', 'SctyCtgyNm', 'ISIN', 'CrpnNm']);

            foreach ($request->all() as $key => $value) {
                $query = $query->where($key, $value);
            }

            return response()->json($query->first());
        }

        // Retorna todos os dados se não tiver um objeto no body
        $files = CounterProducts::select(['RptDt', 'TckrSymb', 'MktNm', 'SctyCtgyNm', 'ISIN', 'CrpnNm'])
            ->paginate(10);

        return response()->json($files);
    }
}
