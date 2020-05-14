<?php

namespace App\Http\Controllers\Vip;

use App\Http\Controllers\Controller;
use App\Model\Folder;
use App\Model\Vip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        分页显示
//        获取当前登录用户
        $currentUser = Vip::find(session()->get('vip')->user_id);

        $cF_id = 0;

//        获取用户所有的文件夹
//        $allFolder = $currentUser->folder;
        $userfolder = DB::table('vipuser_folder')->where('user_id',$currentUser->user_id);
        $folder = Folder::find($userfolder->value('folder_id'))


//        $folder = Folder::orderBy('folder_id','asc')
            ->where(function ($query) use ($request){
                $foldername = $request->input('foldername');
                if(!empty($foldername)){
                    $query->where('folder_name','like','%'.$foldername.'%');
                } else {
                    $query->where('folder_parentid',0);
                }
            })
            ->paginate($request->input('num')?$request->input('num'):10);

        return view('vip.folder.list',compact('folder','request','cF_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function folderCreate($id)
    {
        $folder_id = $id;
        return view('vip.folder.add',compact('folder_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function folderStore(Request $request, $id)
    {
//        获取当前登录用户
        $currentUser = Vip::find(session()->get('vip')->user_id);

//        接收前台传来的表单数据
        $foldername = $request->input('foldername');
        $folderpid = $id;
//        dd($foldername);

//        添加到数据库folder表
        $res = Folder::create(['folder_name'=>$foldername, 'folder_parentid'=>$folderpid, 'folder_original'=>1]);

//        获取新建文件夹的id号码
        $currentFid = Folder::where('folder_name',$foldername)->value('folder_parentid',$folderpid);



//        添加到数据库vipuser_folder表
        \DB::table('vipuser_folder')->insert(['user_id'=>$currentUser->user_id,'folder_id'=>$currentFid]);

//        根据是否成功，给客户端一个Json格式反馈
        if($res){
            $data = 0;
        }else{
            $data = 1;
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
//        获取当前登录用户
        $currentUser = Vip::find(session()->get('vip')->user_id);
//        获取选中的文件夹
        $currentFolder = Folder::find($id);

//        当前文件夹id，后续传回前台，方便新建文件夹等使用
        $cF_id = $id;

//        dd($cF_id);

//        获取用户所有的文件夹（选中文件夹的子文件夹）
        $userfolder = DB::table('vipuser_folder')->where('user_id',$currentUser->user_id);
        $folder = Folder::find($userfolder->value('folder_id'))
            ->where(function ($query) use ($request,$id){
                $foldername = $request->input('foldername');
                if(!empty($foldername)){
                    $query->where('folder_name','like','%'.$foldername.'%');
                } else {
                    $query->where('folder_parentid',$id);
                }
            })
            ->paginate($request->input('num')?$request->input('num'):10);


//        return redirect('vip/folder')->with('folder','request');
        return view('vip.folder.list',compact('folder', 'request','cF_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $folder = Folder::find($id);
        return view('vip.folder.edit',compact('folder'));
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
//        1.根据ID获取要修改(自定义文件夹)的记录
//        $folder = Folder::find($id)->where();
        $folder = DB::table('folder')->where('folder_id','$id')->value('folder_original');

        if(!$folder)
        {
            $data = 2;
            return $data;
        }

//        2.获取要修改的其他信息
        $foldername = $request->input('foldername');
//        3.修改数据库中相应值
        $folder->folder_name = $foldername;

        $res = $folder->save();

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
        //
    }
}
