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
{include('admin/_header.php')}

</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">
	<!-- Header -->
	<div class="header">

        <!-- Logo -->
		<div class="header-left">
			<a href="/admin-index" class="logo">
				<img src="{$site_url}/assets/img/logo.png" alt="Logo">
			</a>
			<a href="/admin-index" class="logo logo-small">
				<img src="{$site_url}/assets/img/logo-small.png" alt="Logo" width="30" height="30">
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
					<a class="dropdown-item" href="/settings"><i data-feather="settings" class="mr-1"></i> 设置</a>
					<a class="dropdown-item" href="/logout"><i data-feather="log-out" class="mr-1"></i> 注销</a>
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
					<li class="active">
						<a href="index.html"><i data-feather="home"></i> <span>Dashboard</span></a>
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
		<div class="content container-fluid">

			<div class="row">
				<div class="col-xl-3 col-sm-6 col-12">
					<div class="card">
						<div class="card-body">
							<div class="dash-widget-header">
								<span class="dash-widget-icon bg-1">
									<i class="fa fa-usd"></i>
								</span>
								<div class="dash-count">
									<div class="dash-title">Amount Due</div>
									<div class="dash-counts">
										<p>1,642</p>
									</div>
								</div>
							</div>
							<div class="progress progress-sm mt-3">
								<div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="text-muted mt-3 mb-0"><span class="text-danger mr-1"><i class="fa fa-arrow-down mr-1"></i>1.15%</span> since last week</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12">
					<div class="card">
						<div class="card-body">
							<div class="dash-widget-header">
								<span class="dash-widget-icon bg-2">
									<i class="fa fa-users"></i>
								</span>
								<div class="dash-count">
									<div class="dash-title">Customers</div>
									<div class="dash-counts">
										<p>3,642</p>
									</div>
								</div>
							</div>
							<div class="progress progress-sm mt-3">
								<div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="text-muted mt-3 mb-0"><span class="text-success mr-1"><i class="fa fa-arrow-up mr-1"></i>2.37%</span> since last week</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12">
					<div class="card">
						<div class="card-body">
							<div class="dash-widget-header">
								<span class="dash-widget-icon bg-3">
									<i class="fa fa-file-text"></i>
								</span>
								<div class="dash-count">
									<div class="dash-title">Invoices</div>
									<div class="dash-counts">
										<p>1,041</p>
									</div>
								</div>
							</div>
							<div class="progress progress-sm mt-3">
								<div class="progress-bar bg-7" role="progressbar" style="width: 85%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="text-muted mt-3 mb-0"><span class="text-success mr-1"><i class="fa fa-arrow-up mr-1"></i>3.77%</span> since last week</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12">
					<div class="card">
						<div class="card-body">
							<div class="dash-widget-header">
								<span class="dash-widget-icon bg-4">
									<i class="fa fa-file-o"></i>
								</span> 
								<div class="dash-count">
									<div class="dash-title">Estimates</div>
									<div class="dash-counts">
										<p>2,150</p>
									</div>
								</div>
							</div>
							<div class="progress progress-sm mt-3">
								<div class="progress-bar bg-8" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="text-muted mt-3 mb-0"><span class="text-danger mr-1"><i class="fa fa-arrow-down mr-1"></i>8.68%</span> since last week</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

{include('admin/_footer.php')}

</body>
</html>
