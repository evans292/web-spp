<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg">
            <h3 class="text-dark" style="color: black;">LAPORAN DATA GURU</h3>
            <hr>
        </div>
    </div>
<div class="row">
    <div class="col-lg">
    <table border="1" class="table table-bordered" id="report" width="100%" style="color: black;">
  <thead class="text-center">
    <tr>
      <th scope="col">No</th>
      <th scope="col">ID</th>
      <th scope="col">Nama Guru</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <?php $i = 1; foreach($guru as $g) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $g['id']; ?></td>
            <td class="text-left"><?= $g['nama']; ?></td>
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

