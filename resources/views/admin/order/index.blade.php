@extends('admin/layout')
@section('content')
<style>
#nav .badge
{
  position: absolute;
  top: -10px;
  right: -10px;
}
ul#nav li+li
{
   margin-left: 30px;
}
</style>

<div class="panel panel-default">
<div class="panel-heading">订单管理</div>
  <div class="panel-body">
  <ul id="nav" class="nav nav-pills">
    <li role="presentation" class="@if($type==\xesc\Order::STATUS_WAITTING_PAY)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_WAITTING_PAY)}}">待付款</a>  <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_WAITTING_PAY]}}</span></li>
    <li role="presentation" class="@if($type==\xesc\Order::STATUS_DOING)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_DOING)}}">制作中</a> <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_DOING]}}</span></li>
    <li role="presentation" class="@if($type==\xesc\Order::STATUS_SHIPPING)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_SHIPPING)}}">配送中</a> <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_SHIPPING]}}</span></li>
    <li role="presentation" class="@if($type==\xesc\Order::STATUS_FINISHED)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_FINISHED)}}">已完成</a> <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_FINISHED]}}</span></li>
    <li role="presentation" class="@if($type==\xesc\Order::STATUS_CANCEL)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_CANCEL)}}">已取消</a> <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_CANCEL]}}</span></li>
     <li role="presentation" class="@if($type==\xesc\Order::STATUS_ALL)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_ALL)}}">全部订单</a> <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_ALL]}}</span></li>
  </ul>
  <br>
        @foreach($orders as $order)
        <div class="panel panel-success">
          <!-- Default panel contents -->
          <div class="panel-heading">
          <div class="left">
          <label>订单号：</label>
          <span>{{$order->order_no}}</span>
          </div>
          <div class="right">
           <label>状态：</label>
           <span>{{\xesc\Order::o}}</span>
          </div>
          </div>

          <div class="panel-body">
            <p>...</p>
          </div>

          <!-- Table -->
          <table class="table">
            ...
          </table>
        </div>
        @endforeach
  </div>


</div>

@endsection
