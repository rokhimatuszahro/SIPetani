<div class="container-fluid">

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="<?= base_url('dashboard'); ?>">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Harga</li>
</ol>

<!-- Data Pengunjung -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-dollar-sign"></i>
    Data Harga</div>
  <div class="card-body">
    <div class="table-responsive">
    <?= $this->session->flashdata('message'); ?>
    <a href="<?= base_url('tambahharga'); ?>" class="btn btn-success mb-3"><i class="fa fa-dollar-sign mr-2"></i>Tambah Data</a>
      <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
        <thead class="text-center">
          <tr>
            <th>NO</th>
            <th>ID HARGA</th>
            <th>HARI</th>
            <th>HARGA</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody>
          <!--untuk menampikan data pada tabel-->
          <?php $n = 1; ?>
          <?php foreach ($harga as $data) :?>
          <tr>
            <td><?= $n; ?></td>
            <td><?= $data["id_harga"]; ?></td>
            <td><?= $data["hari"]; ?></td>
            <td>Rp. <?= number_format($data["harga"], 0, ".", "."); ?></td>
            <td class="text-center">
              <a href="<?= base_url('admin/hapusharga/'); ?><?= $data['id_harga']; ?>" onclick ="return confirm('Anda Yakin Ingin Menghapus Data Ini?');" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
              </a> || 
              <a href="<?= base_url('admin/editharga/'); ?><?=$data["id_harga"]; ?>" class="btn btn-sm btn-warning">
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