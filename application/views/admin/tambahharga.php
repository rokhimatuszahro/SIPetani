<body class="bg-dark">

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Tambah Data Harga</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('tambahharga'); ?>">
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <input type="text" class="form-control rounded-pill" id="hari" name="hari" value="<?= set_value('hari'); ?>">
                        <?php echo form_error('hari','<p class="text-danger small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control rounded-pill" id="harga" name="harga" value="<?= set_value ('harga'); ?>">
                        <?php echo form_error('harga','<p class="text-danger small ml-2">','</p>'); ?>
                    </div>
                        <br><hr>
                        <div class="row">
                            <div class="left col-md-6">
                            <a class="btn btn-danger rounded-pill ml-3" bref="<?= base_url('harga'); ?>">Batal</a>
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