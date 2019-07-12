<?php

namespace App;

use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use SearchTrait;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'email',
        'phone',
    ];

    protected $searchable = [
        'first_name',
        'last_name',
        'address',
        'email',
        'phone',
    ];

    public function getNameAttribute()
    {
        return implode(' ', [$this->first_name, $this->last_name]);
    }
}
