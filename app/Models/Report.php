<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'halaqa_id',
        'date',
        'present_students',
        'absent_students',
        'attendance_rate',
    ];

    public function halaqa()
    {
        return $this->belongsTo(Halaqa::class);
    }
}
