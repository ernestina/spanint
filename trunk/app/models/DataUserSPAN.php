<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataUserSPAN {

    private $db;
    
    //untuk Monitoring User Aktif
    private $_kdkppn;
    private $_user_name;
    private $_last_name;
    private $_attribute1;
    private $_name;
    private $_responsibility_name;
    private $_email_address;
    private $_start_date;
    private $_end_date;
    private $_error;
    
    //untuk Monitoring Pergantian User
    private $_tgl_invoice;
    private $_wfapproval_status;
    private $_desc_invoice;
    private $_status;
    private $_username;
    private $_nama_pegawai;
    private $_posisi;
    
    //untuk Monitoring Invoice Proses
    private $_no_id;
    private $_kode_unit;
    private $_nama_usr_awal;
    private $_nip_usr_awal;
    private $_email_usr_awal;
    private $_posisi_user_awal;
    private $_nama_usr_pengganti;
    private $_nip_usr_pengganti;
    private $_email_usr_pengganti;
    private $_posisi_user_pengganti;
    private $_tanggal_awal;
    private $_tanggal_akhir;
    private $_surat;
    private $_status_setup_awal;
    private $_status_setup_akhir;
    private $_catatan;
    
    //untuk LoV posisi
    private $_kd_posisi;
    private $_deskripsi_posisi;
    private $_flag;
    
    //global
    private $_valid = TRUE;
    private $_table = 'USER_SPAN';
    private $_table1 = 'AP_INVOICES_ALL_V';
    private $_table2 = 'HR_OPERATING_UNITS';
    private $_table3 = 'FND_USER';
    private $_table4 = 'USER_HISTORY';
    private $_table5 = 'T_POSISI';
    
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

    public function get_user_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT KDKPPN, USER_NAME, LAST_NAME, ATTRIBUTE1, substr(NAME,12,30) NAME, EMAIL_ADDRESS, START_DATE, END_DATE FROM " . $this->_table . " 
				 WHERE 
				end_date is null 
                AND ((END_DATE BETWEEN TO_DATE ('".Session::get('ta')."0101','YYYYMMDD') AND TO_DATE ('".Session::get('ta')."1231','YYYYMMDD')) OR END_DATE is null) ";

        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= "  GROUP BY KDKPPN, USER_NAME, LAST_NAME, ATTRIBUTE1,NAME, EMAIL_ADDRESS, START_DATE, END_DATE";
        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdkppn($val['KDKPPN']);
            $d_data->set_user_name($val['USER_NAME']);
            $d_data->set_last_name($val['LAST_NAME']);
            $d_data->set_attribute1($val['ATTRIBUTE1']);
            $d_data->set_name($val['NAME']);
            $d_data->set_responsibility_name($val['RESPONSIBILITY_NAME']);
            $d_data->set_email_address($val['EMAIL_ADDRESS']);
            $d_data->set_start_date(date("d-m-Y", strtotime($val['START_DATE'])));
            if (is_null($val['END_DATE'])) {
                $d_data->set_end_date('-');
            } else {
                $d_data->set_end_date(date("d-m-Y", strtotime($val['END_DATE'])));
            }
            $data[] = $d_data;
        }
        return $data;
    }
    
    public function get_spm_gantung($filter) {
        Session::get('id_user');
        $sql = "SELECT DISTINCT * FROM 
                ( SELECT
                AIA.KDKPPN
                , AIA.CREATION_DATE TGL_INVOICE
                , AIA.INVOICE_NUM
                , AIA.INVOICE_DESCRIPTION DESC_INVOICE
                , AIA.WFAPPROVAL_STATUS
                , AIA.STATUS
                , AIA.ORIGINAL_RECIPIENT USERNAME
                , AIA.TO_USER NAMA_PEGAWAI
                , SUBSTR(FU.DESCRIPTION, 12, 20) POSISI 
                FROM " . $this->_table1 . " AIA
                , " . $this->_table2 . " OU
                , " . $this->_table3 . " FU
				WHERE 1=1 AND
				AIA.ORIGINAL_RECIPIENT = FU.USER_NAME
                AND AIA.STATUS = 'OPEN'
                ";

        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= ")  ORDER BY NAMA_PEGAWAI";
        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdkppn($val['KDKPPN']);
            $d_data->set_tgl_invoice(date("d-m-Y", strtotime($val['TGL_INVOICE'])));
            $d_data->set_no_invoice($val['INVOICE_NUM']);
            $d_data->set_desc_invoice($val['DESC_INVOICE']);
            $d_data->set_wfapproval_status($val['WFAPPROVAL_STATUS']);
            $d_data->set_status($val['STATUS']);
            $d_data->set_username($val['USERNAME']);
            $d_data->set_nama_pegawai($val['NAMA_PEGAWAI']);
            $d_data->set_posisi($val['POSISI']);
            //$d_data->set_start_date(date("d-m-Y", strtotime($val['START_DATE'])));
            
            $data[] = $d_data;
        }
        return $data;
    }
    
    public function get_ganti_user ($filter) {
        Session::get('id_user');
        $sql = "SELECT 
                NO_ID, KODE_UNIT, NAMA_USR_AWAL, NIP_USR_AWAL, EMAIL_USR_AWAL, POSISI_USER_AWAL, NAMA_USR_PENGGANTI, NIP_USR_PENGGANTI, EMAIL_USR_PENGGANTI, POSISI_USER_PENGGANTI, TANGGAL_AWAL, TANGGAL_AKHIR, SURAT, STATUS_SETUP_AWAL, STATUS_SETUP_AKHIR, CATATAN
                FROM " . $this->_table4 . " WHERE 1=1 ";
        
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= "  ORDER BY to_date(TANGGAL_AWAL,'DD-MM-YYYY') DESC, to_date(TANGGAL_AKHIR,'DD-MM-YYYY') DESC ";
        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_no_id($val['NO_ID']);
            $d_data->set_kode_unit($val['KODE_UNIT']);
            $d_data->set_nama_usr_awal($val['NAMA_USR_AWAL']);
            $d_data->set_nip_usr_awal($val['NIP_USR_AWAL']);
            $d_data->set_email_usr_awal($val['EMAIL_USR_AWAL']);
            $d_data->set_posisi_user_awal($val['POSISI_USER_AWAL']);
            $d_data->set_nama_usr_pengganti($val['NAMA_USR_PENGGANTI']);
            $d_data->set_nip_usr_pengganti($val['NIP_USR_PENGGANTI']);
            $d_data->set_email_usr_pengganti($val['EMAIL_USR_PENGGANTI']);
            $d_data->set_posisi_user_pengganti($val['POSISI_USER_PENGGANTI']);
            $d_data->set_tanggal_awal(date("d-m-Y", strtotime($val['TANGGAL_AWAL'])));
            $d_data->set_tanggal_akhir(date("d-m-Y", strtotime($val['TANGGAL_AKHIR'])));
            $d_data->set_surat($val['SURAT']);
            $d_data->set_status_setup_awal($val['STATUS_SETUP_AWAL']);
            $d_data->set_status_setup_akhir($val['STATUS_SETUP_AKHIR']);
            $d_data->set_catatan($val['CATATAN']);
            //$d_data->set_start_date(date("d-m-Y", strtotime($val['START_DATE'])));
            
            $data[] = $d_data;
        }
        return $data;
    }
    
    public function get_posisi_user () {
        //Session::get('id_user');
        $sql = "SELECT 
                KD_POSISI, DESKRIPSI, FLAG
                FROM " . $this->_table5 . "";
        
        /*
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        */
        //$sql .= "  ORDER BY NO_ID DESC";
        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kd_posisi($val['KD_POSISI']);
            $d_data->set_deskripsi_posisi($val['DESKRIPSI']);
            $d_data->set_flag($val['FLAG']);

            $data[] = $d_data;
        }
        return $data;
    }
    
    

    /*
     * tambah data user
     * param array data array key=>value, nama kolom=>data
     */

    public function add_d_user() {
        
        $data = array(
            'kode_unit' => $this->get_kode_unit(),
            
            'nama_usr_awal' => $this->get_nama_usr_awal(),
            'nip_usr_awal' => $this->get_nip_usr_awal(),
            'email_usr_awal' => $this->get_email_usr_awal(),
            'posisi_user_awal' => $this->get_posisi_user_awal(),
            
            'nama_usr_pengganti' => $this->get_nama_usr_pengganti(),
            'nip_usr_pengganti' => $this->get_nip_usr_pengganti(),
            'email_usr_pengganti' => $this->get_email_usr_pengganti(),
            'posisi_user_pengganti' => $this->get_posisi_user_pengganti(),
            
            'tanggal_awal' => $this->get_tanggal_awal(),
            'tanggal_akhir' => $this->get_tanggal_akhir(),
            'surat' => $this->get_surat(),
            'status_setup_awal' => $this->get_status_setup_awal(),
            'status_setup_akhir' => $this->get_status_setup_akhir(),
            'catatan' => $this->get_catatan()
        );
        
        //var_dump($this->get_catatan());
        if (!is_array($data)) {
            return false;
        }
        //$sql = "INSERT INTO USER_HISTORY(catatan,email_usr_awal,email_usr_pengganti,kode_unit,nama_usr_awal,nama_usr_pengganti,nip_usr_awal,nip_usr_pengganti,posisi_user_awal,posisi_user_pengganti,status_setup_akhir,status_setup_awal,surat,tanggal_akhir,tanggal_awal) VALUES ('1','2','3','4','5','6','7','8','9','10','11','12','13',to_date('20150202','YYYYMMDD'),to_date('20150202','YYYYMMDD'))";
        //$result = $this->db->insert2($sql);
        return $this->db->insert($this->_table4, $data);
    }

    /*
     * setter
     */

    public function set_kdkppn($kdkppn) {
        $this->_kdkppn = $kdkppn;
    }

    public function set_user_name($user_name) {
        $this->_user_name = $user_name;
    }

    public function set_last_name($last_name) {
        $this->_last_name = $last_name;
    }

    public function set_attribute1($attribute1) {
        $this->_attribute1 = $attribute1;
    }

    public function set_name($name) {
        $this->_name = $name;
    }

    public function set_responsibility_name($responsibility_name) {
        $this->_responsibility_name = $responsibility_name;
    }

    public function set_email_address($email_address) {
        $this->_email_address = $email_address;
    }

    public function set_start_date($start_date) {
        $this->_start_date = $start_date;
    }

    public function set_end_date($end_date) {
        $this->_end_date = $end_date;
    }
    
    public function set_tgl_invoice($tgl_invoice) {
        $this->_tgl_invoice = $tgl_invoice;
    }

    public function set_no_invoice($no_invoice) {
        $this->_no_invoice = $no_invoice;
    }
    
    public function set_desc_invoice($desc_invoice) {
        $this->_desc_invoice = $desc_invoice;
    }

    public function set_wfapproval_status($wfapproval_status) {
        $this->_wfapproval_status = $wfapproval_status;
    }

    public function set_status($status) {
        $this->_status = $status;
    }

    public function set_username($username) {
        $this->_username = $username;
    }

    public function set_nama_pegawai($nama_pegawai) {
        $this->_nama_pegawai = $nama_pegawai;
    }

    public function set_posisi($posisi) {
        $this->_posisi = $posisi;
    }
    
    public function set_no_id($no_id) {
        $this->_no_id = $no_id;
    }
    
    public function set_kode_unit($kode_unit) {
        $this->_kode_unit = $kode_unit;
    }
    
    public function set_nama_usr_awal($nama_usr_awal) {
        $this->_nama_usr_awal = $nama_usr_awal;
    }
    
    public function set_nip_usr_awal($nip_usr_awal) {
        $this->_nip_usr_awal = $nip_usr_awal;
    }
    
    public function set_email_usr_awal($email_usr_awal) {
        $this->_email_usr_awal = $email_usr_awal;
    }
    
    public function set_posisi_user_awal($posisi_user_awal) {
        $this->_posisi_user_awal = $posisi_user_awal;
    }
    
    public function set_nama_usr_pengganti($nama_usr_pengganti) {
        $this->_nama_usr_pengganti = $nama_usr_pengganti;
    }
    
    public function set_nip_usr_pengganti($nip_usr_pengganti) {
        $this->_nip_usr_pengganti = $nip_usr_pengganti;
    }
    
    public function set_email_usr_pengganti($email_usr_pengganti) {
        $this->_email_usr_pengganti = $email_usr_pengganti;
    }
    
    public function set_posisi_user_pengganti($posisi_user_pengganti) {
        $this->_posisi_user_pengganti = $posisi_user_pengganti;
    }
    
    public function set_tanggal_awal($tanggal_awal) {
        $this->_tanggal_awal = $tanggal_awal;
    }
    
    public function set_tanggal_akhir($tanggal_akhir) {
        $this->_tanggal_akhir = $tanggal_akhir;
    }
    
    public function set_surat($surat) {
        $this->_surat = $surat;
    }
    
    public function set_status_setup_awal($status_setup_awal) {
        $this->_status_setup_awal = $status_setup_awal;
    }
    
    public function set_status_setup_akhir($status_setup_akhir) {
        $this->_status_setup_akhir = $status_setup_akhir;
    }
    
    public function set_catatan($catatan) {
        $this->_catatan = $catatan;
    }
    
    public function set_kd_posisi($kd_posisi){
        $this->_kd_posisi = $kd_posisi;
    }
    
    public function set_deskripsi_posisi($deskripsi_posisi){
        $this->_deskripsi_posisi = $deskripsi_posisi;
    }
    
    public function set_flag($flag){
        $this->_flag = $flag;
    }

    /*
     * getter
     */

    public function get_kdkppn() {
        return $this->_kdkppn;
    }

    public function get_user_name() {
        return $this->_user_name;
    }

    public function get_last_name() {
        return $this->_last_name;
    }

    public function get_attribute1() {
        return $this->_attribute1;
    }

    public function get_name() {
        return $this->_name;
    }

    public function get_responsibility_name() {
        return $this->_responsibility_name;
    }

    public function get_email_address() {
        return $this->_email_address;
    }

    public function get_start_date() {
        return $this->_start_date;
    }

    public function get_end_date() {
        return $this->_end_date;
    }
    
    public function get_tgl_invoice() {
        return $this->_tgl_invoice;
    }
    
    public function get_no_invoice() {
        return $this->_no_invoice;
    }
    
    public function get_desc_invoice() {
        return $this->_desc_invoice;
    }
    
    public function get_wfapproval_status() {
        return $this->_wfapproval_status;
    }
    
    public function get_status() {
        return $this->_status;
    }
    
    public function get_username() {
        return $this->_username;
    }
    
    public function get_nama_pegawai() {
        return $this->_nama_pegawai;
    }
    
    public function get_posisi() {
        return $this->_posisi;
    }
    
    public function get_no_id() {
        return $this->_no_id;
    }
    
    public function get_kode_unit() {
        return $this->_kode_unit;
    }
    
    public function get_nama_usr_awal() {
        return $this->_nama_usr_awal;
    }
    
    public function get_nip_usr_awal() {
        return $this->_nip_usr_awal;
    }
    
    public function get_email_usr_awal() {
        return $this->_email_usr_awal;
    }
    
    public function get_posisi_user_awal() {
        return $this->_posisi_user_awal;
    }
    
    public function get_nama_usr_pengganti() {
        return $this->_nama_usr_pengganti;
    }
    
    public function get_nip_usr_pengganti() {
        return $this->_nip_usr_pengganti;
    }
    
    public function get_email_usr_pengganti() {
        return $this->_email_usr_pengganti;
    }
    
    public function get_posisi_user_pengganti() {
        return $this->_posisi_user_pengganti;
    }
    
    public function get_tanggal_awal() {
        return $this->_tanggal_awal;
    }
    
    public function get_tanggal_akhir() {
        return $this->_tanggal_akhir;
    }
    
    public function get_surat() {
        return $this->_surat;
    }
    
    public function get_status_setup_awal() {
        return $this->_status_setup_awal;
    }
        
    public function get_status_setup_akhir() {
        return $this->_status_setup_akhir;
    }
    
    public function get_catatan() {
        return $this->_catatan;
    }
    
    public function get_kd_posisi() {
        return $this->_kd_posisi;
    }
    
    public function get_deskripsi_posisi() {
        return $this->_deskripsi_posisi;
    }
    
    public function get_flag() {
        return $this->_flag;
    }
    
    public function get_table() {
        return $this->_table;
    }
    
    public function get_table1() {
        return $this->_table1;
    }
    
    public function get_table4() {
        return $this->_table4;
    }
    
    public function get_table5() {
        return $this->_table5;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
