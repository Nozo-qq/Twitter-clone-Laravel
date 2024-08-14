<div class="card overflow-hidden">
    <div class="card-body pt-1 pb-1">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-1">
            <li class="nav-item">
                <a class="{{ (Route::is('dashboard')) ? 'nav-link text-dark' : 'nav-link'}}" href="{{ route('dashboard') }}">
                    <span>Home</span></a>
            </li>
            <li class="nav-item">
                <a class="{{ (Route::is('feed')) ? 'nav-link text-dark' : 'nav-link'}}" href="{{ route('feed') }}">
                    <span>Feed</span></a>
            </li>
            <li class="nav-item">
                <a class="{{ (Route::is('suggestions')) ? 'nav-link text-dark' : 'nav-link'}}" href="{{ route('suggestions') }}">
                    <span>People you may know</span></a>
            </li>
        </ul>
    </div>
    <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm" href="{{ route('language', 'en') }}">en</a>
        <a class="btn btn-link btn-sm" href="{{ route('language', 'es') }}">es</a>
        <a class="btn btn-link btn-sm" href="{{ route('language', 'fr') }}">fr</a>
    </div>
</div>
