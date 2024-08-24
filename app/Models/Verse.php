<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Verse extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['id','surah_id','content','content_othman_taha','content_othman_taha_new','search','search_othman_taha','number','juz','hizb_id','page','line'];

    public function hizb(): HasOne
    {
        return $this->hasOne(Hizb::class,'id','hizb_id');
    }

    public function roots()
    {
        return $this->belongsToMany(Root::class,'roots_verses','verse_id','root_id')->withPivot('number');
    }

    public function words()
    {
        return $this->belongsToMany(Word::class,'words_verses','verse_id','word_id')->withPivot('number');;
    }
    
    public function translate($language_id = null,$author_id = null)
    {
        if($language_id == null){
            if($author_id == null){
                return VerseTransalte::where('verse_id', $this->id)->get();
            }else{
                return VerseTransalte::where('verse_id', $this->id)->where('author_id',$author_id)->get()->first();
            }
        }else{
            if($author_id == null){
                return VerseTransalte::where('verse_id', $this->id)->where('language_id',$language_id)->get();
            }else{
                return VerseTransalte::where('verse_id', $this->id)->where('language_id',$language_id)->where('author_id',$author_id)->get()->first();
            }
        }
    }
}
