@extends('admin/layout')
@section('content')
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">

        <span class="layui-breadcrumb">
          <a href="/">首页</a>
          <a href="/demo/">商品管理</a>
          <a><cite>展示品牌</cite></a>
        </span>

    </div>
    <form class="layui-form" action="/admin/brand" style="padding-bottom: 10px;padding-left: 10px;">
            品牌名称：
            <div class="layui-input-inline">
                <input type="text" name="brand_name"  class="layui-input" value="{{$brand['brand_name']??''}}" placeholder="请输入品牌名称......">
            </div>
            品牌网址：
            <div class="layui-input-inline">
                <input type="text" name="brand_url" class="layui-input" value="{{$brand['brand_url']??''}}" placeholder="请输入品牌网址......">
            </div>
            <button type="submit" class="layui-btn">搜索</button>
    </form>

    <button type="button" class="layui-btn layui-btn-primary moredel">批量删除</button>

        <table class="layui-table" id="test">
            <thead>
            <tr>
                <th width="20"> <input class="layui-form-checkbox" type="checkbox" name="checkedall" lay-skin="primary"></th>
                <th width="150">ID</th>
                <th width="150">品牌名称</th>
                <th width="150">品牌网址</th>
                <th width="150">品牌LOGO</th>
                <th width="150">品牌简介</th>
                <th width="150">操作</th>
            </tr>

            </thead>
            <tbody>
            @foreach($data as $k=>$v)
            <tr brand_id = {{$v->brand_id}}>
                <td> <input type="checkbox" name="brandcheck[]" lay-skin="primary" value="{{$v->brand_id}}"></td>
                <td>{{$v->brand_id}}</td>
                <td field="brand_name" oldval = {{$v->brand_name}}>
                    <span class="brand">{{$v->brand_name}}</span>
                    <input class="brands" value="{{$v->brand_name}}" style="display:none" brand_id="{{$v->brand_id}}">
                </td>
                <td field="brand_url" oldval = {{$v->brand_url}}>
                    <span class="brand">{{$v->brand_url}}</span>
                    <input class="brands" value="{{$v->brand_url}}" style="display:none" brand_id="{{$v->brand_id}}"></td>
                <td>
                    @if(!empty($v->brand_logo))
                        <img src="{{$v->brand_logo}}">
                    @endif
                </td>
                <td>{{$v->brand_desc}}</td>
                <td>
                    <a href="/admin/brand/edit/{{$v->brand_id}}"><button type="button" class="layui-btn layui-btn-normal">修改</button></a>
                    <button type="button" class="layui-btn layui-btn-danger del">删除</button>
                </td>
            </tr>
                @endforeach
            <tr>
                <td colspan="7px">
                    {{$data->appends($brand)->links('vendor.pagination.adminshop')}}
                </td>
            </tr>
            </tbody>

        </table>
    <script src="/static/jquery.js"></script>
    <script>
        //删除
        $(document).on('click','.del',function(){
            var brand_id=$(this).parents('tr').attr('brand_id');
            if(window.confirm("确认删除吗？")){
                $.ajax({
                    url:'/admin/brand/destroy',
                    data:{brand_id:brand_id},
                    type:'post',
                    dataType:'json',
                    success:function(result){
                        if(result['code']==00000){
                            alert(result['msg']);
                            location.href=result['url'];
                        }else{
                            alert(result['msg']);
                            location.href=result['url'];
                        }
                    }
                })
            }
        });
        //即点即改
        $(document).on('click','.brand',function(){
            $(this).hide();
            $(this).next('input').show();

        })
        $(document).on('blur','.brands',function(){
            var oldval = $(this).parent('td').attr('oldval');
//            console.log(oldval);
//            return;
            var data = $(this).val();
            var field = $(this).parent('td').attr('field');
//            console.log(data);
//            console.log(field);
//            return;
            if(oldval == data){
//                $(this).hide();
//                $('#brand_name').html('<span id="brand_name">'+oldval+'</span>').show();
                window.location.reload();
                return;
            }
            var brand_id = $(this).attr('brand_id');
            if(data == ''){
                alert('不能为空');
                window.location.reload();
//                $(this).val(oldval).hide();
//                $('#brand_name').html('<span id="brand_name">'+oldval+'</span>').show();
                return;
            }
            var _this = $(this);
            $.ajax({
                url:'/admin/brand/brandjd',
                type:'post',
                data:{data:data,field:field,brand_id:brand_id},
                dataType:'json',
                success:function(res){
                    if(res.code == '00000'){
                        window.location.reload();
                    }else{
//                        console.log(res);
                        alert(res.msg);
                        window.location.reload();
//                        _this.val(oldval).hide();
//                        $('#brand_name').html('<span id="brand_name">'+oldval+'</span>').show();
                        return;
                    }
                }
            })
        })
        //ajax分页
        $(document).on('click','.layui-laypage a',function(){
            //获取要跳转的路径
            var url = $(this).attr('href');
            $.get(url,function(res){
                $('tbody').html(res);
//                console.log(res);
//                return false;
            })
            return false;
        })
        //全选
        $(document).on('click','.layui-form-checkbox:first',function(){
            var checkedval = $('input[name="checkedall"]').prop('checked');
//            alert(checkedval);
            $('input[name="brandcheck[]"]').prop('checked',checkedval);
            if(checkedval){
                $('.layui-form-checkbox:gt(0)').addClass('layui-form-checked');
            }else{
                $('.layui-form-checkbox:gt(0)').removeClass('layui-form-checked');
            }
        })
        //批量删除
        $(document).on('click','.moredel',function(){
            var ids = new Array();
            $('input[name="brandcheck[]"]:checked').each(function(i,k){
                ids.push($(this).val());
            })
            $.get('/admin/brand/destroys',{brand_id:ids},function (res){
                window.location.reload();
            })
        })
    </script>
    </div>
@endsection