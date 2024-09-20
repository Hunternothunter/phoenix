<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WatchController extends Controller
{
    public function index()
    {

        return view('watch.index', compact('video'));
    }
    public function show($id)
    {
        return view('watch.show', $id);
    }
}
