<?php

namespace App;

use App\Mail\BareMail;
use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'prof', 'image', 'age',
        'prefecture_id', 'genre_id', 'address', 'sex',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token, new BareMail()));
    }


    public function articles():HasMany
    {
        return $this->hasMany('App\Article');
    }


    public function followers(): BelongsToMany
    {
        //中間テーブルのカラム名と、リレーション元/先のテーブル名に規則性がない(テーブル名に相違がない)ため、
        //第三引数と第四引数で中間テーブルのカラム名を指定する必要がある
        //第三引数にリレーション元モデルidを示す中間テーブルのカラムを指定
        //第四引数にリレーション先モデルidを示す中間テーブルのカラムを指定
        return $this->belongsToMany('App\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }


    public function followings(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }


    public function likes():BelongsToMany
    {
        return $this->belongsToMany('App\Article', 'likes')->withTimestamps();
    }


    public function isFollowedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->followers->where('id', $user->id)->count()
            : false;
    }


    public function getCountFollowersAttribute():int
    {
        //$this->followersによりユーザーモデルの全フォロワーがコレクションで返る
        return $this->followers->count();
    }


    public function getCountFollowingsAttribute():int
    {
        return $this->followings->count();
    }


    public function comments():BelongsToMany
    {
        return $this->belongsToMany('App\Article', 'commnets');
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
        return $this->belongsToMany('App\Article', 'joins')->withTimestamps();
    }
}
