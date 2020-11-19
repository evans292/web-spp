    <!-- Begin Page Content -->
    <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
          <div class="col-lg-6">
        <ul class="list-group">
        <a href="<?= base_url('laporan/guru'); ?>" style="text-decoration: none" target="_blank">
			  <li class="list-group-item">
          Laporan Data Guru
        </li>
        </a>
        <a href="<?= base_url('laporan/siswa'); ?>" style="text-decoration: none" target="_blank">
			  <li class="list-group-item">
         Laporan Data Siswa
        </li>
        </a>
      </ul>
      </div>

      <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
        <h5>Laporan Pembayaran</h5>
        </div>
        <div class="card-body">
          <form method="get" action="<?= base_url('laporan/pembayaran'); ?>" target="_blank">
            <div class="form-group">
              <label for="tgl1">Mulai Tanggal</label>
              <input id="tgl1" class="form-control" type="date" name="tgl1" value="<?= date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
              <label for="tgl2">Sampai Tanggal</label>
              <input id="tgl2" class="form-control" type="date" name="tgl2" value="<?= date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success" style="float: right;">Buat Laporan</button>
            </div>
          </form>
        </div>
      </div>
          
        </div>
      </div>

        

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->