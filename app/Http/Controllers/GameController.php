<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\GameRequestValidation;

class GameController extends Controller
{

    //Returns a JSON response containing all games in the database
    public function index()
    {

        $this->authorize('viewAny', Game::class);

        //Fetch all games from the database using the 'all' method from the Eloquent ORM
        $games = Game::all();

        //Construct a response object containing the fetched games
        $responce = [
            'success' => true,
            'games' => $games
        ];

        //Return the response as a JSON object with HTTP status code 200 (OK)
        return response()->json($responce, 200);
    }

    //Stores a new game in the database and returns a JSON response containing the new game
    public function store(GameRequestValidation $request)
    {

        $this->authorize('create', Game::class);

        //Get the validated data from the 'GameRequestValidation' object and assign it to a variable
        $data = $request->validated();

        //Assign the processed image file to the 'image' field in the $data array
        $data['image'] = treat_image($request->image);

        //Create a new 'Game' object with the $data array and save it to the database
        $game = Game::create($data);

        //Construct a response object containing the new game
        $responce = [
            'success' => true,
            'game' => $game
        ];

        //Return the response as a JSON object with HTTP status code 200 (OK)
        return response()->json($responce, 200);
    }



    //Returns a JSON response containing the specified game
    public function show(Game $game)
    {

        $this->authorize('view', Game::class);

        //Construct a response object containing the specified game
        $responce = [
            'success' => true,
            'game' => $game
        ];

        //Return the response as a JSON object with HTTP status code 200 (OK)
        return response()->json($responce, 200);
    }

    //Updates an existing game in the database and returns a JSON response
    public function update(GameRequestValidation $request, $id)
    {

        $this->authorize('update', Game::class);

        // Get the validated data from the request
        $data = $request->validated();

        // Find the game with the specified ID
        $game = Game::find($id);

        // Check if a game with the same name already exists, and return an error if it does
        if (Game::where('name', $request->name)->first() && $request->name != $game->name) {
            $responce = [
                'success' => false,
                'errors' => [['This name is already taken']]
            ];

            //Return the error as a JSON object with HTTP status code 401 (Unauthorized )
            return response()->json($responce, 401);
        }

        // If a new image has been uploaded, delete the old image and save the new one
        if ($request->hasfile('image')) {
            delete_image($game->image);
            $data["image"] = treat_image($request->image);
        } else {
            // If no new image has been uploaded, keep the existing image
            $data["image"] = $game->image;
        }

        // Update the game with the new data
        $game->update($data);

        $responce = [
            'success' => true,
        ];

        //Return the response as a JSON object with HTTP status code 200 (OK)
        return response()->json($responce, 200);
    }

    // Delete a game from the database and return a JSON response
    public function destroy(Game $game)
    {

        $this->authorize('delete', Game::class);

        // Delete the game image from the uploads folder
        delete_image($game->image);

        // Delete the game from the database
        $game->delete();

        $response = [
            'success' => true,
        ];

        //Return the response as a JSON object with HTTP status code 200 (OK)
        return response()->json($response, 200);
    }

    //Returns a JSON response containing the count of games
    public function count()
    {
        //Get the count of games
        $count_of_games = Game::count();

        //Construct a response object containing the count of games
        $response = [
            'success' => true,
            'count' => $count_of_games
        ];

        //Return the response as a JSON object with HTTP status code 200 (OK)
        return response()->json($response, 200);
    }
}
