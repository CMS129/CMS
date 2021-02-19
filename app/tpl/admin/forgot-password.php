<?php die('Access Denied');?>
<!doctype html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta http-equiv="x-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
<meta name="applicable-device" content="pc,mobile">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title>{$title}</title>
{include('_header.php')}

</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper login-body">
	<div class="login-wrapper">
		<div class="container">
			<img class="img-fluid logo-dark mb-2" src="{$site_url}/assets/img/logo.png" alt="{$title}">
			<div class="loginbox">
				<div class="login-right">

				    <div class="login-right-wrap">
					    <h1>找回密码 ?</h1>
					    <p class="account-subtitle">输入您的电子邮件以获取密码重置链接</p>
						<form action="{$site_url}/forgot-password" method="post">
							<div class="form-group">
								<label class="form-control-label">邮件地址</label>
								<input class="form-control" type="text" name="loginmail" id="loginmail" value="" autocomplete="off" _input="true" tabindex="1" placeholder="请填写注册邮箱地址" required>
							</div>
							<div class="form-group mb-0">
							    <input type="hidden" class="form-control" name="__hash__" id="__hash__" value="{$token}">
							    <input type="hidden" class="form-control" name="pubKey" id="pubKey" value="{$pubKey}">
								<button class="btn btn-lg btn-block btn-primary" type="submit" id="loginsubmit">下一步</button>
							</div>
						</form>
						<div class="text-center dont-have">记住您的密码? <a href="{$site_url}/login">立即登陆</a></div>
				    </div>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Main Wrapper -->

{include('_footer.php')}

<script>
$(function() {
    var t = $('#loginmail');
	var h = $('#__hash__');
    var k = $('#pubKey');
    t.focus(function() {
        t.val('');
    });
    $("#loginsubmit").click(function() {
        if(t.val()!==''){
            var res = new JSEncrypt();
            res.setPublicKey(window.atob(k.val()));
            var v = res.encrypt(t.val()+h.val());
            t.val(v);
        }
    });
});
</script>

</body>
</html>