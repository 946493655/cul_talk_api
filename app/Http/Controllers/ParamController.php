<?php
namespace App\Http\Controllers;

use App\Models\ParamModel;

class ParamController extends BaseController
{
    /**
     * 论坛的用户参数统计
     * 一用户一条记录
     */

    public function show()
    {
        $uid = $_POST['uid'];
        if (!$uid) {
            $rstARrr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstARrr);exit;
        }
        $model = ParamModel::where('uid',$uid)->first();
        $datas = $this->objToArr($model);
        $rstARrr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstARrr);exit;
    }
}