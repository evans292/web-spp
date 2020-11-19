      <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          
      <?php if($this->session->flashdata('message')) : ?>
    <div class="flash-data" data-flashdata=" <?= $this->session->flashdata('message'); ?>"></div>
   <?php endif; ?>
   <?php if($this->session->flashdata('flash')) : ?>
    <div class="flash-data" data-flash=" <?= $this->session->flashdata('flash'); ?>"></div>
   <?php endif; ?>
			
		<div class="row">
			<div class="col-md-6">
				<form method="post" action="<?= base_url('user/changepass'); ?>">
        <div class="form-group">
        <label for="password1" class="col-sm col-form-label">Password Lama</label>
          <input type="password" class="form-control" id="password1" name="password1">
          <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
        </div>
          <div class="form-group">
          <label for="password2" class="col-sm col-form-label">Password Baru</label>
          <input type="password" class="form-control" id="password2" name="password2">
          <?= form_error('password2', '<small class="text-danger">', '</small>') ?>
        </div>
        <div class="form-group">
        <label for="password3" class="col-sm col-form-label">Ulangi Password Baru</label>
          <input type="password" class="form-control" id="password3" name="password3">
          <?= form_error('password3', '<small class="text-danger">', '</small>') ?>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary float-right">Ubah</button>
        </div>
      </form>
			</div>
		</div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

  
  