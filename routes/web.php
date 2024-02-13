<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = [];
    if(auth()->check()){
        $posts = auth()->user()->userCoolPosts()->latest()->get();
        //$posts = Post::where('user_id', auth()->id())->get(); //alternative way
    }

    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'register_method'])->name('register');
Route::post('/logout', [UserController::class, 'logout_method']);
Route::post('/login', [UserController::class, 'login_method'])->name('login');

//Blog post related routes:
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditPostScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);