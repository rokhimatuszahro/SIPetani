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

        $datainsert = [
            'nama' => htmlspecialchars($nama, true),
            'jenkel' => $jenkel,
            'email' => htmlspecialchars($email, true),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'pin' => htmlspecialchars($pin, true),
            'id_akses' => 1,
            'foto' => 'default.jpg',
            'status_login' => 0,
            'status' => 1
        ];

        $user = $this->User_model->getUserByEmail($email)->num_rows();

        if ($user <= 0) {
            $this->User_model->setRegistrasiMobile($datainsert);
            $data = [
                'success' => '1',
                'message' => 'Berhasil Registrasi'
            ];
        }else{
            $data = [
                'success' => '0',
                'message' => 'Email sudah pernah terdaftar'
            ];
        }
        echo json_encode($data);
    }

    public function apiLogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->getUserByEmail($email)->row_array();

        if(!empty($user)){
            if(password_verify($password, $user['password'])){
                $data = [
                    'success' => '1',
                    'message' => 'Berhasil Login',
                    'user_detail' => $user
                ];
            }else{
                $data = [
                    'success' => '0',
                    'message' => 'Password Anda Salah'
                ];
            }
        }else{
            $data = [
                'success' => '0',
                'message' => 'Email Anda Salah'
            ];
        }
        echo json_encode($data);
    }

    public function apiResetAkun()
    {
        $email = $this->input->post('email');
        $pin = $this->input->post('pin');

        $passbaru = substr(uniqid(rand(),true), 16, 4);

        $user = $this->User_model->getUserByEmail($email)->row_array();

        if(!empty($user)){
            if($user['pin'] == $pin){
                $this->User_model->updatePasswordUserByEmail($email, password_hash($passbaru, PASSWORD_DEFAULT));
                $data = [
                    'success' => '1',
                    'message' => 'Berhasil Reset Akun',
                    'password_baru' => $passbaru
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
            $tanggungan = $this->Transaksi_model->getPemesananStatusbayar($email,0)->num_rows();
            if($tanggungan <= 0){
                $pesantiket = $this->Transaksi_model->setPemesananTiket($data_pemesan);

                // QrCode
                $pemesan = $this->Transaksi_model->getPemesananTiketLimit(1,$user_id)->row_array();
                $this->fungsi->qrcode($pemesan['id_pemesanan'].'/'.$pemesan['jumlah_tiket'],'qrcode-'.$pemesan['id_pemesanan']);
                $this->Transaksi_model->updatePemesananTiket('qrcode-'.$pemesan['id_pemesanan'].'.png',$pemesan['id_pemesanan']);
                $data = [
                    'success' => '1',
                    'message' > 'Selamat Anda Berhasil Memesan Tiket'
                ];
            }else{
                $data = [
                    'success' => '2',
                    'message' => 'Anda Masih Memiliki Pesanan'
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

    public function apiDetailPemesanan()
    {
        $id_user = $this->input->post('id_user');

        $detailPemesanan = $this->Transaksi_model->getTransaksiById($id_user,0)->row_array();
        $detailPemesananLunas = $this->Transaksi_model->getTransaksiById($id_user,1)->num_rows();

        if(!empty($detailPemesanan)) {
            $data = [
                'success' => '1',
                'message' => 'Berhasil Memuat Detail Pemesanan!',
                'detail_pemesanan' => $detailPemesanan
            ];
        }else if($detailPemesananLunas > 0){
            $data = [
                'success' => '2',
                'message' => 'Anda Tidak Memiliki Pesanan!'
            ];
        }else{
            $data = [
                'success' => '0',
                'message' => "Gagal Memuat Detail Pemesanan"
            ];
        }
        echo json_encode($data);
    }

    public function apiUploadBukti()
    {
        $id_user = $this->input->post('id_user');
        $email = $this->input->post('email');
        $foto = base64_decode($this->input->post('foto'));

        $transaksi = $this->Transaksi_model->getPemesananStatusbayar($email,0)->row_array();

        $path = './assets/img/bukti_pembayaran/'.$transaksi['id_pemesanan'].".mobile.jpeg";

        if($transaksi){
            $this->Transaksi_model->updateBuktiPembayaran($id_user, $transaksi['id_pemesanan'].".mobile.jpeg");
            file_put_contents($path, $foto);
            $data = [
                'success' => '1',
                'message' => 'Harap tunggu beberapa saat untuk konfirmasi pesanan'
            ];
        }else{
            $data = [
                'success' => '0',
                'message' => 'Pesanan Anda sudah dikonfirmasi'
            ];
        }
        echo json_encode($data);
    }

    public function apiProfile()
    {
        $email = $this->input->post('email');
        $profile = $this->User_model->getUserByEmail($email)->row_array();

        if($profile){
            $data = [
                'success' => '1',
                'message' => 'Berhasil load Profile',
                'profile' => $profile,
                'foto' => 'http://192.168.43.178/sipetani/assets/img/profile/'.$profile['foto']
            ];
        }else{
            $data = [
                'success' => '0',
                'message' => 'Gagal load Profile'
            ];
        }
        echo json_encode($data);
    }

    public function apiTiket()
    {
        $id_user = $this->input->post('id_user');

        if($id_user){
            $cek = $this->Transaksi_model->getTransaksiById($id_user, 1)->num_rows();
            if($cek > 0){
                $Tiket = $this->Transaksi_model->getTransaksiById($id_user, 1)->result_array();
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

        $dataedit = [
            'nama' => $inpnama,
            'email' => $inpemail,
            'pin' => $inppin,
            'jenkel' => $inpjenkel
        ];

        $user = $this->User_model->getUserByEmail($email)->row_array();
        $oldfoto = $user['foto'];

        if($this->input->post()){
            if(!empty($passlama)){
                if(password_verify($passlama,$user['password'])){
                    $passhash = password_hash($passbaru, PASSWORD_DEFAULT);
                    $cekemailberubah = $this->User_model->updateEditProfile($dataedit,$email,$oldfoto,$foto,$id_user,$passhash);
                    if($cekemailberubah == FALSE){
                        $data = [
                            'success' => '1',
                            'message' => 'Edit Profile Berhasil'
                        ];
                    }else{
                        $data = [
                            'success' => '3',
                            'message' => 'Email Berhasil Diubah, Silahkan Login Kembali'
                        ];
                    }
                }else{
                    $data = [
                        'success' => '2',
                        'message' => 'Password Lama Salah'
                    ];
                }
            }else{
                $cekemailberubah = $this->User_model->updateEditProfile($dataedit,$email,$oldfoto,$foto,$id_user,$passbaru);
                if($cekemailberubah == TRUE){
                    $data = [
                        'success' => '3',
                        'message' => 'Email Berhasil Diubah, Silahkan Login Kembali'
                    ];
                }else{
                    $data = [
                        'success' => '1',
                        'message' => 'Edit Profile Berhasil'
                    ];
                }
            }
        }else{
            $data = [
                'success' => '0',
                'message' => 'Gagal Edit Profile'
            ];
        }
        echo json_encode($data);
    }

    public function apiPrint($id_pemesanan=null){
        $data['judul'] = 'Tiket Anda';
        $data['tiket'] = $this->Transaksi_model->getPemesananById($id_pemesanan)->row_array();
        if($data['tiket']['status_pembayaran'] == 1){
            $tampilan = $this->load->view('landing_home/printtiketmobile', $data);
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