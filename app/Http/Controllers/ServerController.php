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


    public function update(ServerRequestValidation $request, $id)
    {
        $data = $request->validated();

        $server = Server::find($id);

        if (Server::where('name', $request->name)->first() && $request->name != $server->name) {
            $responce = [
                'success' => false,
                'errors' => [['This name is already taken']]
            ];

            return response()->json($responce, 401);
        }


        if ($request->hasfile('image')) {
            delete_image($server->image);
            $data["image"] = treat_image($request->image);
        } else {
            $data["image"] = $server->image;
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
