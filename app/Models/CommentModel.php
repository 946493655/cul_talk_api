<?php
namespace App\Models;

class CommentModel extends BaseModel
{
    /**
     * 评论
     */

    public $table = 'comment';
    public $fillable = [
        'id','talkid','intro','uid','created_at','updated_at',
    ];

    /**
     * 得到话题名称
     */
    public function getTalkName()
    {
        $talkModel = TalksModel::find($this->talkid);
        return $talkModel ? $talkModel->name : '';
    }
}