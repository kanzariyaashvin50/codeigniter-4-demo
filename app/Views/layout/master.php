<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include("layout/head_script")?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        
        <!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="<?= base_url('public/assets/dist/img/AdminLTELogo.png')?>" alt="AdminLTELogo" height="60" width="60">
		</div>

        <!-- Change With Template Customization -->
        <?= $this->include('layout/header'); ?>

        <!-- Change With Template Customization with Navigation bar -->
        <?= $this->include('layout/navigation_menu'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?=$this->renderSection("content")?>
        </div>

        <!-- Change With Template Customization -->
		<?= $this->include('layout/footer'); ?>
        <!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->

		<?= $this->include('layout/footer_script'); ?>
        
        <?=$this->renderSection("scripts")?>
        
        
    </div>

</body>
</html>