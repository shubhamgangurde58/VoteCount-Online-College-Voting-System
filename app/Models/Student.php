<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $fillable = ['name', 'roll_no', 'email', 'password', 'department', 'has_voted'];

    protected $hidden = ['password'];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}