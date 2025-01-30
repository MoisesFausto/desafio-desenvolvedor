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
}
