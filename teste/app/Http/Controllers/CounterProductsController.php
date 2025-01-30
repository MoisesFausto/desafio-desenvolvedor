<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCounterProductsRequest;
use App\Services\CounterProductsService;

class CounterProductsController extends Controller
{
    public function __construct(protected CounterProductsService $counterProductsService)
    {
    }

    public function upload(StoreCounterProductsRequest $request)
    {
        return $this->counterProductsService->uploadFile($request);
    }
}
