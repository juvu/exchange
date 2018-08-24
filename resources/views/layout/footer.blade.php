<div class="footer">
    <div class="fkicon">
		<div class="ft-links">
			<a href="javascript:;" title="Ticket"><i class="ft-icon ui-icon ui-icon-qm"></i></a>
			<a href="https://twitter.com/gate_io" target="_blank" title="Twitter"><i class="ft-icon ui-icon ui-icon-twitter"></i></a>
			<a href="https://t.me/gate_io" target="_blank" title="Telegram"><i class="ft-icon ui-icon ui-icon-telegram"></i></a>
			<a href="https://www.instagram.com/gate.io/" target="_blank" title="Instagram"><i class="ft-icon ui-icon ui-icon-instagram"></i></a>
			<a href="mailto:support@mail.gate.io" target="_blank" title="Email"><div class="ft-icon ui-icon ui-icon-email"></div></a>
			<a href="https://github.com/gateio" target="_blank" title="Github"><div class="ft-icon ui-icon ui-icon-github"></div></a>
		</div>
        <div class="fxts">
            <p><i>!</i>比特币等密码币的交易存在风险，在全球范围内一周7天，一天24小时无休止交易，没有每日涨停跌停限制，价格受到新闻事件，各国政策，市场需求等多种因素影响，浮动很大。我们强烈建议您事先调查了解，在自身所能承受的风险范围内参与交易。</p>
        </div>
    </div>
</div>
<div class="footer_bottom">
	<div class="autobox" style="height: 40px;margin-top: 5px;">
		<span style="display: inline-block;color:#A6A9AB;">CopyRight© 2013-2016 {$C['web_name']}交易平台 All Rights Reserved &nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" target="_blank">{$C['web_icp']}</a><span style="display: inline-block; color:#A6A9AB"></span></span>
	</div>
	<!-- 原安全验证位置 -->
</div>
<include file="$kefu"/>
<div id="all_mask" class="all_mask" style="height: 0px; display: none;"></div>
<div class="all_mask_loginbox" style="top: 313px; display: none;">
	<div class="login_title pl20">登录</div>
	<form id="form-login" class="mask_wrap login-fb">
		<div class="login_text zin90">
			<div class="mask_wrap_title">账号：</div>
			<input id="login_username" name="username" type="text" placeholder="请输入手机号/会员名">
		</div>
		<div class="login_text zin80">
			<div class="mask_wrap_title">密码：</div>
			<input id="login_password" name="password" type="password" placeholder="请输入登录密码">
		</div>
		<eq name="C['login_verify']" value="1">
			<div class="login_text zin70" id="ga-box-i">
				<img id="codeImg reloadverifyindex" src="" width="120" height="38" onclick="this.src=this.src+'?t='+Math.random()" style="margin-top: 1px; cursor: pointer;" title="换一张">
				<input type="text" class="code" id="login_verify" name="code" placeholder="请输入验证码" style="width: 106px; float: left;">
			</div>
		</eq>
		<div class="login_button">
			<input type="button" value="登录" onclick="upLogin();">
		</div>
		<div class="login-footer wwxwwx" style="border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
			<!--<a target="_blank" href="/"><img src="__PUBLIC__/Home/images/qq2.png" style="vertical-align: text-bottom; padding-right: 5px;">zzQQ登录</a>-->

			<span style="color: #CCC; float: right; margin-right: 25px;">
			<a style="font-size: 12px;" href="">免费注册</a>｜<a href="" style="font-size: 12px;">忘记密码</a></span>
		</div>
	</form>
	<div class="mask_wrap_close" onclick="wrapClose()"></div>
</div>
<script type="text/javascript" src="{{ asset('Home/js/jquery.cookies.2.2.0.js') }}"></script>
<script>
	function NumToStr(num) {
		if (!num) return num;
		num = Math.round(num * 100000000) / 100000000;
		num = num.toFixed(8);
		var min = 0.0001;
		var times = 0;
		var arr;
		if (num <= min) {
			times = 0;
			while (num <= min) {
				num *= 10;
				times++;
				if (times > 100) break;
			}
			num = num + '';
			arr = num.split(".");
			for (var i = 0; i < times; i++) {
				arr['1'] = '0' + arr['1'];
			}
			return arr[0] + '.' + arr['1'] + '';
		}
		return num.toFixed(8) + ' ';
	}


	function loginpop() {
		$('.all_mask').css({'height': $(document).height()});
		$('.all_mask').show();
		$('.all_mask_loginbox').show();
		$(".reloadverify").click();
		$('body,html').animate({scrollTop: 0},1500);
	}

	var is_login = {$Think.session.userId
	}
	;

	if (window.location.hash == '#login') {
		if (!is_login) {
			loginpop();
		}
	}

	if (is_login) {
		$.getJSON("/Ajax/allfinance?t=" + Math.random(), function (data) {

			$('#user_finance').html(data);
		});
	}


	function wrapClose() {
		$('.all_mask').hide();
		$('.all_mask_loginbox').hide();
	}

	var cookieValue = $.cookies.get('cookie_username');
	if (cookieValue != '' && cookieValue != null) {
		$("#login_username").val(cookieValue);
	}

	function upLogin() {
		var username = $("#login_username").val();
		var password = $("#login_password").val();
		var verify = $("#login_verify").val();
		if (username == "" || username == null) {
			layer.tips('请输入用户名', '#login_username', {tips: 3});
			return false;
		}
		if (password == "" || password == null) {
			layer.tips('请输入登录密码', '#login_password', {tips: 3});
			return false;
		}

		$.post("{:U('Login/submit')}", {
			username: username,
			password: password,
			verify: verify,
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


    var allverfiy = function() {
        if ($('#login_username').val() == '' || $('#login_username').val().length == 0) {
            layer.tips('请输入用户名', '#login_username', {tips: 3});
            return;
        }
        if ($('#login_password').val() == '' || $('#login_password').val().length == 0) {
            layer.tips('请输入登录密码', '#login_password', {tips: 3});
            return;
        }
        if ($('#login_verify').val() == '' || $('#login_verify').val().length == 0) {
            layer.tips('图形验证码不能为空!', '#login_verify', {tips: 3});
            return;
        }
        return true;
    }
    var allloginClick = function() {
        var e = event || window.event || arguments.callee.caller.arguments[0];
        if (e && e.keyCode == 13) { // enter 键
            if (!allverfiy()) {
                return;
            }
            upLogin();
        }
    }
    $('#login_username').bind('keydown', allloginClick);
    $('#login_password').bind('keydown', allloginClick);
    $('#login_verify').bind('keydown', allloginClick);
</script></body></html>