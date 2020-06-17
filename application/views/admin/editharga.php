<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Ubah Data Harga</div>
      <div class="card-body">
      <form method="POST" action="<?= base_url('admin/editharga/'); ?><?= $harga["id_harga"]; ?>">
        <input type="hidden" name="id" value="<?= $harga["id_harga"]; ?>">
            <div class="form-group">
              <label for="hari">Hari</label>
              <input type="text" class="form-control rounded-pill" id="hari" name="hari" value="<?= $harga["hari"]; ?>">
              <?php echo form_error('hari','<p class="text-danger small ml-2">','</p>'); ?>
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input type="text" class="form-control rounded-pill" id="harga" name="harga" value="<?= $harga["harga"]; ?>">
              <?php echo form_error('harga','<p class="text-danger small ml-2">','</p>'); ?>
            </div>
              <br><hr>
              <div class="row">
                <div class="col-6">
                <a href="<?= base_url('harga'); ?>" class="btn btn-danger rounded-pill float-left">Batal</a>
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