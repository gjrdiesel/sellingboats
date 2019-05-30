<?php

namespace App\Http\Requests;

use App\Sale;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'boat_id' => 'required|exists:boats,id',
            'sold_at' => 'required|date',
            'status' => "required|in:" . implode(',', Sale::$statuses),
            'price' => 'required|numeric|max:1000000000|min:1',
            'customers' => 'required|array',
            'customers.*' => 'required|exists:customers,id',
        ];
    }
}
