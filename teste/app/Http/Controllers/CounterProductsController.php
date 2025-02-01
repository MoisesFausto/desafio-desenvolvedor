<?php

namespace App\Http\Controllers;

use App\Http\Requests\CounterProductsRequest;
use App\Http\Requests\StoreCounterProductsRequest;
use App\Services\CounterProductsService;
use Illuminate\Http\JsonResponse;

class CounterProductsController extends Controller
{
    public function __construct(protected CounterProductsService $counterProductsService)
    {
    }

    public function fileUpload(StoreCounterProductsRequest $request): JsonResponse
    {
        return $this->counterProductsService->upload($request);
    }

    public function fileHistory(CounterProductsRequest $request): JsonResponse
    {
        return $this->counterProductsService->history($request);
    }

    public function fileSearch(CounterProductsRequest $request): JsonResponse
    {
        return $this->counterProductsService->search($request);
    }
}
