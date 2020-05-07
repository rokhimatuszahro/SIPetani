<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Pemesanan</li>
        </ol>

        <!-- Data Pemesanan -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-ticket-alt"></i>
            Data Pemesanan</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                  <tr>
                    <th>NO</th>
                    <th>ID PEMESANAN</th>
                    <th>NAMA</th>
                    <th>ALAMAT</th>
                    <th>TANGGAL BERKUNJUNG</th>
                    <th>JUMLAH TIKET</th>
                    <th>NO TELP.</th>
                    <th>TOTAL PEMBAYARAN</th>
                    <th>BUKTI PEMBAYARAN</th>
                    <th>STATUS PEMBAYARAN</th>
                    <th>STATUS CETAK</th>
                  </tr>
                </thead>
                <tbody>
                  <!--untuk menampikan data pada tabel-->
                  <?php $n = 1; ?>
                  <?php foreach ($pemesanan as $data) :?>
                  <tr>
                    <td><?= $n; ?></td>
                    <td><?= $data["id_pemesanan"]; ?></td>
                    <td><?= $data["nama_pemesan"]; ?></td>
                    <td><?= $data["alamat"]; ?></td>
                    <td><?= $data["tanggal_berkunjung"]; ?></td>
                    <td><?= $data["jumlah_tiket"]; ?></td>
                    <td><?= $data["no_telp"]; ?></td>
                    <td>Rp. <?= number_format($data["total_pembayaran"],0,',','.'); ?></td>
                    <td>
                      <?php if (!$data["bukti_pembayaran"]): ?>
                        <small><label class="p-2 badge badge-danger rounded-pill">Belum Unggah</label></small>
                      <?php else: ?>
                      <img class="rounded" height="60" width="80" src="<?= base_url('assets/img/bukti_pembayaran/'); ?><?= $data["bukti_pembayaran"]; ?>">    
                      <?php endif ?>
                    </td>
                    <td>
                      <?php if ($data["status_pembayaran"] == 1): ?>
                        <small><label class="p-2 badge badge-success rounded-pill">Lunas</label></small>
                      <?php else: ?>
                        <small><label class="p-2 badge badge-danger rounded-pill">Lunas</label></small>
                      <?php endif ?>
                    </td>
                    <td>
                      <?php if ($data["status_cetak"] == 1): ?>
                        <small><label class="p-2 badge badge-success rounded-pill">Cetak</label></small>
                      <?php else: ?>
                        <small><label class="p-2 badge badge-danger rounded-pill">Cetak</label></small>
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