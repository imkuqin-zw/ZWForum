<?php

//use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'admin','middleware' => ['auth:api','banned_auth'],'namespace' => 'Api\Admin','as' => 'api.admin.'], function () {
    Route::get('user/perms','UserController@getPerms')->name('user.perms');
    Route::resource('user','UserController');
    Route::resource('tag','TagController');
    Route::resource('cate','CategoryController');
    Route::resource('topic','TopicController');
    Route::resource('reply','ReplyController');
    Route::resource('role','RoleController');
    Route::post('user/roles','UserController@attachUserRole')->name('user.attach');
    Route::get('perms','RoleController@showPermissions')->name('permission.index');
    Route::post('role/perms','RoleController@attachRolePerms')->name('role.attach');

});

Route::group(['namespace' => 'Api','as' => 'api.'], function () {
    Route::group(['as' => 'topic.'],function (){
        Route::get('topic/{id}/cate','TopicController@getTopicByCate')->name('getTopicByCate');
        Route::get('topic/{id}/tag','TagController@showTopicList')->name('getTopicByTag');
        Route::get('topic/{id}','TopicController@show')->name('show');
        Route::get('topic','TopicController@index')->name('topicList');
    });
    Route::get('user/banned','UserController@isBanned')->name('user.banned');
    Route::get('user/{id}/topic','UserController@getUserTopic')->name('user.getUserTopic');
    Route::get('user/{id}/reply','UserController@getUserReply')->name('user.getUserReply');
    Route::get('user/{id}/vote','UserController@getUserVote')->name('user.getUserVote');
    Route::get('user/{id}/follower','UserController@getUserFollower')->name('user.getUserFollower');
    Route::get('user/{id}','UserController@getBaseInfo')->where('id', '[0-9]+')->name('user.getBaseInfo');
    Route::post('register','UserController@register')->name('user.register');

    Route::get('cate/showlist','CategoryController@showList')->name('cate.showList');
    Route::get('tag/showlist','TagController@showList')->name('tag.showList');

    Route::get('reply/{id}','ReplyController@index')->name('reply.index');
    Route::get('search','SearchController@search')->name('search');


});

Route::group(['middleware' => ['auth:api','api_banned_auth'],'namespace' => 'Api','as' => 'api.'], function () {
    Route::group(['as' => 'topic.'],function () {
        Route::post('topic/uploadimg','TopicController@uploadImg')->name('uploadImg');
        Route::post('topic', 'TopicController@store')->name('create');
//        Route::put('topic/{id}/restore', 'TopicController@restore')->name('restore');
        Route::put('topic/{id}', 'TopicController@update')->name('update');
//        Route::delete('topic/{id}/softdelete', 'TopicController@softDelete')->name('delete');
        Route::delete('topic/{id}', 'TopicController@destroy')->name('destroy');
        Route::get('tag/editlist','TagController@editList')->name('tag.editList');
        Route::get('cate/editlist','CategoryController@editList')->name('cate.editList');
        Route::get('user/selfbaseinfo','UserController@getLogUserBaseInfo')->name('user.getLogUserBaseInfo');
        Route::put('user/{id}/portrait','UserController@updatePortrait')->name('user.updatePortrait');
        Route::put('user/{id}/password','UserController@updatePassword')->name('user.updatePassword');


        Route::put('user/{id}','UserController@update')->name('user.update');

        Route::post('reply','ReplyController@store')->name('reply.create');
        Route::delete('reply/{id}','ReplyController@destroy')->name('reply.delete');
    });

});
