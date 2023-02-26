@extends('layouts.app')

@section('content')
    <div class="container">

        <h1 class="d-flex flex-wrap gap-3 justify-content-between ">
            Update Game
            <a href="{{ route('games.index') }}" class="btn btn-primary mb-2">Back</a>
        </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('games.update', $game->id) }}" method="post" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group mb-2">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $game->name }}">
            </div>

            <div class="form-group mb-2">
                <label for="">Description</label>
                <textarea type="text" class="form-control" rows="10" name="description">{{ $game->description }}</textarea>
            </div>

            <div class="form-group mb-2">
                <label for="">Image</label>
                <input type="file" class="form-control" name="image">
            </div>

            <div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </div>
        </form>


    </div>
@endsection
