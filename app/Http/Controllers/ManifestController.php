<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManifestController extends Controller
{
    /**/ 
    public function index() {
        $manifest = config('laravelpwa');
        $manifest['manifest']['start_url'] = route('home') . '/';

        return response()->json($manifest['manifest']);
    }
}
