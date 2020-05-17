<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
//    1.关联的数据表
    public $table = 'folder';
//    2.主键
    public $primaryKey = 'folder_id';
//    3.允许批量操作的字段
    public $guarded = [];
//    4.是否维护created_at和update_at字段
    public $timestamps = false;

//    5.添加动态属性，关联权限模型
    public function app(){
        return $this->belongsToMany('App\Model\App','folder_app','folder_id','app_id');
    }
}
