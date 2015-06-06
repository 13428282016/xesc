@extends('...layout.index')
@extends('...layout.header')

@section('content')
<style>

        .am-container .addresses {
            background-color: #ffffff;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
            padding: 10px;
            font-size: 16px;
        }
        .am-container .addresses>.am-g {
            width: 100%;
            height: 40px;
        }
        .am-container div.am-g {
            margin: 0px;
            line-height: 40px;
        }

        .am-container div.am-g ~.am-g {
            border-bottom: 1px solid #d2d2d2;
        }

        .am-container div.am-g +.am-g ~.am-g {
            line-height: 40px;
        }


        .am-container .addresses label {

        }

        .am-container .addresses input {

            border: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
        }

        .am-container .addresses .name {
            border-bottom: 1px solid #d2d2d2;
            padding-left: 23px;
            width: 79%;

        }
        .addresses .sex {
            /*padding-left: 70px;*/
        }
        .addresses .sex input[type='radio'] {
            display:none;

        }
        label {
            padding-left: 20px;
            cursor: pointer;
            background: url('/image/frontend/address_radio_unchecked.png') no-repeat left ;
            font-weight: normal;
            margin:0px 0px 0px 70px;
            font-size: 16px;
        }

        label.checked {
            background: url('/image/frontend/address_radio_checked.png') no-repeat left ;
        }
        .am-navbar .am-navbar-nav .am-btn {
            color: #ffffff;
        }

</style>

 <!-- 添加地址框 -->
    <form method="POST" action="/recvaddr/{{$addr->id}}">
    <div class="am-container">

        <input type="hidden" value="{{csrf_token()}}" name="_token">
        <input type="hidden" value="PUT" name="_method">
        <div class="am-g addresses">

            <div class="am-g contact" >
                联系人:
                <input class="name" name="name" placeholder="请填写收餐人姓名" value="{{$addr->name}}">
            </div>
            <div class="am-g sex">
                <span >
                    <input  type="radio" id="man" name="sex" value="1" @if($addr->sex==\xesc\RecvAddr::SEX_MAN) checked="checked" @endif >
                    <label name="man" for="man" class="checked">先生</label>
                </span>
                <span >
                    <input type="radio" id="lady" name="sex"  @if($addr->sex==\xesc\RecvAddr::SEX_WOMEN) checked="checked" @endif value="2">
                    <label name="lady" for="lady" >女士</label>
                </span>
            </div>
            <div class="am-g">
                联系电话:
                <input name="cellphone" value="{{$addr->cellphone}}" placeholder="请填写收餐手机号码">
            </div>
            <div class="am-g" style="border-bottom: 0px">
                送餐地址:
                <input name="address" style="width: 70%" value="{{$addr->address}}" placeholder="请填写详细收餐地址">
            </div>

        </div>

    </div>
<!-- 添加地址框 -->

<!-- 底栏 -->
<div data-am-widget="navbar" class="am-navbar am-cf " id="" style="z-index: 1009">
    <div class="am-navbar-nav am-cf am-avg-sm-4" style="height: 49px;padding: 0px;overflow: visible">
        <div class="am-g">
            <div class="am-u-sm-12">
                <button
                     class="am-btn"  id="add_addresses_btn" style=" background-color: transparent ;line-height: 35px;">
                    确 定
                </button>
            </div>
            <div class="background" style="  position: absolute;left: -1px;
  width: 101%;
  z-index: -1;">
                <img style="width: 100%" src="{{asset('/image/frontend/address_bottombar_bg.png')}}">
            </div>
        </div>
    </div>
</div>
<!-- 底栏 -->
  </form>
<script>

    $(function() {
        $('.addresses .sex label').click(function(){
            var radioId = $(this).attr('name');
            $('label').removeAttr('class') && $(this).attr('class', 'checked');
            $('input[type="radio"]').removeAttr('checked') && $('#' + radioId).attr('checked', 'checked');
        });
    });

</script>

@endsection