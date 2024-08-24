<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Surah;
use Illuminate\Http\Request;

class SurahController extends Controller
{
    public function getAll()
    {
        return json_encode(['surahs' => Surah::all()], 200);
    }

    public function findWithTitle(Request $request)
    {
        //$title
        return json_encode(Surah::where('title', $request['title'])->orWhere('title', 'like', '%' . $request['title'] . '%')->get(), 200);
    }

    public function editTitle(Request $request)
    {
        //$id, $new_title
        Surah::find($request['id'])->update(['title' => $request['new_title']]);
        return json_encode(['status' => 'ok'], 200);
    }
}
