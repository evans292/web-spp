<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg">
            <h3 class="text-dark" style="color: black;">LAPORAN DATA SISWA</h3>
            <hr>
        </div>
    </div>
<div class="row">
    <div class="col-lg">
    <table border="1"  class="table table-bordered" id="report" width="100%" style="color: black;">
  <thead class="text-center">
    <tr>
      <th scope="col">No</th>
      <th scope="col">NIS</th>
      <th scope="col">Nama Siswa</th>
      <th scope="col">Kelas</th>
      <th scope="col">Tahun Ajaran</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <?php $i = 1; foreach($siswa as $s) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $s['nis']; ?></td>
            <td align="left"><?= $s['nama']; ?></td>
            <td><?= $s['kelas']; ?></td>
            <td><?= $s['tahunajaran']; ?></td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
    </div>
</div>
</div>


</div>
<!-- /.container-fluid -->

</div>

