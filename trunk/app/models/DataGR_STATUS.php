<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataGR_STATUS {

    private $db;
    private $_status;
    private $_file_name;
    private $_gl_date;
    private $_bank_code;
    private $_bank_account_num;
    private $_resp_name;
    private $_keterangan;
    private $_mata_uang;
    private $_ntpn;
    private $_segment1;
    private $_segment2;
    private $_segment3;
    private $_segment4;
    private $_segment5;
    private $_segment6;
    private $_segment7;
    private $_segment8;
    private $_segment9;
    private $_segment10;
    private $_segment11;
    private $_segment12;
    private $_amount;
    private $_gr_batch_num;
    private $_table1 = 'spgr_mpn_receipts_all';
    private $_table2 = 'spgr_mpn_coa';
    private $_table3 = 'SPGR_MPN_NTPN_GANDA';
    private $_table4 = 'SPGR_MPN_NTPN_GANDA_DETAIL';
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

    public function get_gr_status_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT DISTINCT STATUS, FILE_NAME, GL_DATE, RESP_NAME, BANK_CODE, BANK_ACCOUNT_NUM,
				CASE STATUS 
				WHEN 'Validated' THEN 'Lakukan interface ulang' 
				WHEN 'Error' THEN 'Data Error, Silakan Konsultasikan dengan DTP' 
				ELSE 'Data Completed' END AS KETERANGAN 
				FROM "
                . $this->_table1 . " 
				WHERE 
				SUBSTR(RESP_NAME,1,3) = '" . Session::get('id_user') . "'  
				 AND status <> 'Reversed' "

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " ORDER BY GL_DATE DESC ";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_status($val['STATUS']);
            $d_data->set_file_name($val['FILE_NAME']);
            $d_data->set_bank_code($val['BANK_CODE']);
            $d_data->set_bank_account_num($val['BANK_ACCOUNT_NUM']);
            $d_data->set_gl_date($val['GL_DATE']);
            $d_data->set_resp_name($val['RESP_NAME']);
            $d_data->set_keterangan($val['KETERANGAN']);


            $data[] = $d_data;
        }
        return $data;
    }

    public function get_detail_lhp_rekap($filter) {
        $sql = "select status,cont_gl_date,bank_code,CONT_BANK_ACCOUNT_NUM,
				file_name,resp_name, sum(RECEIPT_DIST_AMOUNT) as RPH ,GR_BATCH_NUM
				from spgr_mpn_receipts_all 
				where Status<>'Reversed'";
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " group by status,cont_gl_date,bank_code,CONT_BANK_ACCOUNT_NUM,file_name,resp_name ,GR_BATCH_NUM
				order by status DESC";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_status($val['STATUS']);
            $d_data->set_gl_date(substr($val['CONT_GL_DATE'], 6, 2) . "-" . substr($val['CONT_GL_DATE'], 4, 2) . "-" . substr($val['CONT_GL_DATE'], 0, 4));
            $d_data->set_bank_code($val['BANK_CODE']);
            $d_data->set_bank_account_num($val['CONT_BANK_ACCOUNT_NUM']);
            $d_data->set_file_name($val['FILE_NAME']);
            $d_data->set_resp_name($val['RESP_NAME']);
            $d_data->set_keterangan($val['RPH']);
            $d_data->set_gr_batch_num($val['GR_BATCH_NUM']);

            $data[] = $d_data;
        }
        return $data;
    }

    public function get_detail_penerimaan($filter) {
        $sql = "select NTPN,NTB, CURRENCY_CODE, cont_gl_date,bank_code,CONT_BANK_ACCOUNT_NUM,
				RECEIPT_DIST_SEGMENT1, RECEIPT_DIST_SEGMENT2, RECEIPT_DIST_SEGMENT3,RECEIPT_DIST_AMOUNT as RPH  
				from spgr_mpn_receipts_all 
				where ";
        foreach ($filter as $filter) {
            $sql .= $filter;
        }
        $sql .= " order by CONT_GL_DATE, NTPN";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_status($val['NTPN']);
            $d_data->set_mata_uang($val['CURRENCY_CODE']);
            $d_data->set_file_name($val['NTB']);
            $d_data->set_gl_date(substr($val['CONT_GL_DATE'], 6, 2) . "-" . substr($val['CONT_GL_DATE'], 4, 2) . "-" . substr($val['CONT_GL_DATE'], 0, 4));
            $d_data->set_bank_code($val['BANK_CODE']);
            $d_data->set_bank_account_num($val['CONT_BANK_ACCOUNT_NUM']);
            $d_data->set_resp_name($val['RECEIPT_DIST_SEGMENT1'] . "/" . $val['RECEIPT_DIST_SEGMENT2'] . "/" . $val['RECEIPT_DIST_SEGMENT3']);
            $d_data->set_keterangan($val['RPH']);

            $data[] = $d_data;
        }
        return $data;
    }

    public function get_detail_coa_penerimaan($filter) {
        $sql = "SELECT smc.receipt_number,
						gcc.segment1,
						gcc.segment2,
						gcc.segment3,
						gcc.segment4,
						gcc.segment5,
						gcc.segment6,
						gcc.segment7,
						gcc.segment8,
						gcc.segment9,
						gcc.segment10,
						gcc.segment11,
						gcc.segment12,
						smc.currency_code,
						smc.amount_dist
						FROM GL_CODE_COMBINATIONS gcc,
						SPGR_MPN_COA smc
						WHERE smc.CODE_COMBINATION_ID=gcc.CODE_COMBINATION_ID ";
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        //$sql .= " order by CONT_GL_DATE, NTPN";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_ntpn($val['RECEIPT_NUMBER']);
            $d_data->set_segment1($val['SEGMENT1']);
            $d_data->set_segment2($val['SEGMENT2']);
            $d_data->set_segment3($val['SEGMENT3']);
            $d_data->set_mata_uang($val['CURRENCY_CODE']);
            $d_data->set_amount($val['AMOUNT_DIST']);

            $data[] = $d_data;
        }
        return $data;
    }

    public function get_konfirmasi_penerimaan($filter) {
        $sql = "SELECT * FROM "
                . $this->_table2 . "
				WHERE 1=1";

        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        //$sql .= " order by CONT_GL_DATE, NTPN";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_ntpn($val['RECEIPT_NUMBER']);
            $d_data->set_file_name($val['NTB']);
            $d_data->set_gl_date($val['TANGGAL']);
            $d_data->set_resp_name($val['NAMA']);
            $d_data->set_segment1($val['SEGMENT1']);
            $d_data->set_segment2($val['SEGMENT2']);
            $d_data->set_segment3($val['SEGMENT3']);
            $d_data->set_segment4($val['SEGMENT4']);
            $d_data->set_segment5($val['SEGMENT5']);
            $d_data->set_segment6($val['SEGMENT6']);
            $d_data->set_segment7($val['SEGMENT7']);
            $d_data->set_segment8($val['SEGMENT8']);
            $d_data->set_segment9($val['SEGMENT9']);
            $d_data->set_segment10($val['SEGMENT10']);
            $d_data->set_segment11($val['SEGMENT11']);
            $d_data->set_segment12($val['SEGMENT12']);
            $d_data->set_mata_uang($val['CURRENCY_CODE']);
            $d_data->set_amount($val['AMOUNT_DIST']);
            $d_data->set_gr_batch_num($val['NOURUT']);

            $data[] = $d_data;
        }
        return $data;
    }

	
	public function get_akun_pnbp($filter) {
        $sql = "SELECT distinct SEGMENT3, B.DESCRIPTION FROM "
				. $this->_table2. " A, T_NAMA_AKUN B
				WHERE 1=1
				AND A.SEGMENT3=B.FLEX_VALUE 
				AND SUBSTR(SEGMENT3,1,2) = '42'
				AND SEGMENT2 = '".Session::get('id_user')."'
				" ;
  
        foreach ($filter as $filter) {
            $sql .= " AND ". $filter;
        }
        $sql .= " order by SEGMENT3";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
			$d_data->set_segment3($val['SEGMENT3']);
			$d_data->set_keterangan($val['DESCRIPTION']);
            $data[] = $d_data;
        }
        return $data;
    }
	

    public function get_download_koreksi_penerimaan($ids) {
        $sql = "SELECT 

					RECEIPT_NUMBER ,
					'O' TYPE
					,TO_CHAR(TO_DATE(TANGGAL_GL,'DD-MON-YYYY'),'YYYYMMDD')TANGGAL,
					SEGMENT1,
					SEGMENT2,
					SEGMENT3,
					SEGMENT4,
					SEGMENT5,
					SEGMENT6,
					SEGMENT7,
					SEGMENT8,
					SEGMENT9,
					SEGMENT10,
					SEGMENT11,
					SEGMENT12,
					CURRENCY_CODE,
					AMOUNT_DIST *-1 AMOUNT,
					TO_CHAR(TO_DATE(TANGGAL,'DD-MON-YYYY'),'YYYYMMDD')TANGGAL2
					 FROM SPGR_MPN_COA
					 WHERE 
					 NOURUT IN ('" . $ids . "') 
					 UNION ALL
					SELECT RECEIPT_NUMBER ,'C' TYPE,TO_CHAR(TO_DATE(TANGGAL_GL,'DD-MON-YYYY'),'YYYYMMDD')TANGGAL,
					SEGMENT1,
					SEGMENT2,
					SEGMENT3,
					SEGMENT4,
					SEGMENT5,
					SEGMENT6,
					SEGMENT7,
					SEGMENT8,
					SEGMENT9,
					SEGMENT10,
					SEGMENT11,
					SEGMENT12,
					CURRENCY_CODE,
					AMOUNT_DIST AMOUNT,
					TO_CHAR(TO_DATE(TANGGAL,'DD-MON-YYYY'),'YYYYMMDD')TANGGAL2
					 FROM SPGR_MPN_COA
					 WHERE NOURUT IN ('" . $ids . "')"
        ;


        // foreach ($filter as $filter) {
        // $sql .= " AND ". $filter;
        // }
        //$sql .= " order by CONT_GL_DATE, NTPN";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_ntpn($val['RECEIPT_NUMBER']);
            $d_data->set_file_name($val['TYPE']);
            $d_data->set_gl_date($val['TANGGAL']);
            $d_data->set_segment1($val['SEGMENT1']);
            $d_data->set_segment2($val['SEGMENT2']);
            $d_data->set_segment3($val['SEGMENT3']);
            $d_data->set_segment4($val['SEGMENT4']);
            $d_data->set_segment5($val['SEGMENT5']);
            $d_data->set_segment6($val['SEGMENT6']);
            $d_data->set_segment7($val['SEGMENT7']);
            $d_data->set_segment8($val['SEGMENT8']);
            $d_data->set_segment9($val['SEGMENT9']);
            $d_data->set_segment10($val['SEGMENT10']);
            $d_data->set_segment11($val['SEGMENT11']);
            $d_data->set_segment12($val['SEGMENT12']);
            $d_data->set_mata_uang($val['CURRENCY_CODE']);
            $d_data->set_amount($val['AMOUNT']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_download_konfirmasi_penerimaan($ids, $segment1) {
        $sql = "SELECT " .
                $segment1 . " 
		RECEIPT_NUMBER,
		NTB, 
		SEGMENT3, 
		AMOUNT_DIST AMOUNT 
		FROM SPGR_MPN_COA 
		WHERE 
		NOURUT IN ('" . $ids . "')";

        // foreach ($filter as $filter) {
        // $sql .= " AND ". $filter;
        // }
        //$sql .= " order by CONT_GL_DATE, NTPN";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_ntpn($val['RECEIPT_NUMBER']);
            $d_data->set_file_name($val['NTB']);
            $d_data->set_segment1($val['SEGMENT1']);
            $d_data->set_segment3($val['SEGMENT3']);
            $d_data->set_amount($val['AMOUNT']);

            $data[] = $d_data;
        }
        return $data;
    }

    public function get_ntpn_ganda($filter) {
        $sql = "SELECT * 
		FROM SPGR_MPN_NTPN_GANDA 
		WHERE 
		1=1 ";

        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " order by NTPN";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_ntpn($val['NTPN']);
            $d_data->set_gl_date($val['TG_BUKU']);
            $d_data->set_segment1($val['BULAN']);
            $d_data->set_segment2($val['KDKPPN']);
            $d_data->set_amount($val['AMOUNT']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_detail_ntpn_ganda($filter) {
        $sql = "SELECT * 
		FROM SPGR_MPN_NTPN_GANDA_DETAIL 
		WHERE 
		1=1 ";

        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " order by NTPN";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_ntpn($val['NTPN']);
            $d_data->set_file_name($val['NTB']);
            $d_data->set_resp_name($val['NAMA']);
            $d_data->set_segment1($val['SEGMENT1']);
            $d_data->set_segment2($val['SEGMENT2']);
            $d_data->set_segment3($val['SEGMENT3']);
            $d_data->set_amount($val['AMOUNT']);
            $d_data->set_bank_account_num($val['BANK_ACCOUNT_NUM']);
            $d_data->set_gr_batch_num($val['GR_BATCH_NUM']);
            $d_data->set_file_name($val['FILE_NAME']);
            $d_data->set_status($val['STATUS']);
            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_status($status) {
        $this->_status = $status;
    }

    public function set_segment1($segment1) {
        $this->_segment1 = $segment1;
    }

    public function set_segment2($segment2) {
        $this->_segment2 = $segment2;
    }

    public function set_segment3($segment3) {
        $this->_segment3 = $segment3;
    }

    public function set_segment4($segment4) {
        $this->_segment4 = $segment4;
    }

    public function set_segment5($segment5) {
        $this->_segment5 = $segment5;
    }

    public function set_segment6($segment6) {
        $this->_segment6 = $segment6;
    }

    public function set_segment7($segment7) {
        $this->_segment7 = $segment7;
    }

    public function set_segment8($segment8) {
        $this->_segment8 = $segment8;
    }

    public function set_segment9($segment9) {
        $this->_segment9 = $segment9;
    }

    public function set_segment10($segment10) {
        $this->_segment10 = $segment10;
    }

    public function set_segment11($segment11) {
        $this->_segment11 = $segment11;
    }

    public function set_segment12($segment12) {
        $this->_segment12 = $segment12;
    }

    public function set_amount($amount) {
        $this->_amount = $amount;
    }

    public function set_ntpn($ntpn) {
        $this->_ntpn = $ntpn;
    }

    public function set_file_name($file_name) {
        $this->_file_name = $file_name;
    }

    public function set_mata_uang($mata_uang) {
        $this->_mata_uang = $mata_uang;
    }

    public function set_bank_code($bank_code) {
        $this->_bank_code = $bank_code;
    }

    public function set_bank_account_num($bank_account_num) {
        $this->_bank_account_num = $bank_account_num;
    }

    public function set_gl_date($gl_date) {
        $this->_gl_date = $gl_date;
    }

    public function set_gr_batch_num($gr_batch_num) {
        $this->_gr_batch_num = $gr_batch_num;
    }

    public function set_resp_name($resp_name) {
        $this->_resp_name = $resp_name;
    }

    public function set_keterangan($keterangan) {
        $this->_keterangan = $keterangan;
    }

    /*
     * getter
     */

    public function get_ntpn() {
        return $this->_ntpn;
    }

    public function get_segment1() {
        return $this->_segment1;
    }

    public function get_segment2() {
        return $this->_segment2;
    }

    public function get_segment3() {
        return $this->_segment3;
    }

    public function get_segment4() {
        return $this->_segment4;
    }

    public function get_segment5() {
        return $this->_segment5;
    }

    public function get_segment6() {
        return $this->_segment6;
    }

    public function get_segment7() {
        return $this->_segment7;
    }

    public function get_segment8() {
        return $this->_segment8;
    }

    public function get_segment9() {
        return $this->_segment9;
    }

    public function get_segment10() {
        return $this->_segment10;
    }

    public function get_segment11() {
        return $this->_segment11;
    }

    public function get_segment12() {
        return $this->_segment12;
    }

    public function get_amount() {
        return $this->_amount;
    }

    public function get_status() {
        return $this->_status;
    }

    public function get_file_name() {
        return $this->_file_name;
    }

    public function get_gr_batch_num() {
        return $this->_gr_batch_num;
    }

    public function get_gl_date() {
        return $this->_gl_date;
    }

    public function get_mata_uang() {
        return $this->_mata_uang;
    }

    public function get_bank_code() {
        return $this->_bank_code;
    }

    public function get_bank_account_num() {
        return $this->_bank_account_num;
    }

    public function get_resp_name() {
        return $this->_resp_name;
    }

    public function get_keterangan() {
        return $this->_keterangan;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
