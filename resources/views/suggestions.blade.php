@extends('Layouts.layout')
@section('title', 'Suggestions')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('Shared.left-sidebar')
        </div>
        <div class="col-6">
            @forelse ($users as $user)
                <div class="mt-3">
                    @include('Shared.user-card')
                </div>
            @empty
                No Suggestions!.
            @endforelse
        </div>
    </div>
@endsection
