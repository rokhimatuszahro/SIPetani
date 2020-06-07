<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?= base_url('assets/img/logo/logo.png'); ?>" rel='shortcut icon'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
        @media (max-width: 767.98px) {
            td{
                font-size : 10px;
                color: white;
                font-style: oblique;
                font-weight: bolder;
                text-shadow: black,2,2,1;
                z-index: 1;
                text-shadow: 1px 1px 5px black !important;
            }
            h1{
                font-size: 15px;
                z-index: 1;
                text-shadow: 1px 1px 3px black !important;
            }
            .bg-gambar{
                background-image: url("<?= base_url('assets/img/print/background2.png'); ?>");
                background-repeat: no-repeat;
                background-size:cover;
                background-position: -65px 0;
                position: relative;
                z-index: -2;
            }
            .bg-gambar::after{
                content: '';
                display: block;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.3);
                position: absolute;
                top: 0;
                z-index: -1;
            }
            .badge{
                background-color:lawngreen;
            }
        }
    </style>

    <title>Tiket Anda</title>
  </head>
  <body>
    <?php if(!empty($error)) : ?>
        <div class="container mt-5">
            <?= $error; ?>
        </div>
    <?php else : ?>
    <div class="card w-75 mx-auto mt-5 rounded-top bg-gambar border-secondary">
        <div class="bg-dark py-2 pl-2 rounded-top">
            <img src="<?= base_url('assets/img/logo/logo.png'); ?>" width="30" height="30" alt="">
            <h1 class="text-white d-inline">Tiket Wisata Taman Botani</h1>
        </div>
        <div class="px-2 pt-2">
            <table class="table table-sm table-striped table-borderless">
                <tr>
                    <td>Nama</br><small> / Name</small></td>
                    <td>:</td>
                    <td><small></small><?= substr($tiket['nama_pemesan'], 0, 38); ?></td>
                </tr>
                <tr>
                    <td>Alamat</br><small> / Address</small></td>
                    <td>:</td>
                    <td><?= substr($tiket['alamat'], 0, 38); ?></td>
                </tr>
                <tr>
                    <td>No, Telepon</br><small> / Phone</small></td>
                    <td>:</td>
                    <td><?= $tiket['no_telp']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Pemesanan</br><small> / Order Date</small></td>
                    <td>:</td>
                    <td><?= $tiket["tanggal_pemesanan"]; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Berkunjung</br><small> / date of visit</small></td>
                    <td>:</td>
                    <td><?= $tiket["tanggal_berkunjung"]; ?></td>
                </tr>
            </table>
        </div>
        <div class="pl-2">
            <table class="table table-sm">
                <td class="align-middle"><h1 class="d-inline">QR Code <img class="ml-2" src="<?= base_url('assets/img/qrcode/'.$tiket['qrcode']); ?>" width="40" height="40" alt=""></h1></td>
                <td class="align-middle">Terima Kasih telah membeli tiket</br>Selamat Berwisata <span class="badge p-1"><i class="fas fa-fw fa-smile-wink"></i></span></td>
            </table>
        </div>
    </div>
    <?php endif; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>