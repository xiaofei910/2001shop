<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 后台大布局 - Layui</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">layui 后台布局</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="">控制台</a></li>
            <li class="layui-nav-item"><a href="">商品管理</a></li>
            <li class="layui-nav-item"><a href="">用户</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它系统</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    贤心
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="">退了</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                @php $name = Route::currentRouteName();@endphp
                <li class="layui-nav-item">
                    <a class="" href="/admin">首页</a>
                </li>
                <li @if(strpos($name,'goods')!==false)class="layui-nav-item layui-nav-itemed" @else class="layui-nav-item"@endif><!--  layui-nav-itemed -->
                    <a class="" href="javascript:;">商品管理</a>
                    <dl class="layui-nav-child">
                        <dd @if($name == 'goods.create')class="layui-this" @endif><a href="javascript:;">添加商品</a></dd>
                        <dd @if($name == 'goods')class="layui-this" @endif><a href="javascript:;">展示商品</a></dd>
                    </dl>
                </li>
                <li @if(strpos($name,'brand')!==false)class="layui-nav-item layui-nav-itemed" @else class="layui-nav-item"@endif>
                    <a href="javascript:;">品牌管理</a>
                    <dl class="layui-nav-child">
                        <dd @if($name == 'brand.create')class="layui-this" @endif><a href="/admin/brand/create">添加品牌</a></dd>
                        <dd @if($name == 'brand')class="layui-this" @endif><a href="/admin/brand">展示品牌</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="">云市场</a></li>
                <li class="layui-nav-item"><a href="">发布商品</a></li>
            </ul>
        </div>
    </div>
    <div class="layui-body">
        @yield('content')
    </div>
    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © layui.com - 底部固定区域
    </div>
</div>
<script src="/static/admin/layui/layui.js"></script>
<script>
    //JavaScript代码区域
    layui.use(['form','element'], function(){
        var element = layui.element;
        var form = layui.form
    });

    layui.use('upload', function(){
        var $ = layui.jquery
                ,upload = layui.upload;
        //拖拽上传
        upload.render({
            elem: '#test10'
            ,url: '/admin/brand/upload' //改成您自己的上传接口
            ,done: function(res){
                layer.msg(res.msg);
                layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src',res.store_result);
//                console.log(res)
                layui.$('input[name="file"]').val(res.store_result);
            }
        });
    });
</script>
</body>
</html>