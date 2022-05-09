<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>

	<!-- Font Awesome -->
	<?= link_tag('public/assets/plugins/fontawesome-free/css/all.min.css') ?>

	<!-- icheck bootstrap -->
	<?= link_tag('public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>

	<!-- Tempusdominus Bootstrap 4 -->
	<?= link_tag('public/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>

	<!-- Select2 -->
	<?= link_tag('public/assets/plugins/select2/css/select2.min.css') ?>
	<?= link_tag('public/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>

	<!-- Ekko Lightbox -->
	<?= link_tag('public/assets/plugins/ekko-lightbox/ekko-lightbox.css') ?>

	<!-- Theme style -->
	<?= link_tag('public/assets/dist/css/adminlte.min.css') ?>

	<script>
		var site_url = '<?= site_url() ?>';
	</script>

	<style>
		.error-class {
			color: red;
		}
	</style>

</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<h1 class="h1"><strong> Login </strong></h1>
				<div class=" mb-2 mt-1 custom_error_message text-danger">
					<?php 
					$session = \Config\Services::session();
					echo ($session->getFlashdata('error')) ? $session->getFlashdata('error') : ""; 
					if ($session->has("message")) {
						$emailerror = (!empty($session->getFlashdata("message")['email']) ? $session->getFlashdata("message")['email'] : '');
						$passerror  = (!empty($session->getFlashdata("message")['password']) ? $session->getFlashdata("message")['password'] : '');
					}
					?>
				</div>
			</div>

			<div class="card-body">
				<form method="POST" action="<?= base_url('admin/login') ?>" id="login-form">

					<div class="form-group">
						<div class="input-group">
							<input type="email" class="form-control <?= (!empty($emailerror) ? 'is-invalid' : '') ?>" name="email" placeholder="Email ID" value="">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-envelope"></span>
								</div>
							</div>
							<?php if (!empty($emailerror)) : ?>
								<span class="invalid-feedback text-danger" role="alert">
									<strong><?= $emailerror ?></strong>
								</span>
							<?php endif; ?>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<input type="password" class="form-control <?= (!empty($passerror) ? 'is-invalid' : '') ?>" name="password" placeholder="Password" value="">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
							<?php if (!empty($passerror)) : ?>
								<span class="invalid-feedback text-danger" role="alert">
									<strong><?= $passerror ?></strong>
								</span>
							<?php endif; ?>
						</div>
					</div>

					<div class="social-auth-links text-center mt-2 mb-3">
						<button type="submit" class="btn btn-block btn-primary"> Submit </button>
					</div>
				</form>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<?= script_tag('public/assets/plugins/jquery/jquery.min.js') ?>

	<!-- Bootstrap 4 -->
	<?= script_tag('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>

	<!-- Select2 -->
	<?= script_tag('public/assets/plugins/select2/js/select2.full.min.js') ?>

	<!-- InputMask -->
	<?= script_tag('public/assets/plugins/moment/moment.min.js') ?>
	<?= script_tag('public/assets/plugins/inputmask/jquery.inputmask.min.js') ?>

	<!-- Tempusdominus Bootstrap 4 -->
	<?= script_tag('public/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>

	<!-- bs-custom-file-input -->
	<?= script_tag('public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>

	<!-- AdminLTE App -->
	<?= script_tag('public/assets/dist/js/adminlte.min.js') ?>

	<!-- Jquery Validation  -->
	<?= script_tag('public/assets/libs/jquery-validation/js/jquery.validate.min.js') ?>

	<!-- Login JS -->
	<?= script_tag('public/assets/pages/login.js') ?>

</body>

</html>