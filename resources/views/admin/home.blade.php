@extends('admin.layout')
@section('content')

<ul class="nav nav-pills nav-stacked">
    <li role="presentation" class="active"><a href="{{url('admin/dishes')}}">美食管理</a></li>
    <li role="presentation"><a href="{{url('admin/order')}}">订单管理</a></li>
    <li role="presentation"><a href="{{url('admin/user')}}">用户管理</a></li>
</ul>
@endsection