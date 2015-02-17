<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataUserSPAN {

    private $db;
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
    private $_tgl_invoice;
    private $_wfapproval_status;
    private $_desc_invoice;
    private $_status;
    private $_username;
    private $_nama_pegawai;
    private $_posisi;
    private $_valid = TRUE;
    private $_table = 'USER_SPAN';
    private $_table1 = 'AP_INVOICES_ALL_V AIA';
    private $_table2 = 'HR_OPERATING_UNITS OU';
    private $_table3 = 'FND_USER FU';
    
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
        $sql = "SELECT
                AIA.KDKPPN
                , AIA.CREATION_DATE TGL_INVOICE
                , AIA.INVOICE_NUM
                , AIA.DESCRIPTION DESC_INVOICE
                , AIA.WFAPPROVAL_STATUS
                , AIA.STATUS
                , AIA.ORIGINAL_RECIPIENT USERNAME
                , AIA.TO_USER NAMA_PEGAWAI
                , FU.DESCRIPTION POSISI 
                FROM " . $this->_table1 . " 
                , " . $this->_table2 . "
                , " . $this->_table3 . "
				WHERE 
				AIA.ORG_ID = OU.ORGANIZATION_ID
                AND AIA.ORIGINAL_RECIPIENT = FU.USER_NAME
                AND AIA.STATUS <> 'CLOSED'
                ";

        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= "  ORDER BY AIA.CREATION_DATE DESC";
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

    public function get_table() {
        return $this->_table;
    }
    
    public function get_table1() {
        return $this->_table1;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
