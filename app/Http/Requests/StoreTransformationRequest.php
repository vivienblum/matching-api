<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransformationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'collection_id' => ['integer', 'exists:collections,id'],
            'image' => ['required', 'image'],
            'popularity' => ['integer', 'min:0', 'max:10'],
        ];
    }
}
