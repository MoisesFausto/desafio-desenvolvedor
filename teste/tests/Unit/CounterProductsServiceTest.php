<?php

namespace Tests\Unit;

use App\Models\CounterProducts;
use App\Respositories\CounterProductsRepository;
use App\Services\CounterProductsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class CounterProductsServiceTest extends TestCase
{
    private $mockCounterProductsRepository;
    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockCounterProductsRepository = $this->createMock(CounterProductsRepository::class);
        $this->service = new CounterProductsService($this->mockCounterProductsRepository);
    }

    public function testHistoryReturnDataWhenFileNameOrRptDtProvider()
    {
        $request = new Request();
        $request->merge([
            'FileName' => 'test.csv',
            'RptDt' => '2024-08-23',
        ]);

        $mockedReturnData = new Collection([
            'id' => 1,
            'NameFile' => 'test.csv',
            'RptDt' => '2024-08-23',
            'UploadAt' => '2025-01-30 05:33:24',
        ]);

        $this
            ->mockCounterProductsRepository
            ->expects($this->once())
            ->method('findByFileNameOrRptDt')
            ->with($request->FileName, $request->RptDt)
            ->willReturn($mockedReturnData);

        $response = $this->service->history($request);

        $data = $response->getData(true);
        $this->assertEquals(200, $response->status());
        $this->assertIsArray($data);
    }

    public function testHistoryReturnErrorWhenFileNameOrRptDtNotProvider()
    {
        $request = new Request();
        $request->merge([]);

        $response = $this->service->history($request);

        $data = $response->getData(true);
        $this->assertEquals(404, $response->status());
        $this->assertEquals('File not found', $data['message']);
    }

    public function testSearchReturnErroWhenWithoutParams()
    {
        $request = new Request();
        $request->merge([
            'TckrSymb' => '003H11'
        ]);

        $response = $this->service->search($request);

        $data = $response->getData(true);
        $this->assertEquals(500, $response->status());
        $this->assertEquals('Check if the parameters TckrSymb and RptDt were passed correctly', $data['message']);
    }

    public function testSearchReturnDataWhenAllParamsAreProvided()
    {
        $request = new Request();
        $request->merge([
            'TckrSymb' => '003H11',
            'RptDt' => '2024-08-25'
        ]);

        $mockedReturnData = new CounterProducts([
            'RptDt' => '2024-08-25',
            'TckrSymb' => '003H11',
            'MktNm' => 'EQUITY-CASH',
            'SctyCtgyNm' => 'FUNDS',
            'ISIN' => 'BR003HCTF006',
            'CrpnNm' => 'KINEA CO-INVESTIMENTO FDO INV IMOB'
        ]);

        $this
            ->mockCounterProductsRepository
            ->expects($this->once())
            ->method('findByParams')
            ->with($request->all())
            ->willReturn($mockedReturnData);

        $response = $this->service->search($request);

        $data = $response->getData(true);
        $this->assertEquals(200, $response->status());
        $this->assertEquals('003H11', $data['TckrSymb']);
        $this->assertEquals('2024-08-25', $data['RptDt']);
    }

    public function testSearchReturnDataIfNotObjectInRequest()
    {
        $request = new Request();
        $request->merge([]);

        $mockedReturnData = [
            [
            'RptDt' => '2024-08-25',
            'TckrSymb' => '003H11',
            'MktNm' => 'EQUITY-CASH',
            'SctyCtgyNm' => 'FUNDS',
            'ISIN' => 'BR003HCTF006',
            'CrpnNm' => 'KINEA CO-INVESTIMENTO FDO INV IMOB'
            ],
            [
            'RptDt' => '2024-08-25',
            'TckrSymb' => '003H11',
            'MktNm' => 'EQUITY-CASH',
            'SctyCtgyNm' => 'FUNDS',
            'ISIN' => 'BR003HCTF006',
            'CrpnNm' => 'KINEA CO-INVESTIMENTO FDO INV IMOB'
            ]
        ];

        $this
            ->mockCounterProductsRepository
            ->expects($this->once())
            ->method('getAllCounterProductsPaginate')
            ->with(10)
            ->willReturn($mockedReturnData);

        $response = $this->service->search($request);

        $data = $response->getData(true);
        $this->assertEquals(200, $response->status());
        $this->assertIsArray($data);
    }
}
