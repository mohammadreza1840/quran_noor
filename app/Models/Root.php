<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Root extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['id','root','search_root'];

    public function words()
    {
        return $this->belongsToMany(Word::class,'roots_words','root_id','word_id');
    }

    public function verses()
    {
        return $this->belongsToMany(Verse::class,'roots_verses','root_id','verse_id')->withPivot('number');
    }
}
