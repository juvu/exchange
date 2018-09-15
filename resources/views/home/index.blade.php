@extends('layout.header')
@section('content')
<div class="index_pic_wrap po_re">
    <div id="myCarousel" class="my-carousel">
        <!--<div class="my-carousel-indicators">-->
        <ol class="my-carousel-indicators">
            @foreach($indexAdver as $key=>$val)
                <li data-target="#myCarousel" data-slide-to="{{$key}}" @if($key=1) class="active" @endif>

                </li>
            @endforeach
        </ol>
        <div class="my-carousel-inner">
            @foreach($indexAdver as $key=>$val)
                <div class="item hand @if($key==1) active @endif</eq>" onclick="window.open('/storage/img/ad/{{$val->img}}')" style="background-image: url('/storage/img/ad/{{$val->img}}');"></div>
            @endforeach
        </div>
    </div>
    <div class="login_wrap">
        <div class="login_box">
            <div class="login_bg"></div>
            <!-- 未登录状态 -->
            @if(userid() == 0)
                <div id="login-bar" class="login_box_2">
                    <h2>欢迎登录111交易平台</h2>
                    <dl>
                        <dt>您正在使用的账号为:</dt>
                        <dd>
                            <a href="/finance/" class="user-email">111</a>
                        </dd>
                        <dd>
                            ID：
                            <span class="user-id">2222</span>
                        </dd>
                        <dd>
                            总资产：
                            <span class="user-finance" id="user_finance">loading...</span>
                        </dd>
                    </dl>
                    <div class="login_box_2_btn">
                        <a href="/finance/">充值</a>
                        <a href="/finance/">提现</a>
                        <a href="/finance/mywt.html" class="w82">委托管理</a>
                    </div>
                    <div class="gotocenter">
                        <a href="/finance/" class="center">去财务中心</a>
                    </div>
                    <div class="service_qq"></div>
                </div>
            @else
                <form id="form-login-i">
                    <div class="login_box_1">
                        <div class="login_title">登录</div>
                        <div class="login_text zin90">
                            <input type="text" id='index_username' value="" placeholder="请输入手机号/会员名"/>

                            <div id="email-err-i" class="prompt" style="display: none"></div>
                        </div>
                        <div class="login_text zin80">
                            <input type="password" id="index_password" value="" placeholder="请输入登录密码"/>

                            <div id="pw-err-i" class="prompt" style="display: none"></div>
                        </div>
                        
                        <div class="login_text zin70" id="ga-box-i">
                            <img id="codeImg reloadverifyindex" src="{{captcha_src()}}" width="120" height="38" onclick="this.src=this.src+'?t='+Math.random()" style="margin-top: 1px; cursor: pointer;" title="换一张">
                            <input type="text" class="code" id="index_verify" name="code" placeholder="请输入验证码" style="width: 106px; float: left;">
                        </div>
                        
                        <div class="login_button">
                            <input type="button" value="登录" onclick="upLoginIndex();"/>
                        </div>
                        <div class="login-footer">
                                                
                          <span> <a href="#">免费注册</a> ｜ <a href="#">忘记密码</a>
                          </span>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
<div class="zhanwei"></div>
<!--    公告   -->
<div class="ui-notice">
    <div class="ui-notice-inner">
        <i class="ui-icon ui-icon-tongzhi"></i>
        <div class="ui-notice-content" id="uiNotice"></div>
        <a class="ui-more" href="api/Article/index">更多...</a>
    </div>
</div>
<div class="price_today">
    <div class="autobox">
        <ul class="price_today_ull">
            <li data-sort="0" style="cursor: default;">交易市场</li>
            <li class="click-sort" data-sort="1" data-flaglist="0" data-toggle="0">价格
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="6" data-flaglist="0" data-toggle="0">交易量
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="4" data-flaglist="0" data-toggle="0">总市值
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="7" data-flaglist="0" data-toggle="0">日涨跌
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li>
            <li data-sort="0">价格趋势(3日)</li>
            <li data-sort="0" style="width: 150px; text-align: center; text-indent: -1em;">操作</li>
        </ul>
    </div>
</div>
<ul class="price_today_ul" id="price_today_ul"></ul>

<input type="hidden" name="coin_type" value="cny_btc"/>
<input type="hidden" name="amount" value="1000000"/>

<script type="text/javascript" src="{{ asset('/Home/js/util.js') }}"></script>

