<?= $this->extend("layout/master") ?>

<?= $this->section("pageTitle") ?>
Users
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<!-- Content Header (Page header) -->

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User's list</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<!-- Update Users Section -->
<div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Users</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="javascript:void(0)" method="POST" id="users-update-form">
                <input type="hidden" name="_method" id="form_method" value="PUT" />
                <input type="hidden" name="updateId" id="updateId">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="firstname">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control firstname_error_input" id="firstname" name="firstname" autocomplete="off" placeholder="Enter First Name" value="">
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong class="firstname_error"></strong>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="lastname">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control lastname_error_input" id="lastname" name="lastname" autocomplete="off" placeholder="Enter Last Name" value="">
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong class="lastname_error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="email">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control email_error_input" id="email" name="email" autocomplete="off" placeholder="Enter Email Address" value="">
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong class="email_error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                   <input type="checkbox" id="is_active" name="is_active" value="1">
                                   <label for="is_active"> Active / Inactive </label>
                                 </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary update-btn">Update</button>
                </div>
            </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- End Section -->

<!-- View Users Section -->
<div class="modal fade" id="modal-lg-view">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View User Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="javascript:void(0)" method="POST" id="users-update-form">
                <input type="hidden" name="_method" id="form_method" value="PUT" />
                <input type="hidden" name="updateId" id="updateId">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="firstname">First Name : </label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <span id="view_firstname"></label>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="lastname">Last Name :</label>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="form-group">
                                <span id="view_lastname"></label>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email">Email Address :</label>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="form-group">
                                <span id="view_email"></span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="is_active">Status :</label>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="form-group">
                                <span id="view_is_active"></span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- view End Section -->
<?= $this->endSection() ?>

<?=$this->section("scripts")?>
	<?= script_tag('public/assets/pages/users.js') ?>
<?=$this->endSection()?>
