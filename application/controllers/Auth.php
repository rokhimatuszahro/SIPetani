<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        session_detail_pembayaran();
    }

    public function login()
    {
        is_login();
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',[
                'required' => 'Data %s kosong harap isi data!',
                'valid_email' => 'Format %s salah'
            ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required',[
                'required' => 'Data %s kosong harap isi data!'
            ]);
        if ($this->form_validation->run() == FALSE)
        {
            $data['judul'] = 'SIPetani-Login';
            $this->load->view('templates/header',$data);
            $this->load->view('auth/login.php');
            $this->load->view('templates/footer');
        }else{
            $this->_login();
        }
    }

    private function _login()
    {
        is_login();
        $email = htmlspecialchars($this->input->post('email'));
        $password = htmlspecialchars($this->input->post('password'));
        $user = $this->User_Model->getUserByEmail($email)->row_array();
        if ($user){
            if ($user['status'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $this->User_Model->updateUserOnline($user['id_user']);
                    $data = [
                        'email' => $user['email'],
                        'id_user' => $user['id_user'],
                        'id_akses' => $user['id_akses']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['id_akses'] == 2) {
                        $this->session->set_flashdata('login','<div class="login" data-login="Login Berhasil!" data-type="success"></div>');
                        redirect('dashboard');
                    }else{
                        $this->session->set_flashdata('login','<div class="login" data-login="Login Berhasil!" data-type="success"></div>');
                        redirect('landing_home');
                    }
                }else{
                    $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Password Anda Salah" data-judul="Login Akun" data-type="error"></div>');
                    redirect('login');
                }
            }else{
                $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Akun Anda belum aktif, cek email Anda" data-judul="Aktivasi Akun" data-type="error"></div>');
                redirect('login');
            }
        }else{
            $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Email tidak terdaftar" data-judul="Login Akun" data-type="error"></div>');
            redirect('login');
        }
    }

    public function registration()
    {
        is_login();
        $this->_ruleregisvalidation();
        if ($this->form_validation->run() == FALSE)
        {
            $data['judul'] = 'SIPetani-New Account';
            $this->load->view('templates/header',$data);
            $this->load->view('auth/registration.php');
            $this->load->view('templates/footer');
        }else{
            $data = $this->input->post();
            $token = base64_encode(random_bytes(32));
            $email = htmlspecialchars($this->input->post('email'));

            $user_token = [
                'email' => $email,
                'token' => $token,
                'waktu_buat' => time()
            ];

            $this->User_Model->setUserToken($user_token);
            $this->User_Model->setRegistrasi($data);

            $this->_sendEmail($token, 'verify');
            
            $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Akun Anda Berhasil diregistrasi silahkan, cek email Anda!" data-judul="Registrasi Akun" data-type="success"></div>');
            redirect('login');
        }
    }

    private function _sendEmail($token, $type)
    {
        is_login();
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
        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun SIPetani');
            $this->email->message('
                <h5>Klik tombol link berikut untuk Verifikasi Akun anda</h5></br>
                <p>Klik link dibawah untuk melakukan Verifikasi akun anda harap lakukan Verifikasi sebelum 1 hari setelah pendaftaran!</p>
                <a href="'.base_url().'auth/verify?email='.$this->input->post('email').'&token='.urlencode($token).'" class="btn btn-primary">Aktivasi</>
            ');
        }elseif ($type == 'forgot') {
            $this->email->subject('Reset Akun SIPetani');
            $this->email->message('
                <h5>Klik tombol link berikut untuk Reset Akun anda</h5></br>
                <p>Klik link dibawah untuk melakukan Reset akun anda harap lakukan Reset sebelum 1 hari setelah pendaftaran!</p>
                <a href="'.base_url().'auth/resetpassword?email='.$this->input->post('email').'&token='.urlencode($token).'" class="btn btn-primary">Reset akun</>
            ');
        }
        if ($this->email->send('')) {
            return true;
        }else{
            $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Email tidak terkirim, cek koneksi Anda!" data-judul="Registrasi Akun" data-type="error"></div>');
            redirect('registration');
        }
    }

    public function verify()
    {
        is_login();
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->User_Model->getUserByEmail($email)->row_array();
        if ($user) {
            $user_token = $this->User_Model->getUserToken($token)->row_array();
            if (!$user['status'] == 1) {
                if ($user_token) {
                    if (time() - $user_token['waktu_buat'] < (60*60*24)) {
                            $this->User_Model->updateUserByEmail($email);
                            $this->User_Model->deleteUserToken($token);$this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Aktivasi akun berhasil silahkan, Login!" data-judul="Aktivasi Akun" data-type="success"></div>');
                            redirect('login');
                    }else{
                        $this->User_Model->deleteUserByEmail($email);
                        $this->User_Model->deleteUserToken($token);
                        $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Aktivasi akun gagal, token expired!" data-judul="Aktivasi Akun" data-type="error"></div>');
                        redirect('login');  
                    }
                }else{
                    $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Aktivasi akun gagal, token tidak valid!" data-judul="Aktivasi Akun" data-type="error"></div>');
                    redirect('login');
                }
            }else{
                $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Akun Anda sudah aktif!" data-judul="Aktivasi Akun" data-type="success"></div>');
                redirect('login');
            }
        }else{
            $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Aktivasi akun gagal, email salah!" data-judul="Aktivasi Akun" data-type="error"></div>');
            redirect('login');
        } 

    }

    private function _ruleregisvalidation()
    {
        is_login();
        $this->form_validation->set_rules('username', 'Username', 'trim|required',[
                'required' => 'Data %s kosong harap isi data!'
            ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]|valid_email',[
                'required' => 'Data %s kosong harap isi data!',
                'is_unique' => '%s sudah terdaftar',
                'valid_email' => 'Format %s salah'
            ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[8]|matches[password2]',[
                'required' => 'Data %s kosong harap isi data!',
                'min_length' => 'Data %s kurang dari 4 Char',
                'max_length' => 'Data %s lebih dari 8 Char',
                'matches' => 'Repeat %s tidak sama'
            ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password]',[
                'required' => 'Data %s kosong harap isi data!'
            ]);
        $this->form_validation->set_rules('pin', 'PIN', 'trim|required|exact_length[3]|numeric',[
                'required' => 'Data %s kosong harap isi data!',
                'exact_length' => 'Data %s 3 digit',
                'numeric' => 'Format %s salah'
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
    }

    public function forgotPassword()
    {
        is_login();
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',[
            'required' => 'Data %s kosong harap isi data!',
            'valid_email' => 'Format %s salah'
            ]);
        $this->form_validation->set_rules('pin', 'PIN', 'trim|required|exact_length[3]|numeric',[
                'required' => 'Data %s kosong harap isi data!',
                'exact_length' => 'Data %s 3 digit',
                'numeric' => 'Format %s salah'
            ]);
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'SIPetani-Forgot Password';
            $this->load->view('templates/header',$data);
            $this->load->view('auth/forgotpassword.php');
            $this->load->view('templates/footer');
        }else{
            $email = $this->input->post('email');
            $pin = $this->input->post('pin');
            $user = $this->User_Model->getUserByEmail($email)->row_array();
            if ($user) {
                if ($user['status'] == 1) {
                    if ($user['pin'] == $pin) {
                        $token = base64_encode(random_bytes(32));
                        $user_token = [
                            'email' => $email,
                            'token' => $token,
                            'waktu_buat' => time()
                        ];

                        $this->User_Model->setUserToken($user_token);
                        $this->_sendEmail($token, 'forgot');
                        $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Harap cek email Anda untuk mereset password Anda!" data-judul="Reset Akun" data-type="success"></div>');
                        redirect('forgotpassword');

                    }else{
                        $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="PIN Anda salah!" data-judul="Reset Akun" data-type="error"></div>');
                        redirect('forgotpassword');
                    }
                }
                else{
                    $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Email tidak aktif!" data-judul="Reset Akun" data-type="error"></div>');
                    redirect('forgotpassword');
                }
            }else{
                $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Email tidak terdaftar!" data-judul="Reset Akun" data-type="error"></div>');
                redirect('forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        is_login();
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->User_Model->getUserByEmail($email)->row_array();
        if ($user) {
            $user_token = $this->User_Model->getUserToken($token)->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->session->set_userdata('token', $token);
                $this->changepassword();
            }else{
                $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Email tidak terdaftar, token tidak valid!" data-judul="Reset Akun" data-type="error"></div>');
                redirect('login');  
            }
        }else{
            $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Reset akun gagal, Email salah!" data-judul="Reset Akun" data-type="error"></div>');
            redirect('login');
        }
    }

    public function changepassword()
    {
        is_login();
        if (!$this->session->userdata('reset_email')) {
            redirect('login');
        }
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[8]|matches[password2]',[
                'required' => 'Data %s kosong harap isi data!',
                'min_length' => 'Data %s kurang dari 4 Char',
                'max_length' => 'Data %s lebih dari 8 Char',
                'matches' => 'Repeat %s tidak sama'
            ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password]',[
                'required' => 'Data %s kosong harap isi data!'
            ]);
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'SIPetani-Reset Password';
            $this->load->view('templates/header',$data);
            $this->load->view('auth/changepassword');
            $this->load->view('templates/footer');
        }else{
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
            $token = $this->session->userdata('token');

            $this->User_Model->updatePasswordUserByEmail($email, $password);
            $this->User_Model->deleteUserToken($token);
            $this->session->unset_userdata('reset_email');
            $this->session->unset_userdata('token');
            $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Password berhasil diubah!" data-judul="Reset Akun" data-type="success"></div>');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->User_Model->updateUserOffline($this->session->userdata('id_user'));
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('id_akses');
        $this->session->set_flashdata('message','<div class="flash-data" data-flashdata="Anda berhasil Logout!" data-judul="Logout Akun" data-type="success"></div>');
        redirect('login');
    }

}

?>

