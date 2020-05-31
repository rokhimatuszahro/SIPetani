<body class="bg-dark">

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Tambah Data Pengunjung</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('tambahpengunjung'); ?>">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control rounded-pill" id="tanggal" name="tanggal">
                        <?php echo form_error('tanggal','<p class="text-danger small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pengunjung">Jumlah Pengunjung</label>
                        <input type="text" class="form-control rounded-pill" id="jumlah_pengunjung" name="jumlah_pengunjung" value="<?= set_value ('jumlah_pengunjung'); ?>">
                        <?php echo form_error('jumlah_pengunjung','<p class="text-danger small ml-2">','</p>'); ?>
                    </div>
                        <br><hr>
                        <div class="row">
                            <div class="left col-md-6">
                            <a class="btn btn-danger rounded-pill ml-3" bref="<?= base_url('pengunjung'); ?>">Batal</a>
                        </div>
                        <div class="right col-md-6">
                            <button class="btn btn-primary rounded-pill ml-5" type="submit" name="submit">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
             </div>
        </div>
    </div>