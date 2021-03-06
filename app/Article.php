<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    //日付型データに変換
    protected $dates = ['deadline'];

    //fillableを使うことでクライアント側からtitleやbody以外のパラメータを含んだ不正なリクエストを制限することができる
    protected $fillable = [
        'title',
        'body',
        'area',
        'date',
        'genre_id',
        'prefecture_id',
        'deadline',
        'member',
        'fee',
    ];

    // :BelongsToという記述はuserメソッドの戻り値の「型」を宣言している
    public function user():BelongsTo
    {
        //user_idやidなどのカラム名が渡されていないのにリレーションが成り立つのは、
        //usersテーブルの主キーはid、articlesテーブルの外部キーは関連するテーブル名の
        //単数形_id(つまりuser_id)であるという前提のもと、Laravel側で処理をしているため
        return $this->belongsTo('App\User');
    }

    public function likes():BelongsToMany
    {
        //likeにおけるarticleモデルとuserモデルの関係は多対多となる
        //belongsToManyメソッドの第一引数には関係するモデルのモデル名を渡す
        //第二引数には中間テーブルのテーブル名を渡す
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user): bool
    {
        return $user
        //countメソッド コレクションの要素数を数えて数値を返す
        //(bool) 型キャストを記述することで変数を論理値、つまり、trueかfalseに変換する
        //よって、この記事をいいねしたユーザーの中に、引数として渡された$userがいれば、trueが返る(1以上の数値を論理値へ型キャストするとtrueになるから)
        //この記事をいいねしたユーザーの中に、引数として渡された$userがいなければ、falseが返る(0を論理値へ型キャストするとfalseになるから)
        ?(bool)$this->likes->where('id', $user->id)->count()
        :false;
    }

    //get...Attribute形式をアクセサという
    //使用する際はgetとAttributeの部分を除き、残った部分をスネークケースにし、呼び出し時は()は記述しない
    public function getCountLikesAttribute(): int
    {
        //$this->likesにより、記事モデルからlikesテーブル経由で紐づいているユーザーモデルが、コレクションで返る
        //つまり、この記事にいいねした全ユーザーモデルがコレクションで返る
        return $this->likes->count();
    }

    public function tags():BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function comments():BelongsToMany
    {
        return $this->belongsToMany('App\User', 'comments')->withTimestamps();
    }

    public function genre():BelongsTo
    {
        return $this->belongsTo('App\Genre');
    }

    public function prefecture():BelongsTo
    {
        return $this->belongsTo('App\Prefecture');
    }

    public function joins():BelongsToMany
    {
        return $this->belongsToMany('App\User', 'joins')->withTimestamps();
    }

    public function isJoinedBy(?User $user):bool
    {
        return $user
        ? (bool)$this->joins->where('id', $user->id)->count()
        :false;
    }

    public function getCountJoinsAttribute():int
    {
        return $this->joins->count();
    }
}
