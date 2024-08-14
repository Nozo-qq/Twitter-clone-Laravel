@extends('Layouts.layout')
@section('title', 'Users table')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('Admin.Shared.left-sidebar')
        </div>
        <div class="col-9">
            <h1>Users</h1>
            <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined At</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->toDateString() }}</td>
                            <td>
                                <a href="{{ route('admin.promote', $user->id) }}">Promote</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
