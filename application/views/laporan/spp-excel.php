<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_spp.xls");
header("Pragma: no-cache");
header("Expires:0");

?>
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg">
            <h3 class="text-dark" style="color: black;">LAPORAN DATA PEMBAYARAN SPP</h3>
            <hr>
        </div>
    </div>
<div class="row">
    <div class="col-lg">
    <h6 class="text-dark">Tanggal : <?= $this->input->get('tgl1'); ?> - <?= $this->input->get('tgl2'); ?></h6>
    <table border="1" width="100%" style="color: black;">
  <thead class="text-center">
    <tr>
      <th scope="col">No</th>
      <th scope="col">NIS</th>
      <th scope="col">Nama Siswa</th>
      <th scope="col">Kelas</th>
      <th scope="col">No. Bayar</th>
      <th scope="col">Pembayaran Bulan</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Keterangan</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <?php $total = 0; $i = 1; foreach($spp as $s) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $s['nis']; ?></td>
            <td align="left"><?= $s['nama']; ?></td>
            <td><?= $s['kelas']; ?></td>
            <td><?= $s['nobayar']; ?></td>
            <td><?= $s['bulan']; ?></td>
            <td align="right"><?= $s['jumlah']; ?></td>
            <td><?= $s['ket']; ?></td>
        </tr>
    <?php $total += $s['jumlah']; endforeach; ?>
        <tr>
            <td colspan="6" align="right">Total</td>
            <td align="right" class="font-weight-bold"><?= $total; ?></td>
            <td></td>
        </tr>
  </tbody>
</table>


    </div>
</div>
</div>

