<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'classes_subjects', 'subject_id', 'class_id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
    
}