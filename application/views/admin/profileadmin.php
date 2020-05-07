<div class="container-fluid">
<div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow my-5 ftco-animate">
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
                          <label class="badge badge-primary float-right p-1"><?= $user['email']; ?></label>
                        </li>
                        <li class="list-group-item">Nama
                          <label class="badge badge-primary float-right p-1"><?= $user['nama']; ?></label>
                        </li>
                        <li class="list-group-item">Jenis Kelamin
                          <label class="badge badge-primary float-right p-1"><?= $user['jenkel']; ?></label>
                        </li>
                        <li class="list-group-item">PIN
                          <label class="badge badge-primary float-right p-1"><?= $user['pin']; ?></label>
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
                    <form method="post" action="<?= base_url('profileadmin'); ?>" enctype="multipart/form-data">
                      <div class="form-group">
                        <input type="text" class="form-control text-center rounded-pill" name="email" value="<?= $user['email']; ?>" id="email" readonly>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control text-center rounded-pill" name="nama" id="nama" placeholder="Nama" value="<?= $user['nama']; ?>">
                        <?php echo form_error('nama','<p class="text-danger small ml-2">','</p>'); ?>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control text-center rounded-pill" name="pin" id="pin" placeholder="PIN" value="<?= $user['pin']; ?>">
                        <?php echo form_error('pin','<p class="text-danger small ml-2">','</p>'); ?>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-6 mb-sm-0">
                          <input type="password" class="form-control text-center rounded-pill" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                          <input type="password" class="form-control text-center rounded-pill" name="password2" id="password2" placeholder="Repeat Password">
                        </div>
                        <?php echo form_error('password','<p class="text-danger small ml-4">','</p>'); ?>
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
                          </div>
                        <?php endif ?>
                          <br>
                          <label for="jeniskelamin" class="mb-2 mt-3 text-xs">Foto Profil</label>
                          <div class="btn btn-primary rounded-pill mb-2">
                            <input type="file" class="col-12" name="profil" id="profil">
                          </div>
                          <button type="submit" class="btn btn-primary btn-block font-weight-bold rounded-pill mt-4">Edit</button>
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