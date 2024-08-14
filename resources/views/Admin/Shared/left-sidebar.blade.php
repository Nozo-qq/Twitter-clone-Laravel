<div class="card overflow-hidden">
    <div class="card-body pt-1 pb-1">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-1">
            <li class="nav-item">
                <a class="{{ (Route::is('admin.dashboard')) ? 'nav-link text-dark' : 'nav-link'}}" href="{{ route('admin.dashboard') }}">
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="{{ (Route::is('admin.users.index')) ? 'nav-link text-dark' : 'nav-link'}}" href="{{ route('admin.users.index') }}">
                    <span>Users</span></a>
            </li>
            <li class="nav-item">
                <a class="{{ (Route::is('admin.admins')) ? 'nav-link text-dark' : 'nav-link'}}" href="{{ route('admin.admins') }}">
                    <span>Admins</span></a>
            </li>
            <li class="nav-item">
                <a class="{{ (Route::is('admin.ideas.index')) ? 'nav-link text-dark' : 'nav-link'}}" href="{{ route('admin.ideas.index') }}">
                    <span>Ideas</span></a>
            </li>
        </ul>
    </div>
    <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm" href="{{ route('language', 'en') }}">en</a>
        <a class="btn btn-link btn-sm" href="{{ route('language', 'es') }}">es</a>
        <a class="btn btn-link btn-sm" href="{{ route('language', 'fr') }}">fr</a>
    </div>
</div>
