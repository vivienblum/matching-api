<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:100'],
            'popularity' => ['integer', 'min:-1', 'max:128'],
            'image' => ['required', 'image'],
        ];
    }
}
