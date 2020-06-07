<section class="bg-jumbotron hero-wrap hero-wrap-2" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
            <h1 class="mb-3 bread text-gray-100">Tiket <?= $user['nama']; ?></h1>
            <p class="breadcrumbs">
              <span class="mr-2"><a href="<?= base_url('landing_home'); ?>">Home <i class="ion-ios-arrow-forward"></i></a></span>
              <span class="mr-2"><a href="<?= base_url('landing_home/#pemesanan'); ?>">pemesanan <i class="ion-ios-arrow-forward"></i></a></span>
              <span>Tiket Saya <i class="ion-ios-arrow-forward"></i></span>
            </p>
          </div>
        </div>
      </div>
</section>

<section class="ftco-section bg-gradient-primary">
  
  <div class="container">
    <div class="row justify-content-center ftco-animate">
      <div class="col-12">

        <div class="card o-hidden border-0 shadow-lg my-5 ftco-animate">
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Pemesan</th>
                  <th>Tgl Pemesanant</th>
                  <th>Total Biaya</th>
                  <th>Print</th>
                </tr>
              </thead>
              <tbody>

                <?php if ($tiket == null): ?>
                
                  <tr class="text-center">
                    <td colspan="5">
                      <div class="mt-4">
                        <span class="alert alert-danger">Anda Belum Memiliki Tiket</span>
                      </div>
                    </td>
                  </tr>
                
                <?php else: ?>
                
                <?php $no = 1; foreach ($tiket as $t): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $t['nama_pemesan']; ?></td>
                    <td><?= $t['tanggal_pemesanan']; ?></td>
                    <td><?= $t['total']; ?></td>
                    <td><a href="<?= base_url('Landing_Home/print/'.$t['id_pemesanan']); ?>" target="_blank"><i class="fas fa-print"></i></a></td>
                </tr>
                <?php endforeach ?>
              
                <?php endif ?>
              
              </tbody>
            </table>
          </div>
        </div>

      </div>  
    </div>
  </div>

</section>