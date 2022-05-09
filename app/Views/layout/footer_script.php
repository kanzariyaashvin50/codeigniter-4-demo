	
    <!-- jQuery -->
    <?= script_tag('public/assets/plugins/jquery/jquery.min.js') ?>
	
    <!-- jQuery UI 1.11.4 -->
    <?= script_tag('public/assets/plugins/jquery-ui/jquery-ui.min.js') ?>
	
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	
    <!-- Bootstrap 4 -->
    <?= script_tag('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>
	
    <!-- Select2 -->
    <?= script_tag('public/assets/plugins/select2/js/select2.full.min.js') ?>

    <!-- Bootstrap Switch -->
    <?= script_tag('public/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>
    
	<!-- ChartJS -->
    <?= script_tag('public/assets/plugins/chart.js/Chart.min.js') ?>
	
    <!-- Sparkline -->
    <?= script_tag('public/assets/plugins/sparklines/sparkline.js') ?>

	<!-- jQuery Knob Chart -->
    <?= script_tag('public/assets/plugins/jquery-knob/jquery.knob.min.js') ?>

	<!-- InputMask -->
    <?= script_tag('public/assets/plugins/moment/moment.min.js') ?>
    <?= script_tag('public/assets/plugins/inputmask/jquery.inputmask.min.js') ?>

    <!-- daterangepicker -->
    <?= script_tag('public/assets/plugins/moment/moment.min.js') ?>
    <?= script_tag('public/assets/plugins/daterangepicker/daterangepicker.js') ?>

    <!-- Tempusdominus Bootstrap 4 -->
    <?= script_tag('public/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>

	<!-- bs-custom-file-input -->
	<?= script_tag('public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>
	
    <!-- Summernote -->
	<?= script_tag('public/assets/plugins/summernote/summernote-bs4.min.js') ?>
	
    <!-- overlayScrollbars -->
	<?= script_tag('public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>

	<!-- Ekko Lightbox -->
	<?= script_tag('public/assets/plugins/ekko-lightbox/ekko-lightbox.min.js') ?>

	<script>
    var csrfName = $('meta.csrf').attr('name'); //CSRF TOKEN NAME
    var csrfHash = $('meta.csrf').attr('content'); //CSRF HASH
    
	$(function () {
		bsCustomFileInput.init();

		$(document).on('click', '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox({
			alwaysShowClose: true
		});
		});
	});
	</script>

    <!-- AdminLTE App -->
    <?= script_tag('public/assets/dist/js/adminlte.js') ?>

	<!-- Block UI -->
    <?= script_tag('public/assets/dist/js/block_ui.js') ?>

	<!-- Jquery Validation  -->
	<?= script_tag('public/assets/libs/jquery-validation/js/jquery.validate.min.js') ?>

	<!-- Datatable JS -->
	<?= script_tag('public/assets/dist/js/datatable/jquery.dataTables.min.js') ?>	
	
	<!-- Swal JS -->
	<?= script_tag('public/assets/libs/sweetalert2/sweetalert2.min.js') ?>	

	<!-- Custom JS -->
	<?php //script_tag('public/assets/dist/js/pages/custom.js') ?>
	