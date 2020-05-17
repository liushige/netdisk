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
        $app = App::find($id);
        return view('vip.app.show',compact('app'));
    }


    /**
     * move app to special folder
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function appMove(Request $request,$id)
    {
        $app = App::find($id);
        return view('vip.app.move',compact('app'));
    }

    /**
     * app move data operation
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function appMoveUpdate(Request $request,$id)
    {
//        获取当前登录用户
        $currentUser = Vip::find(session()->get('vip')->user_id);

        $app = App::find($id);
        $toFolderid = $request->input('toFolderid');

//        1.判断用户输入的id是否存在且是自己的
        $toFolder = DB::table('folder as a')
            ->where(function ($q) use($toFolderid){
                $q->where('folder_id','=',$toFolderid);
            })
            ->where(function ($q) use($currentUser){
                $q->orwhere('folder_userid','=',$currentUser->user_id)
                    ->orwhere('folder_userid','=',0);
            })->get();

        if(!count($toFolder))
        {
            $data = 3;
            return $data;
        }

//        3.修改数据库中相应值
        $res1 = \DB::table('folder_app')->where('app_id',$id)->delete();
        $res2 = \DB::table('folder_app')->insert(['folder_id'=>$toFolderid,'app_id'=>$id]);

        if($res1 and $res2){
            $data = 0;
        }else{
            $data = 1;
        }
        return $data;
    }


    /**
     * modify the loaded app
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appid = $id;
        return view('vip.app.edit',compact('appid'));
    }

    /**
     * upload again
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadAgain(Request $request,$id)
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

    }

    public function storeAgain(Request $request,$id)
    {
//        $listkey = 'LIST:ARTICLE';
//        $hashkey = 'HASH:ARTICLE:';


//        获取当前app
        $app = App::find($id);

////        获取当前登录用户
//        $currentUser = Vip::find(session()->get('vip')->user_id);

        $appname = $request->input('app_name');
        $appurl = $request->input('app_url');
        $appver = $request->input('app_version');
        $appsort = $request->input('app_sort');
        $appplat = $request->input('app_plat');
        $apploc = $request->input('art_thumb');
        $appdoc = $request->input('app_doc');


//        删除之前存的东西通过文件名
//        // 取到磁盘实例
//        $disk = \Illuminate\Support\Facades\Storage::disk('local');
//        $disk->delete($app->);


//        修改数据库中相应值
        $app->app_name = $appname;
        $app->app_url = $appurl;
        $app->app_version = $appver;
        $app->app_sort = $appsort;
        $app->app_platform = $appplat;
        $app->app_location = $apploc;
        $app->app_doc = $appdoc;

        $res = $app->save();

        if($res){
//            如果添加成功，更新redis
//            \Redis::rpush($listkey,$res->art_id);
//            \Redis::hMset($hashkey.$res->art_id,$res->toArray());

            return redirect('vip/app/{app}/edit')->with('errors','操作成功');
        }else{
            return back()->with('errors','操作失败');
        }
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

        $app = App::find($id);
        $res1 = $app->delete();
        $res2 = DB::table('folder_app')->where('app_id',$app->app_id)->delete();
        if($res1 and $res2){
            $data = 0;
        }else{
            $data = 1;
        }
        return $data;
    }

    /**
     * aside show the app as founction
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function asideShow($id)
    {
//        获取当前登录用户
        $currentUser = Vip::find(session()->get('vip')->user_id);

        if($id>=0 and $id<=7)
        {
            $appitem = DB::table('app')->where('app_userid',$currentUser->user_id)->get();
            $app = [];
            foreach ($appitem as $v){
                if($v->app_sort == $id){
                    $app[] = $v;
                }
            }

        } else if($id == 8 or $id == 9){
            $appitem = DB::table('app')->where('app_userid',$currentUser->user_id)->get();
            $app = [];
            foreach ($appitem as $v){
                if($v->app_platform == $id-8){
                    $app[] = $v;
                }
            }
        }else {
        }
        return view('vip.app.sort',compact('app'));
    }

}
