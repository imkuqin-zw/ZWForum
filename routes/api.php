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

Route::group(['prefix' => 'admin','middleware' => 'auth:api','namespace' => 'Api\Admin','as' => 'api.admin.'], function () {
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
        Route::get('topic/gethotlist','TopicController@getHotTopic')->name('gethotlist');
        Route::get('topic/getnewlist','TopicController@getNewTopic')->name('getnewlist');
        Route::get('topic/getvotelist','TopicController@getTopicOrderByVote')->name('getvotelist');
        Route::get('topic/getreplylist','TopicController@getTopicOrderByReply')->name('getreplylist');
        Route::get('topic/{id}/cate','TopicController@getTopicByCate')->name('getTopicByCate');
        Route::get('topic/{id}/tag','TopicController@getTopicByTag')->name('getTopicByTag');
        Route::get('topic/{id}','TopicController@show')->name('show');
        Route::post('topic','TopicController@store')->name('create');

    });
    Route::get('user/{id}','UserController@show')->name('user.show');
    Route::group(['as' => 'cate.'],function (){
        Route::get('cate','CategoryController@index')->name('index');
        Route::get('cate/gethotlist','CategoryController@gethotlist')->name('gethotlist');
        Route::get('cate/{id}/topiclist','CategoryController@getTopicByCate')->name('getTopicByCate');
    });

});

Route::group(['middleware' => 'auth:api','namespace' => 'Api','as' => 'api.'], function () {
    Route::group(['as' => 'topic.'],function () {
        Route::post('topic/uploadimg','TopicController@uploadImg')->name('uploadImg');
        Route::post('topic', 'TopicController@store')->name('create');
        Route::put('topic/{id}/restore', 'TopicController@restore')->name('delete');
        Route::put('topic/{id}', 'TopicController@update')->name('update');
        Route::delete('topic/{id}/softdelete', 'TopicController@softDelete')->name('delete');
        Route::delete('topic/{id}', 'TopicController@destroy')->name('destroy');

    });
    Route::put('user/{id}','UserController@update')->name('user.update');
});
