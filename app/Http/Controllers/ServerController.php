<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;
use Illuminate\Http\Request;
use App\Http\Requests\ServerFormValidation;
use Illuminate\Support\Facades\File;


class ServerController extends Controller
{
    public function index()
    {
        //Fetch all games and servers
        $games = Game::all();
        $servers = Server::all();

        return view('admin.servers.index', compact(['servers', 'games']));
    }

    public function create()
    {
        //Fetch All Games
        $games = Game::all();

        return view('admin.servers.add', compact('games'));
    }

    public function store(ServerFormValidation $request)
    {
        //Store the validated data in $data
        $data = $request->validated();

        //Stock the image and give it a random name
        $file = $request->image;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/servers/', $filename);
        $data["image"] = $filename;

        //Create Server
        Server::create($data);

        //Rediret to servers page with a success message
        return redirect('admin/servers')->with('message', 'Server Has Been Added Successfuly');
    }

    public function show(Server $server)
    {
        //
    }

    public function edit(Server $server)
    {
        $games = Game::all();
        return view('admin.servers.edit', compact(['server', 'games']));
    }

    public function update(ServerFormValidation $request, Server $server)
    {
        $data = $request->validated();

        if ($request->hasfile('image')) {

            //Delete the image from upload folder
            $destination = 'uploads/servers/' . $server->image;
            if (File::exists($destination)) File::delete($destination);

            //Update the image
            $file = $request->image;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/servers/', $filename);
            $data["image"] = $filename;
        }

        $server->update($data);

        return redirect('admin/servers')->with('message', 'Server Has Been Updated Successfuly');
    }

    public function destroy(Server $server)
    {
        //Delete the image from upload folder
        $destination = 'uploads/servers/' . $server->image;
        if (File::exists($destination)) File::delete($destination);

        $server->delete();
        return redirect('admin/servers')->with('message', 'Server Has Been Deleted Successfuly');
    }

}
