<?php
namespace App\Models;

class IntegralModel extends BaseModel
{
    /**
     * 积分交易
     */

    public $table = 'integral';
    public $fillable = [
        'id','uid','uid2','talkid','number','created_at','updated_at',
    ];
}