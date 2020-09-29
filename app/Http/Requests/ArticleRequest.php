<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //指定されたリソースを更新する権限を持っているか確認するメソッド
    public function authorize()
    {
        //他の場所で認証ロジックを行う設計をする場合はtrueを返すように設定
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'title' => 'required|max:50',
            'body' => 'required|max:500',
        ];
    }

    //attributesメソッドでは、バリデーションエラーメッセージに表示される項目名をカスタマイズできる
    public function attributes()
    {
        return[
            'title' => 'タイトル',
            'body' => '本文',
        ];
    }
}
