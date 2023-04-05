<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;
use Illuminate\Http\Request;
use App\Http\Requests\ServerRequestValidation;

class ServerController extends Controller
{

    public function index()
    {
        $servers = Server::all();

        $responce = [
            'success' => true,
            'servers' => $servers
        ];

        return response()->json($responce, 200);
    }


    public function store(ServerRequestValidation $request)
    {
        $data = $request->validated();

        $data['image'] = treat_image($request->image);

        $server = Server::create($data);

        $responce = [
            'success' => true,
            'server' => $server
        ];

        return response()->json($responce, 200);
    }


    public function show(Server $server)
    {
        $responce = [
            'success' => true,
            'server' => $server
        ];

        return response()->json($responce, 200);
    }


    public function update(ServerRequestValidation $request, Server $server)
    {
        $data = $request->validated();

        if ($request->hasfile('image')) {
            delete_image($server->image);
            $data["image"] = treat_image($request->image);
        }

        $server->update($data);

        $responce = [
            'success' => true,
        ];

        return response()->json($responce, 200);
    }


    public function destroy(Server $server)
    {
        delete_image($server->image);

        $server->delete();

        $responce = [
            'success' => true,
        ];

        return response()->json($responce, 200);
    }
}
