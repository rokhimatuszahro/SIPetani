<?php
defined('ABSEPATH') OR exit('No direct script access allowed');

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


}