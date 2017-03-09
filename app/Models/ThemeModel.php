<?php
namespace App\Models;

class CateModel extends BaseModel
{
    /**
     * 主题专栏
     */
    protected $table = 'category';
    protected $fillable = [
        'id','name','intro','pid','created_at','updated_at',
    ];
}