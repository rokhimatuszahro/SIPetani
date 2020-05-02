<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark static-top">

    <a class="navbar-brand mr-1" href="<?= base_url('dashboard'); ?>">Taman Botani</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form method="post" action="" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari..." autocomplete="off" aria-label="Search" aria-describedby="basic-addon2" name="keyword">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit" name="cari">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="rounded-circle" src="<?= base_url('assets/img/profile/'.$user['foto'].''); ?><?= $data['foto']; ?>" height="40" width="40">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <div class="dropdown-header">
            <p>Selamat datang</p>
            <?php if ($user['status'] == 1): ?>
                <span><small><i class="fas fa-fw fa-circle text-succes" style="font-size: 10px;"></i><?= $user['nama']; ?></small></span>
            <?php endif ?>
          </div>
          <a class="dropdown-item" href="<?= base_url('profileadmin'); ?>">Profil</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pemesanan'); ?>">
          <i class="fas fa-fw fa-ticket-alt"></i>
          <span>Pemesanan</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pengunjung'); ?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Pengunjung</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('harga'); ?>">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Harga</span></a>
      </li>
      <li class="nav-item" style="position: relative;">
        <!-- Cek pemesanan yang status pembayaran 0 dan sudah unggah bukti pembayaran -->
        <?php if ($cek_pemesanan > 0): ?>
          <span class="badge badge-danger" style="position: absolute; bottom: 32px; left: 25px; font-size: 10px; color: white;"><?= $cek_pemesanan; ?>
          </span>
        <?php endif ?>
        
        <a class="nav-link" href="<?= base_url('konfirmasi'); ?>">
          <i class="fas fa-fw fa-check"></i>
          <span>Konfirmasi</span>
        </a>
      </li>
    </ul>


    <div id="content-wrapper">