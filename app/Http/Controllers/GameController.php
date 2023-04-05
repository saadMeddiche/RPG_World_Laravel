<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index()
    {
        $games = Game::all();

        $responce = [
            'success' => true,
            'games' => $games
        ];

        return response()->json($responce, 200);
    }


    public function store(Request $request)
    {
        $data = $request->validated();

        $data['image'] = treat_image($request->image);

        $game = Game::create($data);

        $responce = [
            'success' => true,
            'game' => $game
        ];

        return response()->json($responce, 200);
    }

    public function show(Game $game)
    {

        $responce = [
            'success' => true,
            'game' => $game
        ];

        return response()->json($responce, 200);
    }


    public function update(Request $request, Game $game)
    {
        $data = $request->validated();

        if ($request->hasfile('image')) {
            delete_image($game->image);
            $data["image"] = treat_image($request->image);
        }

        $game->update($data);

        $responce = [
            'success' => true,
        ];

        return response()->json($responce, 200);
    }

    public function destroy(Game $game)
    {
        delete_image($game->image);

        $game->delete();

        $responce = [
            'success' => true,
        ];

        return response()->json($responce, 200);
    }
}
