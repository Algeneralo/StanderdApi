<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Comments extends Model
{
    protected $table = "comments";
    protected $fillable = ['details', 'user_id', 'post_id'];

    public function posts()
    {
        return $this->belongsTo('App\Models\Posts');
    }

}
