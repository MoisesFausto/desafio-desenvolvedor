<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('counter_products', function (Blueprint $table) {
            $table->id();
            $table->date('RptDt');
            $table->string('TckrSymb', 20);
            $table->string('Asst', 20);
            $table->string('AsstDesc', 50);
            $table->string('SgmtNm', 50);
            $table->string('MktNm', 50);
            $table->string('SctyCtgyNm', 50);
            $table->date('XprtnDt')->nullable();
            $table->string('XprtnCd', 20)->nullable();
            $table->date('TradgStartDt');
            $table->date('TradgEndDt');
            $table->string('BaseCd', 20)->nullable();
            $table->string('ConvsCritNm', 50)->nullable();
            $table->string('MtrtyDtTrgtPt', 50)->nullable();
            $table->boolean('ReqrdConvsInd')->nullable();
            $table->string('ISIN', 20)->nullable();
            $table->string('CFICd', 20)->nullable();
            $table->date('DlvryNtceStartDt')->nullable();
            $table->date('DlvryNtceEndDt')->nullable();
            $table->string('OptnTp', 20)->nullable();
            $table->integer('CtrctMltplr')->nullable();
            $table->integer('AsstQtnQty')->nullable();
            $table->integer('AllcnRndLot')->nullable();
            $table->string('TradgCcy', 10);
            $table->string('DlvryTpNm', 50)->nullable();
            $table->integer('WdrwlDays')->nullable();
            $table->integer('WrkgDays')->nullable();
            $table->integer('ClnrDays')->nullable();
            $table->string('RlvrBasePricNm', 50)->nullable();
            $table->integer('OpngFutrPosDay')->nullable();
            $table->string('SdTpCd1', 20)->nullable();
            $table->string('UndrlygTckrSymb1', 20)->nullable();
            $table->string('SdTpCd2', 20)->nullable();
            $table->string('UndrlygTckrSymb2', 20)->nullable();
            $table->decimal('PureGoldWght', 15, 5)->nullable();
            $table->decimal('ExrcPric', 15, 5)->nullable();
            $table->string('OptnStyle', 20)->nullable();
            $table->string('ValTpNm', 20)->nullable();
            $table->boolean('PrmUpfrntInd')->nullable();
            $table->date('OpngPosLmtDt')->nullable();
            $table->string('DstrbtnId', 50)->nullable();
            $table->decimal('PricFctr', 15, 5)->nullable();
            $table->integer('DaysToSttlm')->nullable();
            $table->string('SrsTpNm', 20)->nullable();
            $table->boolean('PrtcnFlg')->nullable();
            $table->boolean('AutomtcExrcInd')->nullable();
            $table->string('SpcfctnCd', 50)->nullable();
            $table->string('CrpnNm', 100);
            $table->date('CorpActnStartDt')->nullable();
            $table->string('CtdyTrtmntTpNm', 50)->nullable();
            $table->decimal('MktCptlstn', 20, 5)->nullable();
            $table->string('CorpGovnLvlNm', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counter_products');
    }
};
