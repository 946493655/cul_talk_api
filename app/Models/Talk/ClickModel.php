<?php
namespace App\Models\Talk;

class ClickModel extends BaseModel
{
    protected $table = 'talks_click';
    protected $fillable = [
        'id','talkid','uid','created_at',
    ];
}