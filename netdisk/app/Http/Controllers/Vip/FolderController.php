<?php

namespace App\Http\Controllers\Vip;

use App\Http\Controllers\Controller;
use App\Model\Folder;
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
        $folder = Folder::orderBy('folder_id','asc')
            ->where(function ($query) use ($request){
                $foldername = $request->input('foldername');
                if(!empty($foldername)){
                    $query->where('folder_name','like','%'.$foldername.'%');
                }
            })
            ->paginate($request->input('num')?$request->input('num'):10);
        return view('vip.folder.list',compact('folder','request'));
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
