<?php
Route::get('', 'HomeController@index')->name('index');

Route::get('{id}', 'ForumsController@show')->name('show');

Route::get('{id}/nuevo', 'ForumsTopicsController@create')->middleware('auth')->name('create');
Route::post('{id}/nuevo', 'ForumsTopicsController@store')->middleware('auth')->name('store');
Route::get('{foro_id}/{tema_id}', 'ForumsTopicsController@show')->name('showTopic');
Route::post('{foro_id}/{tema_id}', 'ForumsTopicsController@storeReply')->middleware('auth')->name('storeReply');