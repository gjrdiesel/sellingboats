<?php

namespace App\Traits;

trait MoneyTrait {
    /**
     * Gives $boat a moneyFormat so we can properly display dollar formats in one place
     *
     * @return string
     */
    function getMoneyFormatAttribute()
    {
        setlocale(LC_MONETARY, 'en_US');
        return money_format('%(#10n', $this->list_price ?? $this->price);
    }
}