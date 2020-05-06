<?php 

class User_model extends CI_Model {

    public function getUserByEmail($data)
    {
         return $query = $this->db->get_where('users', ['email' => $data]);
    }

    public function getUser()
    {
        return $this->db->get('users');
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

    

}