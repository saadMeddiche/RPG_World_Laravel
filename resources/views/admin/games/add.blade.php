@extends('layouts.admin-app')

@section('title','Games | Add')

@section('content')
    <div class="container">

        <h1 class="d-flex flex-wrap gap-3 justify-content-between ">
            Add New Game
            <a href="{{ route('games.index') }}" class="btn btn-primary mb-2">Back</a>
        </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('games.store') }}" method="post" enctype="multipart/form-data">

            @csrf

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
