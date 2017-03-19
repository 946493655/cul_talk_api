<?php
namespace App\Models;

use App\Models\Talk\ClickModel;

class TalksModel extends BaseModel
{
    /**
     * 话题
     */
    protected $table = 'talks';
    protected $fillable = [
        'id','name','topic_id','cate','intro','award','uid','uname','read','sort','isshow','created_at','updated_at',
    ];
    //award发布话题的积分奖励：1-5随机值

    /**
     * 根据 category 获取所有子类别的id
     */
    public function getCateArr($cate)
    {
        if (!$cate) { return array(); }
        $cateArr[] = $cate;
        $cateModels = CateModel::where('pid',$cate)->get();
        if (count($cateModels)) {
            foreach ($cateModels as $cateModel) {
                $cateArr[] = $cateModel->id;
                $cateModel2s = CateModel::where('pid',$cateModel->id)->get();
                if (count($cateModel2s)) {
                    foreach ($cateModel2s as $cateModel2) {
                        $cateArr[] = $cateModel2->id;
                    }
                }
            }
        }
        return $cateArr;
    }

    /**
     * 获取赏积分的额度
     */
    public function getIntegral()
    {
        $integral = IntegralModel::where('talkid',$this->id)->first();
        return $integral ? $integral->number : 0;
    }

    /**
     * 获取评论
     */
    public function getComments()
    {
        $comments = CommentModel::where('talkid',$this->id)->get();
        return $comments ? $comments : [];
    }

    /**
     * 获取点赞
     */
    public function getClicks()
    {
        $clicks = ClickModel::where('talkid',$this->id)->get();
        return $clicks ? $clicks : [];
    }
}