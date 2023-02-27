<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;
use Illuminate\Http\Request;
use App\Http\Requests\ServerFormValidation;
use Illuminate\Support\Facades\File;


class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        $servers = Server::all();
        return view('admin.servers.index', compact(['servers', 'games']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = Game::all();
        return view('admin.servers.add', compact('games'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServerFormValidation $request)
    {

        $data = $request->validated();


        $server = new Server();

        $server->name = $data['name'];
        $server->description = $data['description'];
        $server->game_id = $data['game_id'];

        $file = $request->image;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/servers/', $filename);

        $server->image = $filename;

        $server->save();

        return redirect('admin/servers')->with('message', 'Server Has Been Added Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server)
    {
        $games = Game::all();
        return view('admin.servers.edit', compact(['server', 'games']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(ServerFormValidation $request, Server $server)
    {
        $data = $request->validated();

        $server->name = $data['name'];
        $server->description = $data['description'];
        $server->game_id = $data['game_id'];

        if ($request->hasfile('image')) {

            //Delete the image from upload folder
            $destination = 'uploads/servers/' . $server->image;
            if (File::exists($destination)) File::delete($destination);

            //Update the image
            $file = $request->image;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/servers/', $filename);
            $server->image = $filename;
        }


        $server->update();

        return redirect('admin/servers')->with('message', 'Server Has Been Updated Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        //Delete the image from upload folder
        $destination = 'uploads/servers/' . $server->image;
        if (File::exists($destination)) File::delete($destination);

        $server->delete();
        return redirect('admin/servers')->with('message', 'Server Has Been Deleted Successfuly');
    }
}
