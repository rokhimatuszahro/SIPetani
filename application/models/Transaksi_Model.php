<?php

class Transaksi_model extends CI_Model {

    // Admin
    public function getCekPemesanan($statusbayar, $buktibayar)
    {
        $this->db->select('*');
        $this->db->from('pemesanan');
        $this->db->where('bukti_pembayaran !=', $buktibayar);
        $this->db->where('status_pembayaran', $statusbayar);
        return $this->db->get();
    }

    public function getPemesanan()
    {
        return $this->db->get('pemesanan');
    }



    public function getHarga()
    {
        return $this->db->get('harga');
    }



    public function getPengunjungLimit($limit)
    {
        $this->db->order_by('id_pengunjung', 'DESC');
        $this->db->limit($limit);
        return $this->db->get('pengunjung');
    }



    public function getDataRekap($waktu, $waktu_pemesanan)
    {
        $this->db->select_sum('total', 'hasil');
        $this->db->from('pemesanan');
        $this->db->where('status_pembayaran', 1);
        $this->db->where($waktu_pemesanan, $waktu);
        return $this->db->get();
    }

    public function getChart($bulan,$tahun)
    {
        $this->db->select_sum('total','hasil');
        $this->db->from('pemesanan');
        $this->db->where('status_pembayaran', 1);
        $this->db->where('MONTH(tanggal_pemesanan)', $bulan);
        $this->db->where('YEAR(tanggal_pemesanan)', $tahun);
        return $this->db->get();
    }

    public function getKonfirmasi()
    {
        $this->db->select('*');
        $this->db->from('pemesanan');
        $this->db->join('users', 'users.id_user = pemesanan.id_user');
        $this->db->where('pemesanan.bukti_pembayaran !=', NULL);
        $this->db->order_by('id_pemesanan', 'DESC');
        return $this->db->get();
    }

    public function updateKonfirmasi($id,$status)
    {
        if ($id == 'all') {
            $this->db->set('status_pembayaran', $status);
            $this->db->where('bukti_pembayaran !=', NULL);
            $this->db->update('pemesanan');
        }else{
            $this->db->set('status_pembayaran', $status);
            $this->db->where('id_pemesanan', $id);
            $this->db->update('pemesanan');
        }
    }

    //landing_home
    public function getPemesananStatusbayar($data,$statusbayar)
	{
		$this->db->select('*');
		$this->db->from('pemesanan');
		$this->db->join('users', 'users.id_user = pemesanan.id_user');
		$this->db->where('email', $data);
		$this->db->where('pemesanan.status_pembayaran', $statusbayar);
		return $this->db->get();
    }
    
    public function setPemesananTiket($data)
	{
		$this->db->insert('pemesanan',$data);
	}

	public function getPemesananTiketLimit($limit,$id)
	{
		$this->db->where('id_user', $id);
		$this->db->order_by('id_pemesanan', 'DESC');
		$this->db->limit($limit);
		return $this->db->get('pemesanan');
	}

	public function updatePemesananTiket($qrcode,$id)
	{
		$this->db->set('qrcode', $qrcode);
		$this->db->where('id_pemesanan', $id);
	    $this->db->update('pemesanan');
    }
    
    public function getTransaksiByEmail($data,$statusbayar)
	{
		$this->db->select('*');
		$this->db->from('pemesanan');
		$this->db->join('users', 'users.id_user = pemesanan.id_user');
		$this->db->where('email', $data);
		$this->db->where('pemesanan.status_pembayaran', $statusbayar);
		return $this->db->get();
    }
    
    public function updateTransaksiUploadBukti($id_user,$old_img_data,$data)
    {
        $upload_img = $_FILES['bukti']['name'];
        if ($upload_img) {
            $config['upload_path'] = './assets/img/bukti_pembayaran/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('bukti')){
                if ($old_img_data != NULL){
                    unlink(FCPATH.'assets/img/bukti_pembayaran/'.$old_img_data);
                }
                $new_img = $this->upload->data('file_name');
                $this->db->set('bukti_pembayaran', $new_img); 
            }else{
                echo $this->upload->display_errors();
            }
        } 
        $this->db->where('id_user', $id_user);
        $this->db->where('status_pembayaran', 0);
        $this->db->update('pemesanan');
    }

    public function getPemesananById($id)
	{
		return $this->db->get_where('pemesanan', ['id_pemesanan' => $id]);
    }
    
    public function updateStatusCetakById($id,$status)
	{
		$this->db->set('status_cetak', $status);
		$this->db->where('id_pemesanan', $id);
	    $this->db->update('pemesanan');	
    }
    
    public function getTransaksiById($id,$statusbayar)
    {
        $this->db->select('*');
        $this->db->from('pemesanan');
        $this->db->join('users', 'users.id_user = pemesanan.id_user');
        $this->db->where('pemesanan.id_user', $id);
        $this->db->where('pemesanan.status_pembayaran', $statusbayar);
        return $this->db->get();
    }

    public function updateBuktiPembayaran($id_user,$foto)
    {
        $this->db->set('bukti_pembayaran', $foto); 
        $this->db->where('id_user', $id_user); 
        $this->db->where('status_pembayaran', 0); 
        $this->db->update('pemesanan'); 
    }

    public function getPengunjung()
    {
        return $this->db->get('pengunjung');
    }

    public function getPengunjungById($id)
    {
        $this->db->where('id_pengunjung', $id);
        return $this->db->get('pengunjung');
    }

    public function setPengunjung($data)
    {
        $datainsert = [
            'tgl_pengunjung' => $data['tanggal'],
            'jum_pengunjung' => htmlspecialchars($data['jumlah_pengunjung'],true)
        ];
        $this->db->insert('pengunjung',$datainsert);
    }

    public function updatePengunjung($data,$id)
    {
        $data_pengunjung = [
            'tgl_pengunjung' => $data['tanggal'],
            'jum_pengunjung' => htmlspecialchars($data['jumlah_pengunjung'],true)
        ];
        $this->db->set($data_pengunjung);
        $this->db->where('id_pengunjung', $id);
        $this->db->update('pengunjung');
    }

    public function deletePengunjungById($id)
    {
        $this->db->delete('pengunjung', ['id_pengunjung' => $id]);
    }

    public function getHargaById($id)
    {
        $this->db->where('id_harga', $id);
        return $this->db->get('harga');
    }

    public function setHarga($data)
    {
        $datainsert = [
            'hari' => htmlspecialchars($data['hari'],true),
            'harga' => htmlspecialchars($data['harga'],true)
        ];
        $this->db->insert('harga',$datainsert);
    }

    public function updateHarga($data,$id)
    {
        $data_harga = [
            'hari' => htmlspecialchars($data['hari'],true),
            'harga' => htmlspecialchars($data['harga'],true)
        ];
        $this->db->set($data_harga);
        $this->db->where('id_harga', $id);
        $this->db->update('harga');
    }

    public function deletehargaById($id)
    {
        $this->db->delete('harga', ['id_harga' => $id]);
    }
}