@extends('Layouts.layout')
@section('title', 'Comment edit')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('Shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('Shared.success-message')
            <hr>
            <div class="mt-3">
                <div>
                    <form action="{{ route('ideas.comment.update', [$comment->idea, $comment->id]) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="content" class="form-label">Comment Content:</label>
                            <textarea name="content" class="fs-6 form-control" id="content" rows="1" required>{{ $comment->content }}</textarea>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </form>
                    <hr>
                    <div class="d-flex align-items-start">
                        <div class="w-100">
                            <!-- Additional content or placeholders can go here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            @include('Shared.search-bar')
            @include('Shared.right-sidebar')
        </div>
    </div>
@endsection
