<?php die('Access Denied');?>
<!doctype html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta http-equiv="x-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
<meta name="applicable-device" content="pc,mobile">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title>{$seo_title}-{$title}</title>
<meta name="keywords" content="{$title},{$seo_title}">
<meta name="description" content="{$title}的{$seo_title}仅做学习用，模拟必应等中文切词进行伪原创，生成后的伪原创文章更准确更贴近必应等搜索引擎收录。您不得使用{$title}提供的{$seo_title}工具来进行自媒体等的洗稿和伪原创。">
{include('_header.php')}

</head>
<body>

<div class="main-wrapper">

<!-- Loader -->
<div id="loader-wrapper">
    <div id="loader">
        <div class="loader-ellips">
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
        </div>
    </div>
</div>

<!-- Header -->
<header id="home" class="header">

    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-md home-menu">
        <div class="container">

            <!-- Start Header Navigation -->
            <a class="logo-link smooth-menu" href="{$site_url}/">
                <img src="{$site_url}/assets/img/logo.png" class="logo logo-display kanakku_logo" alt="{$title}">
                <img src="{$site_url}/assets/img/logo-small.png" class="logo logo-scrolled" alt="{$title}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                <i class="la la-bars"></i>
            </button>
            <!-- End Header Navigation -->

            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="{$site_url}/">首页</a>
                    </li>
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="{$site_url}/#features">功能</a>
                    </li>
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="{$site_url}/#viewdemos">演示</a>
                    </li>
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="{$site_url}/#about">关于</a>
                    </li>
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="{$site_url}/#customize">定制</a>
                    </li>
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="{$site_url}/#overview">网页</a>
                    </li>
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="{$site_url}/word">伪原创</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- End Navigation -->

</header>
<!-- End Header -->

<!-- Start Word -->
<div class="hero-section auto-height">
    <div class="container">
        <div class="hero-wrap">
            <div class="container" data-aos="fade-up">
                <div class="content">
                    <h1>{$seo_title}</h1>
                    <p>
                        {$title}的{$seo_title}仅做学习用，因大量用户使用{$seo_title}用于自媒体，{$title}积极配合网信办开展自媒体专项整治活动，坚决遏制自媒体乱象，坚决维护网络正常的传播秩序，努力营造风清气正、积极向上、健康有序的网络空间!大幅降低伪原创度，现对内容降低到50%的伪原创度，用户必须自觉做好转载来源，以保护原作者的合法权益!  
                    </p>
                </div>
            </div>
            <form id="word-form" method="post" novalidate="true">
                <div class="messages"></div>
                <div class="alert" style="color: #ffffff; display: none;" id="alert_message">内容不能为空</div>
                <div class="input-group">
                    <textarea type="hidden" id="text-word" name="word" style="width:100%; height:500px;"></textarea>
                    <p class="input-group-addon">
                        <button id="submit_button" type="submit" class="btn btn-primary active">立即伪原创</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Word -->

<!-- Start Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="footer-widget" data-aos="fade-up">
                        <h4>社交网站 Social Links</h4>
                        <div class="footer-list">
                            <ul>
                                <li>
                                    <div class="info-list">
                                        <a href="https://github.com/" target="_blank">
                                            <i class="la la-github"></i>
                                            <span>Github <span class="category">演示下载</span></span>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="info-list social-list">
                                        <a href="https://www.facebook.com/" class="social-icon" target="_blank"><i class="la la-facebook"></i></a>
                                        <a href="https://www.twitter.com/" class="social-icon" target="_blank"><i class="la la-twitter"></i></a>
                                        <a href="https://www.google.com/" class="social-icon" target="_blank"><i class="la la-google-plus"></i></a>
                                        <a href="https://www.linkedin.com/" class="social-icon" target="_blank"><i class="la la-linkedin"></i></a>
                                        <a href="https://www.pinterest.com/" class="social-icon" target="_blank"><i class="la la-pinterest-p"></i></a>
                                        <a href="https://weixin.qq.com/" class="social-icon" target="_blank"><i class="la la-wechat"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="footer-widget" data-aos="fade-up" data-aos-delay="100">
                        <div class="footer-list">
                            <div id="Qrcode" class="Qrcode"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="footer-widget" data-aos="fade-up" data-aos-delay="200">
                        <h4>联系方式 Contact Info</h4>
                        <div class="footer-list">
                            <ul>
                                <li>
                                    <div class="info-list">
                                        <a href="{$site_url}" target="_blank">
                                            <i class="la la-globe"></i>
                                            <span>{$site_url}</span>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="info-list">
                                        <a href="mailto:{$email}" target="_blank">
                                            <i class="la la-envelope"></i>
                                            <span>{$email}</span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; Copyright 2021. All Rights Reserved by <a href="{$site_url}">{$title}</a></p>
                </div>
                <div class="col-md-6">
                    <div class="powered-by">
                        <p>
                            <a href="{$site_url}/terms" target="_blank">服务条例</a>
                            <a href="{$site_url}/privacy" target="_blank">隐私声明</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->

    </div>
</footer>
<!-- End Footer -->

</div>

{include('_footer.php')}

<script type="text/javascript">
$(function() { 
	$('#word-form').on('submit', function(e) {
		if (!e.isDefaultPrevented()) {
			//console.log('messages');
			var emailFormat = $('#text-word').val();
			if (emailFormat) {
				$('#alert_message').css({
					'display': 'none'
				})
				var url = "{$site_url}/wyc";
				$.ajax({
					type: "POST",
					url: url,
					data: $(this).serialize(),
					success: function(data) {
						var messageAlert = 'alert-' + data.type;
						var messageText = data.message;
						var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                        if (messageAlert && messageText) {
                            $('#word-form').find('.messages').html(alertBox);
						    $('#word-form').find('#text-word').html(data.data);
							$('#word-form')[0].reset();
						}
					}
				});
			} else {
				$('#alert_message').css({
					'display': 'block'
				});
			    //$('#text-word').focus();
				return false;
			}
			return false;
		}
	});
});
</script>

</body>
</html>