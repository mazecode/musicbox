<?php

Route::get('/', 'HomeController@index')->name('home');

// Auth Routes
// Auth::routes();

// Socialite Routes
// Route::get('login/{driver}', 'SocialController@login');
// Route::get('login/{driver}/callback', 'SocialController@callback');

// SPA Routes
// Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');