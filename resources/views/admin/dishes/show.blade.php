@extends('admin/layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">查看美食</div>
    <div class="panel-body">
        <div>
            <label>商品名：</label><span>{{$dishes->name}}</span>
        </div>
         <div>
            <label>状态：</label>
            <span>
            @if($dishes->status==\xesc\Dishes::STATUS_ONLINE)
            在售
            @elseif($dishes->status==\xesc\Dishes::STATUS_OFFLINE)
            下架
            @endif
            </span>
         </div>
        <div>

            <label>价格：</label><span>{{$dishes->price}}</span>
        </div>
        <div>
            <label>照片：</label><img src="{{$dishes->image}}">
        </div>
        <div>
            <label>描述：</label><span>{{$dishes->desc}}</span>
        </div>
        <div>
            <label>添加时间：</label><span>{{$dishes->created_at}}</span>
        </div>
        <div>
            <label>修改时间：</label><span>{{$dishes->updated_at}}</span>
        </div>

    </div>


</div>
@endsection