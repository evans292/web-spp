<!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
    <div class="col-md">
        <!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<?php if(validation_errors()) : ?>
				<div class="alert alert-danger" role="alert">
					<?= validation_errors(); ?>
				</div>
			<?php endif; ?>

    <?php if($this->session->flashdata('message')) : ?>
    <div class="flash-data" data-flashdata=" <?= $this->session->flashdata('message'); ?>"></div>
    <?php endif; ?>

 <!-- DataTales Example -->
 <div class="card shadow mb-4" id="printThis">
            <div class="card-header py-3 container-fluid">
              <h5 class="m-0 font-weight-bold text-primary">Submenu Management</h5>
              <a class="btn btn-success btn-sm btn-icon-split" href="#" data-toggle="modal" data-target="#addModal" style="float: right; margin-right: 20px;">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Submenu</span>
                  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive" id="printThis">
              <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Title</th>
                      <th>Menu</th> 
                      <th>Url</th> 
                      <th>Icon</th>    
                      <th>Active</th>
                      <th>Aksi</th>  
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Title</th>
                      <th>Menu</th> 
                      <th>Url</th> 
                      <th>Icon</th>    
                      <th>Active</th>  
                      <th>Aksi</th>  
                    </tr>
                  </tfoot>
                  <tbody>
                <?php $i = 1; ?>  
                <?php foreach($submenu as $m) : ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $m["title"]; ?></td>
                      <td><?= $m["menu"]; ?></td>
                      <td><?= $m["url"]; ?></td>
                      <td><?= $m["icon"]; ?></td>
                      <td><?= $m["is_active"]; ?></td>
                      <td>
                      <a href="" class="badge badge-warning" data-toggle="modal" data-target="#editModal<?= $m['id']; ?>">Edit</a>
                      <a href="<?= base_url('menu/hapusSub/') . $m['id']; ; ?>" class="badge badge-danger tombolHapus">Hapus</a>
                      <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Submenu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form action="<?= base_url('menu/editsub'); ?>" method="post">
                          <input type="hidden" name="id" value="<?= $m['id']; ?>">
                            <div class="form-group">
                                <label for="title">Judul</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= $m['title']; ?>">
                            </div>  
                            <div class="form-group">
                            <label for="menu_id">Menu</label>
                                <select name="menu_id" id="menu_id" class="form-control">
                                <option value="<?= $m['menu_id']; ?>"> - <?= $m['menu']; ?> - </option>
                                <?php foreach($menu as $sm) : ?>
                              <option value="<?= $sm['id']; ?>"><?= $sm['menu']; ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="url">Url</label>
                                <input type="text" class="form-control" id="url" name="url" value="<?= $m['url']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input type="text" class="form-control" id="icon" name="icon" value="<?= $m['icon']; ?>">
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" id="check" name="check" checked>
                              <label class="form-check-label" for="check">
                                Active ?
                              </label>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Submenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url('menu/tambahsub'); ?>" method="post">
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
        <label for="menu_id">Menu</label>
            <select name="menu_id" id="menu_id" class="form-control">
      			<option value="">Pilih Menu</option>
      			<?php foreach($menu as $sm) : ?>
			  	<option value="<?= $sm['id']; ?>"><?= $sm['menu']; ?></option>
      			<?php endforeach ?>
      		</select>
        </div>
        <div class="form-group">
            <label for="url">Url</label>
            <input type="text" class="form-control" id="url" name="url">
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="text" class="form-control" id="icon" name="icon">
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" id="check" name="check" checked>
          <label class="form-check-label" for="check">
            Active ?
          </label>
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