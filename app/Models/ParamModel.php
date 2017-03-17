<?php
namespace App\Models;

class ParamModel extends BaseModel
{
    /**
     * 论坛的用户参数统计
     * 一用户一条记录
     */

    public $table = 'param';
    public $fillable = [
        'id','uid','integral','created_at','updated_at',
    ];
}