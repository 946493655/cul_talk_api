<?php
namespace App\Models;

class ThemeModel extends BaseModel
{
    /**
     * 主题专栏
     */
    protected $table = 'theme';
    protected $fillable = [
        'id','name','intro','uid','uname','sort','del','created_at','updated_at',
    ];
    protected $dels = [
        0=>'未删除', 1=>'已删除'
    ];

    public function getDel()
    {
        return array_key_exists($this->del,$this->dels) ? $this->dels[$this->del] : '';
    }
}