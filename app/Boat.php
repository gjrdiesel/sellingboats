<?php

namespace App;

use App\Traits\MoneyTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    use SearchTrait, MoneyTrait;

    protected $guarded = [
        'make',
        'model',
        'serial_number',
        'stock_number',
        'list_price',
        'year',
    ];

    protected $searchable = [
        'make',
        'model',
        'serial_number',
        'stock_number',
    ];

    protected $casts = [
        'equipment_list' => 'json',
    ];

    public function getYearMakeModelAttribute()
    {
        return "$this->year $this->make $this->model";
    }

    public function scopeFilterMake($query, $make)
    {
        return $query->where(array_filter(['make' => $make]));
    }

    public function scopeFilterModel($query, $model)
    {
        return $query->where(array_filter(['model' => $model]));
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function getCreateOrEditLinkAttribute()
    {
        if ($this->sales_count > 0) {
            return route('sale.show', $this->sales()->latest()->first());
        }

        return route('sale.create', ['boat' => $this->id]);
    }
}
