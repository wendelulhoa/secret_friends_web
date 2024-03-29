<?php

namespace App\Http\Controllers;

use App\Models\configsstake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StakeController extends Controller
{
    public function index() {
        return view('stake.index');
    }

    public function getplays() {
        return response()->json(json_decode(configsstake::find(1)->plays), 200);
    }

    public function setPlays(Request $request) {
        $configs = configsstake::find(1);

        if(!is_null($configs)) {
            $configs->update([
                'plays' => json_encode($request['plays'])
            ]);
        } else {
            configsstake::create([
                'plays' => json_encode($request['plays'])
            ]);
        }
    }

    public function getMines() {
        return response()->json(json_decode(configsstake::find(1)->mines), 200);
    }

    public function setMines(Request $request) {
        $configs = configsstake::find(1);

        if(!is_null($configs)) {
            $configs->update([
                'mines' => json_encode(explode(',', $request['mines']))
            ]);
        } else {
            configsstake::create([
                'mines' => json_encode(explode(',', $request['mines']))
            ]);
        }
    }
}
