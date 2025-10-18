<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quran_instructor extends Model
{
    protected $fillable = ['first_name','last_name', 'phone', 'address'];

    public function halaqa(){
        return $this->belongsTo(Halaqa::class,'instuctor_id');
    }
}

