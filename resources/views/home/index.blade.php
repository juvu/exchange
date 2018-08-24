<!--    顶部通知   -->
@extends('layout.header')
@section('content')
<div class="index_pic_wrap po_re">
    <div id="myCarousel" class="my-carousel">
        <!--<div class="my-carousel-indicators">-->
        <ol class="my-carousel-indicators">
            @foreach($indexAdver as $key=>$val)
                <li data-target="#myCarousel" data-slide-to="{{$key}}"
                @if($key=1) class="active" @endif>
                </li>
            @endforeach
        </ol>
        <div class="my-carousel-inner">
            <volist name="indexAdver" id="vo">
                <div class="item hand <eq name='i' value='1'> active</eq>" onclick="window.open('{$vo['url']}')" style="background-image: url({{ asset('ad/1111') }};"></div>
            </volist>
        </div>
    </div>
    <div class="login_wrap">
        <div class="login_box">
            <div class="login_bg"></div>
            <!-- 未登录状态 -->
            <gt name="Think.session.userId" value="0">
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
                <else/>
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
                        <eq name="C['login_verify']" value="1">
                            <div class="login_text zin70" id="ga-box-i">
                                <img id="codeImg reloadverifyindex" src="{:U('Verify/code')}" width="120" height="38" onclick="this.src=this.src+'?t='+Math.random()" style="margin-top: 1px; cursor: pointer;" title="换一张">
                                <input type="text" class="code" id="index_verify" name="code" placeholder="请输入验证码" style="width: 106px; float: left;">
                            </div>
                        </eq>
                        <div class="login_button">
                            <input type="button" value="登录" onclick="upLoginIndex();"/>
                        </div>
                        <div class="login-footer">
                            
      <span> <a href="#">免费注册</a> ｜ <a href="#">忘记密码</a>
      </span>
                        </div>
                    </div>
                </form>
            </gt>
        </div>
    </div>
</div>
<div class="zhanwei"></div>
<!--    公告   -->
<div class="ui-notice">
    <div class="ui-notice-inner">
        <i class="ui-icon ui-icon-tongzhi"></i>
        <div class="ui-notice-content" id="uiNotice"></div>
        <a class="ui-more" href="/Article/index">更多...</a>
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
            <!-- <li class="click-sort" data-sort="2" data-flaglist="0" data-toggle="0">买一价
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="3" data-flaglist="0" data-toggle="0">卖一价
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li> -->
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
<!-- <div class="footer_con" style="margin: 0px auto;width: 1180px;">
    <div class="autobox clear" style="padding: 0px 20px;">
        <p style="width: 1165px;">
            <span>风险警告：</span>
            {:C('web_waring')}
        </p>
    </div>
