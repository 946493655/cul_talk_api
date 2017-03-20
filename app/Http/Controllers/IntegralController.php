<?php
namespace App\Http\Controllers;

use App\Models\IntegralModel;
use App\Models\ParamModel;

class IntegralController extends BaseController
{
    /**
     * 积分交易
     */

    public function index()
    {
        $talkid = $_POST['talkid'];
        $uid = $_POST['uid'];
        $genre = $_POST['genre'];       //genre=1发起方，2接受方
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;
        $page = isset($_POST['page'])?$_POST['page']:1;
        $start = $limit * ($page - 1);

        if (!in_array($genre,[1,2])) {
            $rstArr = [
                'error' => [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $uidKey = $genre==1 ? 'uid' : 'uid2';
        if ($talkid) {
            $models = IntegralModel::where('talkid',$talkid)
                ->where($uidKey,$uid)
                ->skip($start)
                ->take($limit)
                ->get();
            $total = IntegralModel::where('talkid',$talkid)
                ->where($uidKey,$uid)
                ->count();
        } else {
            $models = IntegralModel::where($uidKey,$uid)
                ->skip($start)
                ->take($limit)
                ->get();
            $total = IntegralModel::where($uidKey,$uid)->count();
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
            $datas[$k] = $this->getIntegralModel($model);
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

    public function getOneByTalkid()
    {
        $talkid = $_POST['talkid'];
        if (!$talkid) {
            $rstArr = [
                'error' => [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = IntegralModel::where('talkid',$talkid)->first();
        if (!$model) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->getIntegralModel($model);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    public function store()
    {
        $uid = $_POST['uid'];
        $talkid = $_POST['talkid'];
        $number = $_POST['number'];
        if (!$uid || !$talkid || !$number) {
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
            'number'    =>  $number,
            'created_at'    =>  time(),
        ];
        IntegralModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 设置中意回复人
     */
    public function setUser()
    {
        $talkid = $_POST['talkid'];
        $uid = $_POST['uid'];
        if (!$talkid || !$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = IntegralModel::where('talkid',$talkid)->first();
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'uid2'  =>  $uid,
            'updated_at'    =>  time(),
        ];
        IntegralModel::where('talkid',$talkid)->update($data);
        //更新用户积分
        $this->setParam($uid,$model->number,1);
        $this->setParam($model->uid,$model->number,2);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 更新用户参数：genre==1自增，2自减
     */
    public function setParam($uid,$number,$genre=1)
    {
        $model = ParamModel::where('uid',$uid)->first();
        if (!$model) {
            $data = [
                'uid'   =>  $uid,
                'created_at'    =>  time(),
            ];
            ParamModel::create($data);
        }
        if ($genre==1) {
            ParamModel::where('uid',$uid)->increment('integral',$number);
        } else {
            ParamModel::where('uid',$uid)->decrement('integral',$number);
        }
    }





    public function getIntegralModel($model)
    {
        $data = $this->objToArr($model);
        $data['createTime'] = $model->createTime();
        $data['updateTime'] = $model->updateTime();
        $data['talkName'] = $model->getTalkName();
        return $data;
    }
}