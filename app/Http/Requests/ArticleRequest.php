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
            'body' => 'required|max:200',
            //スペースと/を含ませないようにする
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
            'area' => 'required',
            'date' => 'required',
            'genre_id' => 'required',
            'prefecture_id' => 'required',
            'deadline' => 'required',
            'member' => 'required|lte:50',
            'fee' => 'required'
        ];
    }

    //attributesメソッドでは、バリデーションエラーメッセージに表示される項目名をカスタマイズできる
    public function attributes()
    {
        return[
            'title' => 'タイトル',
            'body' => '本文',
            'tags' => 'タグ',
            'area' => '実施場所',
            'date' => '開催日時',
            'genreId' => 'スポーツのジャンル',
            'prefectureId' => '開催エリア',
            'member' => '募集人数',
            'deadline' => '締め切りの日程',
            'fee' => '参加費',
        ];
    }

    //フォームリクエスのバリデーションが成功した後に自動的に呼ばれるメソッド
    public function passedValidation()
    {
        //json_decodeはJSON形式の文字列をPHP形式の連想配列に変換する
        //collection 配列データを操作するための、書きやすく、使いやすいラッパー
        $this->tags = collect(json_decode($this->tags))
        //コレクションの要素が第一引数から、第二引数に指定した数分だけになる->0から5個分
        ->slice(0, 5)
        //map コレクションの各要素に対して順に処理を行い、新しいコレクションの作成を行う
        ->map(function ($requestTag){
            return $requestTag->text;
        });
    }
}
