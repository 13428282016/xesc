@extends('layout.index')
@extends('layout.header')

@section('content')
<style>

        .am-container .addresses {
            background-color: #ffffff;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
            padding: 10px;
        }

        .am-container div.am-g {
            margin: 0px;
        }
        .am-container .addresses .name {
            border: 0px;
            border-bottom: 1px;
        }
</style>

    <div class="am-container">
        <div class="am-g addresses">
            <div class="am-g">
                <label>联系人：</label>
                <input class="name" name="name">
            </div>
            <div class="am-g"></div>
            <div class="am-g"></div>
            <div class="am-g"></div> 
        </div>
    </div>

@endsection