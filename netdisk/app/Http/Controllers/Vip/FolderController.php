<?php

namespace App\Http\Controllers\Vip;

use App\Http\Controllers\Controller;
use App\Model\App;
use App\Model\Folder;
use App\Model\Vip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\type;

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

//        文件夹部分
        $folder = DB::table('folder as a')
            ->where(function ($q) use($cF_id){
                $q->where('folder_parentid','=',$cF_id);
            })
            ->where(function ($q) use($cF_id,$currentUser){
                $q->orwhere('folder_userid','=',$currentUser->user_id)
                    ->orwhere('folder_userid','=',$cF_id);
            })
            ->paginate($request->input('num')?$request->input('num'):15);

//        软件部分
//        获取当前目录下所有的app在folder_app中的记录
        $appitem = DB::table('folder_app')->where('folder_id',$cF_id)->get();
//        遍历$app
        $app = [];
                foreach ($appitem as $v){
                    $apptemp = App::find($v->app_id);
                    if($apptemp->app_userid == $currentUser->user_id){
                        $app[] = $apptemp;
            }
        }

        return view('vip.folder.list',compact('folder','request','cF_id','app'));
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
        $res = Folder::create(['folder_name'=>$foldername, 'folder_parentid'=>$folderpid, 'folder_original'=>1, 'folder_userid'=>$currentUser->user_id]);

//        获取新建文件夹的id号码
        $currentFid = Folder::where('folder_name',$foldername)->where('folder_parentid',$folderpid)->first();

//        dd($currentFid->folder_id);

//        添加到数据库vipuser_folder表
        \DB::table('vipuser_folder')->insert(['user_id'=>$currentUser->user_id,'folder_id'=>$currentFid->folder_id]);

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
//        当前文件夹id，后续传回前台，方便新建文件夹等使用
        $cF_id = $id;

//        文件夹打开部分
        $folder = DB::table('folder as a')
            ->where(function ($q) use($cF_id){
                $q->where('folder_parentid','=',$cF_id);
            })
            ->where(function ($q) use($cF_id,$currentUser){
                $q->orwhere('folder_userid','=',$currentUser->user_id)
                    ->orwhere('folder_userid','=',0);
            })

            ->paginate($request->input('num')?$request->input('num'):15);


//        软件打开部分
//        获取当前目录下所有的app在folder_app中的记录
        $appitem = DB::table('folder_app')->where('folder_id',$cF_id)->get();
//        遍历$app
        $app = [];
        foreach ($appitem as $v){
            $apptemp = App::find($v->app_id);
            if($apptemp->app_userid == $currentUser->user_id){
                $app[] = $apptemp;
            }
        }

        return view('vip.folder.list',compact('folder', 'request','cF_id','app'));
    }

    /**
     * move the folder.
     *
     * @param  int  Request $request,$id
     * @return \Illuminate\Http\Response
     */
    public function folderMove(Request $request, $id)
    {
        $folder = Folder::find($id);
        return view('vip.folder.move',compact('folder'));
    }


    /**
     * moveUpdate the folder.
     *
     * @param  int  Request $request,$id
     * @return \Illuminate\Http\Response
     */
    public function folderMoveUpdate(Request $request, $id)
    {
//        获取当前登录用户
        $currentUser = Vip::find(session()->get('vip')->user_id);

        $folder = Folder::find($id);
        $toFolderid = $request->input('toFolderid');

//        1.判断是否为系统文件夹
        if(!$folder->folder_original){
            $data = 2;
            return $data;
        }

//        2.判断用户输入的id是否存在且是自己的
        $toFolder = DB::table('folder as a')
            ->where(function ($q) use($toFolderid){
                $q->where('folder_id','=',$toFolderid);
            })
            ->where(function ($q) use($currentUser){
                $q->orwhere('folder_userid','=',$currentUser->user_id)
                    ->orwhere('folder_userid','=',0);
            })->get();

//        dd(count($toFolder));

//        $toFolder = Folder::find($toFolderid);
        if(!count($toFolder))
        {
            $data = 3;
            return $data;
        }

//        3.修改数据库中相应值
        $folder->folder_parentid = $toFolderid;

        $res = $folder->save();
        if($res){
            $data = 0;
        }else{
            $data = 1;
        }
        return $data;
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
//        根据ID获取要修改的文件夹original属性
        $folder_id = Folder::where('folder_id',$id)->value('folder_original');

        if(!$folder_id)
        {
            $data = 2;
            return $data;
        }

//        1.获取所选文件夹记录
        $folder = Folder::find($id);
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

//        根据ID获取要删除的文件夹original属性
        $folder_id = Folder::where('folder_id',$id)->value('folder_original');

//        dd($folder_id);

//        判断是否为系统文件夹（系统文件夹不允许删除）
        if(!$folder_id)
        {
            $data = 2;
            return $data;
        }

        $folder = Folder::find($id);
        $res1 = $folder->delete();
        $res2 = DB::table('vipuser_folder')->where('folder_id',$folder->folder_id)->delete();
        if($res1 and $res2){
            $data = 0;
        }else{
            $data = 1;
        }
        return $data;
    }
}
