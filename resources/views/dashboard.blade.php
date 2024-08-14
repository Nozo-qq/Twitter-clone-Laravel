@extends('Layouts.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('Shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('Shared.success-message')
            @include('Shared.submit-idea')
            <hr>
            @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('Shared.idea-card')
                </div>
            @empty
                No Ideas!.
            @endforelse

            @if($ideas->count() > 0)
            <div class="mt-3">
                {{ $ideas->withQueryString()->links() }}
            </div>
            @endif
        </div>
        <div class="col-3">
            @include('Shared.search-bar')
            @include('Shared.right-sidebar')
        </div>
    </div>
@endsection
