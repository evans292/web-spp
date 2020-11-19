<!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
    <div class="col-md">
        <!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php if($this->session->flashdata('message')) : ?>
    <div class="flash-data" data-flashdata=" <?= $this->session->flashdata('message'); ?>"></div>
    <?php endif; ?>

 <!-- DataTales Example -->
 <div class="card shadow mb-4" id="printThis">
            <div class="card-header py-3 container-fluid">
              <h5 class="m-0 font-weight-bold text-primary">Role : <?= $role['role']; ?></h5>
              <a class="btn btn-primary btn-sm btn-icon-split" href="#" id="Print" style="float: right; margin-right: 32px;">
                    <span class="icon text-white-50">
                      <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Print Tabel</span>
                  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive" id="printThis">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Menu</th>
                      <th>Akses</th>    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Menu</th>
                      <th>Akses</th>     
                    </tr>
                  </tfoot>
                  <tbody>
                <?php $i = 1; ?>  
                <?php foreach($menu as $m) : ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $m["menu"]; ?></td>
                      <td>
                      <div class="form-check">
                      <input type="checkbox" class="form-check-input" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id'] ?>" data-menu="<?= $m['id'] ?>">
                    </div>
                      </td>
                      </tr> 
                <?php $i++; ?>
                <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    
    </div>
</div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



