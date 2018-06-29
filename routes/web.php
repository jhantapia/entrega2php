<?php

// home
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/inicio');
})->name('home');

// login y asociados GUEST
Route::get('/inicio', 'IndexController@index')->name('inicio');
Route::get('/login', 'LoginController@showLogin')->name('login.show');
Route::post('/login', 'LoginController@login')->name('login');
Route::post('/logout', 'LoginController@logout')->name('logout');
Route::get('/login/send-password', 'LoginController@showSendPassword')->name('login.show-send-password');
Route::post('/login/send-password', 'LoginController@sendPassword')->name('login.send-password');
Route::get('/login/recovery-password', 'LoginController@showRecoveryPassword')->name('login.show-recovery-password');
Route::post('/login/recovery-password', 'LoginController@recoveryPassword')->name('login.recovery-password');
Route::get('/books', 'BooksController@getAll')->name('books.all-public');

// todas las rutas al menos debes estar auntenficado
Route::middleware('auth')->group(function () {

    //dasboards
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard/asigna-vs-aprob','DashboardController@getAsignVsAprob')->name('dashboard.get-asigna-vs-aprob');
    Route::get('/dashboard/nodes-statuses','DashboardController@getNodesStatuses')->name('dashboard.get-nodes-statuses');

    // pefil de usuario
    Route::prefix('profile')->group(function () {
        /*Route::get('/', function () {
            return view('sections.profile.index');
        })->name('profile');*/
        Route::get('/', 'UserController@getProfile')->name('profile');
        Route::post('update-profile', 'ProfileController@updateProfile')->name('update-profile');
        Route::post('change-password', 'ProfileController@changePassword')->name('change-password');
    });

    //ADMIN
    //gestion de usuarios
    Route::middleware('admin')->group(function () {

        Route::prefix('management-users')->group(function () {
            Route::get('/', 'UserController@index')->name('management.users');
            Route::get('/all', 'UserController@getAll')->name('management.users.all');
            Route::get('/create', 'UserController@create')->name('management.users.create');
            Route::post('/store', 'UserController@store')->name('management.users.store');
            Route::post('/update', 'UserController@update')->name('management.users.update');
            Route::post('/change-status', 'UserController@changeStatus')->name('management.users.change-status');
            Route::post('/destroy', 'UserController@destroy')->name('management.users.destroy');
        });





        Route::prefix('config')->group(function () {
            Route::prefix('publisher')->group(function () {
                Route::get('/', 'PublishersController@index')->name('publishers');
                Route::get('/all', 'PublishersController@getAll')->name('publishers.all');
                Route::get('/create', 'PublishersController@create')->name('publishers.create');
                Route::post('/store', 'PublishersController@store')->name('publishers.store');
                Route::post('/update', 'PublishersController@update')->name('publishers.update');
                Route::post('/change-status', 'PublishersController@changeStatus')->name('publishers.change-status');
                Route::post('/destroy', 'PublishersController@destroy')->name('publishers.destroy');
            });

            Route::prefix('author')->group(function () {
                Route::get('/', 'AuthorsController@index')->name('authors');
                Route::get('/all', 'AuthorsController@getAll')->name('authors.all');
                Route::get('/create', 'AuthorsController@create')->name('authors.create');
                Route::post('/store', 'AuthorsController@store')->name('authors.store');
                Route::post('/update', 'AuthorsController@update')->name('authors.update');
                Route::post('/change-status', 'AuthorsController@changeStatus')->name('authors.change-status');
                Route::post('/destroy', 'AuthorsController@destroy')->name('authors.destroy');
            });

            Route::prefix('book')->group(function () {
                Route::get('/', 'BooksController@index')->name('books');
                Route::get('/all', 'BooksController@getAll')->name('books.all');
                Route::get('/create', 'BooksController@create')->name('books.create');
                Route::post('/store', 'BooksController@store')->name('books.store');
                Route::post('/update', 'BooksController@update')->name('books.update');
                Route::post('/change-status', 'BooksController@changeStatus')->name('books.change-status');
                Route::post('/destroy', 'BooksController@destroy')->name('books.destroy');
            });
         });

    });

});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
