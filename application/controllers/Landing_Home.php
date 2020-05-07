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

}
	