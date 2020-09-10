@extends('admin/layout')
@section('content')
        <!-- 内容主体区域 -->
        <div style="padding: 15px;">

            <span class="layui-breadcrumb">
              <a href="/">首页</a>
              <a href="/demo/">商品管理</a>
              <a><cite>修改品牌</cite></a>
            </span>

        </div>
        @if ($errors->any())
            <div class="alert alert-danger" style="padding-bottom: 20px; padding-left: 30px; background-color: pink">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:#ff0000; padding-top: 10px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="layui-form" action="/admin/brand/update/{{$data->brand_id}}" enctype="multipart/form-data" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">品牌名称：</label>
                <div class="layui-input-block">
                    <input type="text" name="brand_name" lay-verify="title" autocomplete="off" placeholder="请输入品牌名称" value="{{$data->brand_name}}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">品牌LOGO</label>
                <div class="layui-upload-drag" id="test10">
                    <i class="layui-icon"></i>
                    <p>点击上传，或将文件拖拽到此处</p>
                    <div @if(!$data->brand_logo)class="layui-hide"@endif id="uploadDemoView">
                        <hr>
                        <img src="{{$data->brand_logo}}" alt="上传成功后渲染" style="max-width: 196px">
                        <input type="hidden" name="file" value="{{$data->brand_logo}}">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">品牌地址：</label>
                <div class="layui-input-block">
                    <input type="text" name="brand_url" lay-verify="title" autocomplete="off" placeholder="请输入品牌地址" value="{{$data->brand_url}}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">品牌简介：</label>
                <div class="layui-input-block">
                    <input type="text" name="brand_desc" lay-verify="title" autocomplete="off" placeholder="请输入品牌简介" value="{{$data->brand_desc}}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="margin-left: 20px">
                <button type="submit"  class="layui-btn layui-btn-normal">修改</button>
                <button type="reset" class="layui-btn layui-btn-primary">取消</button>
            </div>
        </form>

@endsection