<section class="bg-jumbotron hero-wrap hero-wrap-2" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
            <h1 class="mb-3 bread text-gray-100">Detail Pemesanan Tiket</h1>
            <p class="breadcrumbs">
              <span class="mr-2"><a href="<?= base_url('landing_home'); ?>">Home <i class="ion-ios-arrow-forward"></i></a></span>
              <span class="mr-2"><a href="<?= base_url('landing_home/#pemesanan'); ?>">pemesanan <i class="ion-ios-arrow-forward"></i></a></span>
              <span>Detail Pemesanan <i class="ion-ios-arrow-forward"></i></span>
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
              <div class="col-lg-6 d-none img-fluid d-lg-block bg-img-detail-pemesanan"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Detail Pemesanan <span class="text-primary font-weight-bold">Tiket</span> Anda</h1>
                  </div>
                    <div>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nama
                          <label class="badge badge-primary-bs float-right p-1"><?= $pemesan['nama']; ?></label>
                        </li>
                        <li class="list-group-item">Alamat
                          <label class="badge badge-primary-bs float-right p-1"><?= $pemesan['alamat']; ?></label>
                        </li>
                        <li class="list-group-item">No Handphone
                          <label class="badge badge-primary-bs float-right p-1"><?= $pemesan['no_telp']; ?></label>
                        </li>
                        <li class="list-group-item">Tanggal Berkunjung
                          <label class="badge badge-primary-bs float-right p-1"><?= $pemesan['tanggal_berkunjung']; ?></label>
                        </li>
                        <li class="list-group-item">Jumlah Tiket
                          <label class="badge badge-primary-bs float-right p-1"><?= $pemesan['jumlah_tiket']; ?> Tiket</label>
                        </li>
                        <li class="list-group-item">Total Pembayaran
                          <label class="badge badge-primary-bs float-right p-1">IDR. <?= number_format($pemesan['total_pembayaran'],0,',','.'); ?></label>
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
                    <h1 class="h4 text-gray-900 mb-4">Terima Kasih Telah Melakukan Pemesanan di SIP<span class="text-primary font-weight-bold">etani</span></h1>
                    <?= $this->session->flashdata('message'); ?>
                  </div>
                  <div class="text-justify">
                  <p class="card-text">Silahkan Melakukan Pembayaran Pesanan Anda Ke No Rekening Berikut.</p>
                  <label class="badge badge-primary-bs rounded-pill p-3 d-block mx-auto col-5"><strong>12345678910</strong></label>
                  </div>
                  <hr>
                  <div class="text-justify">
                  <p class="card-text">Anda Dapat Mencetak Tiket dan Memesan kembali Setelah Mengunggah Bukti Pembayaran.</p>
                  <form class="user" method="post" action="<?= base_url('detail_pemesanan'); ?>" enctype="multipart/form-data">
                    <h5 class="card-title text-primary font-weight-bold mt-4">Unggah Bukti Pembayaran Disini!</h5>
                    <div class="btn btn-primary-bs rounded-pill">
                      <input type="file" class="col-12" name="bukti" id="bukti_pembayaran">
                      <?php echo form_error('bukti_pembayaran','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                  <hr>
                  <button type="submit" name="submit_bukti" class="btn btn-primary btn-user btn-block font-weight-bold mt-4">Unggah</button>
                  <a href="<?= base_url('landing_home'); ?>" class="btn btn-secondary-bs btn-user btn-block font-weight-bold mt-4">Home</a>
                  <hr>
                  </form>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 d-none img-fluid d-lg-block bg-img-upload-pemesanan"></div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</section>