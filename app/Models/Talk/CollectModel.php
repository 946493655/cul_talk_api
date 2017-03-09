<?php
namespace App\Models\Talk;

use App\Models\BaseModel;

class CollectModel extends BaseModel
{
    protected $table = 'talks_collect';
    protected $fillable = [
        'id','talkid','uid','created_at',
    ];
}