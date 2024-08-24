<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerseTransalte extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "verses_translates";
    protected $fillable = ['id', 'verse_id', 'language_id', 'author_id', 'translate'];
}
