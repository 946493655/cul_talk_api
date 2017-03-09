<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    protected $limit = 20;      //每页显示记录数
    protected $selfModel;       //当前控制器实例化model

    /**
     * 对象转为数组
     */
    public function objToArr($obj)
    {
        return json_decode(json_encode($obj),true);
    }
}
