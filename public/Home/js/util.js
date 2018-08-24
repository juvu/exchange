(function(w, d){
    var accountBind = {
        isImageUploaded : false,
        /**
         * accountBind.init
         * 账号绑定
         * @param {*} name
         * @param {*} requestUrl 绑定请求地址
         */
        init : function(options){
            //如果没有传入requestUrl不能初始化
            if(options.requestUrl === '' || options.requestUrl === null || options.requestUrl === undefined ){
                console.error('[accountBind.update]: The requestUrl attribute is necessary');
                return false;
            }
            //初始化操作
            this.options = options;
            this.name = this.options.name;
            this.requestUrl = this.options.requestUrl;
            var _self = this;
            //处理上传图片
            var imgUpload = new upload({
                uploadId : 'inputfile',
                uploadButtonId : 'uploadButton',
                onUploadSuccess : function(data){
                    _self.payimg = '/Upload/pay/' + data;
                    $('#qcodeImg').attr("src", _self.payimg);
                    $('.image-area').removeClass('hide').addClass('show');
                    _self.isImageUploaded = true;   //图片上传成功
                }
            });
            imgUpload.init();
        },
        
        /**
         * accountBind.update
         * 更新绑定账号信息
         * @returns
         */
        update : function(){
            var _self = this;
            var account = $("#bindAccount").val();   //绑定账号
            var name = $("#name").val();
            var paypassword = $("#paypassword").val();

            if(!_self.isImageUploaded){
                layer.msg('没有上传收款码图片', {icon:2});
                return false;
            }
        
            if (account == "" || account == null) {
                layer.tips('请输入账号', '#bindAccount', {tips: 3});
                return false;
            }
            if (name == "" || name == null) {
                layer.tips('请输入昵称', '#name', {tips: 3});
                return false;
            }
        
            if (paypassword == "" || paypassword == null) {
                layer.tips('请输入交易密码', '#paypassword', {tips: 3});
                return false;
            }
        
            if (paypassword == "" || paypassword == null) {
                layer.tips('请输入交易密码', '#paypassword', {tips: 3});
                return false;
            }
            //传给后台的参数
            var options = {
                name : name,
                payimg : _self.payimg,
                paypassword : paypassword
            };
            options[_self.name] = account;
            $.post(_self.requestUrl, options, function (data) {
                if (data.status == '0000') {
                    layer.msg(data.info, {icon: 1});
                    setTimeout(function(){
                        location.reload();
                    },3000);
                } else {
                    layer.msg(data.info, {icon: 2});
                    if (data.url) {
                        window.location = data.url;
                    }
                }
            }, "json");
        }
    }

    /**
     * Upload
     * 文件上传
     * @param {*} options
     */
    var Upload = function(options){
        this.options = $.extend({
            uploadId : 'uploadInput',  //文件上传html控件id
            uploadButtonId : 'uploadButton'  //触发上传按钮id
        }, options, true);
    }
    /** 
     * upload.init
     * 文件上传初始化
     */
    Upload.prototype.init = function(){
        var _self = this;
        var _upload = document.getElementById(_self.options.uploadId);
        var _upload_button = document.getElementById(_self.options.uploadButtonId);
        $(_upload).on("change", function(){
            //创建FormData对象
            var data = new FormData();
            //为FormData对象添加数据
            $.each($(_upload)[0].files, function (i, file) {
                data.append('upload_file' + i, file);
            });
            //发送数据
            $.ajax({
                url: '/Home/User/imgupload',
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,     //不可缺参数
                processData: false,     //不可缺参数
                success: function (data) {
                    if (data) {
                        _self.imageUrl = '/Upload/pay/' + data;
                        _self.options.onUploadSuccess && _self.options.onUploadSuccess.call(_self, data);  //上传成功触发回调
                    }else{
                        console.error("upload url is null");
                    }
                },
                error: function () {
                    alert('上传出错');
                    //$(".loading").hide();   //加载失败移除加载图片
                }
            });

        });
        $(_upload_button).on('click', function(){
            _upload.click();
        });

        return _self;
    }
    /** 
     * upload.getImageUrl
     * 获取上传文件路径 
     */
    Upload.prototype.getImageUrl = function(){
        return this.imageUrl;
    }

    w.accountBind = accountBind;
    w.upload = Upload;
})(window, document)

/** 
 *  ui
 */
;(function(w,d){
    
    var ui = {
        notice : function(element){
            //获取公告
            $.ajax({
                type : "post",
                url : "http://139.224.64.194:9002/Article/notice",
                success : function(res){
                    $(element).html('<a href="' + res.url + '">公告:' + res.title + '</a>')
                }
            });
        },
        message : function(){
            $.ajax({
                type : "post",
                url : "http://139.224.64.194:9002/Article/notice",
                success : function(res){
                    var html = '<div class="ui-message ui-message-error">';
                    html += '<p>【重要通知】: <a href="' + res.url + '">' + res.title + '</a></p>';
                    html += '<a class="ui-close" href="javascript:;"><i class="ui-icon ui-icon-close"></i></a>';
                    html += '</div>';
                    $("body").prepend(html);
                }
            });
            //绑定关闭事件
            $("body").on("click", ".ui-close", function(e){
                $(this).parents(".ui-message").remove();
            });
        }
    }

    w.ui = ui;
    
})(window, document)