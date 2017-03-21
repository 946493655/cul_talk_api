<?php
namespace App\Models\Talk;

use App\Models\TalksModel;

class ClickModel extends BaseModel
{
    protected $table = 'talks_click';
    protected $fillable = [
        'id','talkid','uid','created_at',
    ];

    /**
     * 话题名称
     */
    public function getTalkName()
    {
        $talkModel = TalksModel::find($this->talkid);
        return $talkModel ? $talkModel->name : '';
    }
}