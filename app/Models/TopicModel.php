<?php
namespace App\Models;

class TopicModel extends BaseModel
{
    /**
     * 专栏
     */

    protected $table = 'topics';
    protected $fillable = [
        'id','name','intro','sort','created_at','updated_at',
    ];
}