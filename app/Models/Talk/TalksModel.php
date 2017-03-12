<?php
namespace App\Models\Talk;

use App\Models\BaseModel;
use App\Models\CateModel;
use App\Models\ThemeModel;

class TalksModel extends BaseModel
{
    /**
     * 话题
     */
    protected $table = 'talks';
    protected $fillable = [
        'id','name','topic_id','cate','intro','uid','uname','read','pid','sort','isshow','created_at','updated_at',
    ];

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
}