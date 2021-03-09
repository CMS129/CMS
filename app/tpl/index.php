<?php die('Access Denied');?>
<!doctype html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta http-equiv="x-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
<meta name="applicable-device" content="pc,mobile">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title>{$seo_title}-{$title}官方网站</title>
<meta name="keywords" content="{$title},{$seo_title}">
<meta name="description" content="基于 PHP + MYSQL + Bootstrap 的{$seo_title}，可用于人力资源管理和其他后台办公室管理应用。 系统拥有所有必要的工具模块为您构建一个完整的后台。在iPad、iPhone、平板电脑和其他手机上具有完美响应能力和功能，多个选项，包括视频和语音呼叫等。">
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
                        <a class="smooth-menu nav-link" href="#features">功能</a>
                    </li>
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="#viewdemos">演示</a>
                    </li>
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="#about">关于</a>
                    </li>
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="#customize">定制</a>
                    </li>
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="#overview">网页</a>
                    </li>
                    <li class="nav-item">
                        <a class="smooth-menu nav-link" href="{$site_url}/word">AI伪原创</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- End Navigation -->

</header>
<!-- End Header -->

<!-- Start Banner -->
<div class="hero-section auto-height text-center">
    <div class="container">
        <div class="hero-wrap">
            <div class="container-sm" data-aos="fade-up">
                <div class="content">
                    <h1>{$title}</h1>
                    <p>
                        基于 PHP + MYSQL + Bootstrap 的{$seo_title}，可用于人力资源管理和其他后台办公室管理应用。 系统拥有所有必要的工具模块为您构建一个完整的后台。在iPad、iPhone、平板电脑和其他手机上具有完美响应能力和功能，多个选项，包括视频和语音呼叫等。  
                    </p>
                    <a class="smooth-menu view-btn" href="#viewdemos">官方演示</a> 
                    <a class="smooth-menu view-btn" href="">下载源码</a>
                </div>
            </div>
            <div class="container-sm" data-aos="fade-up">
                <div class="banner">
                    <img class="movebounce" src="{$site_url}/assets/home/img/main.png" alt="movebounce">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner -->

<!-- Start Features -->
<div id="features" class="features-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 equal-height">
                <div class="feature-list" data-aos="fade-right">
                    <div class="feature-icon">
                        <i class="la la-laptop"></i>
                    </div>
                    <div class="feature-info">
                        <h4>响应式设计</h4>
                        <p>
                            在iPad，iPhone，平板电脑和其他手机上具有完美响应能力和功能。 
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 equal-height" data-aos="fade-right" data-aos-delay="100">
                <div class="feature-list">
                    <div class="feature-icon">
                        <i class="la la-cube"></i>
                    </div>
                    <div class="feature-info">
                        <h4>高级功能</h4>
                        <p>
                            高级功能工具，如图形、图表、单据、视频和音频通话、项目等。
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 equal-height" data-aos="fade-right" data-aos-delay="200">
                <div class="feature-list">
                    <div class="feature-icon">
                        <i class="la la-code"></i>
                    </div>
                    <div class="feature-info">
                        <h4>优化代码</h4>
                        <p>
                            经过良好测试、文档化和W3校验代码。开发商可以立即利用。 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Features -->

<!-- Start Demo -->
<div id="viewdemos" class="demo-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container-xs" data-aos="fade-up">
                    <div class="section-heading text-center">
                        <h2>多个模板选项</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row demo-row">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="demo-wrap" data-aos="fade-up">
                    <div class="demo-tabs">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a target="_blank" href="/login" title="Html Preview">Html5</a></li>
                            <li class="nav-item"><a target="_blank" href="/login" title="Laravel Preview">Laravel</a></li>
                            <li class="nav-item"><a target="_blank" href="/login" title="Vuejs Preview">Vuejs</a></li>
                        </ul>
                    </div>
                    <div class="demo-box">
                        <img class="img-fluid" src="{$site_url}/assets/home/img/main.png" width="1150" height="100" alt="Orange">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Demo -->

