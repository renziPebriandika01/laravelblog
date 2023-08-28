<?php

use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------P
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => 'home'
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard.index', [
        "title"=>"dashboard"
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/admin', function () {
//     return view('dashboard.index', [
//         "name" => "Admin",
//         "title"=>"dashboard"
//     ]);
// })->middleware(['auth', 'verified', 'role:admin'])->name('admin');

Route::get('/penulis', function () {
    return view('dashboard.index', [
        "name" => "penulis"
    ]);
})->middleware(['auth', 'verified', 'role:penulis|admin'])->name('penulis');

Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'active' => 'about',
        'name' => 'Renzi',
        'email' => 'Renzi@gmail.com',

    ]);
});

Route::get('/posts', [PostController::class, 'index'])->name('posts')->middleware(['auth', 'verified', 'role_or_permission:lihat-tulisan|admin']);


Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware(['auth', 'verified', 'role_or_permission:lihat-tulisan|admin']);

Route::get('http://localhost:8000/dashboard/posts/checkSlug',[DashboardPostController::class,'checkSlug']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';