<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCollectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'max:100'],
            'available' => ['boolean'],
            'delta' => ['integer', 'min:0', 'max:255'],
            'has_popularity' => ['boolean'],
        ];
    }
}
