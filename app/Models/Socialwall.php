<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socialwall extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
