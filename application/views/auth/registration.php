  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" action="<?= base_url('auth/register'); ?>" method="post">
              <div class="form-group">
                    <input type="number" class="form-control " id="nis" placeholder="NIS" name="nis" value="<?= set_value('nis'); ?>">
                    <?= form_error('nis', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                <div class="form-group">
                    <input type="text" class="form-control " id="name" placeholder="Nama Lengkap" name="name" value="<?= set_value('name'); ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                      <select name="kelas_id" id="kelas_id" class="form-control ">
                      <option value="">Kelas</option>
                      <?php foreach($kelas as $k) : ?>
                     <option value="<?= $k['id']; ?>"><?= $k['kelas']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                <div class="form-group">
                    <input type="hidden" class="form-control " id="tahun" name="tahun" value="2020/2021" readonly>
                  </div>
                  <div class="form-group">
                    <input type="hidden" class="form-control " id="biaya" name="biaya" value="250000" readonly>
                  </div>
                  <div class="form-group">
                    <input type="hidden" class="form-control " id="tempo" name="tempo" value="2020-07-10" readonly>
                  </div>  
                  <div class="form-group">
                  <input type="text" class="form-control " id="email" placeholder="Email" name="email" value="<?= set_value('email'); ?>">
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="password" class="form-control " id="password1" placeholder="Password" name="password1">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control " id="password2" placeholder="Ulangi Password" name="password2">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Daftar
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= base_url('auth/index'); ?>">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


