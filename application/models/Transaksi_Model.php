<?php

class Transaksi_model extends CI_Controller {

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
}