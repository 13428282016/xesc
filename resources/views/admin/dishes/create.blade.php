
@extends('admin/layout')

@section('content')
<script src="{{asset('/js/lib/jquery.iframe-transport/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('/js/lib/imageUpload/image_upload.js')}}"></script>
<link href="{{asset('/js/lib/imageUpload/css/image_upload.css')}}" rel="stylesheet">
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
      <button id="upload" type="button" class="btn btn-success">上传照片</button>
    </div>
  <div class="form-group">
    <label for="desc">描述</label>
    <textarea class="form-control" name="desc" >{{old('desc')}}</textarea>

  </div>

  <button type="submit" class="btn btn-default">添加美食</button>
</form>
  </div>
</div>
<script>

$('#upload').imageUpload('imageUpload',{initType:'single',name:'image', maxByte:1024*1024*4,url:"/upload/dishes",suffixs:['png','jpg','jpeg']});
</script>


@endsection