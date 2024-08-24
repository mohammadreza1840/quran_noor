<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'word', 'search_word'];

    public function roots()
    {
        return $this->belongsToMany(Root::class, 'roots_words', 'word_id', 'root_id');
    }

    public function verses()
    {
        return $this->belongsToMany(Verse::class, 'words_verses', 'word_id', 'verse_id')->withPivot('number');;
    }

    public function translate($language_id = 78)
    {
        return WordTransalte::where('word_id', $this->id)->where('language_id',$language_id)->get()->first();
    }
}
