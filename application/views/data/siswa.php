
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
              <h5 class="m-0 font-weight-bold text-primary">Data Siswa</h5>
              <a class="btn btn-success btn-sm btn-icon-split" href="#" data-toggle="modal" data-target="#addModal" style="float: right; margin-right: 20px;">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Siswa</span>
                  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive" id="printThis">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Tahun Ajaran</th>
                      <th>Biaya</th>
                      <th>Aksi</th>    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Tahun Ajaran</th>
                      <th>Biaya</th>
                      <th>Aksi</th>    
                    </tr>
                  </tfoot>
                  <tbody>
                <?php $i = 1; ?>  
                <?php foreach($siswa as $s) : ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $s["nis"]; ?></td>
                      <td><?= $s["nama"]; ?></td>
                      <td><?= $s["kelas"]; ?></td>
                      <td><?= $s["tahunajaran"]; ?></td>
                      <td><?= $s["biaya"]; ?></td>
                      <td>
                      <a href="" class="badge badge-warning" data-toggle="modal" data-target="#editModal<?= $s['id']; ?>">Edit</a>
                      <a href="<?= base_url('admin/hapussiswa/') . $s['id']; ; ?>" class="badge badge-danger tombolHapusSiswa">Hapus</a>

                      <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?= $s['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="<?= base_url('admin/editsiswa'); ?>" method="post">
                            <input type="hidden" name="id" value="<?= $s['id']; ?>">
                            <div class="form-group">
                                <label for="formGroupExampleInput">NIS</label>
                                <input type="number" class="form-control" id="nis" name="nis" value="<?= $s['nis']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $s['nama']; ?>">
                            </div>
                            <div class="form-group">
                            <label for="menu_id">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="form-control">
                                <option value="<?= $s['kelas_id']; ?>"> - <?= $s['kelas'];?> - </option>
                                    <?php foreach($kelas as $k) : ?>
                                    <option value="<?= $k['id']; ?>"><?= $k['kelas']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tahun Ajaran</label>
                                <input type="text" class="form-control " id="tahun" name="tahun" value="2020/2021" readonly>
                            </div>
                            <div class="form-group">
                            <label for="formGroupExampleInput">Biaya SPP</label>
                                <input type="text" class="form-control " id="biaya" name="biaya" value="250000" readonly>
                            </div>
                            <div class="form-group">
                            <label for="formGroupExampleInput">Jatuh Tempo Pertama</label>
                                <input type="text" class="form-control " id="tempo" name="tempo" value="2020-07-10" readonly>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url('admin/tambahsiswa'); ?>" method="post">
        <div class="form-group">
            <label for="formGroupExampleInput">NIS</label>
            <input type="number" class="form-control" id="nis" name="nis">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Nama Siswa</label>
            <input type="text" class="form-control" id="nama" name="nama">
        </div>
        <div class="form-group">
        <label for="menu_id">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-control">
      			<option value="">Pilih Kelas</option>
      			<?php foreach($kelas as $k) : ?>
			  	<option value="<?= $k['id']; ?>"><?= $k['kelas']; ?></option>
      			<?php endforeach ?>
      		</select>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Tahun Ajaran</label>
            <input type="text" class="form-control " id="tahun" name="tahun" value="2020/2021" readonly>
        </div>
        <div class="form-group">
        <label for="formGroupExampleInput">Biaya SPP</label>
            <input type="text" class="form-control " id="biaya" name="biaya" value="250000" readonly>
        </div>
        <div class="form-group">
        <label for="formGroupExampleInput">Jatuh Tempo Pertama</label>
            <input type="text" class="form-control " id="tempo" name="tempo" value="2020-07-10" readonly>
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