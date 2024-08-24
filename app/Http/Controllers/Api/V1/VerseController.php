<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Hizb;
use App\Models\Root;
use App\Models\Surah;
use App\Models\Verse;
use App\Models\VerseTransalte;
use App\Models\Word;
use Illuminate\Http\Request;

class VerseController extends Controller
{
    public function getAll()
    {
        return json_encode(['verses' => Verse::all()->map(function ($item2) {
            return [
                "id" => (int)$item2->id,
                "surah_id" => (int)$item2->surah_id,
                "content" => $item2->content,
                "search" => $item2->search,
                "number" => (int)$item2->number,
                "juz" => (int)$item2->juz,
                "hizb_id" => (int)$item2->hizb_id,
                "page" => (int)$item2->page,
                "line" => (int)$item2->line,
                "translates" => $item2->translate()->map(function ($item3) {
                    $a = Author::find($item3->author_id);
                    return [
                        "author" => $a->first_name . ' ' . $a->last_name,
                        "translate" => $item3->translate
                    ];
                })
            ];
        })], 200);
    }

    public function getOneDetails($id)
    {
        $v = Verse::find($id);
        $r = [
            "id" => (int)$v->id,
            "surah_id" => (int)$v->surah_id,
            "content" => $v->content,
            "search" => $v->search,
            "number" => (int)$v->number,
            "juz" => (int)$v->juz,
            "hizb_id" => (int)$v->hizb_id,
            "page" => (int)$v->page,
            "line" => (int)$v->line,
            "translates" => $v->translate()->map(function ($item3) {
                $a = Author::find($item3->author_id);
                return [
                    "author" => $a->first_name . ' ' . $a->last_name,
                    "translate" => $item3->translate
                ];
            })
        ];
        return json_encode(['verse' => $r], 200);
    }

    public function findWithRootID(Request $request)
    {
        //$root_id
        return json_encode(['verses' => Root::find($request['root_id'])->verses->map(function ($item2) {
            return [
                "id" => (int)$item2->id,
                "surah_id" => (int)$item2->surah_id,
                "content" => $item2->content,
                "search" => $item2->search,
                "number" => (int)$item2->number,
                "juz" => (int)$item2->juz,
                "hizb_id" => (int)$item2->hizb_id,
                "page" => (int)$item2->page,
                "line" => (int)$item2->line,
                "translates" => $item2->translate()->map(function ($item3) {
                    $a = Author::find($item3->author_id);
                    return [
                        "author" => $a->first_name . ' ' . $a->last_name,
                        "translate" => $item3->translate
                    ];
                })
            ];
        })], 200);
    }

