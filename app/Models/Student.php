<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'year',
        'class_id',
        'sex',
    ];

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function getAverageAttribute()
    {
        return $this->marks->avg('mark');
    }
    public function marksForSubject($subjectId)
    {
        return $this->hasMany(Mark::class)->where('subject_id', $subjectId);
    }
    protected $attributes = [
        'sex' => 'M', 
    ];
}