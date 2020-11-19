    <!-- Begin Page Content -->
    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<?php if($this->session->flashdata('message')) : ?>
<div class="flash-data" data-flashdata=" <?= $this->session->flashdata('message'); ?>"></div>
<?php endif; ?>

<div class="row">
  <div class="col-lg-5">
    <form action="" method="get">
    <div class="form-group">
      <label for="nis">Nama</label>       
      <div class="input-group">
      <input type="text" class="form-control" name="key" id="key" aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="Cari siswa...">
      <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="submit" name="cari" id="button-addon2"><i class="fas fa-search"></i></button>
      </div>
      </div>
    </div>
    </form>
   
    </div>
</div>
<?php if ($this->input->get('key')) : ?>
 <div class="row mt-4">
   <div class="col-lg-12">
   <div class="card shadow mb-4" id="printThis">
  <div class="card-header py-3 container-fluid">
  <h5 class="m-0 font-weight-bold text-primary"><?= $title . " : " . $this->input->get('key'); ?></h5>
   </div>
  <div class="card-body">
   <table class="table table-hover" id="spp" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Jatuh Tempo</th>
            <th>Tgl Bayar</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Petugas</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Jatuh Tempo</th>
            <th>Tgl Bayar</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Petugas</th>
          </tr>
        </tfoot>
        <tbody>
          <?php $i = 1; foreach ($spp as $s) : ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $s['bulan'];?></td>
            <td><?= $s['jatuhtempo'];?></td>
            <td><?= $s['tglbayar'];?></td>
            <td><?= $s['jumlah'];?></td>
            <td><?= $s['ket'];?></td>
            <td><?= $s['petugas_id']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
 </div>
</div>
</div>
 </div>
<?php endif; ?>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->