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
{include('user/_header.php')}

</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper login-body">
	<div class="login-wrapper">
		<div class="container">
		<img class="img-fluid logo-dark mb-4" src="{$site_url}/assets/img/logo.png" alt="Logo">
			<div class="loginbox">
				<div class="login-right">
					<div class="login-right-wrap">
						<div class="lock-user">
							<img class="rounded-circle" src="{$site_url}/assets/img/profiles/avatar-02.jpg" alt="User Image">
							<h4>{$uname}</h4>
						</div>

						<!-- Form -->
						<form action="{$site_url}/user-lock" method="post">
							<div class="form-group">
								<label class="form-control-label">解锁密码</label>
								<input type="password" class="form-control pass-input" name="nloginpwd" id="nloginpwd" value="" autocomplete="off" _input="true" tabindex="1" placeholder="请填写解锁密码" required>
                                <input type="hidden" class="form-control" name="__hash__" id="__hash__" value="{$token}">
							    <input type="hidden" class="form-control" name="pubKey" id="pubKey" value="{$pubKey}">
							</div>
							<div class="form-group mb-0">
								<button class="btn btn-lg btn-block btn-primary" type="submit" id="loginsubmit">解锁</button>
							</div>
						</form>
						<!-- /Form -->

						<div class="text-center dont-have">以其他用户身份登录? <a href="/login">立即登陆</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Main Wrapper -->

{include('user/_footer.php')}

<script>
$(function() {
    var t = $('#nloginpwd');
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