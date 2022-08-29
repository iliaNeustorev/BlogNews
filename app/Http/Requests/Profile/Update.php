<?php

namespace App\Http\Requests\Profile;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string','min:5', 'max:255', Rule::unique('users')->ignore(auth()->id())],
            'picture' => ['image'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'picture' => 'Картинка'
        ];
    }

    public function setPictureName(object $file) : string
    {
        $ext = $file->extension();
        return mb_strtolower(auth()->user()->name . mt_rand(10, 999) . '.' . $ext);
    }
}
