<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $games = Game::all();
        return view('home', compact('games'));
    }
}
