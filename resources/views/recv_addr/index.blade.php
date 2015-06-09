@extends('...layout.index')
@extends('...layout.header')

@section('content')



    <style>

        div.am-container #addresses>.address{
            padding-left: 5px;
            margin: 10px 0px;
            background-color: #ffffff;
            border-bottom: 1px solid #efefef;
            border-radius: 15px;
            height: 70px;
            overflow: hidden;
        }

        div.am-container #addresses>.address div {
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
            margin-top: 10px;
        }

        .details .user-details span {
            color: #808080;
            margin-right: 20px;
        }

        .operate-btn {
            width: 20%;
            text-align: center;
            line-height: 70px;
            float: right;
            height: 70px;
            overflow: hidden;
        }

        .operate-btn nobr {
            position: relative;
            /*right: 100%;*/
        }

        .operate-btn .edit {
            position: relative;
            display: inline-block;
            width: 100%;
            height: 100%;
        }

        .operate-btn  .delete {
            display: inline-block;
            width: 93%;
            height: 100%;
            background-color: #fd4548;
            color: #ffffff;
            margin-left: 8px;
        }
        @media screen and (max-width: 380px) {

            .operate-btn  .delete {
                text-align: left;
            }
        }

        @media screen and (max-width: 530px) and (min-width: 380px ) {
            .operate-btn  .delete span{
                margin-right: 25%;
            }
        }
        @media screen and (min-width: 530px ) {
            .operate-btn  .delete span{
                margin-right: 10%;
            }
        }


    </style>


<div class="am-container">

    @if($addrs)

        <div id="addresses">
        @foreach($addrs as $addr)

            <div id="{{$addr->id}}" class="address" data-id="{{$addr->id}}">

                <div class="details">
                        <span class="address-details"><nobr>{{$addr->address}}</nobr></span><br/>
                    <div class="user-details">
                        <span class="username">{{$addr->name}}</span> <span class="cellphone">{{$addr->cellphone}}</span>
                    </div>
                </div>

                @if( !$chooseAddr )
                <div class="operate-btn" >
                    <nobr>
                    <a class="edit" data-id="{{$addr->id}}" href="{{url("recvaddr/$addr->id/edit")}}" id="edit_address">
                        <img width="25px" src="{{asset('/image/frontend/myaddress_list_edit_address.png')}}" alt=""/>
                    </a>
                    <a class="delete">
                        <img height="70" style="position: relative;left: -8px;  bottom: 1px;float: left" src="{{asset('/image/frontend/address_delete_left_border.png')}}">
                        <span>删除</span>
                    </a>
                    </nobr>
                </div>


                @endif
            </div>

        @endforeach
        </div>

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


    @if($chooseAddr)

        <form id="chooseAddr" style="display: none" method="post" action="/order/choose-addr">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input id="addressId" name="addressId" value="0">
        </form>

        <script>
            $('div.am-container #addresses>.address').click(function(){
                $('#chooseAddr #addressId').val($(this).data('id'));
                $('#chooseAddr').submit();
            });
        </script>
    @else

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

        <script src="{{asset('/js/lib/jquery/jquery.touchSwipe.min.js')}}"></script>
        <script>

            $(function() {
                //Keep track of how many swipes
                var count=0;
                var if_showed = 0;
                //Enable swiping...
                $(".address").swipe( {
                    //Generic swipe handler for all directions
                    swipeLeft:function(event, direction, distance, duration, fingerCount) {

                        var id = $(this).data('id');
                       if (!if_showed) {
                            $('#'+id+' .operate-btn .edit').css({
                                'width':0,
                                'right':50
                            });
                       } else {
                           $('.operate-btn .edit').css({
                               'width':'auto',
                               'right':0
                           });
                       }

                    },
                    //Default is 75px, set to 0 for demo so any distance triggers swipe
                    threshold:0
                });
            });

        </script>
    @endif


@endsection