<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //1.关联的数据表
    public $table = 'adminuser';
//    2.主键
    public $primaryKey = 'user_id';
//    3.允许批量操作的字段
//    public $fillable = ['user_name','user_pass','token','status'];
    public $guarded = [];
//    4.是否维护created_at和update_at字段
    public $timestamps = false;
//    5.添加动态属性，关联角色模型
    public function role(){
        return $this->belongsToMany('App\Model\Role','adminuser_role','user_id','role_id');
    }
}
