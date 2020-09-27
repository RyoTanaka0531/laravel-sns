<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    // :BelongsToという記述はuserメソッドの戻り値の「型」を宣言している
    public function user():BelongsTo
    {
        //user_idやidなどのカラム名が渡されていないのにリレーションが成り立つのは、
        //usersテーブルの主キーはid、articlesテーブルの外部キーは関連するテーブル名の
        //単数形_id(つまりuser_id)であるという前提のもと、Laravel側で処理をしているため
        return $this->belongsTo('App\User');
    }
}
