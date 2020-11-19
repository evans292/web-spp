
<!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
    <div class="col-md">
        <!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?php if($this->session->flashdata('message')) : ?>
    <div class="flash-data" data-flashdata=" <?= $this->session->flashdata('message'); ?>"></div>
    <?php endif; ?>

 <!-- DataTales Example -->
 <div class="card shadow mb-4" id="printThis">
            <div class="card-header py-3 container-fluid">
              <h5 class="m-0 font-weight-bold text-primary">Data Wali Kelas</h5>
              <a class="btn btn-success btn-sm btn-icon-split" href="#" data-toggle="modal" data-target="#addModal" style="float: right; margin-right: 20px;">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Wali Kelas</span>
                  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive" id="printThis">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kelas</th>
                      <th>Nama</th>
                      <th>Aksi</th>    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Kelas</th>
                      <th>Nama</th>
                      <th>Aksi</th>   
                    </tr>
                  </tfoot>
                  <tbody>
                <?php $i = 1; ?>  
                <?php foreach($wali as $w) : ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $w["kelas"]; ?></td>
                      <td><?= $w["nama"]; ?></td>
                      <td>
                      <a href="" class="badge badge-warning" data-toggle="modal" data-target="#editModal<?= $w['id']; ?>">Edit</a>
                      <a href="<?= base_url('admin/hapusguru/') . $w['id']; ; ?>" class="badge badge-danger tombolHapus">Hapus</a>

                      <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?= $w['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Guru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="<?= base_url('admin/editwali'); ?>" method="post">
                            <input type="hidden" name="id" value="<?= $w['id'];?>">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Nama Kelas</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $w['kelas'];?>">
                                </div>
                                <div class="form-group">
                                <label for="menu_id">Guru</label>
                                    <select name="guru_id" id="guru_id" class="form-control">
                                        <option value="<?= $w['id']; ?>"> - <?= $w['nama'];?> - </option>
                                        <?php foreach($guru as $g) : ?>
                                        <option value="<?= $g['id']; ?>"><?= $g['nama']; ?></option>
                                        <?php endforeach ?>
                                    </select>
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



<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Wali Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url('admin/tambahwali'); ?>" method="post">
        <div class="form-group">
            <label for="formGroupExampleInput">Nama Kelas</label>
            <input type="text" class="form-control" id="nama" name="nama">
        </div>
        <div class="form-group">
        <label for="menu_id">Guru</label>
            <select name="guru_id" id="guru_id" class="form-control">
      			<option value="">Pilih Guru</option>
      			<?php foreach($guru as $g) : ?>
			  	<option value="<?= $g['id']; ?>"><?= $g['nama']; ?></option>
      			<?php endforeach ?>
      		</select>
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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->