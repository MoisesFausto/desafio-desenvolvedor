<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class QuotationHistory extends Model
{
    use Notifiable;

    protected $fillable = [
        'currency_from', 'currency_to', 'payment_type', 'name', 'bid', 'create_date', 'quote_value', 'fk_user'
    ];

    public function setCurrencyFromAttribute($value)
    {
        $this->attributes['currency_from'] = $this->convertValueToFloat($value);
    }

    public function getCurrencyFromAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setQuoteValueAttribute($value)
    {
        $this->attributes['quote_value'] = $this->convertValueToFloat($value);
    }

    public function getQuoteValueAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setBidAttribute($value)
    {
        $this->attributes['bid'] = $this->convertValueToFloat($value);
    }

    public function getBidAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    private function convertValueToFloat($value)
    {
        return floatval($value);
    }
}
