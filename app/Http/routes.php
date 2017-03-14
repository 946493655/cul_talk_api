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


/***
 * 专栏
 */
$app->group(['prefix' => 'api/v1', 'namespace'=>'App\Http\Controllers'], function () use ($app) {
    //专栏路由
    $app->post('topic', 'TopicController@index');
    $app->post('topic/show', 'TopicController@show');
    $app->post('topic/all', 'TopicController@getAll');
    $app->post('topic/add', 'TopicController@store');
    $app->post('topic/modify', 'TopicController@update');
    //类别路由
    $app->post('cate', 'CateController@index');
    $app->post('cate/catesbypid', 'CateController@getCatesByPid');
    $app->post('cate/catesbylimit', 'CateController@getCatesByLimit');
    $app->post('cate/catesbytopic', 'CateController@getCatesByTopic');
    $app->post('cate/show', 'CateController@show');
    $app->post('cate/add', 'CateController@store');
    $app->post('cate/modify', 'CateController@update');
    //话题管理
    $app->post('talk', 'TalkController@index');
    $app->post('talk/add', 'TalkController@store');
    $app->post('talk/modify', 'TalkController@update');
    $app->post('talk/show', 'TalkController@show');
});


////话题管理
//$app->group(['prefix' => 'api/v1', 'namespace'=>'App\Http\Controllers\Talk'], function () use ($app) {
//    //点赞
//    $app->post('talkclick', 'TalkClickController@getListByUid');
//    //收藏
//    $app->post('talkcollect', 'TalkCollectController@getListByUid');
//    //关注
//    $app->post('talkfollow', 'TalkFollowController@getListByUid');
//});