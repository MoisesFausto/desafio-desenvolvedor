<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCounterProductsRequest;
use App\Http\Requests\UpdateCounterProductsRequest;
use App\Imports\CounterProductsImport;
use App\Models\CounterProducts;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class CounterProductsController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        try {
            Excel::import(new CounterProductsImport, $request->file('file'));

            return response()->json('CSV imported successfully');
        } catch (Throwable $exceptions) {
            return response()->json(['error' => $exceptions], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
