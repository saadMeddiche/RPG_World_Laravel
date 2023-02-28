@extends('layouts.app')
@section('Title', 'RPG | Home')
@section('content')
    <div class="container">

        <div class="col-md-12 d-flex flex-wrap justify-content-evenly gap-4">

            @foreach ($games as $game)
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('uploads/games/' . $game->image) }}" alt="Card image cap"
                        height="150">
                    <div class="card-body">
                        <h5 class="card-title">{{ $game->name }}</h5>
                        <p class="card-text">{{ $game->description }}</p>
                        <p class="card-text">30 servers | 500 player</p>
                        <a href="{{ route('Game-s-servers', $game->id) }}" class="btn btn-primary">Explore Servers</a>
                    </div>
                </div>
            @endforeach


        </div>

    </div>
@endsection
