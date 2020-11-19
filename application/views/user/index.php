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
			<div class="col-md-8">
				<div class="card mb-3" style="max-width: 540px;">
				  <div class="row no-gutters">
				    <div class="col-md-4">
				      <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img" alt="">
				    </div>
				    <div class="col-md-8">
				      <div class="card-body">
				        <h5 class="card-title"><?= $user['name']; ?></h5>
				        <p class="card-text"><?= $user['email']; ?></p>
				        <p class="card-text mt-5"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		</div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

  
