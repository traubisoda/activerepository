<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;


    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function post()
    {
        $this->belongsTo(Post::class);
    }
}