    public function findWithRootTitle(Request $request)
    {
        //$root_title
        return json_encode(['roots' => Root::where('search_root', $request['root_title'])->orWhere('search_root', 'like', '%' . $request['root_title'] . '%')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'root' => $item->root,
                'search_root' => $item->search_root,
                'verses' => $item->verses->map(function ($item2) {
                    return [
                        "id" => (int)$item2->id,
                        "surah_id" => (int)$item2->surah_id,
                        "content" => $item2->content,
                        "search" => $item2->search,
                        "number" => (int)$item2->number,
                        "juz" => (int)$item2->juz,
                        "hizb_id" => (int)$item2->hizb_id,
                        "page" => (int)$item2->page,
                        "line" => (int)$item2->line,
                        "translates" => $item2->translate()->map(function ($item3) {
                            $a = Author::find($item3->author_id);
                            return [
                                "author" => $a->first_name . ' ' . $a->last_name,
                                "translate" => $item3->translate
                            ];
                        })
                    ];
                })
            ];
        })], 200);
    }

    public function findWithWordID(Request $request)
    {
        //$word_id
        return json_encode(['verses' => Word::find($request['word_id'])->verses->map(function ($item2) {
            return [
                "id" => (int)$item2->id,
                "surah_id" => (int)$item2->surah_id,
                "content" => $item2->content,
                "search" => $item2->search,
                "number" => (int)$item2->number,
                "juz" => (int)$item2->juz,
                "hizb_id" => (int)$item2->hizb_id,
                "page" => (int)$item2->page,
                "line" => (int)$item2->line,
                "translates" => $item2->translate()->map(function ($item3) {
                    $a = Author::find($item3->author_id);
                    return [
                        "author" => $a->first_name . ' ' . $a->last_name,
                        "translate" => $item3->translate
                    ];
                })
            ];
        })], 200);
    }

    public function findWithWordTitle(Request $request)
    {
        //$word_title
        return json_encode(['words' => Word::where('search_word', $request['word_title'])->orWhere('search_word', 'like', '%' . $request['word_title'] . '%')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'word' => $item->root,
                'search_word' => $item->search_root,
                'verses' => $item->verses->map(function ($item2) {
                    return [
                        "id" => (int)$item2->id,
                        "surah_id" => (int)$item2->surah_id,
                        "content" => $item2->content,
                        "search" => $item2->search,
                        "number" => (int)$item2->number,
                        "juz" => (int)$item2->juz,
                        "hizb_id" => (int)$item2->hizb_id,
                        "page" => (int)$item2->page,
                        "line" => (int)$item2->line,
                        "translates" => $item2->translate()->map(function ($item3) {
                            $a = Author::find($item3->author_id);
                            return [
                                "author" => $a->first_name . ' ' . $a->last_name,
                                "translate" => $item3->translate
                            ];
                        })
                    ];
                })
            ];
        })], 200);
    }

    public function findWithTitle(Request $request)
    {
        //$title
        return json_encode(['verses' => Verse::where('search', $request['title'])->orWhere('search', 'like', '%' . $request['title'] . '%')->get()->map(function ($item) {
            return [
                "id" => (int)$item->id,
                "surah_id" => (int)$item->surah_id,
                "content" => $item->content,
                "search" => $item->search,
                "number" => (int)$item->number,
                "juz" => (int)$item->juz,
                "hizb_id" => (int)$item->hizb_id,
                "page" => (int)$item->page,
                "line" => (int)$item->line,
                "translates" => $item->translate()->map(function ($item2) {
                    $a = Author::find($item2->author_id);
                    return [
                        "author" => $a->first_name . ' ' . $a->last_name,
                        "translate" => $item2->translate
                    ];
                })
            ];
        })], 200);
    }

    public function findWithTranslate(Request $request)
    {
        //$translate
        $rr = array();
        $vts = VerseTransalte::where('translate', $request['translate'])->orWhere('translate', 'like', '%' . $request['translate'] . '%')->get();
        foreach ($vts as $key => $value) {
            $v = Verse::find((int)$value->verse_id);
            $a = Author::find($value->author_id);
            $vv = [
                "id" => (int)$v->id,
                "surah_id" => (int)$v->surah_id,
                "content" => $v->content,
                "search" => $v->search,
                "number" => (int)$v->number,
                "juz" => (int)$v->juz,
                "hizb_id" => (int)$v->hizb_id,
                "page" => (int)$v->page,
                "line" => (int)$v->line,
                "translates" => [
                    "author" => $a->first_name . ' ' . $a->last_name,
                    "translate" => $value->translate
                ]
            ];
            array_push($rr,$vv);
        }
        return json_encode(['verses' => $rr], 200);
    }

    public function findWithSurahID(Request $request)
    {
        //$surah_id
        return json_encode(['verses' => Surah::find($request['surah_id'])->verses->map(function ($item2) {
            return [
                "id" => (int)$item2->id,
                "surah_id" => (int)$item2->surah_id,
                "content" => $item2->content,
                "search" => $item2->search,
                "number" => (int)$item2->number,
                "juz" => (int)$item2->juz,
                "hizb_id" => (int)$item2->hizb_id,
                "page" => (int)$item2->page,
                "line" => (int)$item2->line,
                "translates" => $item2->translate()->map(function ($item3) {
                    $a = Author::find($item3->author_id);
                    return [
                        "author" => $a->first_name . ' ' . $a->last_name,
                        "translate" => $item3->translate
                    ];
                })
            ];
        })], 200);
    }

    public function findWithSurahTitle(Request $request)
    {
        //$surah_title
        return json_encode(['surahs' => Surah::where('title', $request['surah_title'])->orWhere('title', 'like', '%' . $request['surah_title'] . '%')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'number' => $item->number,
                'kind' => $item->kind,
                'verses' => $item->verses->map(function ($item2) {
                    return [
                        "id" => (int)$item2->id,
                        "surah_id" => (int)$item2->surah_id,
                        "content" => $item2->content,
                        "search" => $item2->search,
                        "number" => (int)$item2->number,
                        "juz" => (int)$item2->juz,
                        "hizb_id" => (int)$item2->hizb_id,
                        "page" => (int)$item2->page,
                        "line" => (int)$item2->line,
                        "translates" => $item2->translate()->map(function ($item3) {
                            $a = Author::find($item3->author_id);
                            return [
                                "author" => $a->first_name . ' ' . $a->last_name,
                                "translate" => $item3->translate
                            ];
                        })
                    ];
                })
            ];
        })], 200);
    }

    public function findWithJuzNumber($juz_number)
    {
        return json_encode(['verses' => Verse::where('juz', $juz_number)->get()->map(function ($item) {
            return [
                "id" => (int)$item->id,
                "surah_id" => (int)$item->surah_id,
                "content" => $item->content,
                "search" => $item->search,
                "number" => (int)$item->number,
                "juz" => (int)$item->juz,
                "hizb_id" => (int)$item->hizb_id,
                "page" => (int)$item->page,
                "line" => (int)$item->line,
                "translates" => $item->translate()->map(function ($item2) {
                    $a = Author::find($item2->author_id);
                    return [
                        "author" => $a->first_name . ' ' . $a->last_name,
                        "translate" => $item2->translate
                    ];
                })
            ];
        })], 200);
    }

    public function findWithHizbID(Request $request)
    {
        //$hizb_id
        return json_encode(['verses' => Hizb::find($request['hizb_id'])->verses->map(function ($item) {
            return [
                "id" => (int)$item->id,
                "surah_id" => (int)$item->surah_id,
                "content" => $item->content,
                "search" => $item->search,
                "number" => (int)$item->number,
                "juz" => (int)$item->juz,
                "hizb_id" => (int)$item->hizb_id,
                "page" => (int)$item->page,
                "line" => (int)$item->line,
                "translates" => $item->translate()->map(function ($item2) {
                    $a = Author::find($item2->author_id);
                    return [
                        "author" => $a->first_name . ' ' . $a->last_name,
                        "translate" => $item2->translate
                    ];
                })
            ];
        })], 200);
    }

    public function findWithHizbNumber(Request $request)
    {
        //$hizb_number
        return json_encode(['verses' => Hizb::where('number', $request['hizb_number'])->get()->first()->verses->map(function ($item) {
            return [
                "id" => (int)$item->id,
                "surah_id" => (int)$item->surah_id,
                "content" => $item->content,
                "search" => $item->search,
                "number" => (int)$item->number,
                "juz" => (int)$item->juz,
                "hizb_id" => (int)$item->hizb_id,
                "page" => (int)$item->page,
                "line" => (int)$item->line,
                "translates" => $item->translate()->map(function ($item2) {
                    $a = Author::find($item2->author_id);
                    return [
                        "author" => $a->first_name . ' ' . $a->last_name,
                        "translate" => $item2->translate
                    ];
                })
            ];
        })], 200);
    }

    public function findWithPageNumber($page_number)
    {
        return json_encode(['verses' => Verse::where('page', $page_number)->get()->map(function ($item) {
            return [
                "id" => (int)$item->id,
                "surah_id" => (int)$item->surah_id,
                "content" => $item->content,
                "search" => $item->search,
                "number" => (int)$item->number,
                "juz" => (int)$item->juz,
                "hizb_id" => (int)$item->hizb_id,
                "page" => (int)$item->page,
                "line" => (int)$item->line,
                "translates" => $item->translate()->map(function ($item2) {
                    $a = Author::find($item2->author_id);
                    return [
                        "author" => $a->first_name . ' ' . $a->last_name,
                        "translate" => $item2->translate
                    ];
                })
            ];
        })], 200);
    }

    public function findWithVerseNumber($verse_number)
    {
        return json_encode(['verses' => Verse::where('number', $verse_number)->get()->map(function ($item) {
            return [
                "id" => (int)$item->id,
                "surah_id" => (int)$item->surah_id,
                "content" => $item->content,
                "search" => $item->search,
                "number" => (int)$item->number,
                "juz" => (int)$item->juz,
                "hizb_id" => (int)$item->hizb_id,
                "page" => (int)$item->page,
                "line" => (int)$item->line,
                "translates" => $item->translate()->map(function ($item2) {
                    $a = Author::find($item2->author_id);
                    return [
                        "author" => $a->first_name . ' ' . $a->last_name,
                        "translate" => $item2->translate
                    ];
                })
            ];
        })], 200);
    }

    public function findWithSurahAndVerse($surah_number, $verse_number)
    {
        $s_id = Surah::where('number', $surah_number)->get()->first()->id;
        $v = Verse::where('surah_id', $s_id)->where('number', $verse_number)->get()->first();
        return json_encode([
            "id" => (int)$v->id,
            "surah_id" => (int)$v->surah_id,
            "content" => $v->content,
            "search" => $v->search,
            "number" => (int)$v->number,
            "juz" => (int)$v->juz,
            "hizb_id" => (int)$v->hizb_id,
            "page" => (int)$v->page,
            "line" => (int)$v->line,
            "translates" => $v->translate()->map(function ($item2) {
                $a = Author::find($item2->author_id);
                return [
                    "author" => $a->first_name . ' ' . $a->last_name,
                    "translate" => $item2->translate
                ];
            })
        ], 200);
    }

    public function editTranslate(Request $request)
    {
        //$id, $new_translate
        Verse::find($request['id'])->update(['translate'=>$request['new_translate']]);
        return json_encode(['status' => 'ok'], 200);
    }
}
