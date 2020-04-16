<?php

namespace App\Http\Controllers\Vip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Model\Cate;

class CommonController extends Controller
{
    //
    public function __construct()
    {
//        //获取所有的分类
//        $cate = Cate::get();
//        //存放一级类变量
//        $cateone = [];
////        存放二级类变量
//        $catetwo = [];
//
//        foreach ($cate as $k=>$v)
//        {
//            //取出所有的一级类，存放到cateone
//            if($v->cate_pid == 0){
//                $cateone[$k] = $v;
//                //获取当前一级类下的二级类
//                foreach($cate as $m=>$n){
//                    if($v->cate_id == $n->cate_pid){
//                        $catetwo[$k][$m]=$n;
//                    }
//                }
//            }
//        }
////        dd($cateone);
////        dd($catetwo);
//        view()->share('cateone',$cateone);
//        view()->share('catetwo',$catetwo);
    }
}
