<?php

namespace App\Contracts;

use App\Models\CounterProducts;
use Illuminate\Database\Eloquent\Collection;

interface CounterProductsRepository
{
    public function findByFileNameOrRptDt(?string $fileName, ?string $rptDt): Collection;
    public function getAllCounterProductsPaginate(int $paginate = 100);
    public function findByFileName(string $fileName): ?CounterProducts;
    public function findByParams(array $params): ?CounterProducts;
}
