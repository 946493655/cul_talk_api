<?php
namespace App\Http\Controllers;

use App\Models\CommentModel;

class CommentController extends BaseController
{
    /**
     * 评论
     */

    public function index()
    {
        $uid = $_POST['uid'];
        $talkid = $_POST['talkid'];
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;
        $page = isset($_POST['page'])?$_POST['page']:1;
        $start = $limit * ($page - 1);
        if ($uid && $talkid) {
            $query = CommentModel::where('uid',$uid)
                ->where('talkid',$talkid);
        } else if (!$uid && $talkid) {
            $query = CommentModel::where('talkid',$talkid);
        } else if ($uid && !$talkid) {
            $query = CommentModel::where('uid',$uid);
        }
        if (isset($query)) {
            $models = $query->skip($start)
                ->take($limit)
                ->get();
            $total = $query->count();
        } else {
            $models = CommentModel::skip($start)
                ->take($limit)
                ->get();
            $total = CommentModel::count();
        }
        if (!count($models)) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->getCommentModel($model);
        }
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
            'pagelist' =>  [
                'total' =>  $total,
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    public function store()
    {
        $uid = $_POST['uid'];
        $talkid = $_POST['talkid'];
        $intro = $_POST['intro'];
        if (!$uid || !$talkid || !$intro) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'uid'   =>  $uid,
            'talkid'    =>  $talkid,
            'intro'     =>  $intro,
            'created_at'    =>  time(),
        ];
        CommentModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }





    public function getCommentModel($model)
    {
        $data = $this->objToArr($model);
        $data['createTime'] = $model->createTime();
        $data['updateTime'] = $model->updateTime();
        $data['talkName'] = $model->getTalkName();
        return $data;
    }
}