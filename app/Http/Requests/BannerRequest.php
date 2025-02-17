<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Или добавьте свою логику авторизации
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:2|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Пример валидации изображения
            'link' => 'nullable|url',
            'is_active' => 'boolean',
            'position' => 'nullable|max:255',
        ];
    }
}