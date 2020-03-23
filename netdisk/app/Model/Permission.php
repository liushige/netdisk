<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
//    1.关联的数据表
    public $table = 'permission';
//    2.主键
    public $primaryKey = 'pre_id';
//    3.允许批量操作的字段
    public $guarded = [];
//    4.是否维护created_at和update_at字段
    public $timestamps = false;
}
