<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public function login()
    {
        return $this->hasMany('App\Post');
    }
}
