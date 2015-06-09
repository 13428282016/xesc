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
            right: 0px;
            /*right: 100%;*/
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            -ms-transition: all 0.4s;
            -o-transition: all 0.4s;
            transition: all 0.4s;


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

        <div class="am-modal am-modal-confirm" tabindex="-1" id="confirm_delete">
            <div class="am-modal-dialog">
                <div class="am-modal-hd">想要删除这个地址?</div>
                {{--<div class="am-modal-bd">--}}

                {{--</div>--}}
                <div class="am-modal-footer">
                    <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                    <span class="am-modal-btn" data-am-modal-confirm>确定</span>
                </div>
            </div>
        </div>

        <form id="delete_address" method="POST">

            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>

        </form>

        <script src="{{asset('/js/lib/jquery/jquery.touchSwipe.min.js')}}"></script>
        <script>

            $(function() {
                // 记录上一次显示了删除按钮的元素id,已便于点击显示其它删除按钮时，把之前显示了删除按钮的元素重置。
                var last_delete_id = null;

                $('.operate-btn .delete').click(function() {
                    $('#confirm_delete').modal({
                        relatedTarget: this,
                        onConfirm: function(options) {
                            $('form#delete_address').attr('action','/recvaddr/'+last_delete_id);
                            $('#delete_address').submit();
                        },
                        onCancel: function() {
                        }
                    });
                });

                //Enable swiping...
                $("div.am-container #addresses>.address").swipe( {
                    //Generic swipe handler for all directions
                    swipe:function(event, direction, distance, duration, fingerCount, fingerData) {

                        if (direction === 'left') {

                            var id = $(this).data('id');
                            $('#'+id+' .operate-btn nobr').css({
                                'right':'100%'
                            });
                            last_delete_id= id;

                        } else if (direction === null) {

                            $('#'+last_delete_id+' .operate-btn nobr').css({'right':'0px'});

                        }

                    },
                    //Default is 75px, set to 0 for demo so any distance triggers swipe
                    threshold:0
                });

            });

        </script>
   @endif


@endsection