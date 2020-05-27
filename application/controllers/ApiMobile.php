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

}