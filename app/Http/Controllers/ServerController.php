<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ServerRequestValidation;

class ServerController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Server::class);

        $servers = Server::all();

        $responce = [
            'success' => true,
            'servers' => $servers
        ];

        return response()->json($responce, 200);
    }


    public function store(ServerRequestValidation $request)
    {
        $this->authorize('create', Server::class);

        $data = $request->validated();

        $data['image'] = treat_image($request->image);
        $data['user_id'] = auth()->id();

        $server = Server::create($data);

        $responce = [
            'success' => true,
            'server' => $server,
            'data' => $data
        ];

        return response()->json($responce, 200);
    }


    public function show(Server $server)
    {
        $this->authorize('view', Server::class);

        $responce = [
            'success' => true,
            'server' => $server
        ];

        return response()->json($responce, 200);
    }


    public function update(ServerRequestValidation $request, $id)
    {
        $this->authorize('update', Server::class);

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
        $this->authorize('delete', Server::class);

        delete_image($server->image);

        $server->delete();

        $responce = [
            'success' => true,
        ];

        return response()->json($responce, 200);
    }

    //Returns a JSON response containing the count of servers
    public function count()
    {
        //Get the count of servers
        $count_of_servers = Server::count();

        //Construct a response object containing the count of servers
        $response = [
            'success' => true,
            'count' => $count_of_servers
        ];

        //Return the response as a JSON object with HTTP status code 200 (OK)
        return response()->json($response, 200);
    }
}
