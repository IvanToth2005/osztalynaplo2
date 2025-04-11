<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Mark extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['subject_id', 'student_id', 'mark', 'date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}