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