<?php
namespace App\Models\Talk;

use App\Models\BaseModel;

class FollowModel extends BaseModel
{
    protected $table = 'talks_follow';
    protected $fillable = [
        'id','talkid','uid','created_at',
    ];
}