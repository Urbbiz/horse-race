<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Horse;
use App\Models\Better;

class Horse extends Model
{
    use HasFactory;

    public function horseBetter()   //--> funkcijos vardas bookAuthornieko nereiskia, pasirenkam i koki sugalvojam
    {
        return $this->hasMany('App\Models\Better', 'horse_id', 'id');
        // return $this->belongsTo(Better::class, 'horse_id', 'id');
        //si knyga -> pagal autoriaus id priklauso autoriui, kurio id yra toks.
        
    }
}
