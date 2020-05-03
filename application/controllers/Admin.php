<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_not_login();

        if (session()) {
            // Cek apakah dia Admin?
            is_not_admin();
        }
    }

    public function dashboard()
    {

        $data['judul'] = 'SIPetani Dashboard';
        $data['user'] = $this->User_model->getUserByEmail($this->session->userdata('email'))->row_array();
        $data['users'] = $this->User_model->getUser()->result_array();
        $data['cek_pemesanan'] = $this->Transaksi_model->getCekPemesanan(0,0)->num_rows();
        $data['pemesanan'] = $this->Transaksi_model->getPemesanan()->num_rows();
        $data['harga'] = $this->Transaksi_model->getHarga()->num_rows();
        $data['pengunjung'] = $this->Transaksi_model->getPengunjungLimit(1)->row_array();

        // Data Rekap Chart
        $hari = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');

        date_default_timezone_set('Asia/Jakarta');
        $data['waktu'] = $waktu = date('h : i A');

        // Data Rekap
        $data['data_rekap_harian'] = $this->Transaksi_model->getDataRekap($hari,'tanggal_pemesanan')->row_array();
        $data['data_rekapa_bulanan'] = $this->Transaksi_model->getDataRekap($bulan, 'tanggal_pemesanan')->row_array();
        $data['data_rekap_tahunan'] = $this->Transaksi_model->getDataRekap($tahun, 'tanggal_pemesanan')->row_array();

        // Array Chart Tahunan
        $arr_chart = [];

        // Menjumlahkan pemasukan setiap bulannya dalam tahun saat ini adalah dimana hasil setiap bulannya akan dimasukkan ke dalam array chart
        for($i;$i<=12;$i++){
            $query_chart = $this->Transaksi_model->getChart($i,$tahun)->result_array();

            foreach ($query_chart as $row) {
                // Jika hasil pada bulan ke $i=0 maka akan memasukkan nilai 0 pada array chart
                if($row['hasil'] === NULL || $row['hasil'] === 0){
                    array_push($arr_chart, 0);

                // Selain itu akan memasukkan nilai dari hasil ke dalam array chart
                }else{
                    array_push($arr_chart, $row['hasil']);
                }
            }
        }
        // Data Chart
        $data['chart'] = $arr_chart;

        $this->load->view('template/v_header_admin', $data);
        $this->load->view('template/v_navbar_admin', $data);
        $this->load->view('admin/dashboard', $data);
        $data->load->view('template/v_footer_admin', $data);
    }





}