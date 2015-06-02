
@extends('layout.index')

<header data-am-widget="header" class="am-header am-header-default">
    <div class="am-header-left am-header-nav">
        <a href="#left-link" class="">
            返回
        </a>

    </div>
    <h1 class="am-header-title">
        <a href="#title-link" class="">小二上菜</a>
    </h1>

</header>

<div class="am-container">

    @for ($i = 0; $i < 6; $i++)


        <div id="{{$i}}" class="am-g dish">

            <div class="am-u-sm-4">
                <img class="dish-image" width="100%" src="https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=56381638,2357882918&fm=116&gp=0.jpg">
            </div>
            <div class="am-u-sm-8">
                <div class="dish-name">
                    豆豉排骨
                </div>
                <div class="dish-sales">
                    月售：912
                </div>
                <div class="dish-price">
                    ￥{{$i + 10}}.00
                </div>
                <span data-id="{{$i}}" class="add">+</span>
            </div>
        </div>
    @endfor



</div>