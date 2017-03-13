<?php
namespace App\Http\Controllers;

use App\Models\CateModel;

class CateController extends BaseController
{
    /**
     * 主题
     */

    public function index()
    {
        $topic = $_POST['topic'];
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if ($topic) {
            $models = CateModel::where('topic_id',$topic)
                ->skip($start)
                ->take($limit)
                ->orderBy('id','desc')
                ->get();
            $total = CateModel::where('topic_id',$topic)->count();
        } else {
            $models = CateModel::skip($start)
                ->take($limit)
                ->orderBy('id','desc')
                ->get();
            $total = CateModel::count();
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
            $datas[$k] = $this->getCateModel($model);
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
     * 通过 pid 获取类别
     */
    public function getCatesByPid()
    {
        $pid = $_POST['pid'];
        $models = CateModel::where('pid',$pid)->get();
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->getCateModel($model);
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

    /**
     * 通过 limit 获取记录
     */
    public function getCatesByLimit()
    {
        $limit = $_POST['limit'];
        $topic_id = $_POST['topic_id'];
        $models = CateModel::where('topic_id',$topic_id)
            ->orderBy('id','asc')
            ->paginate($limit);
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->getCateModel($model);
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

    /**
     * 通过 topic 获取二级类别
     */
    public function getCatesByTopic()
    {
        $topic_id = $_POST['topic_id'];
        //level：0所有，1一级类别，2非一级类别
        $level = $_POST['level'];
        if (!$topic_id || !in_array($level,[0,1,2])) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        if ($level==0) {
            $models = CateModel::where('topic_id',$topic_id)->get();
        } else if ($level==1) {
            $models = CateModel::where('topic_id',$topic_id)
                ->where('pid',0)
                ->get();
        } else {
            $models = CateModel::where('topic_id',$topic_id)
                ->where('pid','<>',0)
                ->get();
        }
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->getCateModel($model);
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
        $model = CateModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->getCateModel($model);
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
        $uid = isset($_POST['uid']) ? $_POST['uid'] : 0;
        $intro = $_POST['intro'];
        $pid = $_POST['pid'];
        $topic_id = $_POST['topic_id'];
        if (!$name) {
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
            'uid'   =>  $uid,
            'intro' =>  $intro,
            'pid'   =>  $pid,
            'topic_id'  =>  $topic_id,
            'created_at'    =>  time(),
        ];
        CateModel::create($data);
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
        $uid = isset($_POST['uid']) ? $_POST['uid'] : 0;
        $name = $_POST['name'];
        $intro = $_POST['intro'];
        $pid = $_POST['pid'];
        $topic_id = $_POST['topic_id'];
        if (!$id || !$name) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = CateModel::find($id);
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
            'name'  =>  $name,
            'intro' =>  $intro,
            'pid'   =>  $pid,
            'topic_id'  =>  $topic_id,
            'updated_at'    =>  time(),
        ];
        CateModel::where('id',$id)->update($data);
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
    public function getCateModel($model)
    {
        $data = $this->objToArr($model);
        $data['createTime'] = $model->createTime();
        $data['updateTime'] = $model->updateTime();
        $data['topicName'] = $model->getTopicName();
        $data['pname'] = $model->getParentName();
        $data['child'] = $model->getChild();
        $data['parent'] = $model->getParent();
        return $data;
    }
}