<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\User;
use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Model\User;
use Illuminate\Support\Facades\DB;

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
            ->paginate($request->input('num')?$request->input('num'):10);
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

//        查看已添加的用户名是否重复
        $username = $input['username'];
        $nameagain = DB::table('adminuser')->where('user_name',$username)->first();
        if($nameagain){
            $data = 2;
            return $data;
        }

//        3.添加到数据库user表
        $email = $input['email'];
        $pass = Crypt::encrypt($input['pass']);
        $status = $input['status'];

        $res = User::create(['user_name'=>$username,'user_email'=>$email,'user_pass'=>$pass,'status'=>$status]);
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
//        1.获取当前用户拥有的所有权限
//        $user = User::find(session()->get('user')->user_id);
        $user = User::find($id);
        $role = $user->role;

//        $roles放用户拥有所有角色的name集合
        $roles = [];
        foreach ($role as $r){
            $roles[] = $r->role_name;
        }
//        $pres放用户拥有所有权限的name集合(可能存在重复权限)
        $pres = [];
        foreach ($role as $v){
            $ps = $v->permission;
            foreach ($ps as $p){
                $pres[] = $p->pre_name;
            }
        }
//        2.权限去重
        $pres = array_unique($pres);

        return view('admin.user.show',compact('user','roles','pres'));
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
        $userpass = $request->input('pass');
        $status = $request->input('status');
//        3.修改数据库中相应值
        $user->user_email = $useremail;
        $user->user_pass = Crypt::encrypt($userpass);
        $user->status = $status;

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
        $user = User::find($id);
        $res1 = 1;
        $res2 = 1;
//        if(is_array($id)){
//            foreach ($user as $v){
//                $res1 = \DB::table('adminuser_role')->where('user_id',$v->user_id)->delete() and $res1;
//                $res2 = $v->delete() and $res2;
//            }
//        }else{
////            if(!empty(\DB::table('adminuser_role')->where('user_id',$user->user_id)->get())){
////
////            }
//            $res1 = \DB::table('adminuser_role')->where('user_id',$user->user_id)->delete();
//            $res2 = $user->delete();
//        }

        $res = \DB::table('adminuser_role')->where('user_id',$user->user_id)->get();

//        dd(count($res));

        if(count($res)!=0){
            $res1 = \DB::table('adminuser_role')->where('user_id',$user->user_id)->delete();
        }

        $res2 = $user->delete();

        if($res1 and $res2){
            $data = 0;
        }else{
            $data = 1;
        }
        return $data;
    }


    /**
     * 执行批量删除操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delAll(Request $request)
    {
        $input = $request->input('ids');
//        $user = User::find($input);
//        dd($input);

        $res = User::destroy($input);

        if($res){
            $data = 0;
        }else{
            $data = 1;
        }
        return $data;

    }

    /**
     * 获取用户授权（角色）的页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function auth($id)
    {
//        1.获取当前角色
        $user = User::find($id);
//        2.获取全部角色列表
        $role = Role::get();
//        3.获取当前用户所拥有的角色
        $user_role = $user->role;
//        4.当前角色拥有的权限ID
        $role_ids = [];
        foreach ($user_role as $v){
            $role_ids[] = $v->role_id;
        }
        return view('admin.user.auth',compact('user','role','role_ids'));
    }

    /**
     * 执行用户授权（角色）操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doAuth(Request $request)
    {
//        1.获取前台参数
        $input = $request->except('_token');
//        dd($input);
//        2.删除adminuser_role表的原有权限
        \DB::table('adminuser_role')->where('user_id',$input['user_id'])->delete();
//        3.存入前台勾选的用户权限记录
        if(!empty($input['role_id'])){
            foreach ($input['role_id'] as $v){
                \DB::table('adminuser_role')->insert(['user_id'=>$input['user_id'],'role_id'=>$v]);
            }
        }
//        重定向是一条路由，用'.'。
        return redirect('admin/user');

    }
}
