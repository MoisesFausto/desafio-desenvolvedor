<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCounterProductsRequest;
use App\Services\CounterProductsService;

class CounterProductsController extends Controller
{
    public function __construct(protected CounterProductsService $counterProductsService)
    {
    }

    public function fileUpload(StoreCounterProductsRequest $request): JsonResponse
    {
        return $this->counterProductsService->upload($request);
    }
}
