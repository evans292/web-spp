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
                <label for="nis">NIS / ID</label>       
                <div class="input-group">
                <input type="number" class="form-control" name="key" id="key" aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="Cari siswa...">
                <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" name="cari" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
                </div>
              </div>
              </form>
             
              </div>
        </div>
        <?php if ($this->input->get('key')) : ?>
        <div class="row">
        <div class="col-lg-5">    
            <div class="card" style="width: 18rem;">
          <div class="card-header">
          <h5 class="m-0 font-weight-bold text-primary">Biodata Siswa</h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Id Siswa     : <?= $siswa['id']; ?> </li>
              <li class="list-group-item">NIS          : <?= $siswa['nis']; ?> </li>
              <li class="list-group-item">Nama         : <?= $siswa['nama']; ?> </li>
              <li class="list-group-item">Kelas        : <?= $siswa['kelas']; ?> </li>
              <li class="list-group-item">Tahun Ajaran : <?= $siswa['tahunajaran']; ?> </li>
            </ul>
          </div>
              </div>
           </div>
        
           <div class="row mt-4">
             <div class="col-lg-12">
             <div class="card shadow mb-4" id="printThis">
            <div class="card-header py-3 container-fluid">
            <h5 class="m-0 font-weight-bold text-primary">Tagihan Siswa</h5>
             </div>
            <div class="card-body">
             <table class="table table-hover" id="spp" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Bulan</th>
                      <th>Jatuh Tempo</th>
                      <th>No. Bayar</th>
                      <th>Tgl Bayar</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>          
                      <th>Bayar</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Bulan</th>
                      <th>Jatuh Tempo</th>
                      <th>No. Bayar</th>
                      <th>Tgl Bayar</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>       
                      <th>Bayar</th>  
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $i = 1; foreach ($spp as $s) : ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td><?= $s['bulan'];?></td>
                      <td><?= $s['jatuhtempo'];?></td>
                      <td><?= $s['nobayar']; ?></td>
                      <td><?= $s['tglbayar'];?></td>
                      <td><?= $s['jumlah'];?></td>
                      <td><?= $s['ket'];?></td>   
                      <td class="text-center">
                        <?php 
                        $nis = $s['nis'];
                        $act = "bayar";
                        $id = $s['id_spp']; 
                        if ($s['nobayar'] == '') : ?>
                          <a href="<?= base_url('transaksi/bayar/') . "$nis/$act/$id"; ?>" class="badge badge-success tombol-bayar" style="text-decoration: none">Bayar</a>
                        <?php else : ?>
                          <a href="<?= base_url('transaksi/bayar/') . "$nis/batal/$id"; ?>" class="badge badge-danger tombol-bayar" style="text-decoration: none">Batal</a>
                          <a href="<?= base_url('transaksi/slip/') . "$nis/$id"; ?>" class="badge badge-info tombol-bayar" style="text-decoration: none" target="_blank">Cetak</a>
                        <?php endif; ?>
                      </td>
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