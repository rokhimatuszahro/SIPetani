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

    public function getKonfirmasi()
    {
        $this->db->select('*');
        $this->db->from('pemesanan');
        $this->db->join('users', 'users.id_user pemesanan.id_user');
        $this->db->where('pemesanan.bukti_pembayaran !=', 0);
        $this->db->order_by('id_pemesanan', 'DESC');
        return $this->db->get();
    }

    public function updateKonfirmasi($id,$status)
    {
        if ($id == 'all') {
            $this->db->set('status_pembayaran', $status);
            $this->db->where('bukti_pembayaran !=', 0);
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
}