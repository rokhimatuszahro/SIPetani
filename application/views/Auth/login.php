<section class="ftco-section bg-gradient-primary">
  
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center ftco-animate">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center mb-4">
                    <h1 class="h4 text-gray-900">Selamat Datang di <span class="text-primary font-weight-bold">SIP</span>etani</h1>
                    <?= $this->session->flashdata('message'); ?>
                  </div>
                  <form class="user" method="post" action="<?= base_url('login'); ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="email" id="email" value="<?= set_value('email'); ?>" placeholder="SIPetani@gmail.com">
                      <?php echo form_error('email','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user text-center" name="password" id="password" placeholder="Password">
                      <?php echo form_error('password','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold mt-4">
                      Login
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small text-primary" href="<?= base_url('forgotpassword'); ?>">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small text-primary" href="<?= base_url('registration'); ?>">Buat Akun Baru!</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 d-none d-lg-block bg-wellcome"></div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</section>
