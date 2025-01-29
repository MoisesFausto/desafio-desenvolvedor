<?php

namespace App\Imports;

use App\Models\CounterProducts;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CounterProductsImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CounterProducts([
            'RptDt' => $row[0],
            'TckrSymb' => $row[1],
            'Asst' => $row[2],
            'AsstDesc' => $row[3],
            'SgmtNm' => $row[4],
            'MktNm' => $row[5],
            'SctyCtgyNm' => $row[6],
            'XprtnDt' => $row[7],
            'XprtnCd' => $row[8],
            'TradgStartDt' => $row[9],
            'TradgEndDt' => $row[10],
            'BaseCd' => $row[11],
            'ConvsCritNm' => $row[12],
            'MtrtyDtTrgtPt' => $row[13],
            'ReqrdConvsInd' => $row[14],
            'ISIN' => $row[15],
            'CFICd' => $row[16],
            'DlvryNtceStartDt' => $row[17],
            'DlvryNtceEndDt' => $row[18],
            'OptnTp' => $row[19],
            'CtrctMltplr' => $row[20],
            'AsstQtnQty' => $row[21],
            'AllcnRndLot' => $row[22],
            'TradgCcy' => $row[23],
            'DlvryTpNm' => $row[24],
            'WdrwlDays' => $row[25],
            'WrkgDays' => $row[26],
            'ClnrDays' => $row[27],
            'RlvrBasePricNm' => $row[28],
            'OpngFutrPosDay' => $row[29],
            'SdTpCd1' => $row[30],
            'UndrlygTckrSymb1' => $row[31],
            'SdTpCd2' => $row[32],
            'UndrlygTckrSymb2' => $row[33],
            'PureGoldWght' => $row[34],
            'ExrcPric' => $row[35],
            'OptnStyle' => $row[36],
            'ValTpNm' => $row[37],
            'PrmUpfrntInd' => $row[38],
            'OpngPosLmtDt' => $row[39],
            'DstrbtnId' => $row[40],
            'PricFctr' => $row[41],
            'DaysToSttlm' => $row[42],
            'SrsTpNm' => $row[43],
            'PrtcnFlg' => $row[44],
            'AutomtcExrcInd' => $row[45],
            'SpcfctnCd' => $row[46],
            'CrpnNm' => $row[47],
            'CorpActnStartDt' => $row[48],
            'CtdyTrtmntTpNm' => $row[49],
            'MktCptlstn' => $row[50],
            'CorpGovnLvlNm' => $row[51],
        ]);
    }



    public function startRow(): int
    {
        return 3;
    }
}
