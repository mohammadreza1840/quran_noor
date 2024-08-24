<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Root;
use App\Models\Verse;
use App\Models\Word;
use App\Models\WordTransalte;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function getAll()
    {
        return json_encode(['words' => Word::all()->map(function ($item) {
            return [
                "id" => (int) $item->id,
                "word" => $item->word,
                "search_word" => $item->search_word,
                "translate" => $item->translate()->translate
            ];
        })], 200);
    }

    public function getWithID($id)
    {
        $w = Word::find($id);
        return json_encode([
            'word' => [
                "id" => (int) $w->id,
                "word" => $w->word,
                "search_word" => $w->search_word,
                "translate" => $w->translate()->translate
            ]
        ], 200);
    }

    public function getOneSimilars($id)
    {
        return json_encode(['words' => Root::find(Word::find($id)->roots->first()->id)->words->map(function ($item) use ($id) {
            return [
                "id" => (int) $item->id,
                "word" => $item->word,
                "search_word" => $item->search_word,
                "translate" => $item->translate()->translate
            ];
        })], 200);
    }

    public function getWordsOfVerse(Request $request)
    {
        //$verse_id
        return json_encode(['words' => Verse::find($request['verse_id'])->words->map(function ($item) {
            return [
                "id" => (int) $item->id,
                "word" => $item->word,
                "search_word" => $item->search_word,
                "translate" => $item->translate()->translate
            ];
        })], 200);
    }

    public function findWithRootID(Request $request)
    {
        //$root_id
        return json_encode(['words' => Root::find($request['root_id'])->words->map(function ($item) {
            return [
                "id" => (int) $item->id,
                "word" => $item->word,
                "search_word" => $item->search_word,
                "translate" => $item->translate()->translate
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
                'words' => $item->words->map(function ($item2) {
                    return [
                        "id" => (int) $item2->id,
                        "word" => $item2->word,
                        "search_word" => $item2->search_word,
                        "translate" => $item2->translate()->translate
                    ];
                })
            ];
        })], 200);
    }

    public function findWithTitle(Request $request)
    {
        //$title
        return json_encode(['words' => Word::where('search_word', $request['title'])->orWhere('search_word', 'like', '%' . $request['title'] . '%')->get()->map(function ($item) {
            return [
                "id" => (int) $item->id,
                "word" => $item->word,
                "search_word" => $item->search_word,
                "translate" => $item->translate()->translate
            ];
        })], 200);
    }

    public function findWithTranslate(Request $request)
    {
        //$translate
        $wt = WordTransalte::where('translate', $request['translate'])->orWhere('translate', 'like', '%' . $request['translate'] . '%')->get();
        $ws = array();
        foreach ($wt as $key => $value) {
            $w = Word::find($value->word_id);
            $ww = [
                "id" => (int) $w->id,
                "word" => $w->word,
                "search_word" => $w->search_word,
                "translate" => $value->translate
            ];
            array_push($ws, $ww);
        }
        return $ws;
    }

    public function editTitle(Request $request)
    {
        //$id, $new_title
        Word::find($request['id'])->update(['word' => $request['new_title'], 'search_word' => $request['new_title']]);
        return json_encode(['status' => 'ok'], 200);
    }

    public function editTranslate(Request $request)
    {
        //$id, $new_translate
        WordTransalte::where('word_id',$request['id'])->get()->first()->update(['translate' => $request['new_translate']]); 
        return json_encode(['status' => 'ok'], 200);
    }

    public function editRoot(Request $request)
    {
        //$id, $new_root_id, $old_root_id
        $oldR = Root::find($request['old_root_id']);
        $newR = Root::find($request['new_root_id']);
        $w = Word::find($request['id']);
        $w->roots()->attach($newR);
        $w->roots()->detach($oldR);
        return json_encode(['status' => 'ok'], 200);
    }

    public function delete(Request $request)
    {
        //$id
        Word::find($request['id'])->delete();
        return json_encode(['status' => 'ok'], 200);
    }
}
