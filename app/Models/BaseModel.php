<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * 基础 model
     */

    public $timestamps = false;

    /**
     * 创建时间转换
     */
    public function createTime()
    {
        return $this->created_at ? date("Y年m月d日", $this->created_at) : '';
    }

    /**
     * 更新时间转换
     */
    public function updateTime()
    {
        return $this->updated_at ? date("Y年m月d日", $this->updated_at) : '未更新';
    }
}