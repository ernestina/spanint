<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataSupplier {

    private $db;
	private $_nama_supplier;
	private $_npwp_supplier;
	private $_kdvalas;
	private $_nm_bank;
	private $_cabang;
	private $_kd_bank;
	private $_kd_swift;
	private $_iban;
	private $_asal_bank;
	private $_norek_bank;
	private $_norek_penerima;
	private $_nm_pemilik_rek;
	private $_npwp_penerima;
	private $_nip_penerima;
	private $_nm_penerima;
	private $_tipe_supp;
	private $_satker;
	private $_v_supplier_number;
	private $_kppn_code;
	private $_email;
	private $_alamat;
	private $_city;
	private $_provinsi;
	private $_negawa;
	private $_zip;
	private $_phone;
	private $_update_date;
	private $_ids;
	private $_kode_sandi;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'SUPP';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }
    
    public function get_supp_filter($filter) {
		$sql = "SELECT NAMA_SUPPLIER
				, CONCAT(CONCAT(CONCAT('xx',substr(NPWP_SUPPLIER,3,5)), 'xxx'), substr(NPWP_SUPPLIER,11)) NPWP_SUPPLIER
				, KDVALAS, NM_BANK, CABANG, KD_BANK
				, KD_SWIFT, IBAN, ASAL_BANK, NOREK_BANK
				, CONCAT(CONCAT(substr(NOREK_PENERIMA,1,3),'xxxxxx'), substr(NOREK_PENERIMA,10)) NOREK_PENERIMA
				, NM_PEMILIK_REK
				, CONCAT(CONCAT(CONCAT('xx',substr(NPWP_PENERIMA,3,5)), 'xxx'), substr(NPWP_PENERIMA,11)) NPWP_PENERIMA
				, NIP_PENERIMA, NM_PENERIMA, TIPE_SUPP
				, SATKER, V_SUPPLIER_NUMBER, KPPN_CODE, EMAIL, ALAMAT
				, CITY, PROVINSI, NEGARA, ZIP, PHONE, UPDATE_DATE, IDS
				FROM " . $this->_table . "
				WHERE 1 = 1";
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kppn_code($val['KPPN_CODE']);
            $d_data->set_v_supplier_number($val['V_SUPPLIER_NUMBER']);
            $d_data->set_tipe_supp($val['TIPE_SUPP']);
            $d_data->set_nama_supplier($val['NAMA_SUPPLIER']);
            $d_data->set_npwp_supplier($val['NPWP_SUPPLIER']);
            $d_data->set_nm_bank($val['NM_BANK']);
            $d_data->set_asal_bank($val['ASAL_BANK']);
            $d_data->set_kdvalas($val['KDVALAS']);
            $d_data->set_nm_penerima($val['NM_PENERIMA']);
            $d_data->set_nm_pemilik_rek($val['NM_PEMILIK_REK']);
            $d_data->set_norek_penerima($val['NOREK_PENERIMA']);
            $d_data->set_kd_swift($val['KD_SWIFT']);
            $d_data->set_iban($val['IBAN']);
            $d_data->set_npwp_penerima($val['NPWP_PENERIMA']);
            $d_data->set_nip_penerima($val['NIP_PENERIMA']);
            $d_data->set_ids($val['IDS']);
			$data[] = $d_data;
        }
        return $data;
    }
    
    public function get_download_supp_filter($filter) {
		$sql = "SELECT 
				nama_supplier,
				concat(concat(concat(concat(concat(concat(concat(concat(concat(concat(concat(concat(concat(concat(
				TRANSLATE( substr(npwp_supplier,9,1),'0123456789','7890123456'),
				TRANSLATE( substr(npwp_supplier,13,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_supplier,5,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_supplier,8,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_supplier,10,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_supplier,15,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_supplier,7,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_supplier,1,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_supplier,3,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_supplier,14,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_supplier,4,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_supplier,12,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_supplier,2,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_supplier,11,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_supplier,6,1),'0123456789','7890123456')
				) npwp_supplier,
				kdvalas,
				nm_bank,
				cabang,
				kd_bank,
				kd_swift,
				iban,
				asal_bank,
				TRANSLATE(upper(norek_bank),'ABCDEFGHIJKLMNOPQRSTUVWXYZ5678901234','MNOPQRSTUVWXYZABCDEFGHIJKL!)@(#*$&%^') norek_bank,
				TRANSLATE(upper(norek_penerima),'ABCDEFGHIJKLMNOPQRSTUVWXYZ5678901234','MNOPQRSTUVWXYZABCDEFGHIJKL!)@(#*$&%^') norek_penerima, 
				nm_pemilik_rek,
				concat(concat(concat(concat(concat(concat(concat(concat(concat(concat(concat(concat(concat(concat(
				TRANSLATE( substr(npwp_penerima,9,1),'0123456789','7890123456'),
				TRANSLATE( substr(npwp_penerima,13,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_penerima,5,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_penerima,8,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_penerima,10,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_penerima,15,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_penerima,7,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_penerima,1,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_penerima,3,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_penerima,14,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_penerima,4,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_penerima,12,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_penerima,2,1),'0123456789','7890123456')),
				TRANSLATE( substr(npwp_penerima,11,1),'0123456789','5678901234')),
				TRANSLATE( substr(npwp_penerima,6,1),'0123456789','7890123456')
				) npwp_penerima,
				nip_penerima,
				nm_penerima,
				tipe_supp,
				TRANSLATE(upper(satker),'ABCDEFGHIJKLMNOPQRSTUVWXYZ5678901234','MNOPQRSTUVWXYZABCDEFGHIJKL!)@(#*$&%^') satker,
				v_supplier_number,
				kppn_code,email, 
				alamat,
				city,
				provinsi,
				negara,
				zip,
				phone,
				update_date, 
				CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(nama_supplier,kdvalas), nm_bank), kd_bank), asal_bank),nm_pemilik_rek), nm_penerima), tipe_supp), v_supplier_number) kode_sandi 
				FROM supp 
				where ids in ('".$filter;
		$no=0;
		//var_dump($filter);
		/*foreach ($filter as $filter) {
			$sql .= ",'".$filter[checkbox]."'";
		}*/
		$sql .= "') order by nama_supplier,nm_penerima,nip_penerima";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_nama_supplier($val['NAMA_SUPPLIER']);
            $d_data->set_npwp_supplier($val['NPWP_SUPPLIER']);
            $d_data->set_kdvalas($val['KDVALAS']);
            $d_data->set_nm_bank($val['NM_BANK']);
            $d_data->set_cabang($val['CABANG']);
            $d_data->set_kd_bank($val['KD_BANK']);
            $d_data->set_kd_swift($val['KD_SWIFT']);
            $d_data->set_iban($val['IBAN']);
            $d_data->set_asal_bank($val['ASAL_BANK']);
            $d_data->set_norek_bank($val['NOREK_BANK']);
            $d_data->set_norek_penerima($val['NOREK_PENERIMA']);
            $d_data->set_nm_pemilik_rek($val['NM_PEMILIK_REK']);
            $d_data->set_npwp_penerima($val['NPWP_PENERIMA']);
            $d_data->set_nip_penerima($val['NIP_PENERIMA']);
            $d_data->set_nm_penerima($val['NM_PENERIMA']);
            $d_data->set_tipe_supp($val['TIPE_SUPP']);
            $d_data->set_satker($val['SATKER']);
            $d_data->set_v_supplier_number($val['V_SUPPLIER_NUMBER']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
            $d_data->set_email($val['EMAIL']);
            $d_data->set_alamat($val['ALAMAT']);
            $d_data->set_city($val['CITY']);
            $d_data->set_provinsi($val['PROVINSI']);
            $d_data->set_negara($val['NEGARA']);
            $d_data->set_zip($val['ZIP']);
            $d_data->set_phone($val['PHONE']);
            $d_data->set_update_date($val['UPDATE_DATE']);
            $d_data->set_kode_sandi(md5(trim($val['NAMA_SUPPLIER']).trim($val['KDVALAS']).trim($val['NM_BANK']).trim($val['KD_BANK']).trim($val['ASAL_BANK']).trim($val['NM_PEMILIK_REK']).trim($val['NM_PENERIMA']).trim($val['TIPE_SUPP']).trim($val['V_SUPPLIER_NUMBER'])));
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_download_supp_filter_xls($filter) {
		$sql = "SELECT 
				nama_supplier,
				npwp_supplier,
				kdvalas,
				nm_bank,
				kd_bank,
				kd_swift,
				iban,
				asal_bank,
				norek_bank,
				norek_penerima, 
				nm_pemilik_rek,
				npwp_penerima,
				nip_penerima,
				nm_penerima,
				tipe_supp,
				satker,
				v_supplier_number,
				kppn_code
				FROM supp 
				where kppn_code = '".$filter."' ";
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_nama_supplier($val['NAMA_SUPPLIER']);
            $d_data->set_npwp_supplier($val['NPWP_SUPPLIER']);
            $d_data->set_kdvalas($val['KDVALAS']);
            $d_data->set_nm_bank($val['NM_BANK']);
            $d_data->set_kd_bank($val['KD_BANK']);
            $d_data->set_kd_swift($val['KD_SWIFT']);
            $d_data->set_iban($val['IBAN']);
            $d_data->set_asal_bank($val['ASAL_BANK']);
            $d_data->set_norek_bank($val['NOREK_BANK']);
            $d_data->set_norek_penerima($val['NOREK_PENERIMA']);
            $d_data->set_nm_pemilik_rek($val['NM_PEMILIK_REK']);
            $d_data->set_npwp_penerima($val['NPWP_PENERIMA']);
            $d_data->set_nip_penerima($val['NIP_PENERIMA']);
            $d_data->set_nm_penerima($val['NM_PENERIMA']);
            $d_data->set_tipe_supp($val['TIPE_SUPP']);
            $d_data->set_satker($val['SATKER']);
            $d_data->set_v_supplier_number($val['V_SUPPLIER_NUMBER']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
			$data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_nama_supplier($nama_supplier) {
        $this->_nama_supplier = $nama_supplier;
    }

    public function set_npwp_supplier($npwp_supplier) {
        $this->_npwp_supplier = $npwp_supplier;
    }

    public function set_kdvalas($kdvalas) {
        $this->_kdvalas = $kdvalas;
    }

    public function set_nm_bank($nm_bank) {
        $this->_nm_bank = $nm_bank;
    }

    public function set_cabang($cabang) {
        $this->_cabang = $cabang;
    }

    public function set_kd_bank($kd_bank) {
        $this->_kd_bank = $kd_bank;
    }

    public function set_kd_swift($kd_swift) {
        $this->_kd_swift = $kd_swift;
    }

    public function set_iban($iban) {
        $this->_iban = $iban;
    }

    public function set_asal_bank($asal_bank) {
        $this->_asal_bank = $asal_bank;
    }

    public function set_norek_bank($norek_bank) {
        $this->_norek_bank = $norek_bank;
    }

    public function set_norek_penerima($norek_penerima) {
        $this->_norek_penerima = $norek_penerima;
    }

    public function set_nm_pemilik_rek($nm_pemilik_rek) {
        $this->_nm_pemilik_rek = $nm_pemilik_rek;
    }

    public function set_npwp_penerima($npwp_penerima) {
        $this->_npwp_penerima = $npwp_penerima;
    }

    public function set_nip_penerima($nip_penerima) {
        $this->_nip_penerima = $nip_penerima;
    }

    public function set_nm_penerima($nm_penerima) {
        $this->_nm_penerima = $nm_penerima;
    }

    public function set_tipe_supp($tipe_supp) {
        $this->_tipe_supp = $tipe_supp;
    }

    public function set_satker($satker) {
        $this->_satker = $satker;
    }

    public function set_v_supplier_number($v_supplier_number) {
        $this->_v_supplier_number = $v_supplier_number;
    }

    public function set_kppn_code($kppn_code) {
        $this->_kppn_code = $kppn_code;
    }

    public function set_email($email) {
        $this->_email = $email;
    }

    public function set_alamat($alamat) {
        $this->_alamat = $alamat;
    }

    public function set_city($city) {
        $this->_city = $city;
    }

    public function set_provinsi($provinsi) {
        $this->_provinsi = $provinsi;
    }

    public function set_negara($negara) {
        $this->_negara = $negara;
    }

    public function set_zip($zip) {
        $this->_zip = $zip;
    }

    public function set_phone($phone) {
        $this->_phone = $phone;
    }

    public function set_update_date($update_date) {
        $this->_update_date = $update_date;
    }

    public function set_ids($ids) {
        $this->_ids = $ids;
    }

    public function set_kode_sandi($kode_sandi) {
        $this->_kode_sandi = $kode_sandi;
    }
	
		
	/*
     * getter
     */
	
	public function get_nama_supplier() {
        return $this->_nama_supplier;
    }
	
	public function get_npwp_supplier() {
        return $this->_npwp_supplier;
    }
	
	public function get_kdvalas() {
        return $this->_kdvalas;
    }
	
	public function get_nm_bank() {
        return $this->_nm_bank;
    }
	
	public function get_cabang() {
        return $this->_cabang;
    }
	
	public function get_kd_bank() {
        return $this->_kd_bank;
    }
	
	public function get_kd_swift() {
        return $this->_kd_swift;
    }
	
	public function get_iban() {
        return $this->_iban;
    }
	
	public function get_asal_bank() {
        return $this->_asal_bank;
    }
	
	public function get_norek_bank() {
        return $this->_norek_bank;
    }
	
	public function get_norek_penerima() {
        return $this->_norek_penerima;
    }
	
	public function get_nm_pemilik_rek() {
        return $this->_nm_pemilik_rek;
    }
	
	public function get_npwp_penerima() {
        return $this->_npwp_penerima;
    }
	
	public function get_nip_penerima() {
        return $this->_nip_penerima;
    }
	
	public function get_nm_penerima() {
        return $this->_nm_penerima;
    }
	
	public function get_tipe_supp() {
        return $this->_tipe_supp;
    }
	
	public function get_satker() {
        return $this->_satker;
    }
	
	public function get_v_supplier_number() {
        return $this->_v_supplier_number;
    }
	
	public function get_kppn_code() {
        return $this->_kppn_code;
    }
	
	public function get_email() {
        return $this->_email;
    }
	
	public function get_alamat() {
        return $this->_alamat;
    }
	
	public function get_city() {
        return $this->_city;
    }
	
	public function get_provinsi() {
        return $this->_provinsi;
    }
	
	public function get_negara() {
        return $this->_negara;
    }
	
	public function get_zip() {
        return $this->_zip;
    }
	
	public function get_phone() {
        return $this->_phone;
    }
	
	public function get_update_date() {
        return $this->_update_date;
    }
	
	public function get_ids() {
        return $this->_ids;
    }
	
	public function get_kode_sandi() {
        return $this->_kode_sandi;
    }
	
	public function get_table() {
        return $this->_table;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}