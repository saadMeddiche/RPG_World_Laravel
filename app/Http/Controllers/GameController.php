<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\GameRequestValidation;

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


    public function store(GameRequestValidation $request)
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


    public function update(GameRequestValidation $request, $id)
    {
        $data = $request->validated();

        $game = Game::find($id);

        if (Game::where('name', $request->name)->first() && $request->name != $game->name) {
            $responce = [
                'success' => false,
                'errors' => [['This name is already taken']]
            ];

            return response()->json($responce, 401);
        }

        if ($request->hasfile('image')) {
            delete_image($game->image);
            $data["image"] = treat_image($request->image);
        } else {
            $data["image"] = $game->image;
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
