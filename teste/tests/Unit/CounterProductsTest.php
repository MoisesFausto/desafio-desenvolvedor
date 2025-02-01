<?php

namespace Tests\Unit;

use App\Models\CounterProducts;
use App\Services\CounterProductsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class CounterProductsTest extends TestCase
{
    private $counterProductsSpy;
    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->counterProductsSpy = Mockery::spy(CounterProducts::class);
        $this->service = new CounterProductsService($this->counterProductsSpy);
    }

    public function testHistoryReturnsDataWhenFileNameOrRptDtIsProvided()
    {
        $request = new Request();
        $request->merge([
            'FileName' => 'test.csv'
        ]);

        $mockedData = new Collection([
            [
                'id' => 1,
                'NameFile' => 'test.csv',
                'RptDt' => '2024-08-23',
                'UploadAt' => '2025-01-30 05:33:24'
            ]
        ]);


        $this->counterProductsSpy->allows('get')->andReturns($mockedData);

        $response = $this->service->history($request);

        $this->assertEquals(200, $response->status());
        $this->assertEmpty($response->getData(true));
        $this->assertEquals([], $response->getData(true));
    }

    public function testHistoryReturnsNotFoundWhenNoFiltersAreProvided()
    {
        $request = new Request();

        $response = $this->service->history($request);

        $this->assertEquals(404, $response->status());
        $responseData = $response->getData(true);
        $this->assertEquals('File not found', $responseData['message']);
    }
}
