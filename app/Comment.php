<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment', 'user_id','post_id',
    ];


    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
