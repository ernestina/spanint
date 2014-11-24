<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataBLU {

    private $db;
	private $_satker;
	private $_nmsatker;
	private $_kppn;
	private $_rumpun;
	private $_januari;
	private $_februari;
	private $_maret;
	private $_april;
	private $_mei;
	private $_juni;
	private $_juli;
	private $_agustus;
	private $_september;
	private $_oktober;
	private $_november;
	private $_desember;
	private $_invoice_num;
	private $_invoice_date;
	private $_check_number;
	private $_check_date;
	private $_check_amount;
	private $_pendapatan;
	private $_belanja;
	private $_akun;
	private $_program;
	private $_output;
    private $_table1 = 'SP3B_BLU';
	private $_table2 = 'DAFTAR_SP3B_BLU';
	private $_table3 = 'CARI_SP3B_BLU';
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
     * return array objek Data Tetap */

    public function get_rekap_sp3b($filter) {
        Session::get('id_user');
        $sql = "SELECT *
				FROM "
                . $this->_table1 . "
				WHERE 
				1=1"

        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }


        $sql .= " ORDER BY SATKER, KDKPPN ASC";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['SATKER']);
            $d_data->set_nmsatker($val['NMSATKER']);
			$d_data->set_kppn($val['KDKPPN']);
			$d_data->set_rumpun($val['RUMPUN']);
			$d_data->set_januari($val['JAN']);
			$d_data->set_februari($val['FEB']);
			$d_data->set_maret($val['MAR']);
			$d_data->set_april($val['APR']);
			$d_data->set_mei($val['MAY']);
			$d_data->set_juni($val['JUN']);
			$d_data->set_juli($val['JUL']);
			$d_data->set_agustus($val['AUG']);
			$d_data->set_september($val['SEP']);
			$d_data->set_oktober($val['OKT']);
			$d_data->set_november($val['NOV']);
			$d_data->set_desember($val['DES']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_daftar_sp3b($filter) {
        Session::get('id_user');
        $sql = "SELECT *
				FROM "
                . $this->_table2 . "
				WHERE 
				1=1"

        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }


        $sql .= " ORDER BY INVOICE_NUM";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_invoice_date($val['INVOICE_DATE']);
			$d_data->set_check_number($val['CHECK_NUMBER']);
			$d_data->set_check_date($val['CHECK_DATE']);
			$d_data->set_check_amount($val['CHECK_AMOUNT']);
			$d_data->set_pendapatan($val['PENDAPATAN']);
			$d_data->set_belanja($val['BELANJA']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_cari_sp3b($filter) {
        Session::get('id_user');
        $sql = "SELECT *
				FROM "
                . $this->_table3 . "
				WHERE 
				1=1"

        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }


        $sql .= " ORDER BY INVOICE_NUM";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_invoice_date($val['INVOICE_DATE']);
			$d_data->set_check_number($val['CHECK_NUMBER']);
			$d_data->set_check_date($val['CHECK_DATE']);
			$d_data->set_check_amount($val['CHECK_AMOUNT']);
			$d_data->set_pendapatan($val['PENDAPATAN']);
			$d_data->set_belanja($val['BELANJA']);
			$d_data->set_akun($val['SEGMENT3']);
			$d_data->set_kppn($val['KDKPPN']);
			$d_data->set_satker($val['SEGMENT1']);
			$d_data->set_program($val['SEGMENT4']);
			$d_data->set_output($val['SEGMENT5']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_kdsatker_blu($satker) {
        Session::get('id_user');
        $sql = "SELECT A.KDSATKER ,A.NMSATKER ,A.BA ,B.NMBA
				FROM T_SATKER A,
				T_BA B
				WHERE
				A.BA=B.KDBA
				AND A.KDSATKER = '".$satker."'"
				

        ;

        $no = 0;
        /* foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        } */


        //$sql .= " ORDER BY INVOICE_NUM";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
             $d_data->set_satker($val['KDSATKER']);
            $d_data->set_nmsatker($val['NMSATKER']);
			$d_data->set_kppn($val['BA']);			
			$d_data->set_pendapatan($val['NMBA']);
            $data[] = $d_data;
        }
        return $data;
    }

	

    /*
     * setter
     */

	public function set_satker($satker) {
        $this->_satker = $satker;
    }
	public function set_akun($akun) {
        $this->_akun = $akun;
    }
	public function set_program($program) {
        $this->_program = $program;
    }
	public function set_output($output) {
        $this->_output = $output;
    }
    public function set_nmsatker($nmsatker) {
        $this->_nmsatker = $nmsatker;
    }
	public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }
	public function set_rumpun($rumpun) {
        $this->_rumpun = $rumpun;
    }	
	public function set_januari($januari) {
        $this->_januari = $januari;
    }
	public function set_februari($februari) {
        $this->_februari = $februari;
    }
	public function set_maret($maret) {
        $this->_maret = $maret;
    }
	public function set_april($april) {
        $this->_april = $april;
    }
	public function set_mei($mei) {
        $this->_mei = $mei;
    }
	public function set_juni($juni) {
        $this->_juni = $juni;
    }
	public function set_juli($juli) {
        $this->_juli = $juli;
    }
	public function set_agustus($agustus) {
        $this->_agustus = $agustus;
    }
	public function set_september($september) {
        $this->_september = $september;
    }
	public function set_oktober($oktober) {
        $this->_oktober = $oktober;
    }
	public function set_november($november) {
        $this->_november = $november;
    }
	public function set_desember($desember) {
        $this->_desember = $desember;
    }
	public function set_invoice_num($invoice_num) {
        $this->_invoice_num = $invoice_num;
    }
	public function set_invoice_date($invoice_date) {
        $this->_invoice_date = $invoice_date;
    }
	public function set_check_number($check_number) {
        $this->_check_number = $check_number;
    }
	public function set_check_date($check_date) {
        $this->_check_date = $check_date;
    }
	public function set_check_amount($check_amount) {
        $this->_check_amount = $check_amount;
    }
	public function set_pendapatan($pendapatan) {
        $this->_pendapatan = $pendapatan;
    }
	public function set_belanja($belanja) {
        $this->_belanja = $belanja;
    }
    /*
     * getter
     */
	
	public function get_satker() {
        return $this->_satker;
    }
	public function get_akun() {
        return $this->_akun;
    }
	public function get_program() {
        return $this->_program;
    }
	public function get_output() {
        return $this->_output;
    }
	public function get_kppn() {
        return $this->_kppn;
    }
	public function get_rumpun() {
        return $this->_rumpun;
    }
    public function get_nmsatker() {
        return $this->_nmsatker;
    }	
	public function get_januari() {
        return $this->_januari;
    }
	public function get_februari() {
        return $this->_februari;
    }
	public function get_maret() {
        return $this->_maret;
    }
	public function get_april() {
        return $this->_april;
    }
	public function get_mei() {
        return $this->_mei;
    }
	public function get_juni() {
        return $this->_juni;
    }
	public function get_juli() {
        return $this->_juli;
    }
	public function get_agustus() {
        return $this->_agustus;
    }
	public function get_september() {
        return $this->_september;
    }
	public function get_oktober() {
        return $this->_oktober;
    }
	public function get_november() {
        return $this->_november;
    }
	public function get_desember() {
        return $this->_desember;
    }
	public function get_invoice_num() {
        return $this->_invoice_num;
    }
	public function get_invoice_date() {
        return $this->_invoice_date;
    }
	public function get_check_number() {
        return $this->_check_number;
    }
	public function get_check_date() {
        return $this->_check_date;
    }
	public function get_check_amount() {
        return $this->_check_amount;
    }
	public function get_pendapatan() {
        return $this->_pendapatan;
    }
	public function get_belanja() {
        return $this->_belanja;
    }
    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
