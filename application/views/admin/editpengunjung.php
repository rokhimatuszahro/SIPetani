<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Ubah Data Pengunjung</div>
      <div class="card-body">
      <form method="POST" action="<?= base_url('admin/editpengunjung/'); ?><?= $pengunjung["id_pengunjung"]; ?>">
        <input type="hidden" name="id" value="<?= $pengunjung["id_pengunjung"]; ?>">
            <div class="form-group">
              <label for="tanggal">Tanggal</label>
              <input type="date" class="form-control rounded-pill" id="tanggal" name="tanggal" value="<?= $pengunjung["tgl_pengunjung"]; ?>">
              <?php echo form_error('tanggal','<p class="text-danger small ml-2">','</p>'); ?>
            </div>
            <div class="form-group">
              <label for="jumlah pengunjung">Jumlah Pengunjung</label>
              <input type="text" class="form-control rounded-pill" id="jumlah pengunjung" name="jumlah_pengunjung" value="<?= $pengunjung["jum_pengunjung"]; ?>">
              <?php echo form_error('jumlah_pengunjung','<p class="text-danger small ml-2">','</p>'); ?>
            </div>
              <br><hr>
              <div class="row">
                <div class="col-6">
                <a href="<?= base_url('pengunjung'); ?>" class="btn btn-danger rounded-pill float-left">Batal</a>
              </div>
              <div class="col-6">
                 <button class="btn btn-primary rounded-pill float-right" type="submit" name="submit">Ubah</button>
                 </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>