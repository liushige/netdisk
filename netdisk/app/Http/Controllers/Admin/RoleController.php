<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        不分页显示
//        //1.获取角色列表数据
//        $role = Role::get();
////        2.返回角色视图
//        return view('admin.role.list',compact('role'));


//        分页显示
//        1.获取提取的请求参数
//        $input = $request->all();
//        dd($input);
        $role = Role::orderBy('role_id','asc')
            ->where(function ($query) use ($request){
                $rolename = $request->input('rolename');
                if(!empty($rolename)){
                    $query->where('role_name','like','%'.$rolename.'%');
                }
            })
            ->paginate($request->input('num')?$request->input('num'):5);
//        $user = User::get();
//        $user = User::paginate(2);
        return view('admin.role.list',compact('role','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        1.获取表单提交数据
        $input = $request->except('_token');
//        dd($input);
//        2.进行表单验证

//        3.将数据存入role表
        $res = Role::create($input);

        if($res){
            return redirect('admin/role/create')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        return view('admin.role.edit',compact('role'));

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
        $role = Role::find($id);
//        2.获取要修改的其他信息
        $rolename = $request->input('rolename');
        $roledescription = $request->input('roledescription');
//        3.修改数据库中相应值
        $role->role_name = $rolename;
        $role->role_description = $roledescription;

        $res = $role->save();

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
        $role = Role::find($id);
        $res = $role->delete();
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

        $res = Role::destroy($input);

        if($res){
            $data = 0;
        }else{
            $data = 1;
        }
        return $data;

    }
}
