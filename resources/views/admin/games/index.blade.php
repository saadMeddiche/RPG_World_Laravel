@extends('layouts.admin-app')
@section('title','RPG | Games')

@section('content')
    <div class="container" style="max-height:600px; overflow-x: scroll; overflow-y:scroll ">
        <h1 class="d-flex flex-wrap gap-3 justify-content-between m-3">
            Games
            <a href="{{ route('games.create') }}" class="btn btn-primary mb-2">Add Game</a>
        </h1>
        @if (session('message'))
            <div class="alert alert-success" id="alert">{{ session('message') }}</div>
            <script>
                setTimeout(function() {
                    document.getElementById('alert').style.opacity = '0';
                    document.getElementById('alert').remove();
                }, 3000);
            </script>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    {{-- <th>Servers</th>
                <th>Players</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($games as $game)
                    <tr>
                        <td>{{ $game->name }}</td>
                        <td>
                            <img src="{{ asset('uploads/games/' . $game->image) }}" width="50" height="50">
                        </td>
                        <td>{{ $game->description }}</td>
                        {{-- <td>{{ $game->Servers }}</td>
                    <td>{{ $game->Players }}</td> --}}
                        <td>
                            <div class="d-flex flex-wrap justify-content-start gap-2">
                                {{-- <a href="{{ route('games.show', $game->id) }}" class="btn btn-warning text-white"> <i
                                        class="fas fa-eye"></i></a> --}}
                                <a href="{{ route('games.edit', $game->id) }}" class="btn btn-success"><i
                                        class="fas fa-edit"></i></a>
                                <form action="{{ route('games.destroy', $game->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"
                                        onclick="return confirm('Do You Want To Delete The Game ?')"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
