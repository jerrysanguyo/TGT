<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContestantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'talent' => ['required', 'string'],
            'file_name' => ['required', 'file', 'mimes:jpeg,jpg,png,webp'],
        ];
    }
}
