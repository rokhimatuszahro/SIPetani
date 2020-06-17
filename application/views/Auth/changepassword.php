<section class="ftco-section bg-gradient-primary">
  
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center ftco-animate">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-reset-password"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900">
                      <i class="text-primary-bs far fw fa-smile-wink"></i> 
                      <span class="text-primary"><?= $this->session->userdata('reset_email'); ?></span> 
                    </h1>
                    <h1 class="h4 text-gray-900 mb-4">Ubah Password Baru</h1>
                    <?= $this->session->flashdata('message'); ?>
                  </div>
                  <form class="user" method="post" action="<?= base_url('changepassword'); ?>">
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user text-center" name="password" id="password" placeholder="Password Baru">
                      <?php echo form_error('password','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user text-center" name="password2" id="password"
                        placeholder="Ulang Password Baru">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold mt-4">
                      Ubah Sekarang
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</section>