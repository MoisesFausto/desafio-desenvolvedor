<?php

namespace App\Respositories;

use App\Contracts;
use App\Models\CounterProducts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CounterProductsRepository implements Contracts\CounterProductsRepository
{
    public function findByFileNameOrRptDt(?string $fileName, ?string $rptDt): Collection
    {
        return CounterProducts::select(['id', 'NameFile', 'RptDt', 'created_at as UploadAt'])
            ->where('NameFile', '=', $fileName)
            ->orWhere('RptDt', '=', $rptDt)
            ->groupBy('NameFile')
            ->get();
    }

    public function findByFileName(string $fileName): ?CounterProducts
    {
        return CounterProducts::where('NameFile', $fileName)->first();
    }

    public function findByParams(array $params): ?CounterProducts
    {
        $query = CounterProducts::select(['RptDt', 'TckrSymb', 'MktNm', 'SctyCtgyNm', 'ISIN', 'CrpnNm']);

        foreach ($params as $key => $value) {
            $query = $query->where($key, $value);
        }

        return $query->first();
    }

    public function getAllCounterProductsPaginate(int $paginate = 100)
    {
        return Cache::remember('counterProductsPaginate', 10, function () use ($paginate) {
            return CounterProducts::select(
                ['RptDt', 'TckrSymb', 'MktNm', 'SctyCtgyNm', 'ISIN', 'CrpnNm']
            )->paginate($paginate);
        });
    }
}
