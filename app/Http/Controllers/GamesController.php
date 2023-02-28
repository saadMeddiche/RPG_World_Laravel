<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Validator;
use App\Http\Requests\GameFormValidation;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        return view('admin.games.index', compact('games'));
    }

    public function showServers($game_id)
    {
        $game = Game::find($game_id);
        $servers = $game->Servers()->get();
        return view('user.serversOfGame', compact(['servers', 'game']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.games.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameFormValidation $request)
    {
        $data = $request->validated();

        $game = new Game();

        $game->name = $data['name'];
        $game->description = $data['description'];

        $file = $request->image;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/games/', $filename);

        $game->image = $filename;

        $game->save();

        return redirect('admin/games')->with('message', 'Game Has Been Added Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(GameFormValidation $request, Game $game)
    {

        $data = $request->validated();

        $game->name = $data['name'];
        $game->description = $data['description'];

        if ($request->hasfile('image')) {

            //Delete the image from upload folder
            $destination = 'uploads/games/' . $game->image;
            if (File::exists($destination)) File::delete($destination);

            //Update the image
            $file = $request->image;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/games/', $filename);
            $game->image = $filename;
        }


        $game->update();

        return redirect('admin/games')->with('message', 'Game Has Been Updated Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //Delete the image from upload folder
        $destination = 'uploads/games/' . $game->image;
        if (File::exists($destination)) File::delete($destination);

        $game->delete();
        return redirect('admin/games')->with('message', 'Game Has Been Deleted Successfuly');
    }
}
