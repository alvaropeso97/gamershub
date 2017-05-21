<?php

Route::get ('/ajax/getEvento', 'EventController@getEventAjax'); //AJAX

Route::get ('/{id}/{seo_optimized_title}', 'EventController@show')->name('show');
Route::get ('/{id}', 'EventController@showRedirect')->name('showRedirect');
