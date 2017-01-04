<?php
namespace App\Http\Controllers\Talk;

use App\Models\Talk\ClickModel;

class ClickController extends BaseController
{
    /**
     * 话题点赞
     */

//    public function index()
//    {
//        $talkid = (isset($_POST['talkid'])&&$_POST['talkid'])?$_POST['talkid']:0;
//        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
//        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
//        $start = $limit * ($page - 1);      //记录起始id
//
//        if ($talkid) {
//            $models = ClickModel::where('talkid',$talkid)
//                ->orderBy('id','desc')
//                ->skip($start)
//                ->take($limit)
//                ->get();
//        } else {
//            $models = ClickModel::orderBy('id','desc')
//            ->skip($start)
//            ->take($limit)
//            ->get();
//        }
//        if (!count($models)) {
//            $rstArr = [
//                'error' =>  [
//                    'code'  =>  -2,
//                    'msg'   =>  '没有记录',
//                ],
//            ];
//            echo json_encode($rstArr);exit;
//        }
//    }
}