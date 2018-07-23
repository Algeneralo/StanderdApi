<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Posts extends Model
{
    protected $table = "posts";
    protected $fillable = ['details', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comments', 'post_id');
    }
}
