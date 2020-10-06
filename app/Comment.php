<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    //
    protected $fillable = [
        'message', 'article_id', 'user_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo('App\Article');
    }
}
