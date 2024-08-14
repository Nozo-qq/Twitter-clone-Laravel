<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{ $idea->user->getImageURL() }}"
                    alt="{{ $idea->user->name }} Avatar">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user_id) }}"> {{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>

            <div>
                <form action="{{ route('ideas.destroy', $idea->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <a href="{{ route('ideas.show', $idea->id) }}"> View </a>
                    @can('update', $idea)
                        <a class="mx-2" href="{{ route('ideas.edit', $idea->id) }}"> Edit </a>
                        <button class="ms-1 btn btn-danger btn-sm"> X </button>
                    @endcan
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{ route('ideas.update', $idea->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3">{{ $idea->content }}</textarea>
                    @error('content')
                        <span class="d-block fs-6 test-danger mt-2" style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark mt-2"> update </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-start">
                @if (auth()->user() != null)
                    <form action="{{ auth()->user()->hasLikedIdea($idea) ? route('ideas.dislike', $idea->id) : route('ideas.like', $idea->id) }}" method="POST" class="text-decoration-none fw-light nav-link fs-6 me-3 align-items-center">
                        @csrf
                        <input type="hidden" name="idea_id" value="{{ $idea->id }}">
                        <button type="submit" class="btn p-0 border-0 text-reset">
                            <span class="fas fa-heart me-1"></span>
                            {{ $idea->likes_count }}
                        </button>
                    </form>
                @else
                    <form action="{{ route('ideas.like', $idea->id) }}" method="POST" class="text-decoration-none fw-light nav-link fs-6 me-3 align-items-center">
                        @csrf
                        <input type="hidden" name="idea_id" value="{{ $idea->id }}">
                        <button type="submit" class="btn p-0 border-0 text-reset">
                            <span class="fas fa-heart me-1"></span>
                            {{ $idea->likes_count }}
                        </button>
                    </form>
                @endif

                <a class="fw-light nav-link fs-6 me-3">
                    <span class="fas fa-comment me-1"></span>
                    {{ $idea->comments()->count() }}
                </a>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->updated_at->diffForHumans() }}</span>
            </div>
        </div>
        @if($show ?? false)
            @include('Shared.comments-box')
        @endif
    </div>
</div>
