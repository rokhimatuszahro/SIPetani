<section class="ftco-section bg-gradient-primary">
  
  <div class="container">

    <div class="row justify-content-center ftco-animate">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-lupa-password"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Lupa Password Anda?</h1>
                    <p class="mb-4">Masukkan Email dan PIN terakhir anda dan klik Reset Password untuk mereset password anda!</p>
                    <?= $this->session->flashdata('message'); ?>
                  </div>
                  <form class="user" method="post" action="<?= base_url('forgotpassword'); ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="email" id="email" placeholder="Email">
                      <?php echo form_error('email','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="pin" id="pin" placeholder="PIN">
                      <?php echo form_error('pin','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold">
                      Reset Password
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small text-primary" href="<?= base_url('registration'); ?>">Buat Akun Baru!</a>
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