@extends('...layout.index')
@extends('...layout.header')

@section('content')

    <style>

        div.am-container>.address{
            padding: 5px 10px;
            margin: 10px 0px;
            background-color: #ffffff;
            border-bottom: 1px solid #efefef;
            border-radius: 15px;
            height: 70px;
        }

        div.am-container>.address div {
            display: inline-block;
        }

        .address-icon,.no-addresses,.reminder-notes {
            text-align: center;
        }

        .address-icon {
            margin-top: 20%;
        }

        .no-addresses {
            margin-top: 20px;
            color: #333333;
        }

        .reminder-notes {
            margin-top: 10px;
            color: #808080;
        }
        /*.am-navbar-nav a {*/
            /*background: url("../image/frontend/myaddress_list_add_address.png") no-repeat center ;*/
            /*background-size: 16px;*/
        /*}*/

        .am-navbar .am-navbar-nav .am-btn {
            color: #fdc400;
            line-height: 35px;
        }

        .am-navbar .am-navbar-nav .am-btn img {
            display: inline-block;
            width: 16px;
            height: 16px;
            vertical-align: text-top;
            margin: 3px 10px 0px 0px;
        }

        .am-navbar .am-navbar-nav .background {
            position: absolute;left: -1px;width: 101%;z-index: -1;
        }

        .details {
            width: 80%;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #333333;
        }

        .details .user-details span {
            color: #808080;
            margin-right: 20px;
        }

        .edit-btn {
            width: 15%;
            text-align: center;
            line-height: 60px;
            float: right;
        }




    </style>


<div class="am-container">

    @if($addrs)

        @foreach($addrs as $addr)

            <div class="address" data-id="{{$addr->id}}">

                <div class="details">
                        <span class="address-details"><nobr>{{$addr->address}}</nobr></span><br/>
                    <div class="user-details">
                        <span class="username">{{$addr->name}}</span> <span class="cellphone">{{$addr->cellphone}}</span>
                    </div>
                </div>

                <div class="edit-btn" >
                    <a data-id="{{$addr->id}}" href="{{url("recvaddr/$addr->id/edit")}}" id="edit_address">
                        <img width="25px" src="{{asset('/image/frontend/myaddress_list_edit_address.png')}}" alt=""/>
                    </a>
                </div>

            </div>

        @endforeach

    @else
        <div class="address-icon">
            <img width="40" src="{{asset('/image/frontend/myaddress_list_no_address.png')}}">
        </div>
        <div class="no-addresses">
            没有送餐地址
        </div>
        <div class="reminder-notes">
            快去添加一个地址吧
        </div>
    @endif
</div>

<!-- 底栏 -->
<div data-am-widget="navbar" class="am-navbar am-cf " id="" style="z-index: 1009">
    <div class="am-navbar-nav am-cf am-avg-sm-4" style="height: 49px;padding: 0px;overflow: visible">
        <div class="am-g">
            <div class="am-u-sm-12">
                <a class="am-btn" href="{{url("recvaddr/create")}}"  id="add_addresses_btn" >
                    <img src="{{asset('/image/frontend/myaddress_list_add_address.png')}}" >
                   新增送餐地址
                </a>
            </div>
            <div class="background" >
                <img style="width: 100%" src="{{asset('/image/frontend/myaddress_list_bottombar_bg.png')}}">
            </div>
        </div>
    </div>
</div>
<!-- 底栏 -->
    @if($chooseAddr)

        <form id="chooseAddr" style="display: none" method="post" action="/order/choose-addr">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input id="addressId" name="addressId" value="0">
        </form>

        <script>
            $('div.am-container>.address').click(function(){
                $('#chooseAddr #addressId').val($(this).data('id'));
                $('#chooseAddr').submit();
            });
        </script>

    @endif
@endsection