<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Halaqa extends Model
{
    protected $fillable = ['halaqa_name', 'quran_instructors_id'];

    public function students()
    {
        return $this->hasMany(Student::class, 'halaqa_id');
    }


    public function attendances()
    {
        return $this->hasManyThrough(Halaqa::class, Student::class, 'halaqa_id', 'student_id');
    }
}
