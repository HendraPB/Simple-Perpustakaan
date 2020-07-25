<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/', function () {
    return redirect('/home');
});
Route::get('/admin/home', function () {
    return redirect('/home');
});

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    });

    Route::get('/book', function () {
        return view('book');
    })->middleware('akses:book');

    Route::get('/list', function () {
        return view('list');
    })->middleware('akses:list');

    Route::get('/rent', function () {
        return view('rent');
    })->middleware('akses:rent');

    Route::get('/history', function () {
        return view('history');
    })->middleware('akses:history');

    Route::get('/admin', function () {
        return view('admin');
    })->middleware('akses:admin');
    Route::get('/member', function () {
        return view('member');
    })->middleware('akses:member');

    Route::get('/password', function () {
        return view('password');
    });

    Route::prefix('adminAPI')->group(function () {
        Route::resources([
            'book' => 'BookController',
            'rent' => 'RentController',
            'user' => 'UserController',
        ]);

        Route::get('admin', 'UserController@admin');
        Route::get('member', 'UserController@member');

        Route::get('history', 'RentController@history');

        Route::post('password', 'UserController@password');
    });
});
