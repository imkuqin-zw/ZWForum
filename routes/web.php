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

Auth::routes();
Route::get('auth/github', 'Auth\AuthController@redirectToProvider')->name('auth.github');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');
Route::post('auth/githuBind','Auth\AuthController@githuBind')->name('auth.githuBind');
Route::post('auth/githuRegister','Auth\AuthController@githuRegister')->name('auth.githuRegister');

Route::get('/', function () {
    return redirect(route('topic.index'));
});



Route::group(['middleware' => ['web']], function () {
    Route::group(['as' => 'topic.'], function () {
        Route::get('topic/create','TopicController@create')->name('create')->middleware('auth');
        Route::get('topic/{id}/edit','TopicController@edit')->name('edit')->middleware('auth');
        Route::get('topic/{id}','TopicController@show')->name('show');
        Route::get('topic','TopicController@index')->name('index');
        Route::match(['put', 'patch'],'topic/{id}/edit','TopicController@update')->name('update')->middleware('auth');
        Route::post('topic/uploadimg','TopicController@uploadImg')->name('uploadImg')->middleware('auth');
        Route::post('topic/vote','TopicController@vote')->name('vote')->middleware('auth');
        Route::post('topic','TopicController@store')->name('store')->middleware('auth');
        Route::delete('topic/{id}','TopicController@destroy')->name('delete')->middleware('auth');
    });
    Route::get('cate/{id}','CategoryController@show')->name('category.show');
    Route::get('tag/{id}','TagController@show')->name('tag.show');
    Route::post('reply','ReplyController@store')->name('reply.create')->middleware('auth');
    Route::delete('reply/{id}','ReplyController@destroy')->name('reply.delete')->middleware('auth');
   // Route::get('user/messages','UserController@getMessages')->name('user.getMessages');
    Route::get('user/notifications','UserController@getNotifications')->name('user.notifications');
    Route::get('user/mentions','UserController@getMentions')->name('user.mentions');
    Route::get('user/{id}/topics','UserController@getTopicsList')->name('user.topicsList');
    Route::get('user/{id}/replies','UserController@getRepliesList')->name('user.repliesList');
    Route::get('user/{id}/follower','UserController@getFollowerList')->name('user.followerList');
    Route::get('user/{id}/votes','UserController@getVotesList')->name('user.votesList');
    Route::get('user/{id}/edit','UserController@edit')->name('user.edit')->middleware('auth');
    Route::get('user/{id}/portrait','UserController@editPortrait')->name('user.editPortrait')->middleware('auth');
    Route::get('user/{id}/password','UserController@editPassword')->name('user.editPassword')->middleware('auth');
    Route::get('user/{id}','UserController@show')->name('user.show');
    Route::post('follower','UserController@follower')->name('follower.create')->middleware('auth');
    Route::delete('follower/{id}','UserController@followerDestroy')->name('follower.delete')->middleware('auth');
    Route::match(['put', 'patch'],'user/{id}/portrait','UserController@updatePortrait')->name('user.updatePortrait')->middleware('auth');
    Route::match(['put', 'patch'],'user/{id}/password','UserController@updatePassword')->name('user.updatePassword')->middleware('auth');
    Route::match(['put', 'patch'],'user/{id}','UserController@update')->name('user.update')->middleware('auth');

});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin_auth']], function () {
    Route::get('{path?}', 'AdminController@index')->where('path', '[\/\w\.-]*')->name('admin.index');;
});
