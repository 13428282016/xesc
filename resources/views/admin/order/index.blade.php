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
div#orders .order .left
{
  float: left;
}
div#orders .order .right

{
  float: right;
}

div#orders .order  .status{
 color: red;
}
div#orders .order  .summary{
color: red;
}
div#orders .order .right li{
list-style: none;
float: left;
margin: 0 10px;

}
div#orders .order .table .dishes-img
{
  width: 60px;
  height: 60px;
}
div#orders .order .operation
{
  text-align: right;
  padding: 10px;
}
</style>

<div class="panel panel-default">
<div class="panel-heading">订单管理</div>
  <div id="orders" class="panel-body">
  <ul id="nav" class="nav nav-pills">
    <li role="presentation" class="@if($type==\xesc\Order::STATUS_SUBMITTED)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_SUBMITTED)}}">已提交</a>  <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_SUBMITTED]}}</span></li>
    <li role="presentation" class="@if($type==\xesc\Order::STATUS_DOING)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_DOING)}}">制作中</a> <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_DOING]}}</span></li>
    <li role="presentation" class="@if($type==\xesc\Order::STATUS_SHIPPING)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_SHIPPING)}}">配送中</a> <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_SHIPPING]}}</span></li>
    <li role="presentation" class="@if($type==\xesc\Order::STATUS_FINISHED)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_FINISHED)}}">已完成</a> <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_FINISHED]}}</span></li>
    <li role="presentation" class="@if($type==\xesc\Order::STATUS_CANCEL)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_CANCEL)}}">已取消</a> <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_CANCEL]}}</span></li>
     <li role="presentation" class="@if($type==\xesc\Order::STATUS_ALL)active @endif"><a href="{{url("admin/order?type=".\xesc\Order::STATUS_ALL)}}">全部订单</a> <span class="badge">{{$ordersAmount[\xesc\Order::STATUS_ALL]}}</span></li>
  </ul>
  <br>
        @foreach($orders as $order)
        <div class="panel order panel-success">
           <input class="order-id" type="hidden" value="{{$order->id}}">
          <!-- Default panel contents -->
          <div class="panel-heading clearfix ">
          <div class="left">

          <label>订单号：</label>

          <span>{{$order->order_no}}</span>
          </div>
          <div class="right">
            <ul>
            <li>
          <label >总价：</label>
                     <span class="summary">{{$order->price}}</span>
            </li>
            <li>
             <label>状态：</label>
                       <span class="status">{{\xesc\Order::orderStatus($order->status)}}</span>
            </li>
            <li>
             <label>下单时间：</label>
                       <span>{{$order->created_at}}</span>
            </li>
            </ul>



          </div>
          </div>

          <div class="panel-body">

          </div>

          <!-- Table -->
          <table class="table table-striped">
            <thead>
            <th>美食名</th>
            <th>美食图片</th>
            <th>数量</th>
            <th>单价</th>
            <th>合计</th>
            </thead>
            <tbody>
            @foreach(DB::table('order_dishes_mid')->where('order_id',$order->id)->get() as $orderDishes)
            <tr>
            <td>{{$orderDishes->dishes_name}}</td>
            <td><img class="dishes-img" src=" {{$orderDishes->dishes_image}}"></td>
            <td>{{$orderDishes->dishes_amount}}</td>
            <td>{{$orderDishes->dishes_price}}</td>
            <td>{{$orderDishes->dishes_price*$orderDishes->dishes_amount}}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
          <div class="operation">
            <button id="do-btn" type="button"  class="btn @if ($order->status!=\xesc\Order::STATUS_SUBMITTED)hide @endif btn-primary " >制作美食</button>
            <button id="ship-btn"type="button" class="btn @if($order->status!=\xesc\Order::STATUS_DOING)hide @endif btn-success " >配送</button>
            <button id="cancel-btn" type="button" class="btn btn-info @if($order->status==\xesc\Order::STATUS_FINISHED||$order->status==\xesc\Order::STATUS_CANCEL)hide @endif " >取消订单</button>

          </div>
        </div>
        @endforeach
  </div>


</div>
<script>

var orderManager=(function(window,$){

   var order;

    order={

      action:function(type)
        {
              var id= $(this).parents('.order').find('.order-id').val();
                      console.log(this);
                      $.post('{{url('admin/order/')}}/'+type,{_token:"{{csrf_token()}}",id:id},function(data){

                         if(data.success)
                         {
                             location.reload();
                         }
                      });
        },

      init:function()
      {

         $('#do-btn').click(function()
         {
            order.action.call(this,'do');
         });
         $('#ship-btn').click(function()
          {
               order.action.call(this,'ship');
           });
         $('#cancel-btn').click(function()
           {
              order.action.call(this,'cancel');
            });

      }
    }

    order.init()

    return order;

})(window,$);

</script>
@endsection
