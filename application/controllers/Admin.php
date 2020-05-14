<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_not_login();

        if (session()) {
            // Cek apakah dia Admin?
            is_not_admin();
        }
    }

    public function dashboard()
    {

        $data['judul'] = 'SIPetani Dashboard';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['users'] = $this->User_model->getUser()->result_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,0)->num_rows();
        $data['pemesanan'] = $this->Transaksi_model->getPemesanan()->num_rows();
        $data['harga'] = $this->Transaksi_model->getHarga()->num_rows();
        $data['pengunjung'] = $this->Transaksi_model->getPengunjungLimit(1)->row_array();

        // Data Rekap Chart
        $hari = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');

        date_default_timezone_set('Asia/Jakarta');
        $data['waktu'] = $waktu = date('h : i A');

        // Data Rekap
        $data['data_rekap_harian'] = $this->Transaksi_model->getDataRekap($hari,'tanggal_pemesanan')->row_array();
        $data['data_rekap_bulanan'] = $this->Transaksi_model->getDataRekap($bulan, 'tanggal_pemesanan')->row_array();
        $data['data_rekap_tahunan'] = $this->Transaksi_model->getDataRekap($tahun, 'tanggal_pemesanan')->row_array();

        // Array Chart Tahunan
        $arr_chart = [];

        // Menjumlahkan pemasukan setiap bulannya dalam tahun saat ini adalah dimana hasil setiap bulannya akan dimasukkan ke dalam array chart
        for ($i=1;$i<=12;$i++){
            $query_chart = $this->Transaksi_model->getChart($i,$tahun)->result_array();

            foreach ($query_chart as $row) {
                // Jika hasil pada bulan ke $i=0 maka akan memasukkan nilai 0 pada array chart
                if($row['hasil'] === NULL || $row['hasil'] === 0){
                    array_push($arr_chart, 0);

                // Selain itu akan memasukkan nilai dari hasil ke dalam array chart
                }else{
                    array_push($arr_chart, $row['hasil']);
                }
            }
        }
        // Data Chart
        $data['chart'] = $arr_chart;

        $this->load->view('templates/v_header_admin', $data);
        $this->load->view('templates/v_navbar_admin', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/v_footer_admin', $data);
    }

    public function hapusUser($id)
    {
        $this->User_model->deleteUserById($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success role="alert">Data Berhasil Dihapus</div>');
        redirect('dashboard');
    }

    public function akunAdmin()
    {
        $data['judul'] = 'SIPetani Akun Admin';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,0)->num_rows();

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required',[
                'required' => 'Data %s kosong harap isi data!'
            ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required',[
                'required' => 'Data %s kosong harap isi data!',
                'valid_email' => 'Format %s salah'
            ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|    required',[
                'required' => 'Data %s kosong harap isi data!'
            ]);
        $this->form_validation->set_rules('pin', 'PIN', 'trim|required|exact_length[3]|numeric',[
                'required' => 'Data %s kosong harap isi data!',
                'exact_length' => 'Data %s 3 digit',
                'numeric' => 'Format %s salah'
            ]);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/v_header_admin', $data);
            $this->load->view('admin/akunadmin');
            $this->load->view('templates/v_footer_admin2', $data);
        }else{
            $data = $this->input->post();
            $this->User_model->setRegistrasiAdmin($data);

            $this->session->set_flashdata('message', '<div class="alert alert-success role="alert">Data Berhasil Ditambahkan</div>');
            redirect('dashboard');
        }   
    }

    public function profileAdmin()
    {
        $data['judul'] = 'SIPetani Profile Admin';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,0)->num_rows();

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
            $this->load->view('templates/v_header_admin', $data);
            $this->load->view('templates/v_navbar_admin', $data);
            $this->load->view('admin/profileadmin', $data);
            $this->load->view('templates/v_footer_admin', $data);
        }else{
            $this->User_model->updateUserProfileByEmail($this->input->post(), $data['user']['foto']);
            $this->session->set_flashdata('message', '<div class="alert alert-primary small">Edit Profile<strong>Berhasil</strong></div>');
            redirect('profileadmin');
        }
    }


    // Pemesanan
    public function pemesanan()
    {
        $data['judul'] = 'SIPetani Pemesanan';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,0)->num_rows();
        $data['pemesanan'] = $this->Transaksi_model->getPemesanan()->result_array();

        $this->load->view('templates/v_header_admin', $data);
        $this->load->view('templates/v_navbar_admin', $data);
        $this->load->view('admin/pemesanan', $data);
        $this->load->view('templates/v_footer_admin', $data);
    }


    // Konfirmasi
    public function konfirmasi()
    {
        $data['judul'] = 'SIPetani Konfirmasi';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,0)->num_rows();
        $data['konfirmasi'] = $this->Transaksi_model->getKonfirmasi()->result_array();

        $this->load->view('templates/v_header_admin', $data);
        $this->load->view('templates/v_navbar_admin', $data);
        $this->load->view('admin/konfirmasi', $data);
        $this->load->view('templates/v_footer_admin', $data);
    }

    public function validasiKonfirmasi($id,$status)
    {
        $this->Transaksi_model->updateKonfirmasi($id,$status);
        if ($id == 'all') {
            $this->session->set_flashdata('message', '<div class="alert alert-success role="alert">Semua Data Berhasil Dikonfirmasi</div>');
            redirect('konfirmasi');
        }elseif ($status == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success role="alert">Data Berhasil Dikonfirmasi</div>');
            redirect('konfirmasi');
        }else {
            $this->session->set_flashdata('message', '<div class="alert alert-success role="alert">Konfirmasi Data Berhasil Dibatalkan</div>');
            redirect('konfirmasi');
        }
    }

}