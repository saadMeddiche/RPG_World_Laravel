@extends('layouts.admin-app')

@section('title', 'Servers | Edit')

@section('content')
    <div class="container">

        <h1 class="d-flex flex-wrap gap-3 justify-content-between ">
            Update Server
            <a href="{{ route('servers.index') }}" class="btn btn-primary mb-2">Back</a>
        </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('servers.update', $server->id) }}" method="post" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group mb-2">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $server->name }}">
            </div>

            <div class="form-group mb-2">
                <label for="">Description</label>
                <textarea type="text" class="form-control" rows="10" name="description">{{ $server->description }}</textarea>
            </div>

            <div class="form-group mb-2">
                <label for="">Image</label>
                <input type="file" class="form-control" name="image">
            </div>

            <div class="form-group mb-2">
                <label for="">Games</label>
                <select class="form-select" aria-label="Default select example" name="game_id">
                    @foreach ($games as $game)
                        <option value="{{ $game->id }}" {{ $game->id == $server->game_id ? 'selected' : '' }}>
                            {{ $game->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="btn btn-primary" name="update">Save</button>
            </div>
        </form>


    </div>
@endsection
