<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id', 'name'];

    public function verses_translates(){
        return $this->hasMany(VerseTransalte::class);
    }

    public function words_translates(){
        return $this->hasMany(WordTransalte::class);
    }
}
