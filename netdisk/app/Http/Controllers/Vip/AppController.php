<?php

namespace App\Http\Controllers\Vip;

use App\Http\Controllers\Controller;
use App\Model\Vip;
use Illuminate\Http\Request;
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
    public function appCreate($id)
    {
        $cF_id = $id;
        return view('vip.app.add',compact('cF_id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function appStore(Request $request)
    {
        //
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
            return response()->json(['ServerNo'=>'400','ResultData'=>'无效的上传文件']);
        }
        //获取原文件的扩展名
        $ext = $file->getClientOriginalExtension();    //文件拓展名
        //新文件名
        $newfile = md5(time().rand(1000,9999)).'.'.$ext;

        //设置软件存放路径
        $path = public_path('app_cache');


        //1.本地目录：将文件从临时目录移动到本地指定目录
        if(! $file->move($path,$newfile)){
            return response()->json(['ServerNo'=>'400','ResultData'=>'保存文件失败']);
        }
        return response()->json(['ServerNo'=>'200','ResultData'=>$newfile]);

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
