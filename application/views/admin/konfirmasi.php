<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?= base_url('dashboard'); ?>">Dashboard</a> <!-- mengarahkan keadaan saat ini ke dashboard -->
          </li>
          <li class="breadcrumb-item active">Konfirmasi</li>
        </ol>

        <!-- Data Pemesanan -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-check"></i>
            Konfirmasi Data Pemesanan</div>
          <div class="card-body">
            <div class="table-responsive">
              <?= $this->session->flashdata('message'); ?>
              <a href="<?= base_url('admin/validasikonfirmasi/'); ?>all/1" onclick ="return confirm('Anda Yakin Ingin Mengkonfirmasi semua pemesanan?');" class="btn btn-success mb-3"><i class="fa fa-tasks mr-2"></i>Konfirmasi Semua</a>
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                  <tr>
                    <th>NO</th>
                    <th>ID PEMESANAN</th>
                    <th>NAMA PEMESAN</th>
                    <th>TOTAL PEMBAYARAN</th>
                    <th>BUKTI PEMBAYARAN</th>
                    <th>KONFIRMASI PEMBAYARAN</th>
                    <th>STATUS PEMBAYARAN</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $n = 1; ?>
                  <?php foreach ($konfirmasi as $data) :?>  <!-- looping data pada array data dengan key konfirmasi yg sudah dibuat di controller -->
                  <tr>
                    <td><?= $n; ?></td>
                    <td><?= $data["id_pemesanan"]; ?></td> <!-- data id_pemesaan -->
                    <td><?= $data["nama_pemesan"]; ?></td> <!-- data nama_pemesaan -->
                    <td>Rp. <?= number_format($data["total_pembayaran"],0,',','.'); ?></td> <!-- data total biaya yg diformat menjadi nilai mata uang -->
                    <td>
                      <!-- Jika tidak upload bukti pembayaran / == null makan akan  -->
                      <?php if ($data['bukti_pembayaran'] == NULL ): ?>
                          <i class="btn btn-sm btn-danger fas fa-eye-slash rounded-circle"></i>
                      
                      <!-- jika tidak makan akan lanjut ke proses berikutnya  -->
                      <?php else: ?>
                      <!-- memanggil data gambar dengan base_url() -->
                      <a class="btn btn-sm btn-success rounded-circle" target="_BLANK" href="<?= base_url('assets/img/bukti_pembayaran/'); ?><?= $data['bukti_pembayaran']; ?>"><i class="fas fa-eye"></i></a>
                      <?php endif ?>
                    </td>
                    <td class="text-center">
                    
                        <!-- mengirim parameter id_pemesanan dan int 1 jika ingin mengkonfirmasi, ke method validasikonfirmasi -->
                        <a href="<?= base_url('admin/validasikonfirmasi/'); ?><?= $data["id_pemesanan"]; ?>/1" class="btn btn-sm btn-primary rounded-circle" onclick ="return confirm('Anda Yakin Ingin Mengkonfirmasi?');">
                          <i class="fa fa-check"></i>
                        </a>

                        <!-- mengirim parameter id_pemesanan dan int 0 jika ingin membatalkan konfirmasi, ke method validasikonfirmasi -->
                        <a href="<?= base_url('admin/validasikonfirmasi/'); ?><?= $data["id_pemesanan"]; ?>/0" class="btn btn-sm btn-danger rounded-circle">
                          <i class="fa fa-times"></i>
                        </a>
                    </td>
                    <td>
                    <!-- Jika status pembayaran 1 maka lunas -->
                      <?php if ($data["status_pembayaran"] == 1): ?>
                        <small><label class="p-2 badge badge-success rounded-pill">Lunas</label></small>
                    
                    <!-- Selain itu maka tidak lunas -->
                      <?php else: ?>
                        <small><label class="p-2 badge badge-danger rounded-pill">Lunas</label></small>
                      <?php endif ?>
                    </td>
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