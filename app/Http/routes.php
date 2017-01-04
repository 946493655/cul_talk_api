<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});


//话题管理
$app->group(['prefix' => 'api/v1', 'namespace'=>'App\Http\Controllers\Talk'], function () use ($app) {
    //话题管理
    $app->post('talk', 'TalkController@index');
    $app->post('talk/add', 'TalkController@store');
    $app->post('talk/modify', 'TalkController@update');
    $app->post('talk/show', 'TalkController@show');
    $app->post('talk/isdel', 'TalkController@setDel');
    $app->post('talk/delete', 'TalkController@forceDelete');
    //点赞
    $app->post('talkclick', 'TalkClickController@getListByUid');
    //收藏
    $app->post('talkcollect', 'TalkCollectController@getListByUid');
    //关注
    $app->post('talkfollow', 'TalkFollowController@getListByUid');
});


//专栏管理
$app->group(['prefix' => 'api/v1', 'namespace'=>'App\Http\Controllers\Theme'], function () use ($app) {
    //专栏管理
    $app->post('theme', 'ThemeController@index');
    $app->post('theme/add', 'ThemeController@store');
    $app->post('theme/modify', 'ThemeController@update');
    $app->post('theme/show', 'ThemeController@show');
    $app->post('theme/isdel', 'ThemeController@setDel');
    $app->post('theme/delete', 'ThemeController@forceDelete');
    $app->post('theme/all', 'ThemeController@all');
});