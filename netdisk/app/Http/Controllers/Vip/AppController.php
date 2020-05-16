<?php

namespace App\Http\Controllers\Vip;

use App\Http\Controllers\Controller;
use App\Model\App;
use App\Model\Folder;
use App\Model\Vip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Qiniu\Storage;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * create app
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * create app (include infomation) diy
     *
     * @return \Illuminate\Http\Response
     */
    public function appCreate()
    {
        return view('vip.app.add');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function appStore(Request $request)
    {
//        $listkey = 'LIST:ARTICLE';
//        $hashkey = 'HASH:ARTICLE:';

//        获取当前登录用户
        $currentUser = Vip::find(session()->get('vip')->user_id);

        $appname = $request->input('app_name');
        $appurl = $request->input('app_url');
        $appver = $request->input('app_version');
        $appsort = $request->input('app_sort');
        $appplat = $request->input('app_plat');
        $apploc = $request->input('art_thumb');
        $appdoc = $request->input('app_doc');
        $fid = $request->input('app_path');

//        查看用户输入的id是否存在
        $folder = Folder::find($fid);
        if(empty($folder) and $fid != 0)
        {
            return back()->with('errors','存放位置不合法');
        }

//        判断app_path是否属于当前操作对象的
        if($fid){
            $userfolder = DB::table('vipuser_folder as a')
                ->where(function ($q) use($fid){
                    $q->where('a.folder_id','=',$fid);
                })
                ->where(function ($q) use($currentUser){
                    $q->where('a.user_id','=',$currentUser->user_id);
                })
                ->get();
            if(empty($userfolder)){
                return back()->with('errors','存放位置不合法');
            }
        }

//        添加到数据库app表
        $res = App::create(['app_name'=>$appname, 'app_url'=>$appurl, 'app_version'=>$appver, 'app_sort'=>$appsort, 'app_platform'=>$appplat, 'app_location'=>$apploc, 'app_doc'=>$appdoc, 'app_userid'=>$currentUser->user_id]);

//        获取新建app的id号码
        $currentApp = App::where('app_location',$apploc)->where('app_userid',$currentUser->user_id)->first();

//        添加到数据库folder_app表
        \DB::table('folder_app')->insert(['app_id'=>$currentApp->app_id,'folder_id'=>$fid]);

        if($res){
//            如果添加成功，更新redis
//            \Redis::rpush($listkey,$res->art_id);
//            \Redis::hMset($hashkey.$res->art_id,$res->toArray());

            return redirect('vip/app/{app}/create')->with('errors','操作成功');
        }else{
            return back()->with('errors','操作失败');
        }
    }

    /**
     * 本地上传到指定临时文件夹
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //文章上传
    public function upload(Request $request)
    {
        //获取上传文件
        $file = $request->file('app');
        //判断上传文件是否成功
        if(!$file->isValid()){
            return response()->json(['ServerNo'=>'400','ResultData'=>'无效的上传文件','OriginalName'=>'上传失败，请重新上传']);
        }
        //获取原文件扩展名
        $ext = $file->getClientOriginalExtension();    //文件拓展名
        $name = $file->getClientOriginalName();          //原文件名

//        dd($name);

        //新文件名
        $newfile = md5(time().rand(1000,9999)).'.'.$ext;

        //设置软件存放路径
        $path = public_path('app_cache');


        //1.本地目录：将文件从临时目录移动到本地指定目录
        if(! $file->move($path,$newfile)){
            return response()->json(['ServerNo'=>'400','ResultData'=>'保存文件失败','OriginalName'=>'上传失败，请重新上传']);
        }
        return response()->json(['ServerNo'=>'200','ResultData'=>$newfile,'OriginalName'=>$name]);

//        2. 将文件上传到OSS的指定仓库
//        $osskey : 文件上传到oss仓库后的新文件名
//        $filePath:要上传的文件资源
//        $res = OSS::upload($newfile, $file->getRealPath());

////        3. 将文件上传到七牛云存储的指定仓库
////        $qiniu = Storage::disk('qiniu');
//
//        $res = \Storage::disk('qiniu')->writeStream($newfile, fopen($file->getRealPath(), 'r'));
//
//
////        $res = Image::make($file)->resize(100,100)->save($path.'/'.$newfile);
//
//        if($res){
//            // 如果上传成功
//            return response()->json(['ServerNo'=>'200','ResultData'=>$newfile]);
//        }else{
//            return response()->json(['ServerNo'=>'400','ResultData'=>'上传文件失败']);
//        }
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
        //
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
        //
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
