<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?= base_url('dashboard'); ?>">Dashboard</a> <!-- mengarahkan keadaan saat ini ke dashboard -->
          </li>
          <li class="breadcrumb-item active">Lihat Semua</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-ticket-alt"></i>
                </div>
                <div class="mr-5">Pemesanan</div>
                <div class="mr-5"><?= $pemesanan; ?></div> <!-- Menampilan total pemesanan -->
              </div>
              <!-- Mengarahkan keadaan ke method pemesanan -->
              <a class="card-footer text-white clearfix small z-1" href="<?= base_url('pemesanan'); ?>">
                <span class="float-left">Lihat Data</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                <div class="mr-5">Pengunjung</div>
                <div class="mr-5">
                  <?=
                    $pengunjung['jum_pengunjung']; // Menampilkan jumlah pengunjung akhir - akhir ini
                  ?> 
                </div>
                <small><?= $pengunjung['tgl_pengunjung']; ?></small> <!-- Menampilakn tanggal update pengunjung -->
              </div>
              <!-- Mengarahkan keadaan ke method pengunjung -->
              <a class="card-footer text-white clearfix small z-1" href="<?= base_url('pengunjung'); ?>">
                <span class="float-left">Lihat Data</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-secondary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-dollar-sign"></i>
                </div>
                <div class="mr-5">Harga</div>
                <!-- Menampilkan Jumlah event harga -->
                <div class="mr-5"><?= $harga; ?> Event</div> 
              </div>
              <!-- Mengarahkan keadaan ke method harga -->
              <a class="card-footer text-white clearfix small z-1" href="<?= base_url('harga'); ?>">
                <span class="float-left">Lihat Data</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-check"></i>
                </div>
                <div class="mr-5">Konfirmasi</div>
                <!-- Menampilkan jumlah pemesanan yg belum dikonfirmasi -->
                <div class="mr-5"><?= $cek_pemesanan; ?> Pemesanan</div> 
              </div>
              <!-- Mengarahkan keadaan ke method konfirmasi -->
              <a class="card-footer text-white clearfix small z-1" href="<?= base_url('konfirmasi'); ?>">
                <span class="float-left">Lihat Data</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-cloud-sun"></i>
                  </div>
                  <!-- Menampilkan Total penjualan harian pada hari sekarang -->
                  <div class="mr-5">Penjualan Harian <br> Rp. <?= number_format($data_rekap_harian['hasil'],0,',','.'); ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left"><?= date('d - m - Y'); ?></span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-money-check-alt"></i>
                  </div>
                  <!-- Menampilkan Total penjualan bulanan pada bulan sekarang -->
                  <div class="mr-5">Penjualan Bulanan <br> Rp. <?= number_format($data_rekap_bulanan['hasil'],0,',','.'); ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left"><?= date('M - Y'); ?></span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-balance-scale-right"></i>
                  </div>
                  <!-- Menampilkan Total penjualan tahun pada tahun sekarang -->
                  <div class="mr-5">Penjualan Tahunan <br> Rp. <?= number_format($data_rekap_tahunan['hasil'],0,',','.'); ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left"><?= date('Y'); ?></span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
        </div>


        <!-- Area Chart Example -->
        <!-- Untuk isi data chart berada di v_footer_admin.php bagian bawah -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Grafik Penjualan Tiket Bulanan : Tahun <?= date('Y'); ?>
          </div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
          <div class="card-footer small text-muted">
            <!-- Menampilkan waktu update data -->
            Pembaruan <?= date('l d-M-Y'); ?> Pukul <?= $waktu; ?>
          </div>
        </div>
        

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-user"></i>
            Data Pengguna</div>
          <div class="card-body">
            <div class="table-responsive">

                <!-- Menampilkan Flashdata yg dibuat dan dikirim dari controller -->
                <?= $this->session->flashdata('login') ?>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>" data-judul="Akun Admin" data-type="success"></div>

              <!-- mengarahkan keadaan saat ini ke akunadmin -->
              <a href="<?= base_url('akunadmin'); ?>" class="btn btn-success mb-3">
                <i class="fa fa-user-plus mr-2"></i>
                Tambah Akun Admin
              </a>
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>PROFILE</th>
                    <th>JENIS KELAMIN</th>
                    <th>E-MAIL</th>
                    <th>PIN</th>
                    <th>ID AKSES</th>
                    <th>STATUS LOGIN</th>
                    <th>AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <!--untuk menampikan data pada tabel-->
                  <?php $n = 1; ?>
                  <?php foreach ($users as $datauser) :?> <!-- looping data pada array data dengan key users yg sudah dibuat di controller -->
                  <tr>
                    <td><?= $n; ?></td>
                    <td><?= $datauser["nama"]; ?></td>    <!-- Data nama -->
                    <td><img src="<?= base_url('assets/img/profile/'); ?><?= $datauser["foto"]; ?>" class="rounded-circle" height="40" width="40"></td>
                    <td><?= $datauser["jenkel"]; ?></td>  <!-- Data jenkel -->
                    <td><?= $datauser["email"]; ?></td>   <!-- Data email -->
                    <td><?= $datauser["pin"]; ?></td>     <!-- Data pin -->
                    <td>
                      <!-- Jika id_akses 1 maka tampilak User -->
                      <?php if ($datauser["id_akses"] == 1): ?>
                        <small><label class="p-2 badge w-75 badge-success rounded-pill">User</label></small>
                      <!-- Selain itu tampilkan Admin -->
                      <?php else: ?>
                        <small><label class="p-2 badge w-75 badge-primary rounded-pill">Admin</label></small>
                      <?php endif ?>  
                    </td>
                    <td>
                      <!-- Jika status login 1 maka tampilkan online -->
                      <?php if ($datauser["status_login"] == 1): ?>
                        <small><label class="p-2 badge badge-success rounded-pill">Online</label></small>
                      <!-- Selain itu tampilkan offline -->
                      <?php else: ?>
                        <small><label class="p-2 badge badge-danger rounded-pill">Offline</label></small>
                      <?php endif ?>
                    </td>
                    <!-- mengarahkan keadaan saat ini ke admin/hapususer/parameter -->
                    <td class="text-center"><a href="<?= base_url('admin/hapususer/'); ?><?= $datauser['id_user']; ?>" class="btn btn-danger btn-sm dialog" data-judul-dialog="Hapus Akun"><i class="fa fa-trash"></i></a></td>
                  </tr>
                  <?php $n++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>

      </div>