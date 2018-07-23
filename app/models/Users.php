<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Users extends Model
{
    protected $table = "users";
    protected $fillable = ['name', 'email'];

    public function posts()
    {
        return $this->hasMany('App\Models\Posts');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comments');
    }
}
