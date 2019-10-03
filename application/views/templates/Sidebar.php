<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
		<div class="sidebar-brand-icon">
			<i class="fas fa-user-lock"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Administrator</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Nav Item - Dashboard -->
	<div class="sidebar-heading">
		Admin
	</div>
	<li class="nav-item">
		<a class="nav-link" href="index.html">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		User
	</div>

	<li class="nav-item">
		<a class="nav-link" href="charts.html">
			<i class="fas fa-fw fa-user"></i>
			<span>My Account</span></a>
	</li>

	<hr class="sidebar-divider">

	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('auth/logout'); ?>">
			<i class="fas fa-fw fa-sign-out-alt"></i>
			<span>Logout</span></a>
	</li>

	<!-- Nav Item - Pages Collapse Menu -->

	<!-- Divider -->


	<!-- Heading -->


	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
<!-- End of Sidebar -->