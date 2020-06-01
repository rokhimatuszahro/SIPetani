<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_not_login();     // Cek apakah user sudah login, coding di helpers/akses_helper.php
        if (session()) {    // apakah ada session('email'), coding di helpers/akses_helper.php
            is_not_admin(); // Cek apakah user adalah admin, coding di helpers/akses_helper.php
        }
    }

    
    // Dashboard
    public function dashboard()
    {
        // Data berupa array dengan key dan value/nilai untuk parsing data ke view
        $data['judul'] = 'SIPetani Dashboard';
        // Output/hasil model dengan 1 data : row_array(), lebih 1 data : result_array(), jumlah data : num_rows()
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['users'] = $this->User_model->getUser()->result_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,NULL)->num_rows();
        $data['pemesanan'] = $this->Transaksi_model->getPemesanan()->num_rows();
        $data['harga'] = $this->Transaksi_model->getHarga()->num_rows();
        $data['pengunjung'] = $this->Transaksi_model->getPengunjungLimit(1)->row_array();


        // Proses Rekap data Chart
        $hari = date('Y-m-d');  // variable dengan fungsi yg menampung data info tanggal hari ini
        $bulan = date('m');     // variable dengan fungsi yg menampung data bulan saat ini
        $tahun = date('Y');     // variable dengan fungsi yg menampung data tahun saat ini

        date_default_timezone_set('Asia/Jakarta'); // set waktu dan tgl default dengan zona asia/jakarta
        $data['waktu'] = $waktu = date('h : i A'); // Menyimpan data jam, menit dan detik saat ini pada data array

        // Menyimpan Data Rekap harian, bulanan, dan tahunan pada data array untuk parsing data ke view
        $data['data_rekap_harian'] = $this->Transaksi_model->getDataRekap($hari,'tanggal_pemesanan')->row_array();
        $data['data_rekap_bulanan'] = $this->Transaksi_model->getDataRekap($bulan, 'MONTH(tanggal_pemesanan)')->row_array();
        $data['data_rekap_tahunan'] = $this->Transaksi_model->getDataRekap($tahun, 'YEAR(tanggal_pemesanan)')->row_array();

        // Array Chart Tahunan yg menampung data total transaksi bulanan
        $arr_chart = [];

        // Menjumlahkan pemasukan setiap bulannya pada tahun saat ini dimana hasil setiap bulannya akan dimasukkan ke dalam array chart tahunan
        for ($i=1;$i<=12;$i++){
            $query_chart = $this->Transaksi_model->getChart($i,$tahun)->result_array();

            foreach ($query_chart as $row) {
                // Jika hasil pada bulan ke $i=0 maka total pemasukan pada bulan itu 0
                if($row['hasil'] === NULL || $row['hasil'] === 0){
                    array_push($arr_chart, 0);              // fungsi memasukkan nilai kedalam array chart tahunan 

                    // Selain itu akan memasukkan nilai dari hasil ke dalam array chart
                }else{
                    array_push($arr_chart, $row['hasil']);  // fungsi memasukkan nilai kedalam array chart tahunan
                }
            }
        }
        $data['chart'] = $arr_chart; // Data chart array tahunan ditampung dalam data array untuk parsing data ke view

        // Load view dengan mengirimkan data array yang sudah disiapkan sebelumnya
        $this->load->view('templates/v_header_admin', $data);
        $this->load->view('templates/v_navbar_admin', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/v_footer_admin', $data);
    }


    // Hapus akun
    public function hapusUser($id)
    {
        $this->User_model->deleteUserById($id); // Model menghapus data berdasarkan UserID dimana id didapat dri paramenter url
        
        // set pesan flash ketika pesan berhasil dihapus yg nantinya akan ditampilkan di view berdasarkan key flashdata yg sudah dibuat
        $this->session->set_flashdata('message', 'Berhasil hapus Akun Admin');
        redirect('dashboard');  // Mengarahkan keadaan saat ini ke method dashboard
    }


    // Akun admin
    public function akunAdmin()
    {
        // Data berupa array dengan key dan value/nilai untuk parsing data ke view
        $data['judul'] = 'SIPetani Akun Admin';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,0)->num_rows();

        // rule/aturan untuk form validasi dengan parameter (name_pada inputan form post, string, rule/aturan)
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required',[
                'required' => 'Data %s kosong harap isi data!'  // keluaran error yg diinginkan berdasarkan aturan, %s mewakilkan parameter String
            ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required',[
                'required' => 'Data %s kosong harap isi data!', // keluaran error inputan tidak boleh kosong
                'valid_email' => 'Format %s salah'              // keluaran error inputan harus email
            ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required',[
                'required' => 'Data %s kosong harap isi data!'  // keluaran error inputan tidak boleh kosong
            ]);
        $this->form_validation->set_rules('pin', 'PIN', 'trim|required|exact_length[3]|numeric',[
                'required' => 'Data %s kosong harap isi data!', // keluaran error inputan tidak boleh kosong
                'exact_length' => 'Data %s 3 digit',            // keluaran error inputan harus 3 digit
                'numeric' => 'Format %s salah'                  // keluaran error inputan harus nomor
            ]);
        
        // Jika inputan pada form disubmit dan tidak memenuhi rule maka akan meload view kembali dan mengirimkan error berdasarkan rule yg error
        if ($this->form_validation->run() == FALSE)
        {
            // Load view dengan mengirimkan data array yang sudah disiapkan sebelumnya
            $this->load->view('templates/v_header_admin', $data);
            $this->load->view('admin/akunadmin');
            $this->load->view('templates/v_footer_admin2', $data);
        // Jika sudah memenuhi rule maka akan dilakukan proses selanjutnya 
        }else{
            $data = $this->input->post();                   // Menampung semua inputan dari form dengan metode post
            $this->User_model->setRegistrasiAdmin($data);   // Insert data registrasi user

            // set pesan flash ketika pesan berhasil dihapus yg nantinya akan ditampilkan di view berdasarkan key flashdata yg sudah dibuat
            $this->session->set_flashdata('message', 'Berhasil membuat Akun Admin');
            redirect('dashboard'); // Mengarahkan keadaan saat ini ke method dashboard
        }   
    }


    // Profile admin
    public function profileAdmin()
    {
        // Data berupa array dengan key dan value/nilai untuk parsing data ke view
        $data['judul'] = 'SIPetani Profile Admin';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,NULL)->num_rows();

        // rule/aturan untuk form validasi dengan parameter (name_pada inputan form post, string, rule/aturan)
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required',[
                'required' => 'Data %s kosong harap isi data!'  // keluaran error yg diinginkan berdasarkan aturan, %s mewakilkan parameter String
            ]);
        $this->form_validation->set_rules('pin', 'PIN', 'trim|required|exact_length[3]|numeric',[
                'required' => 'Data %s kosong harap isi data!', // keluaran error inputan tidak boleh kosong
                'exact_length' => 'Data %s 3 digit',            // keluaran error inputan tidak boleh kosong
                'numeric' => 'Format %s salah'                  // keluaran error inputan tidak boleh kosong
            ]);
         $this->form_validation->set_rules('password', 'Password', 'trim|min_length[4]|max_length[8]|matches[password2]',[
                'min_length' => 'Data %s kurang dari 4 Char',   // keluaran error inputan tidak boleh kosong
                'max_length' => 'Data %s lebih dari 8 Char',    // keluaran error inputan tidak boleh kosong
                'matches' => 'Repeat %s tidak sama'             // keluaran error inputan tidak boleh kosong
            ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|matches[password]');

        // Jika inputan pada form disubmit dan tidak memenuhi rule maka akan meload view kembali dan mengirimkan error berdasarkan rule yg error
        if ($this->form_validation->run() == FALSE)
        {
            // Load view dengan mengirimkan data array yang sudah disiapkan sebelumnya
            $this->load->view('templates/v_header_admin', $data);
            $this->load->view('templates/v_navbar_admin', $data);
            $this->load->view('admin/profileadmin', $data);
            $this->load->view('templates/v_footer_admin', $data);
        // Jika sudah memenuhi rule maka akan dilakukan proses selanjutnya
        }else{
            $this->User_model->updateUserProfileByEmail($this->input->post(), $data['user']['foto']); // Update profil data dengan parameter data inputan dari form dengn post dan foto lama

            // set pesan flash ketika pesan berhasil dihapus yg nantinya akan ditampilkan di view berdasarkan key flashdata yg sudah dibuat
            $this->session->set_flashdata('message', 'Berhasil Edit Profile');
            redirect('profileadmin'); // Mengarahkan keadaan saat ini ke method profileadmin
        }
    }


    // Pemesanan
    public function pemesanan()
    {
        // Data berupa array dengan key dan value/nilai untuk parsing data ke view
        $data['judul'] = 'SIPetani Pemesanan';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,NULL)->num_rows();
        $data['pemesanan'] = $this->Transaksi_model->getPemesanan()->result_array();

        // Load view dengan mengirimkan data array yang sudah disiapkan sebelumnya
        $this->load->view('templates/v_header_admin', $data);
        $this->load->view('templates/v_navbar_admin', $data);
        $this->load->view('admin/pemesanan', $data);
        $this->load->view('templates/v_footer_admin', $data);
    }


    // Konfirmasi
    public function konfirmasi()
    {
        // Data berupa array dengan key dan value/nilai untuk parsing data ke view
        $data['judul'] = 'SIPetani Konfirmasi';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,NULL)->num_rows();
        $data['konfirmasi'] = $this->Transaksi_model->getKonfirmasi()->result_array();

        // Load view dengan mengirimkan data array yang sudah disiapkan sebelumnya
        $this->load->view('templates/v_header_admin', $data);
        $this->load->view('templates/v_navbar_admin', $data);
        $this->load->view('admin/konfirmasi', $data);
        $this->load->view('templates/v_footer_admin', $data);
    }


    // Validasi konfirmasi
    public function validasiKonfirmasi($id,$status)
    {
        $this->Transaksi_model->updateKonfirmasi($id,$status); // Update status pemesanan dengan menerima parameter id_transaksi dan status
        
        // Jika id_transaksi sama dengan 'all' 
        if ($id == 'all') {
            
            // set pesan flash ketika pesan berhasil dihapus yg nantinya akan ditampilkan di view berdasarkan key flashdata yg sudah dibuat
            $this->session->set_flashdata('message', 'Berhasil Konfirmasi semua pesanan');
            redirect('konfirmasi'); // Mengarahkan keadaan saat ini ke method konfirmasi

        // Jika status sama dengan 1
        }elseif ($status == 1) {

            // set pesan flash ketika pesan berhasil dihapus yg nantinya akan ditampilkan di view berdasarkan key flashdata yg sudah dibuat
            $this->session->set_flashdata('message', 'Berhasil Konfirmasi pesanan');
            redirect('konfirmasi'); // Mengarahkan keadaan saat ini ke method konfirmasi
        
        // Jika tidak maka akan dilakukan proses dibawah
        }else {

            // set pesan flash ketika pesan berhasil dihapus yg nantinya akan ditampilkan di view berdasarkan key flashdata yg sudah dibuat
            $this->session->set_flashdata('message', 'Konfirmasi Dibatalkan');
            redirect('konfirmasi'); // Mengarahkan keadaan saat ini ke method konfirmasi
        }
    }

    
    // Pengunjung
    public function pengunjung()
    {
        $data['judul'] = 'SIPetani Pengunjung';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,NULL)->num_rows();
        $data['pengunjung'] = $this->Transaksi_model->getPengunjung()->result_array();

        $this->load->view('templates/v_header_admin',$data);
        $this->load->view('templates/v_navbar_admin',$data);
        $this->load->view('admin/pengunjung',$data);
        $this->load->view('templates/v_footer_admin',$data);
    }

    public function tambahPengunjung()
    {
        $data['judul'] = 'SIPetani Tambah Data Pengunjung';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,NULL)->num_rows();

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required',[
                'required' => 'Data %s kosong harap isi data!'
            ]);
        $this->form_validation->set_rules('jumlah_pengunjung', 'Jumlah Pengunjung', 'trim|required|numeric',[
                'required' => 'Data %s kosong harap isi data!',
                'numeric' => 'Format %s salah'
            ]);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/v_header_admin',$data);
            $this->load->view('admin/tambahpengunjung');
            $this->load->view('templates/v_footer_admin2',$data);
        }else{
            $data = $this->input->post();
            $this->Transaksi_model->setPengunjung($data);
            $this->session->set_flashdata('message','Berhasil menambah pengunjung');
            redirect('pengunjung');
        }
    }

    public function editPengunjung($id)
    {
        $data['judul'] = 'SIPetani Edit Data Pengunjung';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,NULL)->num_rows();
        $data['pengunjung'] = $this->Transaksi_model->getPengunjungById($id)->row_array();

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required',[
                'required' => 'Data %s kosong harap isi data!'
            ]);
        $this->form_validation->set_rules('jumlah_pengunjung', 'Jumlah Pengunjung', 'trim|required|numeric',[
                'required' => 'Data %s kosong harap isi data!',
                'numeric' => 'Format %s salah'
            ]);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/v_header_admin',$data);
            $this->load->view('admin/editpengunjung');
            $this->load->view('templates/v_footer_admin',$data);
        }else{
            $data = $this->input->post();
            $this->Transaksi_model->updatePengunjung($data,$id);
            $this->session->set_flashdata('message','Berhasil Update Pengunjung');
            redirect('pengunjung');
            }
    }

    public function hapusPengunjung($id)
    {
        $this->Transaksi_model->deletePengunjungById($id);
        $this->session->set_flashdata('message','Berhasil Hapus Pengunjung');
        redirect('pengunjung');
    }


    // Harga
    public function harga()
    {
        $data['judul'] = 'SIPetani Harga';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,NULL)->num_rows();
        $data['harga'] = $this->Transaksi_model->getHarga()->result_array();

        $this->load->view('templates/v_header_admin',$data);
        $this->load->view('templates/v_navbar_admin',$data);
        $this->load->view('admin/harga',$data);
        $this->load->view('templates/v_footer_admin',$data);
    }

    public function tambahHarga()
	{
		$data['judul'] = 'SIPetani Tambah Data Harga';
		$data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
		$data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,0)->num_rows();

		$this->form_validation->set_rules('hari', 'Hari', 'trim|required',[
				'required' => 'Data %s kosong harap isi data!'
			]);
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric',[
				'required' => 'Data %s kosong harap isi data!',
				'numeric' => 'Format %s salah'
			]);
		if ($this->form_validation->run() == FALSE)
        {
			$this->load->view('templates/v_header_admin',$data);
			$this->load->view('admin/tambahharga');
			$this->load->view('templates/v_footer_admin2',$data);
		}else{
			$data = $this->input->post();
			$this->Transaksi_model->setHarga($data);
			$this->session->set_flashdata('message','Berhasil Tambah Harga');
		    redirect('harga');
		}
	}

    public function editHarga($id)
    {
        $data['judul'] = 'SIPetani Edit Data Harga';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,0)->num_rows();
        $data['harga'] = $this->Transaksi_model->getHargaById($id)->row_array();

        $this->form_validation->set_rules('hari', 'Hari', 'trim|required',[
                'required' => 'Data %s kosong harap isi data!'
            ]);
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric',[
                'required' => 'Data %s kosong harap isi data!',
                'numeric' => 'Format %s salah'
            ]);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/v_header_admin',$data);
            $this->load->view('admin/editharga');
            $this->load->view('templates/v_footer_admin',$data);
        }else{
            $data = $this->input->post();
            $this->Transaksi_model->updateharga($data,$id);
            $this->session->set_flashdata('message','Berhasil Update Harga');
            redirect('harga');
        }
    }

    public function hapusHarga($id)
    {
        $this->Transaksi_model->deleteHargaById($id);
        $this->session->set_flashdata('message','Berhasil Hapus Harga');
        redirect('harga');
    }
}