</div> -->
<!-- <div class="news_box">
    <div class="autobox">
        <div class="news_t clear"></div>
        <div class="news_s">
            <div class="news_sc">
                <div class="news_ct">
                    <div class="news_cti"></div>
                    <div class="news_cts">
                        <a target="_blank" href="/Article/index/id/{$indexArticleType[0]['id']}">{$indexArticleType[0]['title']}</a>
                    </div>
                </div>
                <div class="news_cl">
                    <ul class="news_clu">
                        <volist name="indexArticle[0]" id="vo">
                            <li>
                                <a class="news_clua" target="_blank" href="{:U('Article/detail','id='.$vo['id'])}">{$vo['title']} </a>
                                <a class="news_clda" target="_blank" href="{:U('Article/detail','id='.$vo['id'])}"> [ {$vo['addtime']|date="y-m-d",###} ] </a>
                            </li>
                        </volist>
                        <li>
                            <a class="news_clda" target="_blank" href="/Article/index/id/{$indexArticleType[0]['id']}"> 更多&gt;&gt; </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="news_sc">
                <div class="news_ct">
                    <div class="news_cti news_ctin"></div>
                    <div class="news_cts">
                        <a target="_blank" href="/Article/index/id/{$indexArticleType[1]['id']}">{$indexArticleType[1]['title']}</a>
                    </div>
                </div>
                <div class="news_cl">
                    <ul class="news_clu">
                        <volist name="indexArticle[1]" id="vo">
                            <li>
                                <a class="news_clua" target="_blank" href="{:U('Article/detail','id='.$vo['id'])}">{$vo['title']} </a>
                                <a class="news_clda" target="_blank" href="{:U('Article/detail','id='.$vo['id'])}"> [ {$vo['addtime']|date="y-m-d",###} ] </a>
                            </li>
                        </volist>
                        <li>
                            <a class="news_clda" target="_blank" href="/Article/index/id/{$indexArticleType[1]['id']}"> 更多&gt;&gt; </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="news_sc">
                <div class="news_ct">
                    <div class="news_cti news_ctic"></div>
                    <div class="news_cts">
                        <a target="_blank" href="/Article/index/id/{$indexArticleType[2]['id']}">{$indexArticleType[2]['title']}</a>
                    </div>
                </div>
                <div class="news_cl">
                    <ul class="news_clu">
                        <volist name="indexArticle[2]" id="vo">
                            <li>
                                <a class="news_clua" target="_blank" href="{:U('Article/detail','id='.$vo['id'])}">{$vo['title']} </a>
                                <a class="news_clda" target="_blank" href="{:U('Article/detail','id='.$vo['id'])}"> [ {$vo['addtime']|date="y-m-d",###} ] </a>
                            </li>
                        </volist>
                        <li>
                            <a class="news_clda" target="_blank" href="/Article/index/id/{$indexArticleType[2]['id']}"> 更多&gt;&gt; </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> -->
<input type="hidden" name="coin_type" value="cny_btc"/>
<input type="hidden" name="amount" value="1000000"/>



<!-- <eq name="C['index_lejimum']" value="1">
<div class="index_box_2 slogan">
    <div class="slogan_title">选择{:C('web_title')},安全可信赖</div>
    <div class="slogan_tis">累计交易额<span id="yi" style="display: none;margin-left: 5px;" class="yiyi1"></span>
        <sapn style="display: none;" class="yiyi2"> 亿</sapn>
        <span id="wan"></span> 万
    </div>
    <div id="cumulative"></div>
</div>
<script src="__PUBLIC__/Home/js/index_change.js"></script>
</eq> -->


<!--友情链接-->
<!-- <div class="link" style="    padding-top: 0px;">
    <div class="linkbox">
        <h4>
            <a target="_blank" href="/about/partner.html">友情链接</a>
        </h4>
        <ul>
            <volist name="indexLink" id="vo">
                <li style="margin-left: 0px;">
                    <a target="_blank" href="{$vo['url']}">{$vo['title']}</a>
                </li>
            </volist>
        </ul>
    </div>
</div> -->
<script type="text/javascript" src="{{asset('Home/js/util.js') }}"></script>
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
    var time;


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
        $allItems.eq(currentIndex - 1).addClass('active').fadeIn(500);
        $allIndicators.removeClass('active').eq(currentIndex - 1).addClass('active');
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
        $.getJSON('/Ajax/trends?t=' + rd(), function (d) {
            trends = d;
            allcoin();
        });
    }

    function allcoin(cb) {

        $.get('/Ajax/allcoin?t=' + rd(), cb ? cb : function (d) {
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
            //t = setTimeout('allcoin()', 5000);
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
                    '<img src="/Upload/coin/' + ary[i][9] + '" style="vertical-align: middle;margin-right: 5px;width: 24px;">' + ary[i][0] + '</a></dt>'+/*<dd class="orange" style="text-indent: 0.5em;">$' + ary[i][1] + '</dd><dd style="text-indent: 0.5rem;">$' + ary[i][2] + '</dd>*/'<dd style="text-indent: 0rem;">$' + ary[i][3] + '</dd><dd class="w142" style="    text-indent: 0rem;">' + formatCount(ary[i][6]) + '</dd><dd class="w142" style="    text-indent: 0rem;">' + formatCount(ary[i][4]) + '</dd><dd class="w142 ' + (ary[i][7] >= 0 ? 'red' : 'green') + '" style="    text-indent: 0rem;color:red">' + (parseFloat(ary[i][7]) < 0 ? '' : '+') + ((parseFloat(ary[i][7]) < 0.01 && parseFloat(ary[i][7]) > -0.01) ? "0.00" : ary[i][7]) + '%</dd><dd id="' + ary[i][8] + '_plot"  style="width:150px;height:35px;"></dd><dd class="" style="width:165px;text-align: center;text-indent: 0;"><input style="color:#fff;background:#e55600" type="button" value="去交易" onclick="top.location=\'/trade/index/market/' + ary[i][8] + '/\'" /></dd></dl></li>'
        }
        $('#price_today_ul').html(html);
        
    }
    //保留2位小鼠
    function formatCount(count) {
        var countokuu = (count / 100000000).toFixed(3)
        var countwan = (count / 10000).toFixed(3)
        if (count > 100000000)
            return countokuu.substring(0, countokuu.lastIndexOf('.') + 3) + '亿'
        if (count > 10000)
            return countwan.substring(0, countwan.lastIndexOf('.') + 3) + '万'
        else
            return parseFloat(count).toFixed(2)
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
                // oInp.mouseover(function () {
                //     this.style.color = '#fff';
                //     this.style.backgroundColor = '#e55600';
                // });
                // oInp.mouseout(function () {
                //     this.style.color = '#e55600';
                //     this.style.background = 'none';
                // });
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
        $("#index_username").val(cookieValue);
    }
    function upLoginIndex() {
        var username = $("#index_username").val();
        var password = $("#index_password").val();
        var verify = $("#index_verify").val();
        if (username == "" || username == null) {
            layer.tips('请输入用户名', '#index_username', {tips: 3});
            return false;
        }
        if (password == "" || password == null) {
            layer.tips('请输入登录密码', '#index_password', {tips: 3});
            return false;
        }

        $.post("{:U('Login/submit')}", {
            username: username,
            password: password,
            verify:verify,
        }, function (data) {
            if (data.status == 1) {
                $.cookies.set('cookie_username', username);
                layer.msg(data.info, {icon: 1});
                window.location = '/Finance';
            } else {
                //刷新验证码
                $(".reloadverifyindex").click();
                layer.msg(data.info, {icon: 2});
                if (data.url) {
                    window.location = data.url;
                }
            }
        }, "json");
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
            if (!verfiy()) {
                return;
            }
            upLoginIndex();
        }
    }
    $('#index_username').bind('keydown', loginClick);
    $('#index_password').bind('keydown', loginClick);
    $('#index_verify').bind('keydown', loginClick);
</script>
@endsection