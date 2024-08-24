<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id', 'first_name', 'last_name'];

    public function translates(){
        return $this->hasMany(VerseTransalte::class);
    }
}
