<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['id','title','number','kind'];

    public function verses(){
        return $this->hasMany(Verse::class);
    }
}
