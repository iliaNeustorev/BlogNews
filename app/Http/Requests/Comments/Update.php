<?php

namespace App\Http\Requests\Comments;

use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class Update extends FormRequest
{
    public function authorize()
    {
        return Gate::any(['comment-update','comment-timeout'], Comment::findOrfail(request()->id));
    }

    public function rules()
    {
        return [
            'text' => 'required|max:256'
        ];
    }
}
