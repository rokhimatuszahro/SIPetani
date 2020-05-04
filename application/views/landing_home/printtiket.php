<!DOCTYPE html>
<html>
<head>
	<title><?= $judul; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="assets/img/logo/logo.PNG" rel='shortcut icon'>
	<style>
		.gambar{
			background-image: url(assets/img/print/background.png);
			background-position: -55px -30px;
		}
		table:nth-child(2){
			/*margin: auto;*/
		}
		td{
			color: white;
			outline-color: black;
			/*text-shadow: 1px 2px 15px black;*/
		}
		h1{
			text-align: center;
			color: white;
			/*text-shadow: 1px 2px 15px black !important;*/
		}
		
		.qrcode{
			width: 70px;
			height: 70px;
			margin-top: 70px !important;
		}

		.table{
			position: relative;
			z-index: 1;
		}
		
		.content{
			background-color: rgba(48,133,119,1);
		}
		.content2{
			position: relative;
		}

		.content2::after{
			content: '';
			display: block;
			width: 100%;
			height: 240px;
			background-color: rgba(0,0,0,0.3);
			position: absolute;
			top: 0;
		}
	</style>

</head>
<body>
	<div class="gambar">    
		<div class="content">
			<table>
				<tr>
					<td><img src="assets/img/logo/logo.PNG" height="90" width="90"></td>
					<td colspan="3"><h1>Taman Botani</h1></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
		<div class="content2">	
			<table cellpadding="7" class="table">
				<tr>
					<td><b>Nama Pemesan</b></td>
					<td><b>:</b></td>
					<td><b><?= $tiket["nama_pemesan"]; ?></b></td>
					<td rowspan="4"><img class="qrcode" src="assets/img/qrcode/<?= $tiket['qrcode']; ?>"></td>
				</tr>
				<tr>
					<td><b>Alamat</b></td>
					<td><b>:</b></td>
					<td><b><?= $tiket["alamat"]; ?></b></td>
				</tr>
				<tr>
					<td><b>No. Telepon</b></td>
					<td><b>:</b></td>
					<td><b><?= $tiket["no_telp"]; ?></b></td>
				</tr>
				<tr>
					<td><b>Tanggal Pemesanan</b></td>
					<td><b>:</b></td>
					<td><b><?= $tiket["tanggal_pemesanan"]; ?></b></td>
				</tr>
				<tr>
					<td><b>Tanggal Berkunjung</b></td>
					<td><b>:</b></td>
					<td><b><?= $tiket["tanggal_berkunjung"]; ?></b></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>