<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Model\User;

class UserController extends Controller
{
    /**
     * 返回后台用户列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.user.list');
    }

    /**
     * 返回后台用户添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.add');
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        1.接收前台传来的表单数据
        $input = $request->all();
//        2.进行表单验证

//        3.添加到数据库user表
        $username = $input['username'];
        $email = $input['email'];
        $pass = Crypt::encrypt($input['pass']);

        $res = User::create(['user_name'=>$username,'user_email'=>$email,'user_pass'=>$pass]);
//        4.根据是否成功，给客户端一个Json格式反馈
        if($res){
//            $data = [
//                'status'=>'0',
//                'message'=>'添加成功'
//            ];
            $data = 0;
        }else{
//            $data = [
//                'status'=>'1',
//                'message'=>'添加失败'
//            ];
            $data = 1;
        }
        return $data;
    }

    /**
     * 返回单条数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 返回修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 执行修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 执行删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
