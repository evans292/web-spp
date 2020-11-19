<!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
    <div class="col-md">
        <!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?php if($this->session->flashdata('message')) : ?>
    <div class="flash-data" data-flashdata=" <?= $this->session->flashdata('message'); ?>"></div>
    <?php endif; ?>

 <!-- DataTales Example -->
 <div class="card shadow mb-4" id="printThis">
            <div class="card-header py-3 container-fluid">
              <h5 class="m-0 font-weight-bold text-primary">Menu Management</h5>
              <a class="btn btn-success btn-sm btn-icon-split" href="#" data-toggle="modal" data-target="#addModal" style="float: right; margin-right: 20px;">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Menu</span>
                  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive" id="printThis">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Menu</th>
                      <th>Aksi</th>    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Menu</th>
                      <th>Aksi</th>   
                    </tr>
                  </tfoot>
                  <tbody>
                <?php $i = 1; ?>  
                <?php foreach($menu as $m) : ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $m["menu"]; ?></td>
                      <td>
                      <a href="" class="badge badge-warning" data-toggle="modal" data-target="#editModal<?= $m['id']; ?>">Edit</a>
                      <a href="<?= base_url('menu/hapus/') . $m['id']; ; ?>" class="badge badge-danger tombolHapus">Hapus</a>

                      <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="<?= base_url('menu/edit'); ?>" method="post">
                            <input type="hidden" name="id" value="<?= $m['id'];?>">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Nama Menu</label>
                                    <input type="text" class="form-control" id="menu" name="menu" value="<?= $m['menu'];?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                            </form>
                            </div>
                        </div>
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




<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url('menu/tambah'); ?>" method="post">
        <div class="form-group">
            <label for="formGroupExampleInput">Nama Menu</label>
            <input type="text" class="form-control" id="menu" name="menu">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
    </form>
    </div>
  </div>
</div>