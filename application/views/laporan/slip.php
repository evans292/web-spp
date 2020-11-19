<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg">
            <h3 class="text-dark" style="color: black;">SLIP PEMBAYARAN SPP</h3>
            <hr>
            <table>
                <tr>
                   <td>Nama : <?= $slip['nama']; ?></td>
                </tr>
                <tr>
                    <td>NIS : <?= $slip['nis']; ?></td>
                </tr>
                <tr>
                    <td>Kelas : <?= $slip['kelas']; ?></td>
                </tr>
            </table>
            <hr>
        </div>
    </div>
<div class="row">
    <div class="col-lg">
    <table border="1" width="100%" style="color: black;">
  <thead class="text-center">
    <tr>
      <th scope="col">No</th>
      <th scope="col">No. Bayar</th>
      <th scope="col">Pembayaran Bulan</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Keterangan</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <?php $i = 1; foreach($spp as $s) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $s['nobayar']; ?></td>
            <td><?= $s['bulan']; ?></td>
            <td align="right"><?= $s['jumlah']; ?></td>
            <td><?= $s['ket']; ?></td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

    <table class="mt-3" style="margin-top:10px; margin-left:1000px;">
        <tr>
            <td>
                <p>Sumedang, <?= date('d-m-Y'); ?><br>
                    Tubagus Gusti Fauzy,
                </p>
                <br>
                <br>
                <p>_______________________</p>
            </td>
        </tr>
    </table>

    <a href="#" id="Print" class="badge badge-info" onclick="window.print();">Cetak</a>

    </div>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>

