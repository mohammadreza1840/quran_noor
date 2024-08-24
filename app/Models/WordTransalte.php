<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordTransalte extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "words_translates";
    protected $fillable = ['id', 'verse_id', 'language_id', 'translate'];
}
