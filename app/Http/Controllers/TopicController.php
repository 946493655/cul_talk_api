<?php
namespace App\Http\Controllers;

use App\Models\TopicModel;

class TopicController extends BaseController
{
    /**
     * 专栏
     */

    public function index()
    {
        $uid = $_POST['uid'];
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if (!$uid) {
            $models = TopicModel::skip($start)
                ->take($limit)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->get();
            $total = TopicModel::count();
        } else {
            $models = TopicModel::where('uid',$uid)
                ->skip($start)
                ->take($limit)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->get();
            $total = TopicModel::where('uid',$uid)
                ->count();
        }
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->getTopicModel($model);
        }
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
            'pagelist'  =>  [
                'total' =>  $total,
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 获取所有专栏
     */
    public function getAll()
    {
        $models = TopicModel::all();
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->getTopicModel($model);
        }
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

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
        $model = TopicModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->getTopicModel($model);
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
        $name = $_POST['name'];
        $intro = $_POST['intro'];
        $uid = isset($_POST['uid']) ? $_POST['uid'] : 0;
        if (!$name) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = TopicModel::where('name',$name)->first();
        if ($model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '存在同名专栏！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'name'  =>  $name,
            'intro' =>  $intro,
            'uid'   =>  $uid,
            'created_at'    =>  time(),
        ];
        TopicModel::create($data);
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
        $sort = $_POST['sort'];
        $uid = isset($_POST['uid']) ? $_POST['uid'] : 0;
        if (!$id || !$name) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = TopicModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model2 = TopicModel::where('name',$name)->first();
        if ($model2) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '存在同名专栏！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'name'  =>  $name,
            'intro' =>  $intro,
            'sort'  =>  $sort,
            'uid'   =>  $uid,
            'updated_at'    =>  time(),
        ];
        TopicModel::where('id',$id)->update($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 获取 model 集合
     */
    public function getTopicModel($model)
    {
        $data = $this->objToArr($model);
        $data['createTime'] = $model->createTime();
        $data['updateTime'] = $model->updateTime();
        return $data;
    }
}