@extends('admin/layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">美食列表</div>
    <div class="panel-body">
    <table id="dishes" class="table table-hover">
    <thead>
    <th>美食名</th>
        <th>图片</th>
        <th>价格</th>
        <th>状态</th>
          <th>描述</th>
          <th>操作</th>

    </thead>
    <tbody>
    @foreach($dishes as $dish)
    <tr>
    <td><a href="{{url('admin/dishes/'.$dish->id)}}">{{$dish->name}}</a></td>
    <td><a  href="{{url('admin/dishes/'.$dish->id)}}"> <img src=" {{$dish->image}}"/></a></td>
    <td>{{$dish->price}}</td>
    <td>{{$dish->desc}}</td>
    <td><a href="{{url('admin/dishes/'.$dish->id)}}">查看</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{url('admin/dishes/'.$dish->id.'/edit')}}">编辑</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="delete" href="javascript:void(0)" data-id="{{$dish->id}}">删除</a></td>
    </tr>
    @endforeach

    </tbody>


    </table>


    </div>

    <div style="text-align: center">

    <?php echo $dishes->render()?>
    </div>


</div>
<script>
$('#dishes').delegate('.delete','click',function(){

    var id=$(this).data('id');
    $.post("{{url('admin/dishes')}}/"+id,{_method:'DELETE',_token:'{{csrf_token()}}'},function(retval){

          if(retval)
            {
               location.reload();
            }

    });
})
</script>
@endsection
