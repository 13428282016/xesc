/**
 * Created by Administrator on 2015/3/31.
 * 需引入：
 jQuery
 <script src="{js_lib file=jquery.iframe-transport/jquery.iframe-transport.js}"></script>
 <script src="{js file=public/util.js}"></script>
 <link href="{js_lib file=imageUpload/css/image_upload.css}" rel="stylesheet" type="text/css"/>
 */



/*上传图片*/
var image_upload=(function(window,$){


    var image_upload,/*暴露的对象*/
        settings,/*默认配置*/
        initTypes,/*图片初始化类型 ，single 为没个按钮对应一个图片，multi为每个按钮对应多个图片 */
        initWithSingle,/**/
        extendsMethods,/*扩展到jquery原型*/
        valid,/*验证图片的合法性*/
        initWithMulti,
        util;

    util=(function (window,$)
    {
        var util;

        util={};


        util.isValidFileSize=function(file,min,max)
        {

            var size,files,i;

            files=file.files;
            i=0;


            if($.isNumeric(max))
            {
                for( ; i< files.length;i++) {
                    size=files[i].size;
                    if( size < min && size > max)
                    {
                        return false;
                    }
                }
            }
            else if(max)
            {
                for( ; i< files.length;i++) {
                    size=files[i].size;
                    if( min < size)
                    {
                        return false;
                    }
                }
            }
            else
            {
                for( ; i< files.length;i++) {

                    size=files[i].size;
                    if(min > size)
                    {
                        return false;
                    }
                }
            }

            return true;




        }

        util.isValidFileSuffix=function(file,suffixs)
        {
            var files,
                suffix,
                name,
                i;
            i=0;
            files=file.files;

            for( ; i< files.length;i++)
            {

                name=files[i].name;
                suffix= name.substring(name.lastIndexOf('.')+1);
                if($.inArray(suffix,suffixs)==-1)
                {
                    return false;
                }
            }
            return true;

        }
        return util;


    })(window,$);
    image_upload={};
    image_upload.settings=settings={
        maxByte:null,
        minByte:null,
        suffixs:["png","jpg","jpeg"],
        url:"",
        initType:'single',
        name:"imgs[]",
        maxNum:null
    };
    initTypes=["single","multi"];

    initWithMulti =function(settings)
    {

        var $this;
        $this = this;

        //由于元素动态改变，所以这里使用委托注册事件
        $this.each(
            function()
            {
                var $parent;
                $parent=$(this).parent();


                //避免重复委托
                if(!$parent.data('delegated'))
                {
                    //删除图片，显示关闭按钮，隐藏关闭按钮
                    $parent.delegate('.close','click',function(){

                        var $this,
                            $imgs,
                            $btn,
                            settings;
                        $this=$(this);
                        $imgs=$this.parents('.upload-imgs');
                        $btn=$imgs.data('img-btn');
                        settings=$btn.data('settings');
                        $btn.show();
                        $this.parent('.img').remove();

                    }).delegate('.img' ,'mouseenter',function(){
                        var $this;
                        $this=$(this);
                        $this.children('.close').show();

                    }).delegate('.img' ,'mouseleave',function(){
                        var $this;
                        $this=$(this);
                        $this.children('.close').hide();
                    });
                    $parent.data('delegated',true);
                }
            }
        );


        //初始化每个元素的配置
        this.each(function(){
            $(this).data('settings', $.extend(true, {}, settings));
        });
        //点击上传
        this.click(function () {

            var $file,
                $this;
            $this=$(this);
            //穿件临时文件对话框
            $file = $("<input type='file' name='file'>");
            $file.change(function () {
                //验证文件类型
                if(!valid(settings,this))
                {
                    return false;
                }
                //上传文件
                $.ajax(settings.url, {
                    files: $file,
                    iframe: true,
                    processData: true,
                    dataType:'json'
                }).success(function (data) {

                    //释放文件DOM对象
                    delete $file;
                    var $src,
                        $container,
                        settings;
                    if (data.ok) {


                        settings=$this.data('settings');
                        //获取图片url
                        $src = data.msg.data.url;
                        $container=settings.imgContainer|| $("<div class='upload-imgs'></div>");
                        //创建图片预览和隐藏域
                        $item = $("<div class='img'><img/><input type='hidden'><span class='close'></span></div>");
                        $item.children('img').attr('src', $src);
                        $item.children('input').attr({name: settings.name}).val($src);
                        //添加图片到容器
                        $container.append($item);
                        //添加容器到图片前面
                        $container.insertBefore($this);
                        //记录关系
                        $container.data('img-btn',$this);
                        settings.imgContainer = $container;
                        //如果图片数量达到最大值，隐藏上传按钮
                        if($.isNumeric(settings.maxNum)&&$container.children().size()>=settings.maxNum)
                        {
                            $this.hide();
                        }

                    }
                });
            });
            //打开对话框
            $file.click();
        });

    };

    initWithSingle =function (settings) {
        var $this;
        $this = this;

        $this.each(
            function()
            {
                var $parent;
                $parent=$(this).parent();
                if(!$parent.data('delegated'))
                {
                    $parent.delegate('.close','click',function(){

                        var $this,
                            $imgs,
                            $btn,
                            settings;
                        $this=$(this);
                        $imgs=$this.parents('.upload-imgs');
                        $btn=$imgs.data('img-btn');
                        settings=$btn.data('settings');
                        $btn.show();
                        settings.imgContainer.remove();
                        settings.imgContainer=null;

                    }).delegate('.img' ,'mouseenter',function(){
                        var $this;
                        $this=$(this);

                        $this.children('.close').show();

                    }).delegate('.img' ,'mouseleave',function(){
                        var $this;
                        $this=$(this);
                        $this.children('.close').hide();
                    });
                    $parent.data('delegated',true);

                }
            }
        );


        this.each(function(){
            $(this).data('settings', $.extend(true, {}, settings));
        });
        this.click(function () {

            var $file,
                $this;
            $this=$(this);
            $file = $("<input type='file' name='file'>");

            $file.change(function () {
                if(!valid(settings,this))
                {
                    return false;
                }
                $.ajax(settings.url, {
                    files: $file,
                    iframe: true,
                    processData: true,
                    type:'POST',
                    dataType:'json'
                }).success(function (data) {

                    delete $file;
                    var $src,
                        $container,
                        settings;
                    if (data.ok) {

                        settings=$this.data('settings');
                        $src = data.msg.data.url;
                        $container= $("<div class='upload-imgs'></div>");
                        $item = $("<div class='img'><img/><input type='hidden'><span class='close'></span></div>");
                        $item.children('img').attr('src', $src);
                        $item.children('input').attr({name: settings.name}).val($src);
                        //添加图片到容器
                        $container.append($item);
                        //添加容器到图片前面
                        $container.insertBefore($this);
                        $container.data('img-btn',$this);
                        settings.imgContainer = $container;
                        $this.hide();


                    }
                });
            });
            $file.click();
        });
    };
    extendsMethods={

        imageUpload:function(settings)
        {
            //合并配置
            settings=settings?$.extend({},image_upload.settings,settings):image_upload.settings;
            if($.inArray(settings.initType,initTypes)==-1)
            {
                throw  new Error ("illegal initType");
            }
            if(!settings.url)
            {
                throw new Error("illegal url");
            }
            if(settings.initType=="single")
            {

                  initWithSingle.call(this,settings);

            }
            else if(settings.initType=="multi")
            {

                initWithMulti.call(this,settings);

            }
        }

    };






    image_upload.valid=valid= function (settings,file)
    {

        var suffixs,
            maxByte,
            minByte,
            $this;

        suffixs = settings.suffixs;
        maxByte = settings.maxByte;
        minByte = settings.minByte;
        if (!util.isValidFileSuffix(file, suffixs)) {
            alert("文件类型必须为" + suffixs.toString());
            return false;
        }
        if($.isNumeric(maxByte)&& $.isNumeric(minByte))
        {
            if (!util.isValidFileSize(file, minByte,maxByte))
            {
                alert("文件大小必须在" + minByte / 1024 / 1024 + "MB - " +maxByte/1024/1024+"MB 之间");
                return false;
            }
        }
        else if($.isNumeric(minByte))
        {
            if ( util.isValidFileSize(file, minByte, false)) {
                alert("文件大小必须小于" + minByte / 1024 / 1024 + "MB");
                return false;
            }
        }
        else if($.isNumeric(maxByte))
        {
            if (util.isValidFileSize(file, maxByte)) {
                alert("文件大小不能大于" + maxByte / 1024 / 1024 + "MB");
                return false;
            }
        }


        return true;
    };
    //调用方法的入口
    image_upload.callMethod=function()
    {
        var methodName,
            obj,
            argIndex;
        obj=arguments[0];

        //通过$ 静态方法调用
        if(typeof obj =='object')
        {
            obj=$(obj);
            methodName=arguments[1];
            argIndex=2;
        }
        //通过$() 成员方法调用
        else if(typeof  obj =="string")
        {
            obj=this;
            methodName=arguments[0];
            argIndex=1;

        }
        else
        {
           throw new Error("illegal argument")
        }

        if(!$.isFunction( extendsMethods[methodName]))
        {
            throw  new Error ("illegal methodName");
        }
        //获取参数
        extendsMethods[methodName].apply(obj,[].slice.call(arguments,argIndex));

    };
    $.fn.imageUpload=image_upload.callMethod;
    $.imageUpload=image_upload.callMethod;
    return image_upload;

})(window,$);
