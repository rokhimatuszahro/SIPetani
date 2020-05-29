<?php 

class User_model extends CI_Model {

    
    public function getUserByEmail($data)
    {
         return $query = $this->db->get_where('users', ['email' => $data]);
    }

    public function updateUserOnline($id)
    {
        $this->db->set('status_login', 1);
        $this->db->where('id_user', $id);
        $this->db->update('users');
    }

    public function updateUserOffline($id)
    {
        $this->db->set('status_login', 0);
        $this->db->where('id_user', $id);
        $this->db->update('users');
    }

    public function setRegistrasi($data)
    {
    	$datainsert = [
    		'nama' => htmlspecialchars($data['username'],true),
    		'jenkel' => $data['jeniskelamin'],
    		'email' => htmlspecialchars($data['email'],true),
    		'password' => password_hash($data['password'], PASSWORD_DEFAULT),
    		'pin' => htmlspecialchars($data['pin'],true),
    		'id_akses' => 1,
    		'foto' => 'default.jpg',
    		'status_login' => 0,
    		'status' => 0
    	];
    	$this->db->insert('users',$datainsert);
    }

    public function setUserToken($data)
    {
        $this->db->insert('users_token',$data);
    }

    public function deleteUserToken($data)
    {
        $this->db->delete('users_token', ['token' => $data]);
    }

    public function getUserToken($data)
    {
        return $this->db->get_where('users_token', ['token' => $data]);
    }

    public function deleteUserByEmail($data)
    {
        $this->db->delete('users', ['email' => $data]);
    }

    public function updateUserByEmail($data)
    {
        $this->db->set('status', 1);
        $this->db->where('email', $data);
        $this->db->update('users');
    }


    public function getUser()
    {
        return $this->db->get('users');
    }

    

    public function deleteUserById($id)
    {
        $this->db->delete('users', ['id_user' => $id]);
    }

    public function setRegistrasiAdmin($data)
    {
        $datainsert = [
            'nama' => htmlspecialchars($data['nama'], true),
            'jenkel' => $data['jeniskelamin'],
            'email' => htmlspecialchars($data['email'], true),
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'pin' => htmlspecialchars($data['pin'], true),
            'id_akses' => 2,
            'foto' => 'default.jpg',
            'status_login' => 0,
            'status' => 1
        ];
        $this->db->insert('users', $datainsert);
    }
    public function updateUserProfileByEmail($data,$old_img_data)
    {
        $upload_img = $_FILES['profil']['name'];
        $data_user = [
            'nama' => $data['nama'],
            'pin' => $data['pin'],
            'jenkel' => $data['jeniskelamin']
        ];
        if ($data['password']) {
            $this->db->set('password', password_hash($data['password'], PASSWORD_DEFAULT));
        }elseif ($upload_img) {
            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('profil')){
                if ($old_img_data != 'default.jpg') {
                    unlink(FCPATH.'assets/img/profile/'.$old_img_data);
                }
                $new_img = $this->upload->data('file_name');
                $this->db->set('foto', $new_img); 
            }else{
                echo $this->upload->display_errors();
            }
        } 
        $this->db->set($data_user);
        $this->db->where('email', $data['email']);
        $this->db->update('users');
    }


    public function updatePasswordUserByEmail($email,$password)
    {
        $this->db->set('password', $password);
        $this->db->where('email', $email);
        $this->db->update('users');
    }

    public function setRegistrasiMobile($data)
    {
        $this->db->insert('users', $data);
    }

    public function updateEditProfile($dataedit,$email,$oldfoto,$foto,$id_user,$passbaru)
    {
        $emailberubah = FALSE;
        if($email != $dataedit['email']){
            $emailberubah = TRUE;
        }
        if($foto != ""){
            if($oldfoto != 'default.jpg'){
                unlink(FCPATH.'assets/img/profile/'.$oldfoto);
            }
            $nama_imgbaru = $id_user.".".time().".profile.mobile.jpeg";
            $path = './assets/img/profile/'.$nama_imgbaru;
            $this->db->set('foto', $nama_imgbaru);
            file_put_contents($path, $foto);
        }
        if($passbaru != NULL){
            $this->db->set('password', $passbaru);
        }
        $this->db->set($dataedit);
        $this->db->where('email', $email);
        $this->db->update('users');
        return $emailberubah;
    }

}