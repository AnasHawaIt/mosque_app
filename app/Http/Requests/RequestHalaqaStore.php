<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestHalaqaStore extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'halaqa_name' => 'required|string|max:255',
            'halaqa_time' => 'nullable|string',
            'quran_instructors_id' => 'nullable|exists:quran_instructors,id',
        ];
    }
}
