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
	private $_belanja_51;
    private $_belanja_52;
    private $_belanja_53;
    private $_belanja_54;
    private $_belanja_55;
    private $_belanja_56;
    private $_belanja_57;
    private $_belanja_58;
    private $_belanja_59;
    private $_belanja_71;
    private $_belanja_61;
	private $_pagu_51;
    private $_pagu_52;
    private $_pagu_53;
    private $_pagu_54;
    private $_pagu_55;
    private $_pagu_56;
    private $_pagu_57;
    private $_pagu_58;
    private $_pagu_59;
    private $_pagu_71;
    private $_pagu_61;
	private $_ba;
	private $_pagu;
	private $_dipa;
	private $_realisasi;
    private $_table1 = 'SP3B_BLU';
	private $_table2 = 'DAFTAR_SP3B_BLU';
	private $_table3 = 'CARI_SP3B_BLU';
	private $_table4 = 'GL_BALANCES_V';
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
	
	 public function get_realisasi_blu($filter) {
        Session::get('id_user');
        $sql = "select a.satker
				, substr(a.program,1,3) BA
				, a.kppn
				, b.nmsatker
				, sum(a.budget_amt) Pagu
				, sum(a.actual_amt) Total_realisasi
				, sum(decode(substr(a.akun,1,2),'51',a.budget_amt,0)) pagu_51
				, sum(decode(substr(a.akun,1,2),'52',a.budget_amt,0)) pagu_52
				, sum(decode(substr(a.akun,1,2),'53',a.budget_amt,0)) pagu_53
				, sum(decode(substr(a.akun,1,2),'54',a.budget_amt,0)) pagu_54
				, sum(decode(substr(a.akun,1,2),'55',a.budget_amt,0)) pagu_55
				, sum(decode(substr(a.akun,1,2),'56',a.budget_amt,0)) pagu_56
				, sum(decode(substr(a.akun,1,2),'57',a.budget_amt,0)) pagu_57
				, sum(decode(substr(a.akun,1,2),'58',a.budget_amt,0)) pagu_58
				, sum(decode(substr(a.akun,1,2),'59',a.budget_amt,0)) pagu_59
				, sum(decode(substr(a.akun,1,1),'6',a.budget_amt,0)) pagu_61
				, sum(decode(substr(a.akun,1,2),'51',a.actual_amt,0)) belanja_51
				, sum(decode(substr(a.akun,1,2),'52',a.actual_amt,0)) belanja_52
				, sum(decode(substr(a.akun,1,2),'53',a.actual_amt,0)) belanja_53
				, sum(decode(substr(a.akun,1,2),'54',a.actual_amt,0)) belanja_54
				, sum(decode(substr(a.akun,1,2),'55',a.actual_amt,0)) belanja_55
				, sum(decode(substr(a.akun,1,2),'56',a.actual_amt,0)) belanja_56
				, sum(decode(substr(a.akun,1,2),'57',a.actual_amt,0)) belanja_57
				, sum(decode(substr(a.akun,1,2),'58',a.actual_amt,0)) belanja_58
				, sum(decode(substr(a.akun,1,2),'59',a.actual_amt,0)) belanja_59
				, sum(decode(substr(a.akun,1,1),'6',a.actual_amt,0)) belanja_61
				, sum(ENCUMBRANCE_AMT) encumbrance 
				FROM "
                . $this->_table4 . " a,
                t_satker_blu  b 
				where 1=1
				and a.budget_type = '2' 
				and a.satker=b.kdsatker 
				and a.kppn=b.kdkppn
				AND SUBSTR(a.akun,1,1) in ('5','6')
				and nvl(a.budget_amt,0) + nvl(a.actual_amt,0) + nvl(a.encumbrance_amt,0) > 0
				
				"
        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " group by a.satker ,b.nmsatker, a.kppn, substr(a.program,1,3) ";
        $sql .= " ORDER by a.satker ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['SATKER']);
            $d_data->set_kppn($val['KPPN']);
            $d_data->set_ba($val['BA']);
            $d_data->set_pagu($val['PAGU']);
            $d_data->set_dipa($val['NMSATKER']);
			$d_data->set_pagu_51($val['PAGU_51']);
            $d_data->set_pagu_52($val['PAGU_52']);
            $d_data->set_pagu_53($val['PAGU_53']);
            $d_data->set_pagu_54($val['PAGU_54']);
            $d_data->set_pagu_55($val['PAGU_55']);
            $d_data->set_pagu_56($val['PAGU_56']);
            $d_data->set_pagu_57($val['PAGU_57']);
            $d_data->set_pagu_58($val['PAGU_58']);
            $d_data->set_pagu_59($val['PAGU_59']);
			$d_data->set_pagu_61($val['PAGU_61']);
            $d_data->set_belanja_51($val['BELANJA_51']);
            $d_data->set_belanja_52($val['BELANJA_52']);
            $d_data->set_belanja_53($val['BELANJA_53']);
            $d_data->set_belanja_54($val['BELANJA_54']);
            $d_data->set_belanja_55($val['BELANJA_55']);
            $d_data->set_belanja_56($val['BELANJA_56']);
            $d_data->set_belanja_57($val['BELANJA_57']);
            $d_data->set_belanja_58($val['BELANJA_58']);
            $d_data->set_belanja_59($val['BELANJA_59']);
			$d_data->set_belanja_61($val['BELANJA_61']);
			$d_data->set_realisasi($val['TOTAL_REALISASI']);
            $data[] = $d_data;
        }
        return $data;
    }

	

    /*
     * setter
     */
	public function set_pagu($pagu) {
        $this->_pagu = $pagu;
    }
	public function set_realisasi($realisasi) {
        $this->_realisasi = $realisasi;
    }
	public function set_dipa($dipa) {
        $this->_dipa = $dipa;
    }
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
	public function set_pagu_51($pagu_51) {
        $this->_pagu_51 = $pagu_51;
    }

    public function set_pagu_52($pagu_52) {
        $this->_pagu_52 = $pagu_52;
    }

    public function set_pagu_53($pagu_53) {
        $this->_pagu_53 = $pagu_53;
    }

    public function set_pagu_54($pagu_54) {
        $this->_pagu_54 = $pagu_54;
    }

    public function set_pagu_55($pagu_55) {
        $this->_pagu_55 = $pagu_55;
    }

    public function set_pagu_56($pagu_56) {
        $this->_pagu_56 = $pagu_56;
    }

    public function set_pagu_57($pagu_57) {
        $this->_pagu_57 = $pagu_57;
    }

    public function set_pagu_58($pagu_58) {
        $this->_pagu_58 = $pagu_58;
    }

    public function set_pagu_59($pagu_59) {
        $this->_pagu_59 = $pagu_59;
    }

    public function set_pagu_71($pagu_71) {
        $this->_pagu_71 = $pagu_71;
    }

    public function set_pagu_61($pagu_61) {
        $this->_pagu_61 = $pagu_61;
    }

    public function set_belanja_51($belanja_51) {
        $this->_belanja_51 = $belanja_51;
    }

    public function set_belanja_52($belanja_52) {
        $this->_belanja_52 = $belanja_52;
    }

    public function set_belanja_53($belanja_53) {
        $this->_belanja_53 = $belanja_53;
    }

    public function set_belanja_54($belanja_54) {
        $this->_belanja_54 = $belanja_54;
    }

    public function set_belanja_55($belanja_55) {
        $this->_belanja_55 = $belanja_55;
    }

    public function set_belanja_56($belanja_56) {
        $this->_belanja_56 = $belanja_56;
    }

    public function set_belanja_57($belanja_57) {
        $this->_belanja_57 = $belanja_57;
    }

    public function set_belanja_58($belanja_58) {
        $this->_belanja_58 = $belanja_58;
    }

    public function set_belanja_59($belanja_59) {
        $this->_belanja_59 = $belanja_59;
    }

    public function set_belanja_71($belanja_71) {
        $this->_belanja_71 = $belanja_71;
    }

    public function set_belanja_61($belanja_61) {
        $this->_belanja_61 = $belanja_61;
    }
	public function set_ba($ba) {
        $this->_ba = $ba;
    }
	
	
    /*
     * getter
     */
	public function get_ba() {
        return $this->_ba;
    }
	public function get_realisasi() {
        return $this->_realisasi;
    }
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
	public function get_pagu_51() {
        return $this->_pagu_51;
    }

    public function get_pagu_52() {
        return $this->_pagu_52;
    }

    public function get_pagu_53() {
        return $this->_pagu_53;
    }

    public function get_pagu_54() {
        return $this->_pagu_54;
    }

    public function get_pagu_55() {
        return $this->_pagu_55;
    }

    public function get_pagu_56() {
        return $this->_pagu_56;
    }

    public function get_pagu_57() {
        return $this->_pagu_57;
    }

    public function get_pagu_58() {
        return $this->_pagu_58;
    }

    public function get_pagu_59() {
        return $this->_pagu_59;
    }

    public function get_pagu_71() {
        return $this->_pagu_71;
    }

    public function get_pagu_61() {
        return $this->_pagu_61;
    }

    public function get_belanja_51() {
        return $this->_belanja_51;
    }

    public function get_belanja_52() {
        return $this->_belanja_52;
    }

    public function get_belanja_53() {
        return $this->_belanja_53;
    }

    public function get_belanja_54() {
        return $this->_belanja_54;
    }

    public function get_belanja_55() {
        return $this->_belanja_55;
    }

    public function get_belanja_56() {
        return $this->_belanja_56;
    }

    public function get_belanja_57() {
        return $this->_belanja_57;
    }

    public function get_belanja_58() {
        return $this->_belanja_58;
    }

    public function get_belanja_59() {
        return $this->_belanja_59;
    }

    public function get_belanja_71() {
        return $this->_belanja_71;
    }

    public function get_belanja_61() {
        return $this->_belanja_61;
    }
	public function get_pagu() {
        return $this->_pagu;
    }
	public function get_dipa() {
        return $this->_dipa;
    }
	public function get_table1() {
        return $this->_table1;
    }
	public function get_table2() {
        return $this->_table2;
    }
	public function get_table3() {
        return $this->_table3;
    }
	public function get_table4() {
        return $this->_table4;
    }
    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
