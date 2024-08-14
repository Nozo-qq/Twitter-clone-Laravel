<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                    src="{{ $user->getImageURL() }}" alt="{{ $user->name }}">
                <div>
                    <h3 class="card-title mb-0"> {{ $user->name }} </h3>
                    <span class="fs-6 text-muted">@mario</span>
                </div>
            </div>
            @can('update', $user)
                <div>
                    <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                </div>
            @endcan
        </div>

        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio : </h5>

            <p class="fs-6 fw-light">
                {{ $user->bio }}
            </p>
            <div class="d-flex justify-content-start">
                <a class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                    </span> {{ $user->followers()->count() }} Followers </a>
                <a class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                    </span> {{ $user->ideas()->count() }} </a>
                <a class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                    </span> {{ $user->comments()->count() }} </a>
            </div>
            @auth
                @if (Auth::user()->isNot($user))
                    <div class="mt-3">
                        @if(Auth::user()->follows($user))
                            <form method="POST" action="{{ route('users.unfollow', $user->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm"> Unfollow </button>
                        @else
                            <form method="POST" action="{{ route('users.follow', $user->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                        @endif
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
<hr>
