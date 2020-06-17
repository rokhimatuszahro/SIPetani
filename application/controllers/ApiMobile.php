<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiMobile extends CI_Controller {

    public function apiRegistrasi()
    {
        $email = $this->input->post('email');
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
        $pin = $this->input->post('pin');
        $jenkel = $this->input->post('jenkel');

        if (!empty($this->input->post())) { 
            $user = $this->User_Model->getUserByEmail($email)->num_rows();
    
            if ($user == 0) {    
                $datainsert = [
                    'nama' => htmlspecialchars($nama, true),
                    'jenkel' => $jenkel,
                    'email' => htmlspecialchars($email, true),
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'pin' => htmlspecialchars($pin, true),
                    'id_akses' => 1,
                    'foto' => 'default.jpg',
                    'status_login' => 0,
                    'status' => 0
                ];   
                $token = base64_encode(random_bytes(32));

                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'waktu_buat' => time()
                ];
                $this->_sendEmail($token);
                $this->User_Model->setUserToken($user_token);
                $this->User_Model->setRegistrasiMobile($datainsert);
                $data = [
                    'success' => '1',
                    'title' => 'Berhasil Registrasi Akun',
                    'message' => 'Berhasil Registrasi, Silahkan Cek Email Anda Untuk Aktivasi Akun Anda'
                ];
                
            }else{
                $data = [
                    'success' => '0',
                    'message' => 'Email sudah terdaftar'
                ];
            }
            echo json_encode($data);
        }
    }

    private function _sendEmail($token)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'ackermannaomy@gmail.com',
            'smtp_pass' => 'Kode200216',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->load->library('email',$config);

        $this->email->from('ackermannaomy@gmail.com', 'SIPetani');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Verifikasi Akun SIPetani');
        $this->email->message('
            <h5>Klik tombol link berikut untuk Verifikasi Akun anda</h5></br>
            <p>Klik link dibawah untuk melakukan Verifikasi akun anda harap lakukan Verifikasi sebelum 1 hari setelah pendaftaran!</p>
            <a href="'.base_url().'auth/verify?email='.$this->input->post('email').'&token='.urlencode($token).'" class="btn btn-primary">Aktivasi</>
        ');
        if ($this->email->send('')) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function apiLogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_Model->getUserByEmail($email)->row_array();

        if (!empty($email) && !empty($password)) {
            if(!empty($user)){
                if(password_verify($password, $user['password'])){
                    if ($user['status'] == 1) {
                        $this->User_Model->updateUserOnline($user['id_user']);
                        $data = [
                            'success' => '1',
                            'message' => 'Berhasil Login',
                            'user_detail' => $user
                        ];    
                    }else {
                        $data = [
                            'success' => '0',
                            'title' => 'Login Akun',
                            'message' => 'Akun belum Aktif, silahkan cek email anda'
                        ];    
                    }
                }else{
                    $data = [
                        'success' => '0',
                        'title' => 'Password Salah',
                        'message' => 'Password yang Anda masukkan salah'
                    ];
                }
            }else{
                $data = [
                    'success' => '0',
                    'title' => 'Email Salah',
                    'message' => 'Email yang Anda masukkan tidak terdaftar'
                ];
            }
            echo json_encode($data);
        }
    }

    public function apiLogout()
    {
        $id_user = $this->input->post('id_user');
        if (!empty($id_user)) {
            $this->User_Model->updateUserOffline($id_user);
            $data = [
                'success' => '1',
                'title' => 'Logout Berhasil',
                'message' => 'Terima kKasih Sudah Memesan Tiket Wisata Taman Botani Dengan Aplikasi Sipetani, Semoga Liburanmu Menyenangkan :)'
            ];
            echo json_encode($data);
        }
    }

    public function apiResetAkun()
    {
        $email = $this->input->post('email');
        $pin = $this->input->post('pin');

        if (!empty($email) && !empty($pin)) {
            $user = $this->User_Model->getUserByEmail($email)->row_array();
            if(!empty($user)){
                if($user['pin'] == $pin){
                    $data = [
                        'success' => '1',
                        'message' => 'Data Reset Valid'
                    ];
                }else{
                    $data = [
                        'success' => '2',
                        'message' => 'PIN Anda Salah'
                    ];
                }
            }else{
                $data = [
                    'success' => '3',
                    'message' => 'Email Anda Tidak Terdaftar'
                ];
            }
            echo json_encode($data);
        }
    }

    public function apiReset()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        if (!empty($email) && !empty($password)) {
            if (!empty($email)) {
                $this->User_Model->updatePasswordUserByEmail($email, password_hash($password, PASSWORD_DEFAULT));
                $data = [
                    'success' => '1',
                    'title' => 'Reset Password Berhasil',
                    'message' => 'Selamat Anda Berhasil Reset Password, Silahkan Login dengan Password Baru!'
                ];
            }else {
                $data = [
                    'success' => '0',
                    'title' => 'Silahkan Klik lupa Password untuk Reset Password',
                    'message' => 'Gagal Reset Akun'
                ];
            }
            echo json_encode($data);
        }
    }

    public function apiPemesanan()
    {
        $nama_pemesan = $this->input->post('nama');
        $email = $this->input->post('email');
        $noHp = $this->input->post('no');
        $alamat = $this->input->post('alamat');
        $jumlah = $this->input->post('jumlah');
        $tglberkunjung = $this->input->post('tanggal_berkunjung');
        $total = $this->input->post('total');
        $user_id = $this->input->post('user_id');

        if (!empty($this->input->post())) {
            $data_pemesan = [
                'nama_pemesan' => $nama_pemesan, 
                'alamat' => $alamat, 
                'tanggal_berkunjung' => date('Y-m-d',strtotime($tglberkunjung)),
                'tanggal_pemesanan' => date('Y-m-d'),
                'jumlah_tiket' => $jumlah,
                'total' => $total,
                'total_pembayaran' => $total + substr(uniqid(rand(), true),3,3),
                'no_telp' => $noHp,
                'bukti_pembayaran' => '',
                'status_pembayaran' => 0,
                'status_cetak' => 0,
                'id_user' => $user_id,
                'qrcode' => ''
            ];
    
            if(!empty($nama_pemesan))
            {
                $tanggungan = $this->Transaksi_Model->getPemesananStatusbayar($email,0)->num_rows();
                if($tanggungan <= 0){
                    $pesantiket = $this->Transaksi_Model->setPemesananTiket($data_pemesan);
    
                    // QrCode
                    $pemesan = $this->Transaksi_Model->getPemesananTiketLimit(1,$user_id)->row_array();
                    $this->fungsi->qrcode($pemesan['id_pemesanan'].'/'.$pemesan['jumlah_tiket'],'qrcode-'.$pemesan['id_pemesanan']);
                    $this->Transaksi_Model->updatePemesananTiket('qrcode-'.$pemesan['id_pemesanan'].'.png',$pemesan['id_pemesanan']);
                    $data = [
                        'success' => '1',
                        'title' => 'Berhasil Pesan Tiket',
                        'message' => 'Selamat Anda Berhasil Memesan Tiket, Silahkan Unggah Bukti Pembayaran Untuk Cetak Tiket Anda'
                    ];
                }else{
                    $data = [
                        'success' => '2',
                        'title' => 'Notifikasi',
                        'message' => 'Anda Masih Memiliki Pesanan, Silahkan Unggah Bukti Pembayaran Untuk Melakukan Pemesanan Kembali'
                    ];
                }
            }else{
                $data = [
                    'success' => '0',
                    'message' => 'Gagal Memesan Tiket'
                ];
            }
            echo json_encode($data);
        }
    }

    public function apiDetailPemesanan()
    {
        $id_user = $this->input->post('id_user');
        
        if (!empty($id_user)) {
            $detailPemesanan = $this->Transaksi_Model->getTransaksiById($id_user,0)->row_array();

            if(!empty($detailPemesanan)) {
                $data = [
                    'success' => '1',
                    'message' => 'Berhasil Memuat Detail Pemesanan!',
                    'detail_pemesanan' => $detailPemesanan
                ];
            }else{
                $data = [
                    'success' => '2',
                    'title' => 'Notifikasi',
                    'message' => 'Anda Tidak Memiliki Pesanan, Silahkan Lakukan Pemesanan Tiket!'
                ];
            }
            echo json_encode($data);
        }
    }

    public function apiUploadBukti()
    {
        $id_user = $this->input->post('id_user');
        $email = $this->input->post('email');
        $foto = base64_decode($this->input->post('foto'));

        if (!empty($this->input->post())) {
            $transaksi = $this->Transaksi_Model->getPemesananStatusbayar($email,0)->row_array();

            $img_bukti = $transaksi['id_pemesanan'].".".time().".mobile.PNG";
            $path = './assets/img/bukti_pembayaran/'.$img_bukti;
            
            if($transaksi){
                $this->Transaksi_Model->updateBuktiPembayaran($id_user, $img_bukti);
                file_put_contents($path, $foto);
                $data = [
                    'success' => '1',
                    'title' => 'Berhasil Mengunggah Bukti Pembayaran',
                    'message' => 'Harap tunggu beberapa saat untuk konfirmasi pesanan'
                ];
            }else{
                $data = [
                    'success' => '0',
                    'title' => 'Notifikasi',
                    'message' => 'Selamat Anda Dapat Mencetak Tiket!'
                ];
            }
            echo json_encode($data);
        }
    }

    public function apiProfile()
    {
        $email = $this->input->post('email');

        if (!empty($email)) {
            $profile = $this->User_Model->getUserByEmail($email)->row_array();        
            if($profile){
                $data = [
                    'success' => '1',
                    'message' => 'Berhasil load Profile',
                    'profile' => $profile,
                    'foto' => '/assets/img/profile/'.$profile['foto']
                ];
            }else{
                $data = [
                    'success' => '0',
                    'message' => 'Gagal load Profile'
                ];
            }
            echo json_encode($data);
        }
    }

    public function apiTiket()
    {
        $id_user = $this->input->post('id_user');

        if (!empty($id_user)) {
            if($id_user){
                $cek = $this->Transaksi_Model->getTransaksiById($id_user, 1)->num_rows();
                if($cek > 0){
                    $Tiket = $this->Transaksi_Model->getTransaksiById($id_user, 1)->result_array();
                    $data = [
                        'success' => '1',
                        'message' => 'Berhasil load Tiket',
                        'tiket' => $Tiket
                    ];
                }else{
                    $data = [
                        'success' => '2',
                        'message' => 'Anda tidak memiliki Tiket'
                    ];
                }
            }else{
                $data = [
                    'success' => '0',
                    'message' => 'Gagal load Tiket'
                ];
            }
            echo json_encode($data);
        }
    }

    public function apiEditProfile()
    {
        $id_user = $this->input->post('id_user');
        $passlama = $this->input->post('passlama');
        $passbaru = $this->input->post('passbaru');
        $email = $this->input->post('email');
        $inpemail = $this->input->post('inpemail');
        $inpnama = $this->input->post('inpnama');
        $inppin = $this->input->post('inppin');
        $inpjenkel = $this->input->post('inpjenkel');
        $foto = base64_decode($this->input->post('foto'));

        if($this->input->post()){
            $dataedit = [
                'nama' => $inpnama,
                'email' => $inpemail,
                'pin' => $inppin,
                'jenkel' => $inpjenkel
            ];
    
            $user = $this->User_Model->getUserByEmail($email)->row_array();
            $oldfoto = $user['foto'];

            if (!empty($user)) {           
                if(!empty($passlama)){
                    if(password_verify($passlama,$user['password'])){
                        $passhash = password_hash($passbaru, PASSWORD_DEFAULT);
                        $cekemailberubah = $this->User_Model->updateEditProfile($dataedit,$email,$oldfoto,$foto,$id_user,$passhash);
                        if($cekemailberubah == FALSE){
                            $data = [
                                'success' => '1',
                                'title' => 'Profile Anda',
                                'message' => 'Berhasil Edit Profile!'
                            ];
                        }else{
                            $data = [
                                'success' => '3',
                                'title' => 'Profile Anda',
                                'message' => 'Email Berhasil Diubah, Silahkan Login Kembali!'
                            ];
                        }
                    }else{
                        $data = [
                            'success' => '2',
                            'message' => 'Password Lama Salah'
                        ];
                    }
                }else{
                    $cekemailberubah = $this->User_Model->updateEditProfile($dataedit,$email,$oldfoto,$foto,$id_user,$passbaru);
                    if($cekemailberubah == TRUE){
                        $data = [
                            'success' => '3',
                            'title' => 'Profile Anda',
                            'message' => 'Email Berhasil Diubah, Silahkan Login Kembali!'
                        ];
                    }else{
                        $data = [
                            'success' => '1',
                            'title' => 'Profile Anda',
                            'message' => 'Berhasil Edit Profile!'
                        ];
                    }
                }
            }else{
                $data = [
                    'success' => '0',
                    'title' => 'Data Salah :)',
                    'message' => 'Maaf Telah Terjadi Kesalahan Data Pada Akun Anda, Harap Lakukan Login Kembali!'
                ];
            }
            echo json_encode($data);
        }
    }

    public function apiPrint($id_pemesanan=null){
        $data['judul'] = 'Tiket Anda';
        $data['tiket'] = $this->Transaksi_Model->getPemesananById($id_pemesanan)->row_array();
        if($data['tiket']['status_pembayaran'] == 1){
            $tampilan = $this->load->view('landing_home/printtiketmobile2', $data);
        }else{
            $data['error'] = '
                <div class="alert alert-danger alert-dismissible w-27 mx-auto fade show" role="alert">
                    tiket tidak dapat dicetak karena pesanan atas nama <strong>'.$data['tiket']['nama_pemesan'].'<strong>
                    belum unggah bukti pembayaran
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ';
            $tampilan = $this->load->view('landing_home/printtiketmobile', $data);
        }
    }

}