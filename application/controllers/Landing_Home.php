<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing_Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		// cek apakah session detail pembayaran masih ada
		session_detail_pembayaran();

		if (session()) {
			// cek apakah dia user
			is_not_user();
		}
	}


	// Home
	public function index()
	{
		$data['judul'] = 'SIPetani';
		$data['harga'] = $this->User_model->getHarga()->result_array();
		$data['pengunjung'] = $this->User_model->getPengunjungInfo()->result_array();

		if (session()) {
			$data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
			$data['cek_0'] = $this->Transaksi_model->getPemesananStatusbayar($this->session->userdata('email'),0)->num_rows();
		}

		// validasi Detail Pembayaran
		$this->form_validation->set_rules('tgl_berkunjung', 'Tanggal berkunjung', 'trim|required',[
			'required' => '%s tidak valid'
		]);
		$this->form_validation->set_rules('jumlah_tiket', 'Jumlah Tiket', 'trim|required|numeric',[
			'required' => 'Data %s kosong harap isi data!',
			'numeric' => 'Format %s salah'
		]);
		if ($this->form_validation->run() == FALSE){
			$this->load->view('templates/header_landing',$data);
			$this->load->view('landing_home/index',$data);
			$this->load->view('templates/footer');
		}else{
			$this->session->set_userdata('tgl', $this->input->post('tgl_berkunjung'));
			$this->session->set_userdata('jml', $this->input->post('jumlah_tiket'));
			redirect('detail_pembayaran');
		}
	}


	// Edit Profile
	public function editProfile()
	{
		is_not_login();
		$data['judul'] = 'Edit Profile SIPetani';
		if (session()) {
			$data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
		}

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required',[
				'required' => 'Data %s kosong harap isi data!'
			]);
		$this->form_validation->set_rules('pin', 'PIN', 'trim|required|exact_length[3]|numeric',[
				'required' => 'Data %s kosong harap isi data!',
				'exact_length' => 'Data %s 3 digit',
				'numeric' => 'Format %s salah'
			]);
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[4]|max_length[8]|matches[password2]',[
				'min_length' => 'Data %s kurang dari 4 Char',
				'max_length' => 'Data %s lebih dari 8 Char',
				'matches' => 'Repeat %s tidak sama'
			]);
		$this->form_validation->set_rules('password2', 'Password', 'trim|matches[password]');
		if ($this->form_validation->run() == FALSE)
        {
			$this->load->view('templates/header',$data);
			$this->load->view('landing_home/editProfile',$data);
			$this->load->view('templates/footer');
		}else{
			$this->User_model->updateUserProfileByEmail($this->input->post(), $data['user']['foto']);
			$this->session->set_flashdata('message','<div class="alert alert-primary-bs small">Edit Profile <strong>Berhasil!</strong></div>');
       		redirect('landing_home/editprofile');
		}
	}

	// Detail_Pembayaran
	public function detail_Pembayaran()
	{
		$data['judul'] = 'SIPetani-Detail Pembayaran';
		
		// cek apakah ada session userdata tgl
		if (!$this->session->userdata('tgl')) {
	       	redirect('landing_home');
		}else{

			// cek apakah sudah login
			if (session()) {
					
				$data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();

				// cek apakah memiliki tanggungan
				$cekstatuspembayaran = $this->Transaksi_model->getPemesananStatusbayar($this->session->userdata('email'),0)->num_rows();
				if ($cekstatuspembayaran > 0) {
					$this->session->set_flashdata('message','<div class="alert alert-danger-bs small">Anda Masih memiliki tanggungan harap <strong>Unggah!</strong> Bukti Pembayaran!</div>');
			  		redirect('landing_home/#pemesanan');
				}
			}
			
			// cek hari libur
			$tgl_berkunjung = $this->session->userdata('tgl');
			$jml_tiket = $this->session->userdata('jml');
			$data['tgl_berkunjung'] = $tgl_berkunjung;
			$data['jumlah_tiket'] = $jml_tiket;

			if(date('l',strtotime($tgl_berkunjung)) == "Friday"){
				$this->session->set_flashdata('message','<div class="alert alert-danger-bs small">Tanggal berkunjung untuk Hari Jumat <strong>Libur!</strong></div>');
		       	redirect('landing_home/#pemesanan');
			}elseif (date('l',strtotime($tgl_berkunjung)) == "Saturday" || date('l',strtotime($tgl_berkunjung)) == "Sunday") {
				$jumlah = $jml_tiket;
				$total = $jumlah * 20000;
				$data['harga'] = 'IDR. '. number_format($total,0,',','.');
			}else{
				$jumlah = $jml_tiket;
				$total = $jumlah * 12000;
				$data['harga'] = 'IDR. '. number_format($total,0,',','.');
			}

			// validasi form formulir pemesanan
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required',[
				'required' => 'Data %s kosong harap isi data!'
			]);
			$this->form_validation->set_rules('no_telp', 'No Hanphone', 'trim|required|numeric|min_length[12]|max_length[13]',[
				'required' => 'Data %s kosong harap isi data!',
				'min_length' => 'Data %s terlalu pendek',
				'max_length' => 'Data %s terlalu panjang',
				'numeric' => 'Format %s salah'
			]);
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required',[
				'required' => 'Data %s kosong harap isi data!'
			]);
			if ($this->form_validation->run() == FALSE)
	        {			
				$this->load->view('templates/header',$data);
				$this->load->view('landing_home/detail_pembayaran',$data);
				$this->load->view('templates/footer');
			}else{
				
				// jika sudah login
				if (session()) {
					$data_pemesan = [
						'nama_pemesan' => $this->input->post('nama'),
						'alamat' => $this->input->post('alamat'),
						'tanggal_berkunjung' => $tgl_berkunjung,
						'tanggal_pemesanan' => date('Y-m-d'),
						'jumlah_tiket' => $jml_tiket,
						'total' => $total,
						'total_pembayaran' => $total + substr(uniqid(rand(), true),3,3),
						'no_telp' => $this->input->post('no_telp'),
						'bukti_pembayaran' => '',
						'status_pembayaran' => 0,
						'status_cetak' => 0,
						'id_user' => $data['user']['id_user'],
						'qrcode' => ''
					];
					$this->Transaksi_model->setPemesananTiket($data_pemesan);
					
					
					//QrCode
					$pemesan = $this->Transaksi_model->getPemesananTiketLimit(1,$this->session->userdata('id_user'))->row_array();
					$this->fungsi->qrcode($pemesan['id_pemesanan'].'/'.$pemesan['jumlah_tiket'],'qrcode-'.$pemesan['id_pemesanan']);
					$this->Transaksi_model->updatePemesananTiket('qrcode-'.$pemesan['id_pemesanan'].'.png',$pemesan['id_pemesanan']);


					$this->session->unset_userdata('tgl');
					$this->session->unset_userdata('jml');
					redirect('landing_home/detail_pemesanan');
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-primary-bs small">Harap login untuk melanjut proses pemesanan <strong>tiket!</strong></div>');
			  		redirect('login');
				}
			}
		}
	}

	// Detail_Pemesanan
	public function detail_Pemesanan()
	{

		// cek apakah session detail pembayaran masih ada
		session_detail_pembayaran();

		// cek apakah belum login
		is_not_login();
		
		// cek apakah memiliki pesananan baru atau tidak
		if ($this->Transaksi_model->getPemesananStatusbayar($this->session->userdata('email'),0)->num_rows() == NULL) {
			$this->session->set_flashdata('message','<div class="alert alert-danger-bs small">Anda tidak memiliki pesananan silahkan isi form <strong>pemesanan!</strong></div>');
			redirect('landing_home/#pemesanan');
		}

		$data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
		$data['judul'] = 'SIPetani-Detail Pemesanan';
		$data['pemesan'] = $this->Transaksi_model->getTransaksiByEmail($this->session->userdata('email'), 0)->row_array();

		// jika tombol upload di tekan
		if ($this->input->post(`submit_bukti`)) {

			$this->Transaksi_model->updateTransaksiUploadBukti($data['user']['id_user'],$data['pemesan']['bukti_pembayaran'],$this->input->post());
			
			$this->session->set_flashdata('message','<div class="alert alert-primary-bs small">Anda berhasil upload bukti pembayaran silahkan tunggu konfirmasi dari <strong>Admin!</strong><br>Anda dapat upload bukti pembayaran selama pesananan anda belum dikonfirmasi</div>');
			redirect('detail_pemesanan');
		}
		
		$this->load->view('templates/header',$data);
		$this->load->view('landing_home/detail_pemesanan',$data);
		$this->load->view('templates/footer');
	}


	// Tiket
	public function tiket()
	{
		// cek apakah belum login
		is_not_login();

		$data['judul'] = 'SIPetani-Tiket';
		$data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
		$data['tiket'] = $this->Transaksi_model->getPemesananStatusbayar($this->session->userdata('email'),1)->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('landing_home/tiket',$data);
		$this->load->view('templates/footer');		
	}

	public function print($id)
	{
		is_not_login();
		$data['judul'] = 'SIPetani-Print Tiket';
		$data['tiket'] = $this->Transaksi_model->getPemesananById($id)->row_array();
		$html = $this->load->view('landing_home/printtiket', $data, TRUE);
		$this->fungsi->Pdf($html,'Tiket-'.$data['tiket']['id_pemesanan'],'landscape',array(0,0,345,460));	
		$this->Transaksi_model->updateStatusCetakById($data['tiket']['id_pemesanan'],1);
	}

}

	