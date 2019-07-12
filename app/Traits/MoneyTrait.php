<?php

namespace App\Traits;

trait MoneyTrait
{
    /**
     * Gives $boat a moneyFormat so we can properly display dollar formats in one place.
     *
     * @return string
     */
    public function getMoneyFormatAttribute()
    {
        return money_format('$%i', $this->list_price ?? $this->price);
    }
}
