@include('Shared.edit-comment-card')
@foreach ($idea->comments as $comment)
    <div class="mt-3">
    @include('Shared.comment-card')
    </div>
@endforeach
