<?php
namespace App\Models\Talk;

use App\Models\BaseModel;
use App\Models\ThemeModel;

class TalksModel extends BaseModel
{
    /**
     * 话题
     */
    protected $table = 'talks';
    protected $fillable = [
        'id','name','themeid','intro','uid','uname','read','pid','sort','del','created_at','updated_at',
    ];

    /**
     * 话题的主题
     */
    public function theme()
    {
        $themeid = $this->themeid ? $this->themeid : 0;
        $themeModel = ThemeModel::find($themeid);
        return $themeModel ? $themeModel : '';
    }

    /**
     * 话题的主题标题
     */
    public function getThemeName()
    {
        return $this->theme() ? $this->theme()->name : '';
    }

    /**
     * 点击话题
     */
    public function click()
    {
        return ClickModel::where('talkid',$this->id)->get();
    }

    /**
     * 关注话题
     */
    public function follow()
    {
        return FollowModel::where('talkid',$this->id)->get();
    }

    /**
     * 收藏话题
     */
    public function collect()
    {
        return CollectModel::where('talkid',$this->id)->get();
    }

    public function parent()
    {
        $pid = $this->pid ? $this->pid : 0;
        $parent = TalksModel::find($pid);
        return $parent ? $parent : '';
    }

//    /**
//     * 分享话题
//     */
//    public function share()
//    {
//        $datas = TalksShareModel::where('talkid',$this->id)->get();
//        return count($datas) ? $datas : 0;
//    }

//    /**
//     * 举报话题
//     */
//    public function report()
//    {
//        $datas = TalksReportModel::where('talkid',$this->id)->get();
//        return count($datas) ? $datas : 0;
//    }

//    /**
//     * 感谢话题
//     */
//    public function thank()
//    {
//        $datas = TalksThankModel::where('talkid',$this->id)->get();
//        return count($datas) ? $datas : 0;
//    }

//    public function areatoname()
//    {
//        $userInfo = UserModel::find($this->uid);
//        $areaName = $userInfo->area ? $this->getAreaName($userInfo->area) : '';
////        return $userInfo->area ? AreaModel::find($userInfo->area)->cityname : '未知城市';
//        return $areaName ? $areaName : '未知城市';
//    }

//    public function getUName()
//    {
//        $uid = $this->uid ? $this->uid : 0;
//        return $this->getUserName($uid);
//    }
}