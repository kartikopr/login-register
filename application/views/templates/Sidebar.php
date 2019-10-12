<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<?php
	$role_id = $this->session->userdata('user_role_id');

	$query_menu = "SELECT um.menu, um.id_menu
				FROM user_menu um JOIN user_access_menu uam
				ON um.id_menu = uam.id_menu
				WHERE uam.role_id = '$role_id' 
				";

	$menu = $this->db->query($query_menu)->result_array();


	?>
	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
		<div class="sidebar-brand-icon">
			<i class="fas fa-user-lock"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Administrator</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider">
	<?php foreach ($menu as $m) : ?>
		<!-- Nav Item - Dashboard -->
		<div class="sidebar-heading">
			<?= $m['menu']; ?>
		</div>

		<?php
			$menu_id = $m['id_menu'];
			$query_sub_menu = "SELECT * FROM user_sub_menu usm
								where usm.id_menu = $menu_id AND usm.is_active = 1 ";
			$sub_menu = $this->db->query($query_sub_menu)->result_array();
			?>

		<?php foreach ($sub_menu as $sm) : ?>

			<?php if ($title == $sm['title']) : ?>
				<li class="nav-item active">
				<?php else : ?>
				<li class="nav-item">
				<?php endif; ?>

				<a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
					<i class="<?= $sm['icon']; ?>"></i>
					<span><?= $sm['title'] ?></span></a>
				</li>

			<?php endforeach; ?>
			<!-- Divider -->
			<hr class="sidebar-divider mt-3">
		<?php endforeach; ?>



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
