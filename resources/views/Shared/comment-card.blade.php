<div class="d-flex align-items-center mb-3">

    <img style="width:35px" class="me-2 avatar-sm rounded-circle" src="{{ $comment->user->getImageURL() }}"
        alt="{{ $comment->user->name }}">

    <div class="flex-grow-1 d-flex flex-column">
        <div class="d-flex justify-content-between">

            <h6 class=""><a href="{{ route('profile', $comment->user) }}">{{ $comment->user->name }}</a></h6>

            <div class="d-flex align-items-center">

                <small class="fs-6 fw-light text-muted">
                    {{ $comment->created_at->diffForHumans() }}</small>

                @can('comment.edit', $comment)
                    <form action="{{ route('ideas.comment.destroy', [$comment->idea, $comment->id]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <a class="mx-2" href="{{ route('ideas.comment.edit', [$comment->idea, $comment->id]) }}"> Edit
                        </a>
                        <button class="btn btn-danger btn-sm"> X </button>
                    </form>
                @endcan
            </div>
        </div>
        <p class="fs-6 mt-3 fw-light">{{ $comment->content }}</p>
    </div>
</div>

<hr>
