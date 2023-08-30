<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQueryRequest extends FormRequest
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
     * バリデーションルール
     *
     * @return array
     */
    public function rules()
    {
        return [
            'searchQuery' => 'required',
        ];
    }

    /**
     * バリデーションメッセージ
     *
     * @return void
     */
    public function messages()
    {
        return [
            'searchQuery.required' => '検索キーワードを入力してください',
        ];
    }
}
