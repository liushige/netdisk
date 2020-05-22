<?php

namespace App\Http\Controllers\Vip;

use App\Http\Controllers\Controller;
use App\Model\Vip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class VipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        1.获取提取的请求参数
//        $input = $request->all();
//        dd($input);
        $vip = Vip::orderBy('user_id','asc')
            ->where(function ($query) use ($request){
                $username = $request->input('username');
                if(!empty($username)){
                    $query->where('user_name','like','%'.$username.'%');
                }
            })
            ->paginate($request->input('num')?$request->input('num'):10);
        return view('vip.vipUser.list',compact('vip','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vip.vipUser.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        1.接收前台传来的表单数据
        $input = $request->all();

//        2.验证电话号码和用户名是否存在
        $username = $input['username'];
        $userphone = $input['phone'];
        $nameagain = DB::table('vipuser')->where('user_name',$username)->first();
        $phoneagain = DB::table('vipuser')->where('user_phone',$userphone)->first();
        if($nameagain){
            $data = 2;
            return $data;
        }
        if($phoneagain){
            $data = 3;
            return $data;
        }

//        3.添加到数据库user表
        $email = $input['email'];
        $pass = Crypt::encrypt($input['pass']);

        $res = Vip::create(['user_email'=>$email,'user_pass'=>$pass,'user_name'=>$username,'user_phone'=>$userphone]);
//        4.根据是否成功，给客户端一个Json格式反馈
        if($res){
            $data = 0;
        }else{
            $data = 1;
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //        1.获取当前用户拥有的所有权限
//        $user = User::find(session()->get('user')->user_id);
        $user = Vip::find($id);
        return view('vip.vipUser.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vip = Vip::find($id);

        return view('vip.vipUser.edit',compact('vip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        1.根据ID获取要修改的记录
        $user = Vip::find($id);
//        2.获取要修改的其他信息
        $useremail = $request->input('email');
        $userpass = $request->input('pass');
//        3.修改数据库中相应值
        $user->user_email = $useremail;
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vip = Vip::find($id);
        $res = 1;
        if(is_array($id)){
            foreach ($vip as $v){
                $res = $v->delete() and $res;
            }
        }else{
            $res = $vip->delete();
        }

        if($res){
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

        $res = Vip::destroy($input);

        if($res){
            $data = 0;
        }else{
            $data = 1;
        }
        return $data;

    }

}
