<?php

namespace App;

use App\Traits\MoneyTrait;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use MoneyTrait;

    protected $fillable = [
        'boat_id',
        'sold_at',
        'price',
        'status'
    ];

    public static $statuses = ['quoted', 'pending', 'delivered/completed'];

    function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}
