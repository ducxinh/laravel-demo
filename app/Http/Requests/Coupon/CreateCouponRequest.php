<?php

namespace App\Http\Requests\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class CreateCouponRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|string|unique:coupons,code',
            'type' => 'required|string|in:fixed,percentage',
            'value' => 'required|integer',
            'is_used' => 'boolean',
            'expired_at' => 'nullable|date',
            'max_use' => 'nullable|integer',
            'used' => 'integer',
        ];
    }
}
