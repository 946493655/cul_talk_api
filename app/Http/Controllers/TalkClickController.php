<?php
namespace App\Http\Controllers;

use App\Models\Talk\ClickModel;

class TalkClickController extends BaseController
{
    /**
     * 点赞
     */

    public function index()
    {
        $talkid = $_POST['talkid'];
        $uid = $_POST['uid'];
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;
        $page = isset($_POST['page'])?$_POST['page']:1;
        $start = $limit * ($page - 1);

        if ($talkid && $uid) {
            $query = ClickModel::where('talkid',$talkid)
                ->where('uid',$uid);
        } else if (!$talkid && $uid) {
            $query = ClickModel::where('uid',$uid);
        } else if ($talkid && !$uid) {
            $query = ClickModel::where('talkid',$talkid);
        }
        if (isset($query)) {
            $models = $query->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
            $total = $query->count();
        } else {
            $models = ClickModel::orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
            $total = ClickModel::count();
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
            $datas[$k] = $this->getClickModel($model);
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

    /**
     * 设置点赞
     */
    public function store()
    {
        $id = $_POST['id'];
        $uid = $_POST['uid'];
        if (!$id || !$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = ClickModel::where('talkid',$id)
            ->where('uid',$uid)
            ->first();
        if ($model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '已经点过赞！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'talkid'    =>  $id,
            'uid'       =>  $uid,
            'created_at'    =>  time(),
        ];
        ClickModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }






    /**
     * 获取 clickModel 集合
     */
    public function getClickModel($model)
    {
        $data = $this->objToArr($model);
        $data['createTime'] = $model->createTime();
        $data['updateTime'] = $model->updateTime();
        $data['talkName'] = $model->getTalkName();
        return $data;
    }
}