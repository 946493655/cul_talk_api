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
    $app->post('cate/parent', 'CateController@getParent');
    $app->post('cate/show', 'CateController@show');
    $app->post('cate/add', 'CateController@store');
    $app->post('cate/modify', 'CateController@update');
    //话题路由
    $app->post('talk', 'TalkController@index');
    $app->post('talk/show', 'TalkController@show');
    $app->post('talk/add', 'TalkController@store');
    $app->post('talk/modify', 'TalkController@update');
    $app->post('talk/setthumb', 'TalkController@setThumb');
    //话题点赞
    $app->post('talkclick', 'TalkClickController@index');
    $app->post('talkclick/add', 'TalkClickController@store');
    //评论路由
    $app->post('comment', 'CommentController@index');
    $app->post('comment/add', 'CommentController@store');
    //积分交易
    $app->post('integral', 'IntegralController@index');
    $app->post('integral/onebytalkid', 'IntegralController@getOneByTalkid');
    $app->post('integral/add', 'IntegralController@store');
    $app->post('integral/setuser', 'IntegralController@setUser');
    //参数统计
    $app->post('param/show', 'ParamController@show');
});