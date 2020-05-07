<section class="bg-jumbotron hero-wrap hero-wrap-2" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
            <h1 class="mb-3 bread text-gray-100 text-capitalize">selamat datang <?= $user['nama']; ?></h1>
            <p class="breadcrumbs">
              <span class="mr-2"><a href="<?= base_url('landing_home'); ?>">Home <i class="ion-ios-arrow-forward"></i></a></span>
              <span>Edit Profil <i class="ion-ios-arrow-forward"></i></span>
            </p>
          </div>
        </div>
      </div>
</section>

<section class="ftco-section bg-gradient-primary">
  
  <div class="container">
    <div class="row justify-content-center ftco-animate">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 ftco-animate">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Profil <span class="text-primary font-weight-bold"><?= $user['nama']; ?></span></h1>
                  </div>
                    <div>
                      <img class="rounded-circle mb-4 mx-auto d-block" src="<?= base_url(); ?>assets/img/profile/<?= $user['foto']; ?>" height="100" width="100">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">Email
                          <label class="badge badge-primary-bs float-right p-1"><?= $user['email']; ?></label>
                        </li>
                        <li class="list-group-item">Nama
                          <label class="badge badge-primary-bs float-right p-1"><?= $user['nama']; ?></label>
                        </li>
                        <li class="list-group-item">Jenis Kelamin
                          <label class="badge badge-primary-bs float-right p-1"><?= $user['jenkel']; ?></label>
                        </li>
                        <li class="list-group-item">PIN
                          <label class="badge badge-primary-bs float-right p-1"><?= $user['pin']; ?></label>
                        </li>
                      </ul>
                    </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Edit <span class="text-primary font-weight-bold">Profile</span></h1>
                    <?= $this->session->flashdata('message'); ?>
                  </div>
                  <form class="user" method="post" action="<?= base_url('landing_home/editprofile'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="email" value="<?= $user['email']; ?>" id="nama" placeholder="Nama Pemesan" readonly>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="nama" id="nama"
                        placeholder="Nama" value="<?= $user['nama']; ?>">
                      <?php echo form_error('nama','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user text-center" name="pin" id="pin"
                        placeholder="PIN" value="<?= $user['pin']; ?>">
                      <?php echo form_error('pin','<p class="text-danger-bs small ml-2">','</p>'); ?>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-sm-0">
                        <input type="password" class="form-control form-control-user text-center" name="password" id="password" placeholder="Password">
                      </div>
                      <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user text-center" name="password2" id="password2" placeholder="Repeat Password">
                      </div>
                      <?php echo form_error('password','<p class="text-danger-bs small ml-4">','</p>'); ?>
                    </div>
                    <div class="form-group">
                      <label for="jeniskelamin" class="my-2 text-xs">Jenis Kelamin</label><br>
                      <?php if ($user['jenkel'] == 'Perempuan'): ?>
                        <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="Laki-laki" value="Laki - Laki" name="jeniskelamin">
                        <label for="Laki-laki" class="custom-control-label">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="perempuan" value="Perempuan" name="jeniskelamin" checked="checked">
                          <label for="perempuan" class="custom-control-label">Perempuan</label>
                        </div>
                      <?php else: ?>  
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Laki-laki" value="Laki - Laki" name="jeniskelamin" checked="checked">
                          <label for="Laki-laki" class="custom-control-label">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="perempuan" value="Perempuan" name="jeniskelamin">
                        <label for="perempuan" class="custom-control-label">Perempuan</label>
                      <?php endif ?>
                      </div><br>
                      <label for="jeniskelamin" class="mb-2 mt-3 text-xs">Foto Profil</label>
                      <div class="btn btn-primary-bs rounded-pill mb-2">
                        <input type="file" class="col-12" name="profil" id="profil">
                      </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold mt-4">
                      Edit
                    </button>
                    </div>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</section>