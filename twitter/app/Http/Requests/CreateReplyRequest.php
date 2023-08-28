<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReplyRequest extends FormRequest
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
            'reply' => 'required|max:140',
        ];
    }

    /**
     * バリデーション項目名定義
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'reply' => 'リプライ'
        ];
    }

    /**
     * バリデーションメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'reply.required' => ':attributeを入力してください',
            'reply.max' => ':attributeは140文字以内で入力してください',
        ];
    }
}
