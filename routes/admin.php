<?php

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

route::middleware(['auth', 'can:admin'])->prefix('/admin')->as('admin.')->group(function() {
    route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    route::resource('users', AdminUserController::class)->only('index');
    route::resource('ideas', AdminIdeaController::class)->only('index');

    route::get('/admins', [AdminUserController::class, 'admins_index'])->name('admins');
    route::get('/promote/{userId}', [AdminUserController::class, 'promote'])->name('promote');
});
