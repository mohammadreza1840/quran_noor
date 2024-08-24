<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hizb extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['id','number','type'];

    public function verses(){
        return $this->hasMany(Verse::class);
    }
}
