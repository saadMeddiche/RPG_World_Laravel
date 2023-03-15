@extends('layouts.app')
@section('Title', $game->name . ' | Servers')
@section('content')
    <div class="container">

        @if (count($servers) != 0)

            <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                <h3>
                    Servers Of {{ $game->name }}
                </h3>
                <div class="d-flex">
                    <form action="{{ route('Game-s-servers',$game->id) }}" method="get">
                        @csrf
                        <input type="text" name="" id="">
                        <button type="submit" name="search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
            </div>

            <div class="col-md-12 d-flex flex-wrap justify-content-evenly gap-4">

                @foreach ($servers as $server)
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset('uploads/servers/' . $server->image) }}"
                            alt="Card image cap" height="150">
                        <div class="card-body">
                            <h5 class="card-title">{{ $server->name }}</h5>
                            <p class="card-text">{{ $server->description }}</p>
                            <p class="card-text"> 20 player</p>
                            <a href="#" class="btn btn-primary">Explore</a>
                        </div>
                    </div>
                @endforeach


            </div>
        @else
            <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                <h3>
                    {{ $game->name }} Has No Servers Yet :(
                </h3>
                <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
            </div>

        @endif


    </div>
@endsection
