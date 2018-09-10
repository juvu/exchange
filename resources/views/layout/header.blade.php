<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="renderer" content="webkit">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>exchangeRata</title>
	<meta name="Keywords" content="{:C('web_keywords')}">
	<meta name="Description" content="{:C('web_description')}">
	<meta name="author" content="zuocoin.com">
	<meta name="coprright" content="zuocoin.com">
	<link rel="shortcut icon" href=" /favicon.ico"/>
	<link rel="stylesheet" href="{{ asset('Home/css/zuocoin.css') }}"/>
	<link rel="stylesheet" href="{{ asset('Home/css/style.css') }}"/>
	<link rel="stylesheet" href="{{ asset('Home/css/new_style.css') }}"/>
	<link rel="stylesheet" href="{{ asset('Home/css/slide-unlock.css') }}"/>
	<link rel="stylesheet" href="{{ asset('Home/css/font-awesome.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('Home/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('Home/js/jquery.flot.js') }}"></script>
	<script type="text/javascript" src="{{ asset('Home/js/jquery.cookies.2.2.0.js') }}"></script>
	<script type="text/javascript" src="{{ asset('Home/js/jquery.slideunlock.js') }}"></script>
    <script type="text/javascript" src="{{ asset('layer/layer.js') }}"></script>
    
	<script type="text/javascript">
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "https://hm.baidu.com/hm.js?2ca0b0d15f83707f9a4b65802faf0f48";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>

</head>
<body>
<div class="header bg_w" id="trade_aa_header">
	<div class="hearder_top">
		<div class="autobox po_re zin100" id="header">
			<div class="hot-coins-price">
				<ul class="topprice">
				
				</ul>
			</div>
			<div class="right orange" id="login">
				<gt name="" value="0">
					<dl class="mywallet">
						<dt id="user-finance">
						<div class="mywallet_name clear">
							<a href="/finance/">1111</a><i></i>
						</div>
						<div class="mywallet_list" style="display: none;">
							<div class="clear">
								<ul class="balance_list">
									<h4>可用余额</h4>
									<li>
										<a href="javascript:void(0)"><em style="margin-top: 5px;" class="deal_list_pic_cny"></em><strong>USDT：</strong><span>222</span></a>
									</li>
								</ul>
								<ul class="freeze_list">
									<h4>委托冻结</h4>
									<li>
										<a href="javascript:void(0)"><em style="margin-top: 5px;" class="deal_list_pic_cny"></em><strong>USDT：</strong><span>111</span></a>
									</li>
								</ul>
							</div>
							<div class="mywallet_btn_box">
								<a href="/finance/index">充值</a>
								<a href="/finance/index">提现</a>
								<!--<a href="/finance/index">转入</a>
								<a href="/finance/index">转出</a>-->
								<a href="/finance/mywt.html">委托管理</a>
								<a href="/finance/mycj.html">成交查询</a>
							</div>
						</div>
						</dt>
						<dd>
							ID：<span>1111</span>
						</dd>
						<dd>
							<a href="#">退出</a>
						</dd>
					</dl>
					<else/> <!-- 登陆前 -->
					<div class="orange">
						<span class="zhuce"><a class="orange" href="{:U('Login/register')}">注册</a></span> |
						<a href="javascript:;" class="orange" onClick="loginpop();">登录</a>
					</div>
				</gt>
			</div>
			<div class="nav  nav_po_1" id="menu_nav" style=" height: 30px;">
				<ul>
					<li>
						<a href="/" id="index_box">首页</a>
					</li>
					<li>
						<a id="trade_box" href="{:U('Trade/index')}"><span>交易中心</span>
							<img src="{{ asset('Home/images/down.png') }}"></a>
						<div class="deal_list " style="display: none;    top: 36px;">
							<dl id="menu_list_json"></dl>
							<div class="sj"></div>
							<div class="nocontent"></div>
						</div>
					</li>

					@foreach($daohang as $val)
						<li>
							<a id="{{$val->name}}_box" href="/{{$val->url}}">{{$val->title}}</a>
						</li>
					@endforeach

				</ul>
			</div>
		</div>
	</div>
	<div style="clear: both;"></div>
	<div class="autobox clear" id="trade_clear">
		<div class="logo">
			<a href="/"><img src="/storage/img/public/5b7e21e8043f6.png" alt=""/></a>
		</div>
	</div>
</div>

<script>
	// 添加热门数字货币实时价格
	var getCoinsData = function() {

        $.ajax({
            url: '/api/getHotCoin',
            type: 'post',
            dataType: 'json',
            success: function(data) {
                    
                    var array = data;
                    var html = '';
					var arrow = '';
                    var color = '';
                    if(data.length) {
                        for(var i= 0;i < array.length; i++) {
                            color = array[i].change > 0 ? 'color-red' : 'color-green';
                            arrow = array[i].change > 0 ? '↑' : '↓';
                            html += '<li>'+ array[i].name +': <span class="topnum '+ color +'">'+ parseFloat(array[i].new_price).toFixed(4) +'</span><i class="icon-arrow-down '+ color +'">'+ arrow +'</i> </li>'
                        }
                        $('.hot-coins-price ul').html(html);
                    }
                    
            },
            error: function(error) {
                console.log(error);
            }
        })
    }
    getCoinsData();
    coinsData  = setInterval(getCoinsData,5000);

	$.getJSON("/api/getJsonMenu?t=" + Math.random(), function (data) {
		if (data) {
			var list = '';
			for (var i in data) {
				list += '<dd><a href="/Trade/index/market/' + data[i]['name'] + '"><img src="' + data[i]['img'] + '" style="width: 18px; margin-right: 5px;">' + data[i]['title'] + '</a></dd>';
			}
			$("#menu_list_json").html(list);
		}
	});

	$('#trade_box').hover(function () {
		$('.deal_list').show()
	}, function () {
		$('.deal_list').hide()
	});
	$('.deal_list').hover(function () {
		$('.deal_list').show()
	}, function () {
		$('.deal_list').hide()
	});
    
	$('#user-finance').hover(function () {
		$('.mywallet_list').show();
	}, function () {
		$('.mywallet_list').hide()
	});
</script>
<!--头部结束-->

@yield('content')

@include('layout.footer')