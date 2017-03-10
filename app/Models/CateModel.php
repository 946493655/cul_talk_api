<?php
namespace App\Models;

class CateModel extends BaseModel
{
    /**
     * 主题专栏
     */
    protected $table = 'category';
    protected $fillable = [
        'id','name','intro','pid','topic_id','created_at','updated_at',
    ];

    /**
     * 所属专栏
     */
    public function getTopicName()
    {
        $model = TopicModel::find($this->topic_id);
        return $model ? $model->name : '';
    }

    /**
     * 上级名称
     */
    public function getParentName()
    {
        if ($this->pid==0) { return '顶级类别'; }
        $model = CateModel::find($this->pid);
        return $model ? $model->name : '';
    }

    /**
     * 获取子级
     */
    public function getChild()
    {
        $models = CateModel::where('pid',$this->id)->get();CateModel::where('pid',$this->id)->get();
        if (count($models)) {
            foreach ($models as $model) {
                $model->child = CateModel::where('pid',$model->id)->get();
            }
        }
        return $models ? $models : [];
    }
}