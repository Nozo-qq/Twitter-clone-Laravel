<div>
    <form action="{{ route('ideas.comment.store', $idea->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="content" class="fs-6 form-control" rows="1"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-sm"> Post Comment </button>
        </div>
    </form>
    <hr>
    <div class="d-flex align-items-start">
        <div class="w-100">
        </div>
    </div>
</div>
