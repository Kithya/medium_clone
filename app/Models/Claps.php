<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claps extends Model
{
    public const UPDATED_AT = null;
    protected $fillable = [
        'user_id',
        'post_id'
    ];

    public function post()
    {
        $this->belongsTo(Post::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
