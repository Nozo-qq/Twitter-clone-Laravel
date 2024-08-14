@extends('Layouts.layout')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('Shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('Shared.success-message')
            <hr>
            <div class="mt-3">
                @include('Shared.user-card')
            </div>
            @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('Shared.idea-card')
                </div>
            @empty
                No Ideas by {{ $user->name }}!.
            @endforelse
            <div class="mt-3">
                {{ $ideas->withQueryString()->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('Shared.search-bar')
            @include('Shared.right-sidebar')
        </div>
    </div>
@endsection
