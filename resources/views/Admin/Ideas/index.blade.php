@extends('Layouts.layout')
@section('title', 'Ideas table')
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
                        <th>User</th>
                        <th>Conetnt</th>
                        <th>Created At</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ideas as $idea)
                        <tr>
                            <td>{{ $idea->id }}</td>
                            <td><a href="{{ route('users.show', $idea->user) }}">{{ $idea->user->name }}</a></td>
                            <td>{{ $idea->content }}</td>
                            <td>{{ $idea->created_at->toDateString() }}</td>
                            <td>
                               -
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $ideas->links() }}
            </div>
        </div>
    </div>
@endsection
