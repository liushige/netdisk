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
    public function index(Request $request)
    {
//        1.获取提取的请求参数
//        $input = $request->all();
//        dd($input);
        $user = User::orderBy('user_id','asc')
            ->where(function ($query) use ($request){
                $username = $request->input('username');
                if(!empty($username)){
                    $query->where('user_name','like','%'.$username.'%');
                }
            })
            ->paginate($request->input('num')?$request->input('num'):5);
//        $user = User::get();
//        $user = User::paginate(2);
        return view('admin.user.list',compact('user','request'));
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
        $user = User::find($id);

        return view('admin.user.edit',compact('user'));
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
//        1.根据ID获取要修改的记录
        $user = User::find($id);
//        2.获取要修改的其他信息
        $useremail = $request->input('email');
        $username = $request->input('username');
        $userpass = $request->input('pass');
//        3.修改数据库中相应值
        $user->user_email = $useremail;
        $user->user_name = $username;
        $user->user_pass = Crypt::encrypt($userpass);

//        给到前台作为修改编辑页面未改动时的原密码展示
//        $pass = Crypt::decrypt($user->user_pass);

        $res = $user->save();

        if($res){
            $data = 0;
        }else{
            $data = 1;
        }

        return $data;
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
