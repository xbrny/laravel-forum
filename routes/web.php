<?php

Route::get('/discussions/{discussion}/watch', 'WatcherController@watch')->name('watch');
Route::get('/discussions/{discussion}/unwatch', 'WatcherController@unwatch')->name('unwatch');

Route::resource('replies', 'ReplyController')->except('index', 'show', 'create');
Route::get('replies/{reply}/best', 'ReplyController@best')->name('replies.best');

Route::resource('discussions', 'DiscussionController');

Route::resource('topics', 'TopicController');

Route::get('/login/{provider}/redirect', 'Auth\LoginController@redirectServiceProvider')->name('github.login');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'DiscussionController@index')->name('home');

Auth::routes();