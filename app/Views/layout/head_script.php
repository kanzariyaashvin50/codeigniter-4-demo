<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-name" content="<?= csrf_hash() ?>" class="csrf">

<title><?php echo $this->renderSection("pageTitle") ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	
    <!-- Font Awesome -->
    <?= link_tag('public/assets/plugins/fontawesome-free/css/all.min.css') ?>
	
	<!-- Tempusdominus Bootstrap 4 -->
    <?= link_tag('public/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>
	
	<!-- iCheck -->
    <?= link_tag('public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>

    <!-- Bootstrap Switch -->
    <?= link_tag('public/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>
	 
	<!-- Select2 -->
    <?= link_tag('public/assets/plugins/select2/css/select2.min.css') ?>
    <?= link_tag('public/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>

	<!-- Ekko Lightbox -->
    <?= link_tag('public/assets/plugins/ekko-lightbox/ekko-lightbox.css') ?>

	<!-- Theme style -->
    <?= link_tag('public/assets/dist/css/adminlte.min.css') ?>

	<!-- overlayScrollbars -->
    <?= link_tag('public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>
	
	<!-- Daterange picker -->
    <?= link_tag('public/assets/plugins/daterangepicker/daterangepicker.css') ?>
	
	<!-- summernote -->
    <?= link_tag('public/assets/plugins/summernote/summernote-bs4.min.css') ?>

	<!-- DataTable Css -->
    <?= link_tag('public/assets/dist/css/datatable/jquery.dataTables.min.css') ?>
    <?= link_tag('public/assets/libs/sweetalert2/sweetalert2.min.css') ?>
	
    <style>
      .error-class { color: red;}
    </style>

<script>
	var site_url = '<?= site_url() ?>';
</script>