<?php
namespace App\Http\Controllers;

use App\Models\TalksModel;

class TalkController extends BaseController
{
    /**
     * 话题管理控制器
     */

    public function __construct()
    {
        $this->selfModel = new TalksModel();
    }

    /**
     * 话题列表
     */
    public function index()
    {
        $topic = $_POST['topic'];
        $cate = $_POST['cate'];
        $uid = $_POST['uid'];
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        $cateArr = $this->selfModel->getCateArr($cate);
        if ($uid) {
            if ($topic && $cateArr) {
                $query = TalksModel::where('topic_id',$topic)
                    ->where('topic_id',$topic)
                    ->where('uid',$uid);
            } else if (!$topic && $cateArr) {
                $query = TalksModel::whereIn('cate',$cateArr)
                    ->where('uid',$uid);
            } else if ($topic && !$cateArr) {
                $query = TalksModel::where('topic_id',$topic)
                    ->where('uid',$uid);
            }
        } else {
            if ($topic && $cateArr) {
                $query = TalksModel::where('topic_id',$topic)
                    ->whereIn('cate',$cateArr);
            } else if (!$topic && $cateArr) {
                $query = TalksModel::whereIn('cate',$cateArr);
            } else if ($topic && !$cateArr) {
                $query = TalksModel::where('topic_id',$topic);
            }
        }
        if (isset($query)) {
            $models = $query->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
            $total = $query->count();
        } else {
            $models = TalksModel::orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
            $total = TalksModel::count();
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
            $datas[$k] = $this->getTalkModel($model);
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
     * 通过 id 获取一条记录
     */
    public function show()
    {
        $id = $_POST['id'];
        if (!$id) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = TalksModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->objToArr($model);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
            'model' =>  [],
        ];
        echo json_encode($rstArr);exit;
    }

    public function store()
    {
        $name = $_POST['name'];
        $topic_id = $_POST['topic_id'];
        $cate = $_POST['cate'];
        $intro = $_POST['intro'];
        $uid = $_POST['uid'];
        $uname = $_POST['uname'];
        if (!$name || !$topic_id || !$cate || !$intro || (!$uid && !$uname)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'name'  =>  $name,
            'topic_id'   =>  $topic_id,
            'cate'  =>  $cate,
            'intro' =>  $intro,
            'uid'   =>  $uid,
            'uname' =>  $uname,
            'award' =>  rand(1,5),      //话题发布的积分奖励，随机1-5
            'created_at'    =>  time(),
        ];
        TalksModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $intro = $_POST['intro'];
        $uid = $_POST['uid'];
        $uname = $_POST['uname'];
        if (!$id || !$name || !$intro || (!$uid && !$uname)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = TalksModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'name'  =>  $name,
            'intro' =>  $intro,
            'uid'   =>  $model->uid,
            'uname' =>  $model->uname,
            'updated_at'    =>  time(),
        ];
        TalksModel::where('id',$id)->update($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 获取 talkModel 集合
     */
    public function getTalkModel($model)
    {
        $data = $this->objToArr($model);
        $data['createTime'] = $model->createTime();
        $data['updateTime'] = $model->updateTime();
        return $data;
    }
}