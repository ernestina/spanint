<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPFK_DETAIL{

    private $db;
	private $_kppn;
	private $_keterangan;
	private $_tanggal_buku;
	private $_tanggal_bayar;
	private $_ntpn;
	private $_akun;
	private $_rupiah;
	private $_nama_wajib_bayar_setor;
	private $_table1 = 'PFK_SPAN';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    /*
     * mendapatkan data dari tabel Data Tetap
     * @param limit batas default null
     * return array objek Data Tetap*/
    
    public function get_gr_pfk_detail_filter($filter) {
		Session::get('id_user');
		$sql = "SELECT DISTINCT
				CASE WHEN trx='1' then 'POTONGAN SPM' when trx='2' then 'SETORAN MPN' end as KETERANGAN
				,KPPN
				,TANGGAL_BUKU
				,TANGGAL_BAYAR
				,NTPN
				,AKUN
				,RUPIAH * (-1) as RUPIAH
				,NAMA_WAJIB_BAYAR_SETOR
				FROM " 
				. $this->_table1. "
				WHERE 1=1"
				
				;
				
		$no=0;
		//var_dump($filter);
		
		
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		//var_dump ($sql);
		$sql .= " ORDER BY TANGGAL_BUKU DESC";
		
		
		
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_akun($val['AKUN']);
			$d_data->set_keterangan($val['KETERANGAN']);
			$d_data->set_rupiah($val['RUPIAH']);
            $d_data->set_ntpn($val['NTPN']);
			$d_data->set_tanggal_buku($val['TANGGAL_BUKU']);
			$d_data->set_tanggal_bayar($val['TANGGAL_BAYAR']);
			$d_data->set_nama_wajib_bayar_setor($val['NAMA_WAJIB_BAYAR_SETOR']);
			$d_data->set_kppn($val['KPPN']);
            $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_akun($akun) {
        $this->_akun = $akun;
    }
	
    public function set_keterangan($keterangan) {
        $this->_keterangan = $keterangan;
    }
	public function set_rupiah($rupiah) {
        $this->_rupiah = $rupiah;
    }
	public function set_ntpn($ntpn) {
        $this->_ntpn = $ntpn;
    }
	public function set_tanggal_buku($tanggal_buku) {
        $this->_tanggal_buku = $tanggal_buku;
    }
	public function set_tanggal_bayar($tanggal_bayar) {
        $this->_tanggal_bayar = $tanggal_bayar;
    }
	public function set_nama_wajib_bayar_setor($nama_wajib_bayar_setor) {
        $this->_nama_wajib_bayar_setor = $nama_wajib_bayar_setor;
    }
	public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }
	
	/*
     * getter
     */
	
	public function get_akun() {
        return $this->_akun;
    }
		
	public function get_keterangan() {
        return $this->_keterangan;
    }
	
	public function get_rupiah() {
        return $this->_rupiah;
    }
	public function get_ntpn() {
        return $this->_ntpn;
    }
	public function get_tanggal_buku() {
        return $this->_tanggal_buku;
    }
	public function get_tanggal_bayar() {
        return $this->_tanggal_bayar;
    }
	public function get_nama_wajib_bayar_setor() {
        return $this->_nama_wajib_bayar_setor;
    }
	public function get_kppn() {
        return $this->_kppn;
    }
    /*
     * destruktor
     */

    public function __destruct() {
        
    }
/*update*/
}