<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|string|max:1024*1024*1024*1024',
            'category_id' => 'required|exists:App\Models\Category,id',
            'parent_id' => [
                'required',
                Rule::exists('posts', 'id')->where('is_top', 1)->whereNull('parent_id'),
            ],
        ];
    }
}
