@extends('layouts.admin-app')

@section('title', 'RPG | Servers')

@section('content')
    <div class="container" style="max-height:600px; overflow-x: scroll; overflow-y:scroll ">
        <h1 class="d-flex flex-wrap gap-3 justify-content-between m-3">
            Servers
            <a href="{{ route('servers.create') }}" class="btn btn-primary mb-2">Add Server</a>
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
                    <th>Game</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servers as $server)
                    <tr>
                        <td>{{ $server->name }}</td>
                        <td>
                            <img src="{{ asset('uploads/servers/' . $server->image) }}" width="50" height="50">
                        </td>
                        <td>{{ $server->description }}</td>
                        <td>{{ $server->game_id }}</td>

                        <td>
                            <div class="d-flex flex-wrap justify-content-start gap-2">
                                
                                <a href="{{ route('servers.edit', $server->id) }}" class="btn btn-success"><i
                                        class="fas fa-edit"></i></a>
                                <form action="{{ route('servers.destroy', $server->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"
                                        onclick="return confirm('Do You Want To Delete The Server ?')"><i
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