<script>
    //顶部通知
    ui.message();
    //通知
    ui.notice("#uiNotice");

    //轮播图
    var $allItems = $('.my-carousel .my-carousel-inner .item');
    var $allIndicators = $('.my-carousel .my-carousel-indicators li');
    var currentIndex = 0;
    var currentItem = null;
    var nextItem = null;
    var time = null;


    $(".my-carousel").hover(function () {
        time = window.clearInterval(time)
    }, function () {
        time = setInterval(function () {
                    currentItem = $allItems.filter('.active');
                    if (currentIndex + 1 === $allItems.length) {
                        nextItem = $allItems.eq(0);
                        currentIndex = 0;
                    } else {
                        nextItem = $allItems.eq(currentIndex + 1);
                        currentIndex += 1;
                    }
                    nextItem.addClass('active').fadeIn(500);
                    $allIndicators.removeClass('active').eq(currentIndex).addClass('active');
                    currentItem.removeClass('active').fadeOut(1000);
                },
                5000);
    }).trigger("mouseleave");

    $(".my-carousel-indicators li").click(function () {

        var nextIndex = parseInt($(this).attr('data-slide-to'));
        if (nextIndex == currentIndex) return false;
        currentIndex = nextIndex;
        currentItem = $allItems.filter('.active');
        currentItem.removeClass('active').fadeOut(1000);
        $allItems.eq(currentIndex).addClass('active').fadeIn(500);

        $allIndicators.removeClass('active').eq(currentIndex).addClass('active');

    });


    $('.price_today_ull > .click-sort').each(function () {
        $(this).click(function () {
            click_sortList(this);
        })
    })

    function allcoin_callback(priceTmp) {
        for (var i in priceTmp) {
            var c = priceTmp[i][8];
            if (typeof (trends[c]) != 'undefined' && typeof (trends[c]['data']) != 'undefined' && trends[c]['data'].length > 0) {
                $.plot($("#" + c + "_plot"), [
                    {
                        shadowSize: 0,
                        data: trends[c]['data']
                    }
                ], {
                    grid: {borderWidth: 0},
                    xaxis: {
                        mode: "time",
                        ticks: false
                    },
                    yaxis: {
                        tickDecimals: 0,
                        ticks: false
                    },
                    colors: ['#f99f83']
                });
            }
        }
    }

    function click_sortList(sortdata) {
        var a = $(sortdata).attr('data-toggle');
        var b = $(sortdata).attr('data-sort');
        $(".price_today_ull > li").find('.cagret-up').css('border-bottom-color', '#848484');
        $(".price_today_ull > li").find('.cagret-down').css('border-top-color', '#848484');
        $(".price_today_ull > li").attr('data-flaglist', 0).attr('data-toggle', 0);
        $(".price_today_ull > li").css('color', '');
        $(sortdata).css('color', '#ff7950');

        if (a == 0) {
            priceTmp = priceTmp.sort(sortcoinList('dec', b));
            $(sortdata).find('.cagret-down').css('border-top-color', '#ff7950');
            $(sortdata).find('.cagret-up').css('border-bottom-color', '#848484');
            $(sortdata).attr('data-flaglist', 1).attr('data-toggle', 1)
        }
        else if (a == 1) {
            $(sortdata).attr('data-toggle', 0).attr('data-flaglist', 2);
            ;
            $(sortdata).find('.cagret-up').css('border-bottom-color', '#ff7950');
            $(sortdata).find('.cagret-down').css('border-top-color', '#848484');
            priceTmp = priceTmp.sort(sortcoinList('asc', b));
        }
        renderPage(priceTmp);
        change_line_bg('price_today_ul', 'li');
        allcoin_callback(priceTmp);
    }

    function trends() {
        $.getJSON('trends?t=' + rd(), function (d) {
            trends = d;
            allcoin();
        });
    }

    function allcoin(cb) {

        $.get('allcoin?t=' + rd(), cb ? cb : function (d) {
            ALLCOIN = d;
            var t = 0;
            var img = '';
            priceTmp = [];
            //把json转换为二维数组 进行渲染
            for (var x in d) {
                if (typeof(trends[x]) != 'undefined' && parseFloat(trends[x]['yprice']) > 0) {
                    rise1 = (((parseFloat(d[x][4]) + parseFloat(d[x][5])) / 2 - parseFloat(trends[x]['yprice'])) * 100) / parseFloat(trends[x]['yprice']);
                    rise1 = rise1.toFixed(2);
                } else {
                    rise1 = 0;
                }
                img = d[x].pop();
                d[x].push(rise1);
                d[x].push(x);
                d[x].push(img);
                priceTmp.push(d[x]);
            }
            //二次排序
            $('.price_today_ull > .click-sort').each(function () {
                var listId = $(this).attr('data-sort');
                if ($(this).attr('data-flaglist') == 1 && $(this).attr('data-sort') !== 0) {
                    priceTmp = priceTmp.sort(sortcoinList('dec', listId))
                } else if ($(this).attr('data-flaglist') == 2 && $(this).attr('data-sort') !== 0) {
                    priceTmp = priceTmp.sort(sortcoinList('asc', listId))
                }
            });

            renderPage(priceTmp);
            allcoin_callback(priceTmp);
            change_line_bg('price_today_ul', 'li');
            t = setTimeout('allcoin()', 5000);
        }, 'json');
    }

    function rd() {
        return Math.random()
    }
    //渲染函数
    function renderPage(ary) {
        // console.log('ary',ary)
        var html = '';

        for (var i in ary) {
            var coinfinance = 0;
            if (typeof FINANCE == 'object') coinfinance = parseFloat(FINANCE.data[ary[i][8] + '_balance']);
            html += '<li><dl class="autobox clear"><dt><a href="/trade/index/market/' + ary[i][8] + '/">' +
                    '<img src="' + ary[i][9] + '" style="vertical-align: middle;margin-right: 5px;width: 30px;">' + ary[i][0] + '</a></dt>'+'<dd style="text-indent: 0rem;">' + formatPrice(ary[i][1]) + '</dd><dd class="w142" style="    text-indent: 0rem;">' + formatPrice(formatCount(ary[i][4])) + '</dd><dd class="w142" style="    text-indent: 0rem;">' + formatPrice(formatCount(ary[i][6])) + '</dd><dd class="w142 ' + (ary[i][7] >= 0 ? 'red' : 'green') + '" style="    text-indent: 0rem;color:red;text-align: center;">' + (ary[i][1] == 0 ? '--' : (parseFloat(ary[i][7]) < 0 ? '' : '+') + ((parseFloat(ary[i][7]) < 0.01 && parseFloat(ary[i][7]) > -0.01) ? "0.00" : ary[i][7]) + '%') + '</dd><dd id="' + ary[i][8] + '_plot"  style="width:150px;height:35px;"></dd><dd class="" style="width:150px;text-align: center;text-indent: 0;"><input style="color:#fff;background:#de5959" type="button" value="去交易" onclick="toMarket(\'' + ary[i][8] + '\')" /></dd><dd style="width:100px;text-indent:0;text-align:center;"><div class="add-fav ' + (ary[i][13] == "1" ? "add-fav-on" : "") + '" data-collection="' + ary[i][13] + '" data-market="' + ary[i][8] + '" onclick="ui.collection()"></div></dd></dl></li>'
        }
        $('#price_today_ul').html(html);

    }
    
    function toMarket(name){
        top.location='/trade/index/market/' + name + '/';
    }

    //保留2位小鼠
    function formatCount(num) {
        var result = '', counter = 0;
        num = (num || 0).toString();
        for (var i = num.length - 1; i >= 0; i--) {
            counter++;
            result = num.charAt(i) + result;
            if (!(counter % 3) && i != 0) { result = ',' + result; }
        }
        return result;
    }
    //格式化价格
    function formatPrice(price){
        return  price.toString() == '0' ? '--' : "$" + price;
    }
    //移入行变色
    function change_line_bg(id, tag, nobg) {
        var oCoin_list = $('#' + id);
        var oC_li = oCoin_list.find(tag);
        var oInp = oCoin_list.find('input');
        var oldCol = null;
        var newCol = null;
        if (!nobg) {
            for (var i = 0; i < oC_li.length; i++) {
                oC_li.eq(i).css('background-color', i % 2 ? '#fff' : '#f8f8f8');
            }
        }
        oCoin_list.find(tag).hover(function () {
            oldCol = $(this).css('backgroundColor');
            $(this).css('background-color', '#f9f2dd');
        }, function () {
            $(this).css('background-color', oldCol);
        })
    }

    //排序函数
    function sortcoinList(order, sortBy) {
        var ordAlpah = (order == 'asc') ? '>' : '<';
        var sortFun = new Function('a', 'b', 'return parseFloat(a[' + sortBy + '])' + ordAlpah + 'parseFloat(b[' + sortBy + '])? 1:-1');
        return sortFun;
    }


    trends();


    var cookieValue = $.cookies.get('cookie_username');
    if (cookieValue != '' && cookieValue != null) {
        $("#username").val(cookieValue);
    }
    
</script>
<script>
    //菜单高亮
    $('#index_box').addClass('active');

    var verfiy = function() {
        if ($('#index_username').val() == '' || $('#index_username').val().length == 0) {
            layer.tips('请输入用户名', '#index_username', {tips: 3});
            return;
        }
        if ($('#index_password').val() == '' || $('#index_password').val().length == 0) {
            layer.tips('请输入登录密码', '#index_password', {tips: 3});
            return;
        }
        if ($('#index_verify').val() == '' || $('#index_verify').val().length == 0) {
            layer.tips('图形验证码不能为空!', '#index_verify', {tips: 3});
            return;
        }
        return true;
    }
    var loginClick = function() {
        var e = event || window.event || arguments.callee.caller.arguments[0];
        if (e && e.keyCode == 13) { // enter 键
            user.login();
        }
    }
    $('#username').bind('keydown', loginClick);
    $('#password').bind('keydown', loginClick);
    $('#verify').bind('keydown', loginClick);


</script>
@endsection