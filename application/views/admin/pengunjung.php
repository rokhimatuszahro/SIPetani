<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?= base_url('dashboard'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Pengunjung</li>
        </ol>

        <!-- Data Pengunjung -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            Data Pengunjung</div>
          <div class="card-body">
            <div class="table-responsive">

            <!-- Menampilkan Flashdata yg dibuat dan dikirim dari controller -->
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>" data-judul="Pengunjung" data-type="success"></div>

            <a href="<?= base_url('tambahpengunjung'); ?>" class="btn btn-success mb-3"><i class="fa fa-users mr-2"></i>Tambah Data</a>
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                  <tr>
                    <th>NO</th>
                    <th>ID PENGUNJUNG</th>
                    <th>TANGGAL</th>
                    <th>JUMLAH PENGUNJUNG</th>
                    <th>AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <!--untuk menampikan data pada tabel-->
                  <?php $n = 1; ?>
                  <?php foreach ($pengunjung as $data) :?>
                  <tr>
                    <td><?= $n; ?></td>
                    <td><?= $data["id_pengunjung"]; ?></td>
                    <td><?= $data["tgl_pengunjung"]; ?></td>
                    <td><?= $data["jum_pengunjung"]; ?></td>
                    <td class="text-center">
                      <a href="<?= base_url('admin/hapuspengunjung/'); ?><?=$data['id_pengunjung']; ?>" class="btn btn-danger btn-sm dialog" data-judul-dialog="Hapus Pengunjung">
                        <i class="fa fa-trash"></i>
                      </a> || 
                      <a href="<?= base_url('admin/editpengunjung/'); ?><?=$data["id_pengunjung"]; ?>" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit text-white"></i>
                      </a>
                    </td>
                  </tr>
                  <?php $n++; ?>
                  <?php endforeach; ?>  
                </tbody>
              </table>
            </div>
          </div>
      </div>