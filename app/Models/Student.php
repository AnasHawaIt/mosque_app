<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['halaqa_id','first_name', 'last_name', 'phone'];

    public function halaqa()
    {
        return $this->belongsTo(Halaqa::class);
    }
}
