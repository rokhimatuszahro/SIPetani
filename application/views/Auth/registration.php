<section class="ftco-section bg-gradient-primary">
  
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center ftco-animate">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-registrasi"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                    <?= $this->session->flashdata('message'); ?>
                  </div>
                  <form class="user" method="post" action="<?= base_url('registration'); ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="username" id="username" value="<?= set_value('username'); ?>" placeholder="Masukkan Username">
                      <?php echo form_error('username','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="email" id="email" value="<?= set_value('email'); ?>" placeholder="Masukkan Email">
                      <?php echo form_error('email','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user text-center" name="password" id="password" placeholder="Password">
                      </div>
                      <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user text-center" name="password2" id="password2" placeholder="Repeat Password">
                      </div>
                      <?php echo form_error('password','<p class="text-danger-bs small ml-4">','</p>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="pin" id="pin" value="<?= set_value('pin'); ?>" placeholder="PIN">
                      <?php echo form_error('pin','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="no_telp" id="no_telp" value="<?= set_value('no_telp'); ?>" placeholder="No Handphone">
                      <?php echo form_error('no_telp','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group">
                      <textarea class="form-control text-xs" name="alamat" id="alamat" rows="3" placeholder="Alamat Lengkap" ><?= set_value('alamat'); ?></textarea>
                      <?php echo form_error('alamat','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group">
                      <label for="jeniskelamin" class="my-2 text-xs">Jenis Kelamin</label><br>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="Laki-laki" value="Laki - Laki" name="jeniskelamin">
                        <label for="Laki-laki" class="custom-control-label">Laki-laki</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="perempuan" value="Perempuan" name="jeniskelamin">
                        <label for="perempuan" class="custom-control-label">Perempuan</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold">
                      Register Account
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small text-primary" href="<?= base_url('forgotpassword'); ?>">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small text-primary" href="<?= base_url('login'); ?>">Sudah Memiliki Akun? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</section>

