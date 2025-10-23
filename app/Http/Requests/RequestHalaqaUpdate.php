<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestHalaqaUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'halaqa_name' => 'sometimes|string|max:255',
            'halaqa_time' => 'nullable|string',
            'quran_instructors_id' => 'nullable|exists:teachers,id',
        ];
    }
}
