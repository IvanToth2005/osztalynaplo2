<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'classes_subjects');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}