<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vip extends Model
{
//    1.关联的数据表
    public $table = 'vipuser';
//    2.主键
    public $primaryKey = 'user_id';
//    3.允许批量操作的字段
//    public $fillable = ['user_name','user_pass','token','status'];
    public $guarded = [];
//    4.是否维护created_at和update_at字段
    public $timestamps = false;
////    5.添加动态属性，关联文件模型
//    public function folder(){
//        return $this->belongsToMany('App\Model\Folder','vipuser_folder','user_id','folder_id');
//    }
}
