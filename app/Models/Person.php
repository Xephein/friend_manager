<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';

    public function friendships()
    {
        return $this->hasMany(Relationship::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}