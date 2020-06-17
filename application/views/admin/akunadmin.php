<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto my-5">
      <div class="card-header">Tambah Akun Admin</div>
        <div class="card-body">
          <!-- Form dengan method post yg mengirim data ke method akunadmin -->
          <form method="POST" action="<?= base_url('akunadmin'); ?>">

            <div class="form-group">
              <label for="nama">Nama</label>
              <!-- Jika Value pada inputan diisi dengan data array maka ketika inputan error, text inputan tidak akan hilang -->
              <input type="text" class="form-control rounded-pill" id="nama" name="nama" value="<?= set_value('nama'); ?>">
              <!-- Menampilkan feedback dari error form validation berdasarkan name inputan -->
              <?= form_error('nama', '<p class="text-danger small ml-2">','</p>'); ?>
            </div>

            <div class="form-group">
              <label for="jeniskelamin" class="my-3">Jenis Kelamin</label><br>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="Laki-laki" value="Laki - Laki" name="jeniskelamin" checked="">
                <label for="Laki-laki" class="custom-control-label">Laki-laki</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="perempuan" value="Perempuan" name="jeniskelamin">
                <label for="perempuan" class="custom-control-label">Perempuan</label>
              </div>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <!-- Jika Value pada inputan diisi dengan data array maka ketika inputan error, text inputan tidak akan hilang -->
              <input type="text" class="form-control rounded-pill" id="email" name="email" value="<?= set_value('email'); ?>">
              <!-- Menampilkan feedback dari error form validation berdasarkan name inputan -->
              <?= form_error('email', '<p class="text-danger small ml-2">','</p>'); ?>
            </div>

            <div class="form-group">
              <label for="password">Kata Sandi</label>
              <input type="password" class="form-control rounded-pill" id="password" name="password">
              <!-- Menampilkan feedback dari error form validation berdasarkan name inputan -->
              <?= form_error('password', '<p class="text-danger small ml-2">','</p>'); ?>
            </div>

            <div class="form-group">
              <label for="pin">PIN</label>
              <!-- Jika Value pada inputan diisi dengan data array maka ketika inputan error, text inputan tidak akan hilang -->
              <input type="text" class="form-control rounded-pill" id="pin" name="pin" value="<?= set_value('pin'); ?>">
              <!-- Menampilkan feedback dari error form validation berdasarkan name inputan -->
              <?= form_error('pin', '<p class="text-danger small ml-2">','</p>'); ?>
            </div>

              <br><hr>

            <div class="row">
              <div class="left col-md-6">
                <!-- Jika tombol batal diklik maka akan mengarah ke dashboard -->
                <a class="btn btn-danger rounded-pill float-left" href="<?= base_url('dashboard'); ?>">Batal</a>
              </div>
              <div class="right col-md-6">
                <!-- jika tombol submit diklik maka akan mengirim semua data inputan ke method berdasarkan action -->
                <button class="btn btn-primary rounded-pill float-right" type="submit" name="submit">Tambah</button>
              </div>
            </div>
            
          </form>

        </div>
      </div>
    </div>
  </div>