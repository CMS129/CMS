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
<div class="main-wrapper">
	<!-- Header -->
	<div class="header">

        <!-- Logo -->
		<div class="header-left">
			<a href="/user-index" class="logo">
				<img src="{$site_url}/assets/img/logo.png" alt="{$title}">
			</a>
			<a href="/user-index" class="logo logo-small">
				<img src="{$site_url}/assets/img/logo-small.png" alt="{$title}" width="30" height="30">
			</a>
		</div>
		<!-- /Logo -->

        <!-- Sidebar Toggle -->
		<a href="javascript:void(0);" id="toggle_btn">
			<i class="fa fa-bars"></i>
		</a>
		<!-- /Sidebar Toggle -->

        <!-- Search -->
	    <div class="top-nav-search">
			<form>
				<input type="text" class="form-control" placeholder="Search here" required>
				<button class="btn" type="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
		<!-- /Search -->

        <!-- Mobile Menu Toggle -->
		<a class="mobile_btn" id="mobile_btn">
			<i class="fa fa-bars"></i>
		</a>
		<!-- /Mobile Menu Toggle -->

        <!-- Header Menu -->
        <ul class="nav user-menu">
			<!-- User Menu -->
			<li class="nav-item dropdown has-arrow main-drop">
				<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
					<span class="user-img">
						<img src="{$site_url}/assets/img/profiles/avatar-02.jpg" alt="user">
						<span class="status online"></span>
					</span>
					<span>{$user}</span>
				</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="/user-settings"><i data-feather="settings" class="mr-1"></i> 帐户设置</a>
					<a class="dropdown-item" href="/logout"><i data-feather="log-out" class="mr-1"></i> 退出登录</a>
				</div>
			</li>
			<!-- /User Menu -->
		</ul>
		<!-- /Header Menu -->

    </div>
	<!-- /Header -->

	<!-- Sidebar -->
	<div class="sidebar" id="sidebar">
		<div class="sidebar-inner slimscroll">
			<div id="sidebar-menu" class="sidebar-menu">
				<ul>
					<li class="menu-title"><span>Main</span></li>
					<li>
						<a href="/user-index"><i data-feather="home"></i> <span>仪表盘</span></a>
					</li>
					<li class="active">
						<a href="/user-settings"><i data-feather="settings"></i> <span>帐户设置</span></a>
					</li>
					<li>
						<a href="customers.html"><i data-feather="users"></i> <span>Customers</span></a>
					</li>
					<li>
						<a href="estimates.html"><i data-feather="file-text"></i> <span>Estimates</span></a>
					</li>
					<li>
						<a href="invoices.html"><i data-feather="clipboard"></i> <span>Invoices</span></a>
					</li>
					<li>
						<a href="payments.html"><i data-feather="credit-card"></i> <span>Payments</span></a>
					</li>
					<li class="submenu">
						<a href="#"><i data-feather="grid"></i> <span> Application</span> <span class="menu-arrow"></span></a>
						<ul>
							<li><a href="chat.html">Chat</a></li>
							<li><a href="calendar.html">Calendar</a></li>
							<li><a href="inbox.html">Email</a></li>
						</ul>
					</li>
					<li class="menu-title"> 
						<span>Pages</span>
					</li>
					<li> 
						<a href="profile.html"><i data-feather="user-plus"></i> <span>Profile</span></a>
					</li>
					<li class="submenu">
						<a href="#"><i data-feather="lock"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
						<ul>
							<li><a href="login.html"> Login </a></li>
							<li><a href="register.html"> Register </a></li>
							<li><a href="forgot-password.html"> Forgot Password </a></li>
							<li><a href="lock-screen.html"> Lock Screen </a></li>
						</ul>
					</li>
					<li class="submenu">
						<a href="#"><i data-feather="alert-octagon"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
						<ul>
							<li><a href="error-404.html">404 Error </a></li>
							<li><a href="error-500.html">500 Error </a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Sidebar -->

	<!-- Page Wrapper -->
	<div class="page-wrapper">
		
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

{include('user/_footer.php')}

</body>
</html>
