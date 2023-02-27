@extends('layouts.admin-app')

@section('title', 'Servers | Add')

@section('content')
    <div class="container">

        <h1 class="d-flex flex-wrap gap-3 justify-content-between ">
            Add New Server
            <a href="{{ route('servers.index') }}" class="btn btn-primary mb-2">Back</a>
        </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('servers.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-2">
                <label for="">Games</label>
                <select class="form-select" aria-label="Default select example" name="game_id">
                    <option selected>Choose Game</option>
                    @foreach ($games as $game)
                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group mb-2">
                <label for="">Description</label>
                <textarea type="text" class="form-control" rows="10" name="description"></textarea>
            </div>

            <div class="form-group mb-2">
                <label for="">Image</label>
                <input type="file" class="form-control" name="image">
            </div>

            <div>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
            </div>
        </form>


    </div>
@endsection
