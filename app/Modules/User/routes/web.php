<?php
Route::group(['module' => 'User', 'middleware' => ['web', 'auth'], 'namespace' => 'App\Modules\User\Controllers'], function() {
    Route::get('/follow/{channel}', array('as' => 'user.follow', 'uses' => 'UserController@follow'));
    Route::get('/user/search', array('as' => 'user.search', 'uses' => 'UserController@search'));
    Route::get('/getFollowingList', array('as' => 'user.getFollowingList', 'uses' => 'UserController@getFollowingList'));
    Route::resource('user', 'UserController');
});

Route::any('/events/{userId}', array('as' => 'user.events', 'uses' => 'App\Modules\User\Controllers\UserController@events'));