<div id="about" class="about-section">
    <div class="section-right">
        <div class="content-table">
            <div class="table-col" data-aos="fade-left">
                <div class="showcase-img"><img src="{$site_url}/assets/home/img/main-1.png" alt="聊天"></div>
            </div>
            <div class="table-col" data-aos="fade-right">
                <div class="showcase">
                    <h3 class="title">高级功能，聊天！</h3>
                    <p class="desc">高级聊天选项类似于Slack，消息传递更简单，所有选项都可以立即使用</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section-left">
        <div class="content-table">
            <div class="table-col" data-aos="fade-right">
                <div class="showcase-img"><img src="{$site_url}/assets/home/img/main-2.png" alt="设置"></div>
            </div>
            <div class="table-col">
                <div class="showcase" data-aos="fade-left">
                    <h3 class="title">高级功能，设置！</h3>
                    <p class="desc">现在，设置是所有业务的要求，我们是第一个引入后端业务的人</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section-right">
        <div class="content-table">
            <div class="table-col" data-aos="fade-left">
                <div class="showcase-img"><img src="{$site_url}/assets/home/img/main-3.png" alt="单据"></div>
            </div>
            <div class="table-col" data-aos="fade-right">
                <div class="showcase">
                    <h3 class="title">高级功能，单据！</h3>
                    <p class="desc">单据是任何后端和前端业务中必不可少的功能，我们设计了您所需的方式</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start Subscribe -->
<div id="customize" class="custom-section">
    <div class="container">
        <div class="container-xs">
            <div class="section-heading text-center" data-aos="fade-up">
                <h2>想要定制设计吗?</h2>
                <p>我们很乐意根据您的需求定制您的产品，请给我们留言!!</p>
            </div>
            <div class="subscribe" data-aos="fade-up">
                <form id="contact-form" method="post" novalidate="true">
                    <div class="messages"></div>
                    <div class="input-group">
                        <input maxlength=50 id="form_email" type="email" placeholder="Enter your e-mail here" class="form-control" name="email">
                        <span class="input-group-addon">
                            <button id="submit_button" type="submit">
                                <i class="la la-send"></i>
                            </button>
                        </span>
                    </div>
                    <span class="alert" style="color: #7638ff; display: none;" id="alert_message">请输入有效的电子邮件</span>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- End Subscribe -->

<!-- Start Overview -->
<div id="overview" class="overview-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container-xs" data-aos="fade-up" data-aos-delay="100">
                    <div class="section-heading text-center">
                        <h2>网页概述</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center overview-items">
                <div class="overview-carousel owl-carousel owl-theme" data-aos="fade-up" data-aos-delay="200">
                    <div class="overview-img">
                        <img src="{$site_url}/assets/home/img/main.png" alt="#">
                        <h4>仪表盘</h4>
                    </div>
                    <div class="overview-img">
                        <img src="{$site_url}/assets/home/img/main-1.png" alt="#">
                        <h4>聊天</h4>
                    </div>
                    <div class="overview-img">
                        <img src="{$site_url}/assets/home/img/main-2.png" alt="#">
                        <h4>设置</h4>
                    </div>
                    <div class="overview-img">
                        <img src="{$site_url}/assets/home/img/main-3.png" alt="#">
                        <h4>单据</h4>
                    </div>
                    <div class="overview-img">
                        <img src="{$site_url}/assets/home/img/main-4.png" alt="#">
                        <h4>日历</h4>
                    </div>
                    <div class="overview-img">
                        <img src="{$site_url}/assets/home/img/main-5.png" alt="#">
                        <h4>电子邮件</h4>
                    </div>
                    <div class="overview-img">
                        <img src="{$site_url}/assets/home/img/main-6.png" alt="#">
                        <h4>地图</h4>
                    </div>
                    <div class="overview-img">
                        <img src="{$site_url}/assets/home/img/main-7.png" alt="#">
                        <h4>单据</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Overview -->

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

<script>
$(function() {
	$('#contact-form').on('submit', function(e) {
		if (!e.isDefaultPrevented()) {
			//console.log('messages');
			var re = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/;
			var emailFormat = re.test($("#form_email").val());
			if (emailFormat) {
				$('#alert_message').css({
					'display': 'none'
				})
				var url = "{$site_url}/contact";
				$.ajax({
					type: "POST",
					url: url,
					data: $(this).serialize(),
					success: function(data) {
						var messageAlert = 'alert-' + data.type;
						var messageText = data.message;
						var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
						if (messageAlert && messageText) {
							$('#contact-form').find('.messages').html(alertBox);
							$('#contact-form')[0].reset();
						}
					}
				});
			} else {
				$('#alert_message').css({
					'display': 'block'
				});
				$('#form_email').focus();
				return false;
			}
			return false;
		}
	})
});
</script>

</body>
</html>