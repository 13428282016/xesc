
@extends('admin/layout')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">添加美食</div>
  <div class="panel-body">
  @if (count($errors)>0)

  	<div class="alert alert-danger">

  					<ul>
  								@foreach ($errors->all() as $error)
  									<li>{{ $error }}</li>
  								@endforeach
  				</ul>
  	</div>


  @endif
<form method="POST" action="{{url('admin/dishes')}}">
<input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="form-group">
    <label for="name">菜名</label>
    <input type="text" class="form-control" required  value="{{old('name')}}" name="name" placeholder="请输入菜名">
  </div>
   <div class="form-group">
        <label for="status">状态</label>
        <select name="status">
        <option selected="selected"  value="{{\xesc\Dishes::STATUS_ONLINE}}">在售</option>
        <option   value="{{\xesc\Dishes::STATUS_OFFLINE}}">下架</option>
        </select>
      </div>
  <div class="form-group">
    <label for="price">价格</label>
    <input type="text" class="form-control" required name="price" value="{{old('price')}}" placeholder="请输入商品价格">
  </div>
    <div class="form-group">
      <label for="image">商品图片</label>
      <input  type="file"  name="image" >
    </div>
  <div class="form-group">
    <label for="desc">描述</label>
    <textarea class="form-control" name="desc" >{{old('desc')}}</textarea>

  </div>

  <button type="submit" class="btn btn-default">添加美食</button>
</form>
  </div>
</div>



@endsection