<?php
Route::group(['prefix' => 'articles', 'as' => 'admin.articles.', 'middleware' => 'App\Http\Middleware\PermissionMiddleware:1'], function () {
    Route::get('/', function ()    {
        return view('admin.articles.home');
    });
    Route::get ('/addEdit/{id}', 'Articles\ArticlesController@show')->name('show');
    Route::post ('/addEdit', 'Articles\ArticlesController@store');
    Route::post ('/addEdit/{id}', 'Articles\ArticlesController@update');

    Route::get('/addEdit', function ()    {
        return view('admin.articles.addEdit');
    });

    //Ajax
    Route::group(['prefix' => 'ajax'], function () {
        Route::get ('/getGame', 'Games\GamesController@getGameAjax');
    });

});

Route::group(['prefix' => 'games', 'as' => 'admin.games.'], function () {
    Route::get ('/addEdit/{id}', 'Games\GamesController@show')->name('show');
    Route::post ('/addEdit', 'Games\GamesController@store');
    Route::post ('/addEdit/{id}', 'Games\GamesController@update');
    Route::get('/addEdit', function ()    {
        return view('admin.games.addEdit');
    });
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/addEdit', function ()    {
        return view('admin.users.addEdit');
    });
});

Route::group(['prefix' => 'categories', 'as' => 'admin.categories.'], function () {
    Route::get('/', function ()    {
        return view('admin.categories.home');
    })->name('home');
    Route::get('/addEdit', function ()    {
        return view('admin.categories.addEdit');
    });
    Route::get ('/addEdit/{id}', 'Articles\CategoriesController@show')->name('show');
    Route::post ('/addEdit', 'Articles\CategoriesController@store');
    Route::post ('/addEdit/{id}', 'Articles\CategoriesController@update');
    Route::post ('/addEdit/{id}/destroy', 'Articles\CategoriesController@destroy');
});

Route::group(['prefix' => 'developers'], function () {
    Route::get('/addEdit', function ()    {
        return view('admin.developers.addEdit');
    });
});

Route::group(['prefix' => 'distributors'], function () {
    Route::get('/addEdit', function ()    {
        return view('admin.distributors.addEdit');
    });
});

Route::group(['prefix' => 'permissions'], function () {
    Route::get('/addEdit', function ()    {
        return view('admin.permissions.addEdit');
    });
});

Route::group(['prefix' => 'roles'], function () {
    Route::get('/addEdit', function ()    {
        return view('admin.roles.addEdit');
    });
});