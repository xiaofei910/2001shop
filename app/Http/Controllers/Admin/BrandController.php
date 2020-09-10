<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandPost;
use App\Models\Brand;
use Illuminate\Http\Request;
use Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brand_name = $request->brand_name;
        $where = [];
        if($brand_name){
            $where[] = ['brand_name','like',"%$brand_name%"];
        }
        $brand_url = $request->brand_url;
        if($brand_url){
            $where[]= ['brand_url','like',"%$brand_url%"];
        }

        $data =  Brand::where($where)->where('is_del',1)->orderBy('brand_id','desc')->paginate(2);
        if($request->ajax()){
            return view('admin.brand.brandpage',['data'=>$data,'brand'=>$request->all()]);
        }

        return view('admin.brand.index',['data'=>$data,'brand'=>$request->all()]);
    }
    /**
     * 即点即改
     */
    public function brandjd(Request $request){
        $data = $request->data;
        $brand_id = $request->brand_id;
        $field = $request->field;
//        dd([$data,$brand_id,$field]);
        if(!$data || !$brand_id){
//            return json_encode(['code'=>00002,'msg'=>'不能为空']);
            return $this->error('缺少参数');
        }
        if($field == 'brand_name'){
            $where=[
                ['brand_name','=',$data],
                ['brand_id','!=',$brand_id]
            ];
            $one = Brand::where($where)->first();
            if(!empty($one)){
//            return json_encode(['code'=>00003,'msg'=>'品牌名称已存在']);
                return $this->error('品牌名称已存在');
            }
        }
        $res = Brand::where('brand_id',$brand_id)->update([$field=>$data]);
        if($res){
//            return json_encode(['code'=>00000,'msg'=>'修改成功']);
            return $this->success('修改成功');
        }else{
//            return json_encode(['code'=>00001,'msg'=>'修改失败']);
            return $this->error('修改失败');
        }
    }

    /**
     * Show the form for creating a new resource.
     *添加视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
////第二种方法 表单验证请求类
//    public function store(StoreBrandPost $request)
    {
        //第一种方法 validate方法
//        $request->validate([
//            'brand_name' => 'required|unique:brand',
//            'brand_url' => 'required',
//        ],[
//            'brand_name.required'=>'品牌名称不能为空',
//            'brand_name.unique'=>'品牌名称已存在',
//            'brand_url.required'=>'品牌网址不能为空',
//        ]);

        //第三种方法 Validator 门面
        $validator = Validator::make($request->all(),[
            'brand_name' => 'required|unique:brand',
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称不能为空',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_url.required'=>'品牌网址不能为空'
        ]);

        if ($validator->fails()){
            return redirect('admin/brand/create')->withErrors($validator)->withInput();
        }
//        echo 123;
//        exit;
        $data = $request->except(['_token','file']);
        $data['brand_logo'] = $request->file;
//        dd($data);

//        $brand = new Brand();
//        $brand->brand_name = $request->brand_name;
//        $brand->brand_logo = $request->brand_logo;
//        $brand->brand_url = $request->brand_url;
//        $brand->brand_desc = $request->brand_desc;

        $res = Brand::create($data);
        if($res){
            return redirect('/admin/brand');
        }
    }
    /**
     * 文件上传
     */
    public function upload(Request $request){

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file;
            //        dd($file);
            $store_result = '/'.$file->store('brand_upload');
            return json_encode(['code'=>00000,'msg'=>'上传成功','store_result'=>$store_result]);
        }
        return json_encode(['code'=>00001,'msg'=>'上传失败']);

    }

    /**
     * Display the specified resource.
     *详情展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Brand::find($id);
        return view('admin.brand.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBrandPost $request, $id)
    {
        $data = $request->except(['_token','file']);
        $data['brand_logo'] = $request->file;
        $res = Brand::where('brand_id',$id)->update($data);
        if($res!==false){
            return redirect('/admin/brand');
        }else{
            return redirect('admin/brand/edit/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $brand_id = $request->brand_id;
        $res = Brand::where('brand_id',$brand_id)->update(['is_del'=>2]);
        if($res){
            return json_encode(['code'=>00000,'msg'=>'删除成功','url'=>'/admin/brand']);
        }else{
            return json_encode(['code'=>00001,'msg'=>'删除失败','url'=>'/admin/brand']);
        }
    }
    /**
     * 批量删除
     */
    public function destroys(Request $request)
    {
        $brand_id = $request->brand_id;
//        dd($brand_id);
        foreach($brand_id as $v){
            $res = Brand::where('brand_id',$v)->update(['is_del'=>2]);
        }
        if($res){
            return json_encode(['code'=>00000,'msg'=>'删除成功','url'=>'/admin/brand']);
        }else{
            return json_encode(['code'=>00001,'msg'=>'删除失败','url'=>'/admin/brand']);
        }
    }
}
