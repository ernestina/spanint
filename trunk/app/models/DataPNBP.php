<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPNBP {

    private $db;
    private $_dipa_no;
    private $_satker_code;
	private $_nmsatker;
    private $_kppn_code;
    private $_account_code;
	private $_jenis_belanja;
	private $_jenis_spm;
    private $_line_amount;
	private $_amount;
	private $_program_code;
	private $_output_code;
	private $_ntpn;
	private $_tanggal;
	private $_jendok;
	private $_invoice_num;
	private $_description;
	private $_check_num;
	private $_tanggal_sp2d;
    private $_table1 = 'SPAN_PNBP_DIPA_V';
    private $_table2 = 'SPAN_PNBP_GR_V';
	private $_table3 = 'SPAN_PNBP_SA_V';
	private $_table4 = 'SPAN_PNBP_UP_V';
	private $_table5 = 'SPAN_PNBP_DIPA_LINE_V';
	private $_table6 = 'SPAN_PNBP_GR_LINE_V';
	private $_table7 = 'SPAN_PNBP_UP_LINE_V';
	private $_table8 = 'SPAN_PNBP_BEL_LINE_V';
	private $_table9 = 'T_SATKER';
	private $_table10 = 'SPAN_PNBP_SET_UP_V';
	private $_table11 = 'SPAN_PNBP_SET_UP_LINE_V';
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
	
	
	public function get_satker_pnbp($kppn ) {
        $sql = "SELECT DISTINCT A.SATKER_CODE, UPPER(B.NMSATKER) NMSATKER 
				FROM "
                . $this->_table1 . " A, " 
				. $this->_table9 . " B 
				WHERE 
				1=1 
				AND A.SATKER_CODE=B.KDSATKER 
				AND A.KPPN_CODE = '" .$kppn. "'"
        ;
        $no = 0;
        // foreach ($filter as $filter) {
            // $sql .= " AND " . $filter;
        // }

        //$sql .= " ORDER BY  ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $data[] = $d_data;
        }
        return $data;
    }

	public function get_nama_satker_pnbp($satker) {
        $sql = "SELECT DISTINCT KDSATKER, UPPER(NMSATKER) NMSATKER
				FROM "
				. $this->_table9 . " 
				WHERE 
				1=1 
				AND KDSATKER = '" .$satker. "'"
        ;
        $no = 0;
        // foreach ($filter as $filter) {
            // $sql .= " AND " . $filter;
        // }

        $sql .= " ORDER BY KDSATKER";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_satker_code($val['KDSATKER']);
            $data[] = $d_data;
        }
        return $data;
    }
	
    public function get_dipa_pnbp($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table1 . " 
				WHERE 
				1=1 
				 
				"

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

		//$sql .= " AND " . $satker1;
        $sql .= " ORDER BY JENBEL ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_dipa_no($val['DIPA_NO']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
			$d_data->set_jenis_belanja($val['JENBEL']);
            $d_data->set_line_amount($val['AMOUNT']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_gr_pnbp($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table2 . " 
				WHERE 
				1=1 
				
				"

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY ACCOUNT_CODE ";
		//$sql .= " AND " . $satker1;

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_account_code($val['ACCOUNT_CODE']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
            $d_data->set_line_amount($val['AMOUNT']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_up_pnbp($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table4 . " 
				WHERE 
				1=1 
				
				"

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
		
		//$sql .= " AND " . $satker;

        //$sql .= " ORDER BY  ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_jenis_spm($val['JENIS_SPM']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
            $d_data->set_line_amount($val['NILAI_SP2D']);
            $data[] = $d_data;
        }
        return $data;
    }
	public function get_sa_pnbp($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table3 . " 
				WHERE 
				1=1 
				
				"

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

		//$sql .= " AND " . $satker;
        $sql .= " ORDER BY ACCOUNT_CODE";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_account_code($val['ACCOUNT_CODE']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
            $d_data->set_line_amount($val['NILAI_SPM']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_set_up_pnbp($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table10 . " 
				WHERE 
				1=1 
				
				"

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY ACCOUNT_CODE ";
		//$sql .= " AND " . $satker1;

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_account_code($val['ACCOUNT_CODE']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
            $d_data->set_line_amount($val['AMOUNT']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_pnbp_dipa_line($filter) {
        $sql = "SELECT * 
				FROM "
                . $this->_table5 . " 
				WHERE 
				1=1 "

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY PROGRAM_CODE, OUTPUT_CODE, ACCOUNT_CODE ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_account_code($val['ACCOUNT_CODE']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
			$d_data->set_program_code($val['PROGRAM_CODE']);
			$d_data->set_output_code($val['OUTPUT_CODE']);
            $d_data->set_line_amount($val['LINE_AMOUNT']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_pnbp_gr_line($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table6 . " 
				WHERE 
				1=1 "

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY TANGGAL DESC  ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_account_code($val['ACCOUNT_CODE']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
			$d_data->set_tanggal($val['TANGGAL']);
			$d_data->set_ntpn($val['RECEIPT_NUMBER']);
            $d_data->set_line_amount($val['AMOUNT']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_pnbp_up_line($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table7 . " 
				WHERE 
				1=1 "

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY TG_SP2D DESC  ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_satker_code($val['KODE_SATKER']);
			$d_data->set_jendok($val['JENDOK']);
			$d_data->set_jenis_spm($val['JENIS_SPM']);
            $d_data->set_tanggal($val['INVOICE_DATE']);
			$d_data->set_description($val['DESCRIPTION']);
			$d_data->set_check_num($val['NO_SP2D']);
			$d_data->set_tanggal_sp2d($val['TG_SP2D']);
            $d_data->set_line_amount($val['AMOUNT_DIST']);
            $data[] = $d_data;
        }
        return $data;
    }
	public function get_pnbp_bel_line($filter) {
        $sql = "SELECT INVOICE_NUM, SATKER_CODE, INVOICE_DATE, DESCRIPTION, NO_SP2D, TG_SP2D, JENDOK, JENIS_SPM, SEGMENT3, SEGMENT4, SEGMENT5, AMOUNT_DIST, NILAI_SP2D
				FROM "
                . $this->_table8 . " 
				WHERE 
				1=1
				 "

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY TG_SP2D DESC, INVOICE_DATE DESC ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_satker_code($val['KODE_SATKER']);
            $d_data->set_tanggal($val['INVOICE_DATE']);
			$d_data->set_description($val['DESCRIPTION']);
			$d_data->set_check_num($val['NO_SP2D']);
			$d_data->set_tanggal_sp2d($val['TG_SP2D']);
			$d_data->set_jendok($val['JENDOK']);
			$d_data->set_jenis_spm($val['JENIS_SPM']);
			$d_data->set_account_code($val['SEGMENT3']);
			$d_data->set_program_code($val['SEGMENT4']);
			$d_data->set_output_code($val['SEGMENT5']);
            $d_data->set_line_amount($val['AMOUNT_DIST']);
			$d_data->set_amount($val['NILAI_SP2D']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_pnbp_set_up_line($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table11 . " 
				WHERE 
				1=1 "

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY TANGGAL DESC ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_account_code($val['ACCOUNT_CODE']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
			$d_data->set_tanggal($val['TANGGAL']);
			$d_data->set_ntpn($val['RECEIPT_NUMBER']);
            $d_data->set_line_amount($val['AMOUNT']);
            $data[] = $d_data;
        }
        return $data;
    }
    /*
     * setter
     */

    public function set_dipa_no($dipa_no) {
        $this->_dipa_no = $dipa_no;
    }
	
	public function set_description($description) {
        $this->_description = $description;
    }

    public function set_jenis_belanja($jenis_belanja) {
        $this->_jenis_belanja = $jenis_belanja;
    }

    public function set_satker_code($satker_code) {
        $this->_satker_code = $satker_code;
    }
	public function set_nmsatker($nmsatker) {
        $this->_nmsatker = $nmsatker;
    }
    public function set_kppn_code($kppn_code) {
        $this->_kppn_code = $kppn_code;
    }

    public function set_account_code($account_code) {
        $this->_account_code = $account_code;
    }

 
    public function set_line_amount($line_amount) {
        $this->_line_amount = $line_amount;
    }
	
	public function set_amount($line_amount) {
        $this->_amount = $line_amount;
    }
	
	public function set_ntpn($ntpn) {
        $this->_ntpn = $ntpn;
    }
	public function set_invoice_num($invoice_num) {
        $this->_invoice_num = $invoice_num;
    }
	public function set_tanggal($tanggal) {
        $this->_tanggal = $tanggal;
    }
	public function set_jenis_spm($jenis_spm) {
        $this->_jenis_spm = $jenis_spm;
    }
	public function set_jendok($jendok) {
        $this->_jendok = $jendok;
    }
	public function set_check_num($check_num) {
        $this->_check_num = $check_num;
    }
	public function set_tanggal_sp2d($tanggal_sp2d) {
        $this->_tanggal_sp2d = $tanggal_sp2d;
    }
	
	public function set_program_code($program_code) {
        $this->_program_code = $program_code;
    }
	
	public function set_output_code($output_code) {
        $this->_output_code = $output_code;
    }
    /*
     * getter
     */
	 
	public function get_description() {
        return $this->_description;
    }
	
	public function get_ntpn() {
        return $this->_ntpn;
    }
	
	public function get_invoice_num() {
        return $this->_invoice_num;
    }
	
	public function get_tanggal() {
        return $this->_tanggal;
    }
	
	public function get_jenis_spm() {
        return $this->_jenis_spm;
    }
	
	public function get_jendok() {
        return $this->_jendok;
    }
	
	public function get_check_num() {
        return $this->_check_num;
    }
	
	public function get_tanggal_sp2d() {
        return $this->_tanggal_sp2d;
    }
	
	
    public function get_dipa_no() {
        return $this->_dipa_no;
    }

    public function get_satker_code() {
        return $this->_satker_code;
    }
	
	public function get_nmsatker() {
        return $this->_nmsatker;
    }

    public function get_account_code() {
        return $this->_account_code;
    }
	
	public function get_program_code() {
        return $this->_program_code;
    }
	
	public function get_kppn_code() {
        return $this->_kppn_code;
    }
	
	public function get_output_code() {
        return $this->_output_code;
    }


    public function get_jenis_belanja() {
        return $this->_jenis_belanja;
    }

    public function get_line_amount() {
        return $this->_line_amount;
    }
	
	public function get_amount() {
        return $this->_amount;
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
