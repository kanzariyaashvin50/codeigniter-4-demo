<?= $this->extend("layout/master")?>
<?= $this->section("pageTitle")?>
  Profile
<?= $this->endSection()?>

<?= $this->section("content")?>
<?php $session = \Config\Services::session(); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">profile</a></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
        		<!-- Profile Image -->
        		<div class="card card-primary card-outline">
        		  <div class="card-body box-profile">
        		    <div class="text-center">
        		      <img class="profile-user-img img-fluid img-circle admin-profile-img" style="cursor: pointer;width: 200px"
        		           src="<?php echo (!empty($profile_image) ? base_url($profile_image) : base_url('public/assets/dist/img/avatar5.png'))  ?>" alt="Admin profile picture">
        		    </div>
        		    <form method="POST" action="#" enctype="multipart/form-data" id="profile-form">
        		   		 <input type="file" class="d-none" name="admin-profile" id="admin-profile">
		   		 	</form>
        		    <h3 class="profile-username text-center"><?= $firstname .' '.$lastname ?></h3>

        		    <p class="text-muted text-center">Administrator</p>

        		    <ul class="list-group list-group-unbordered mb-3">
        		      <li class="list-group-item">
        		        <b>First Name </b> <a class="float-right"><?= $firstname ?></a>
        		      </li>
        		      <li class="list-group-item">
        		        <b>Last Name</b> <a class="float-right"><?= $lastname ?></a>
        		      </li>
        		      <li class="list-group-item">
        		        <b>Email</b> <a class="float-right"><?= $email ?></a>
        		      </li>
        		    </ul>
        		  </div>
        		  <!-- /.card-body -->
        		</div>
        		<!-- /.card -->
        	</div>
        </div>
     </div>

<?= $this->endSection()?>
<?=$this->section("scripts")?>
	<?= script_tag('public/assets/pages/profile.js') ?>
<?=$this->endSection()?>