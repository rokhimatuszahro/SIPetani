<section class="bg-jumbotron hero-wrap hero-wrap-2" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
            <h1 class="mb-3 bread text-gray-100">Detail Pembayaran Tiket</h1>
            <p class="breadcrumbs">
              <span class="mr-2"><a href="<?= base_url('landing_home'); ?>">Home <i class="ion-ios-arrow-forward"></i></a></span>
              <span class="mr-2"><a href="<?= base_url('landing_home/#pemesanan'); ?>">pemesanan <i class="ion-ios-arrow-forward"></i></a></span>
              <span>Detail Pembayaran <i class="ion-ios-arrow-forward"></i></span>
            </p>
          </div>
        </div>
      </div>
</section>

<section class="ftco-section bg-gradient-primary">
  
  <div class="container">
    <div class="row justify-content-center ftco-animate">
      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 ftco-animate">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none img-fluid d-lg-block bg-img-detail-pembayaran"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Detail Pembayaran <span class="text-primary font-weight-bold">Tiket</span> Anda</h1>
                  </div>
                    <div>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">Tanggal Berkunjung
                          <label class="badge badge-primary-bs float-right p-1"><?= date('d - M - Y',strtotime($tgl_berkunjung)); ?></label>
                        </li>
                        <li class="list-group-item">Jumlah Tiket
                          <label class="badge badge-primary-bs float-right p-1"><?= $jumlah_tiket; ?> Tiket</label>
                        </li>
                        <li class="list-group-item">Total Pembayaran
                          <label class="badge badge-primary-bs float-right p-1"><?= $harga; ?></label>
                        </li>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>  

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 ftco-animate">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Lengkapi Formulir Pemesanan <span class="text-primary font-weight-bold">Tiket</span></h1>
                  </div>
                  <form class="user" method="post" action="<?= base_url('detail_pembayaran'); ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="nama" id="nama" placeholder="Nama Pemesan" value="<?= set_value('nama'); ?>">
                      <?php echo form_error('nama','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="no_telp" id="no_telp"
                        placeholder="No Handphone" value="<?= set_value('no_telp'); ?>">
                        <?php echo form_error('no_telp','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>  
                    <div class="form-group">
                      <textarea class="form-control text-xs" name="alamat" id="alamat" rows="3" placeholder="Alamat Lengkap"><?= set_value('alamat'); ?></textarea>
                      <?php echo form_error('alamat','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <button type="submit" name="submit_pemesan" class="btn btn-primary btn-user btn-block font-weight-bold mt-4">
                      Pesan Tiket
                    </button>
                    <a href="<?= base_url('landing_home'); ?>" class="btn btn-secondary-bs btn-user btn-block font-weight-bold mt-4">
                      Batal
                    </a>
                  </form>
                  <hr>
                </div>
              </div>
              <div class="col-lg-6 d-none img-fluid d-lg-block bg-img-form-pembayaran"></div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</section>