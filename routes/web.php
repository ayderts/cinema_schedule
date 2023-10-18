<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();
Route::group(['prefix'=>'admin'],function (){
    Route::get('/', [AdminController::class, 'index'])->name('home');
    Route::get('/movie/index', [MovieController::class, 'indexView'])->name('admin.movie.index');
    Route::get('/movie/store', [MovieController::class, 'storeView'])->name('admin.movie.store');
    Route::get('/movie/{movie}', [MovieController::class, 'showView'])->name('admin.movie.show');
    Route::get('/movie/{movie}/update', [MovieController::class, 'updateView'])->name('admin.movie.update');
    Route::post('/movie/store', [MovieController::class, 'store'])->name('movie.store');
    Route::patch('/movie/{movie}/update', [MovieController::class, 'update'])->name('movie.update');
    Route::delete('/movie/{movie}', [MovieController::class, 'destroy'])->name('movie.destroy');
    //->post('/individual/{individual:bin}/address', 'individualStore')

    Route::get('/session/index', [SessionController::class, 'indexView'])->name('admin.session.index');
    Route::get('/session/store', [SessionController::class, 'storeView'])->name('admin.session.store');
    Route::get('/session/{session}', [SessionController::class, 'showView'])->name('admin.session.show');
    Route::get('/session/{session}/update', [SessionController::class, 'updateView'])->name('admin.session.update');
    Route::post('/session/store', [SessionController::class, 'store'])->name('session.store')
        ->middleware('CheckSessionTimeStore');;
    Route::patch('/session/{session}/update', [SessionController::class, 'update'])->name('session.update')
        ->middleware('checkSessionTimeUpdate');
    Route::delete('/session/{session}', [SessionController::class, 'destroy'])->name('session.destroy');

})->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->name('home');
