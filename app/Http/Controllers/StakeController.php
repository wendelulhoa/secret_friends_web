<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StakeController extends Controller
{
    public function index() {
        return view('stake.index');
    }

    public function getplays() {
        return Session::get('plays');
    }

    public function setPlays(Request $request) {
        Session::put('plays', $request['plays']);
        // Session::put('plays', [1,2,3]);
    }

    public function getMines() {
        return Session::get('mines');
    }

    public function setMines(Request $request) {
        Session::put('mines', explode(',', $request['mines']));
    }
}
