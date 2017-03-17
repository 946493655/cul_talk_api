<?php
namespace App\Http\Controllers;

use App\Models\IntegralModel;

class IntegralController extends BaseController
{
    /**
     * 积分交易
     */

    public function index()
    {
        $talkid = $_POST['talkid'];
        $uid = $_POST['uid'];
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;
        $page = isset($_POST['page'])?$_POST['page']:1;
        $start = $limit * ($page - 1);

        if ($talkid && $uid) {
            $query = IntegralModel::where('talkid',$talkid)
                ->where('uid',$uid)
                ->skip($start)
                ->take($limit)
                ->get();
        }
    }
}