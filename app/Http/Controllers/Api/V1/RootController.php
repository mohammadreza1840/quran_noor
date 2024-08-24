<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Root;
use App\Models\Verse;
use App\Models\Word;
use Illuminate\Http\Request;

class RootController extends Controller
{
    public function getAll()
    {
        return json_encode(['roots' => Root::all()->take(200)->map(function ($root) {
            return [
                'id' => $root->id,
                'title' => $root->root,
                'search_title' => $root->search_root,
                'words_count' => count($root->words),
                'uses_count' =>  count($root->verses)
            ];
        })], 200);
        return json_encode(['roots' => Root::all()], 200);
    }

    public function getWithID($id)
    {
        /* return json_encode(['root' => Root::find($id)], 200); */
        return json_encode(Root::find($id), 200);
    }

    public function findWithWordID(Request $request)
    {
        //$word_id
        return json_encode(['roots' => Word::find($request['word_id'])->roots->map(function ($item) {
            return [
                'id' => $item->id,
                'root' => $item->root,
                'search_root' => $item->search_root
            ];
        })], 200);
    }

    public function getWithVerseID(Request $request)
    {
        //$verse_id
        return json_encode(['roots' => Verse::find($request['verse_id'])->roots->map(function ($item) {
            return [
                'id' => $item->id,
                'root' => $item->root,
                'search_root' => $item->search_root
            ];
        })], 200);
    }

    public function findWithRootTitle(Request $request)
    {
        //$root_title
        return json_encode(Root::where('search_root', $request['root_title'])->orWhere('search_root', 'like', '%' . $request['root_title'] . '%')->get(), 200);
    }

    public function editTitle(Request $request)
    {
        //$id, $new_title
        Root::find($request['id'])->update(['root' => $request['new_title'], 'search_root' => $request['new_title']]);
        return json_encode(['status' => 'ok'], 200);
    }

    public function deleteOne(Request $request)
    {
        //$id
        Root::find($request['id'])->delete();
        return json_encode(['status' => 'ok'], 200);
    }
}
