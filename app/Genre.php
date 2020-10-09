<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Genre extends Model
{
    public function articles():HasMany
    {
        return $this->hasMany('App\Article');
    }
}
