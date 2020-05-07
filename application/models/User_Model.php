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


}