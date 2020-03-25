<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permission = Permission::orderBy('pre_id','asc')
            ->where(function ($query) use ($request){
                $prename = $request->input('prename');
                if(!empty($prename)){
                    $query->where('pre_name','like','%'.$prename.'%');
                }
            })
            ->paginate($request->input('num')?$request->input('num'):10);
//        $user = User::get();
//        $user = User::paginate(2);
        return view('admin.permission.list',compact('permission','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.add');
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
        $res = Permission::create($input);

        if($res){
            return redirect('admin/permission/create')->with('msg','添加成功');
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
        $permission = Permission::find($id);

        return view('admin.permission.edit',compact('permission'));
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
        $permission = Permission::find($id);
//        2.获取要修改的其他信息
        $prename = $request->input('pre_name');
        $predescription = $request->input('pre_description');
        $preurl = $request->input('pre_url');
//        3.修改数据库中相应值
        $permission->pre_name = $prename;
        $permission->pre_description = $predescription;
        $permission->pre_url = $preurl;

        $res = $permission->save();

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
        $permission = Permission::find($id);
        $res1 = \DB::table('role_permission')->where('pre_id',$permission->pre_id)->delete();
        $res2 = $permission->delete();
        if($res1 or $res2){
            $data = 1;
        }else{
            $data = 0;
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
        $res = 1;
        $input = $request->input('ids');
        if (!empty($input)){
            $res = Permission::destroy($input);
        }
        if($res){
            $data = 0;
        }else{
            $data = 1;
        }
        return $data;

    }
}
