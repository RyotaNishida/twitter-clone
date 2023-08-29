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
     * バリデーション項目名定義
     *
     * @return void
     */
    public function attributes()
    {
        return [
            'searchQuery' => '検索ワード',
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
            'searchQuery.required' => ':attributeを入力してください',
        ];
    }
}
