<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataRealisasiES1 {

    private $db;
    private $_period_name;
    private $_satker;
    private $_code_id;
    private $_kppn;
    private $_akun;
    private $_program;
    private $_output;
    private $_dana;
    private $_bank;
    private $_kewenangan;
    private $_lokasi;
    private $_budget_type;
    private $_currency_code;
    private $_budget_amt;
    private $_encumbrance_amt;
    private $_actual_amt;
    private $_balancing_amt;
    private $_nm_satker;
    private $_obligation;
    private $_block_amount;
    private $_temp_block;
    private $_cash_limit;
    private $_invoice;
    private $_table1 = 'GL_BALANCES_V';
    private $_table2 = 'T_BA';
    private $_table3 = 'T_KEGIATAN';
    private $_table4 = 'T_ESELON1';
    private $_table6 = 'T_OUTPUT';
    private $_table5 = 'T_AKUN';
    private $_table7 = 'BLOCK_REVISI';
    private $_table8= 'T_SATKER';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;

        if (('' . Session::get('ta')) == date("Y")) {
            $this->_table1 = 'GL_BALANCES_V';
            $this->_table8 = 'T_SATKER';
        } else {
            $this->_table1 = 'GL_BALANCES_V_TL';
            $this->_table8 = 't_satker_tl';
        }
    }

    /*
     * mendapatkan data dari tabel Data Tetap
     * @param limit batas default null
     * return array objek Data Tetap */





    /* ----------------------------------------------------------------------------------------------------------- contekan */

    public function get_ba_kegiatan_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(OUTPUT,1,4) KODE_KEGIATAN, C.NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  "
                . $this->_table3 . " C ON SUBSTR(A.OUTPUT,1,4)=C.KDKEGIATAN LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY SUBSTR(OUTPUT,1,4), C.NMKEGIATAN";
        $sql .= " ORDER BY SUBSTR(OUTPUT,1,4) ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_es1_kegiatan_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(OUTPUT,1,4) KODE_KEGIATAN, C.NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI, B.NMES1 , B.KDES1
				FROM "
                . $this->_table1 . " A, "
                . $this->_table4 . " B, "
                . $this->_table3 . " C 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' AND
				AND SUBSTR(A.PROGRAM,1,5)=B.KDES1
				SUBSTR(A.OUTPUT,1,4)=C.KDKEGIATAN			
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
				
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY SUBSTR(OUTPUT,1,4), C.NMKEGIATAN ,B.NMES1 , B.KDES1";
        $sql .= " ORDER BY SUBSTR(OUTPUT,1,4) ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['BUDGET_AMT']);
            $d_data->set_actual_amt($val['ACTUAL_AMT']);
            $d_data->set_nm_satker($val['NMBA']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_ba_pendapatan_filter($filter) {
        Session::get('id_user');
        $sql = " SELECT A.AKUN, A.DESCRIPTION, SUM(PAGU) PAGU	,SUM(D.TOTAL) POTONGAN, SUM(REALISASI) - NVL(SUM(D.TOTAL),0) SETORAN, SUM(REALISASI) REALISASI, A.KDBA
		FROM (
		SELECT A.SATKER, A.AKUN, C.DESCRIPTION, SUM(BUDGET_AMT) PAGU
		,  SUM(ACTUAL_AMT) * -1 REALISASI, B.BA KDBA
				FROM "
                . $this->_table1 . " A, "
                . $this->_table5 . " C , 
				( SELECT DISTINCT KDSATKER, BA, KANWIL_DJPB, BAES1 FROM " . $this->_table8 . " ) B  				
				WHERE 1=1 
				AND A.AKUN =C.FLEX_VALUE			
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) = '4'
				AND BUDGET_TYPE = '2'
				AND A.SATKER = B.KDSATKER								
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY A.AKUN, C.DESCRIPTION, B.BA, A.SATKER )A  ";
		$sql .= " LEFT JOIN
					( SELECT DISTINCT AKUN, SATKER, SUM(NILAI_ORI)TOTAL FROM SPPM_BPN WHERE SUBSTR(JENDOK_EXIS,1,1) NOT IN ('3','4','5','6') AND BUDGET = '2' GROUP BY AKUN, SATKER ) D
					ON A.SATKER = D.SATKER
					AND A.AKUN = D.AKUN ";
		 $sql .= " GROUP BY A.AKUN,  A.DESCRIPTION,  A.KDBA ";

        $sql .= " ORDER BY A.AKUN ";


        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['AKUN']);
            $d_data->set_nmkegiatan($val['DESCRIPTION']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
			$d_data->set_dana($val['POTONGAN']);
			$d_data->set_bank($val['SETORAN']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_kanwil_pendapatan_filter($filter) {
        Session::get('id_user');
        $sql = " SELECT A.AKUN, A.DESCRIPTION, SUM(PAGU) PAGU	,SUM(D.TOTAL) POTONGAN, SUM(REALISASI) - NVL(SUM(D.TOTAL),0) SETORAN, SUM(REALISASI) REALISASI
		FROM (
		SELECT A.SATKER, A.AKUN, C.DESCRIPTION, SUM(BUDGET_AMT) PAGU
		,  SUM(ACTUAL_AMT) * -1 REALISASI, B.BA KDBA
				FROM "
                . $this->_table1 . " A, "
                . $this->_table5 . " C , 
				( SELECT DISTINCT KDSATKER, BA, KANWIL_DJPB, BAES1 FROM " . $this->_table8 . " ) B  				
				WHERE 1=1 
				AND A.AKUN =C.FLEX_VALUE			
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) = '4'
				AND BUDGET_TYPE = '2'
				AND A.SATKER = B.KDSATKER								
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY A.AKUN, C.DESCRIPTION, B.BA, A.SATKER )A  ";
		$sql .= " LEFT JOIN
					( SELECT DISTINCT AKUN, SATKER, SUM(NILAI_ORI)TOTAL FROM SPPM_BPN WHERE SUBSTR(JENDOK_EXIS,1,1) NOT IN ('3','4','5','6') AND BUDGET = '2' GROUP BY AKUN, SATKER ) D
					ON A.SATKER = D.SATKER
					AND A.AKUN = D.AKUN ";
		 $sql .= " GROUP BY A.AKUN,  A.DESCRIPTION ";

        $sql .= " ORDER BY A.AKUN ";


        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['AKUN']);
            $d_data->set_nmkegiatan($val['DESCRIPTION']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
			$d_data->set_dana($val['POTONGAN']);
			$d_data->set_bank($val['SETORAN']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_ba_per_satker_pendapatan_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT C.NMSATKER, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT)* -1 REALISASI, A.SATKER, SUBSTR(PROGRAM,1,5) KDBA
				FROM "
                . $this->_table1 . " A, 
                ( SELECT DISTINCT KDSATKER, nmsatker,BA, BAES1 FROM " . $this->_table8.")  C 
				WHERE 1=1 
				AND A.SATKER =C.KDSATKER			
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(AKUN,1,1) = '4'
				AND BUDGET_TYPE = '2'
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY A.SATKER, C.NMSATKER ";
        $sql .= " ORDER BY A.SATKER ";


        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['SATKER']);
            $d_data->set_nmkegiatan($val['NMSATKER']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            
            $data[] = $d_data;
        }
        return $data;
    }
	
	
    
	public function get_ba_per_es1_pendapatan_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT C.NMES1, SUM(BUDGET_AMT) PAGU
		, SUM(ACTUAL_AMT) * -1 REALISASI, B.BAES1 KDES1
				FROM "
                . $this->_table1 . " A, "
                . $this->_table4 . " C , 
				( SELECT DISTINCT KDSATKER, BA, BAES1 FROM " . $this->_table8 . " ) B
				WHERE 1=1 
				AND B.BAES1 =C.KDES1	
				AND A.SATKER = B.KDSATKER				
				AND A.SUMMARY_FLAG = 'N' 
				AND BUDGET_TYPE = '2'
				AND SUBSTR(AKUN,1,1) = '4'
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY B.BAES1, C.NMES1 ";
        $sql .= " ORDER BY B.BAES1 ";


        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KDES1']);
            $d_data->set_nmkegiatan($val['NMES1']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_kl_per_es1satker_pendapatan_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT BAES1 KODE, C.NMES1 NAMA, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT)* -1 REALISASI 
				FROM "
                . $this->_table1 . " A, "
                . $this->_table4 . " C, 
				( SELECT DISTINCT KDSATKER, BA, BAES1 FROM " . $this->_table8 . " ) B  	
				WHERE 1=1 
							
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(AKUN,1,1) = '4'
				AND A.SATKER = B.KDSATKER
				AND BUDGET_TYPE = '2'
				AND C.KDES1 = B.BAES1
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				
				";
        $no = 0;
        foreach ($filter as $filter1) {
            $sql .= " AND " . $filter1;
        }
        $sql .= " GROUP BY BAES1, C.NMES1 ";
		$sql .= " UNION ALL ";
		$sql .= "SELECT BAES1 || '-' || A.SATKER KODE, UPPER(B.NMSATKER) NAMA, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT)* -1 REALISASI 
				FROM "
                . $this->_table1 . " A, 
                ( SELECT DISTINCT NMSATKER, KDSATKER, BA, BAES1 FROM " . $this->_table8 . " ) B 				
				WHERE 1=1 
				AND A.SATKER =B.KDSATKER			
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(AKUN,1,1) = '4'
				AND BUDGET_TYPE = '2'
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				
				";
        $no = 0;
        foreach ($filter as $filter2) {
            $sql .= " AND " . $filter2;
        }
        $sql .= " GROUP BY BAES1, A.SATKER, B.NMSATKER ";
        $sql .= " ORDER BY KODE ";
        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE']);
            $d_data->set_nmkegiatan($val['NAMA']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_kanwil_per_es1satker_pendapatan_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT BA KODE, C.NMBA NAMA, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT)* -1 REALISASI 
				FROM "
                . $this->_table1 . " A, "
                . $this->_table2 . " C, 
				( SELECT DISTINCT KDSATKER, BA,KANWIL_DJPB, BAES1 FROM " . $this->_table8 . " ) B  	
				WHERE 1=1 
							
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(AKUN,1,1) = '4'
				AND A.SATKER = B.KDSATKER
				AND BUDGET_TYPE = '2'
				AND C.KDBA = B.BA
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				
				";
        $no = 0;
        foreach ($filter as $filter1) {
            $sql .= " AND " . $filter1;
        }
        $sql .= " GROUP BY BA, C.NMBA ";
		$sql .= " UNION ALL ";
		$sql .= "SELECT BAES1 || '-' || A.SATKER KODE, UPPER(B.NMSATKER) NAMA, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT)* -1 REALISASI 
				FROM "
                . $this->_table1 . " A, 
                ( SELECT DISTINCT NMSATKER, KDSATKER, BA, KANWIL_DJPB, BAES1 FROM " . $this->_table8 . " ) B 				
				WHERE 1=1 
				AND A.SATKER =B.KDSATKER			
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(AKUN,1,1) = '4'
				AND BUDGET_TYPE = '2'
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				
				";
        $no = 0;
        foreach ($filter as $filter2) {
            $sql .= " AND " . $filter2;
        }
        $sql .= " GROUP BY BAES1, A.SATKER, B.NMSATKER ";
        $sql .= " ORDER BY KODE ";
        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE']);
            $d_data->set_nmkegiatan($val['NAMA']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            
            $data[] = $d_data;
        }
        return $data;
    }
	
/* fungsi di bawah ini dipakai juga utk eselon1 per output*/
    public function get_ba_output_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(OUTPUT,1,4) KODE_KEGIATAN, C.NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  "
                . $this->_table3 . " C ON SUBSTR(A.OUTPUT,1,4)=C.KDKEGIATAN LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
                                AND SUBSTR(A.AKUN,1,1) IN('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
				";

        foreach ($filter as $filter1) {
            $sql .= " AND " . $filter1;
        }
        $sql .= " GROUP BY SUBSTR(OUTPUT,1,4), C.NMKEGIATAN ";
        $sql .=" union all 
                SELECT OUTPUT KODE_KEGIATAN, C.NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  "
                . $this->_table6 . " C ON OUTPUT=C.KDKEGIATAN LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N'
                                AND SUBSTR(A.AKUN,1,1) IN('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
				 ";

        foreach ($filter as $filter2) {
            $sql .= " AND " . $filter2;
        }
        $sql .= " GROUP BY OUTPUT, C.NMKEGIATAN";
        $sql .= " ORDER BY kode_kegiatan ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }

    
    public function get_ba_per_es1_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(program,1,5) KODE_KEGIATAN, C.nmes1 NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  "
                . $this->_table4 . " C ON SUBSTR(A.program,1,5)=C.kdes1 LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY SUBSTR(program,1,5), C.nmes1";
        $sql .= " ORDER BY SUBSTR(program,1,5) ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }

   public function get_ba_persates1_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(program,1,5) KODE_KEGIATAN, C.nmes1||' '||d.nmba NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  "
                . $this->_table4 . " C ON SUBSTR(A.program,1,5)=C.kdes1 LEFT JOIN "
                . $this->_table2 . " D ON SUBSTR(A.program,1,3)=D.KDBA LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        foreach ($filter as $filter1) {
            $sql .= " AND " . $filter1;
        }
        $sql .= " GROUP BY SUBSTR(program,1,5), C.nmes1,d.nmba";
        $sql .=" union all 
                SELECT SUBSTR(program,1,5)||'-'||satker KODE_KEGIATAN, C.nmsatker NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  
                ( SELECT DISTINCT KDSATKER, nmsatker,BA, BAES1 FROM " . $this->_table8.") C ON A.satker=C.kdsatker LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        foreach ($filter as $filter2) {
            $sql .= " AND " . $filter2;
        }
        $sql .= " GROUP BY SUBSTR(program,1,5),satker, C.nmsatker";
        $sql .= " ORDER BY kode_kegiatan ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }
    
    public function get_ba_per_jenbel_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(akun,1,2) KODE_KEGIATAN, C.NMAKUN NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  
                R_JENBEL C ON SUBSTR(A.akun,1,2)=C.KDAKUN LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY SUBSTR(AKUN,1,2), C.NMAKUN";
        $sql .= " ORDER BY SUBSTR(AKUN,1,2) ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }
    
    public function get_ba_per_sdana_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(dana,1,1) KODE_KEGIATAN, C.deskripsi NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  
                T_SDANA C ON SUBSTR(A.dana,1,1)=C.kd_sdana LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY SUBSTR(dana,1,1), C.deskripsi";
        $sql .= " ORDER BY SUBSTR(dana,1,1) ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }
  
        public function get_ba_peres1jenbel_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(program,1,5) KODE_KEGIATAN, C.nmes1 NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  "
                . $this->_table4 . " C ON SUBSTR(A.program,1,5)=C.kdes1 LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        foreach ($filter as $filter1) {
            $sql .= " AND " . $filter1;
        }
        $sql .= " GROUP BY SUBSTR(program,1,5), C.nmes1";
        $sql .=" union all 
                SELECT SUBSTR(program,1,5)||'-'||substr(A.akun,1,2) KODE_KEGIATAN, C.nmakun NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  
                R_JENBEL C ON substr(A.akun,1,2)=C.KDAKUN LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        foreach ($filter as $filter2) {
            $sql .= " AND " . $filter2;
        }
        $sql .= " GROUP BY SUBSTR(program,1,5),SUBSTR(A.AKUN,1,2), C.NMAKUN";
        $sql .= " ORDER BY kode_kegiatan ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_ba_peres1sdana_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(program,1,5) KODE_KEGIATAN, C.nmes1 NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  "
                . $this->_table4 . " C ON SUBSTR(A.program,1,5)=C.kdes1 LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        foreach ($filter as $filter1) {
            $sql .= " AND " . $filter1;
        }
        $sql .= " GROUP BY SUBSTR(program,1,5), C.nmes1";
        $sql .=" union all 
                SELECT SUBSTR(program,1,5)||'-'||substr(A.dana,1,1) KODE_KEGIATAN, C.deskripsi NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  
                T_SDANA C ON substr(A.DANA,1,1)=C.KD_SDANA LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        foreach ($filter as $filter2) {
            $sql .= " AND " . $filter2;
        }
        $sql .= " GROUP BY SUBSTR(program,1,5),SUBSTR(A.DANA,1,1), C.DESKRIPSI";
        $sql .= " ORDER BY kode_kegiatan ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }

       public function get_es1_persat_filter($filter) {
        Session::get('id_user');
        $sql = " SELECT satker KODE_KEGIATAN, C.nmsatker NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  
                ( SELECT DISTINCT KDSATKER, nmsatker,BA, BAES1 FROM " . $this->_table8.") C ON A.satker=C.kdsatker LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        foreach ($filter as $filter2) {
            $sql .= " AND " . $filter2;
        }
        $sql .= " GROUP BY satker, C.nmsatker";
        $sql .= " ORDER BY kode_kegiatan ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_fa_es1_persatjenbel_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT satker KODE_KEGIATAN, C.nmsatker NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  
                ( SELECT DISTINCT KDSATKER, nmsatker,BA, BAES1 FROM " . $this->_table8.") C ON a.satker=C.kdsatker LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        foreach ($filter as $filter1) {
            $sql .= " AND " . $filter1;
        }
        $sql .= " GROUP BY satker, C.nmsatker";
        $sql .=" union all 
                SELECT satker||'-'||substr(A.akun,1,2) KODE_KEGIATAN, C.nmakun NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  
                R_JENBEL C ON substr(A.akun,1,2)=C.KDAKUN LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        foreach ($filter as $filter2) {
            $sql .= " AND " . $filter2;
        }
        $sql .= " GROUP BY satker,SUBSTR(A.AKUN,1,2), C.NMAKUN";
        $sql .= " ORDER BY kode_kegiatan ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }

        public function get_fa_es1_persatsdana_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT satker KODE_KEGIATAN, C.nmsatker NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  
                ( SELECT DISTINCT KDSATKER, nmsatker,BA, BAES1 FROM " . $this->_table8.") C ON a.satker=C.kdsatker LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        foreach ($filter as $filter1) {
            $sql .= " AND " . $filter1;
        }
        $sql .= " GROUP BY satker, C.nmsatker";
        $sql .=" union all 
                SELECT satker||'-'||substr(A.dana,1,1) KODE_KEGIATAN, C.deskripsi NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT+nvl(B.JMLBLOCK,0)) BLOCK_AMOUNT, SUM(BALANCING_AMT-nvl(B.JMLBLOCK,0)) BALANCING_AMT
                                FROM "
                . $this->_table1 . " A LEFT JOIN  
                T_SDANA C ON substr(A.DANA,1,1)=C.KD_SDANA LEFT JOIN "
                . $this->_table7 . " B ON  A.CODE_COMBINATION_ID=B.CCID 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
                                ";
        foreach ($filter as $filter2) {
            $sql .= " AND " . $filter2;
        }
        $sql .= " GROUP BY satker,SUBSTR(A.dana,1,1), C.deskripsi";
        $sql .= " ORDER BY kode_kegiatan ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }
    
    /*
     * setter
     */

    public function set_obligation($obligation) {
        $this->_obligation = $obligation;
    }

    public function set_block_amount($block_amont) {
        $this->_block_amount = $block_amont;
    }

    public function set_temp_block($temp_block) {
        $this->_temp_block = $temp_block;
    }

    public function set_cash_limit($cash_limit) {
        $this->_cash_limit = $cash_limit;
    }

    public function set_invoice($invoice) {
        $this->_invoice = $invoice;
    }

    public function set_satker($satker) {
        $this->_satker = $satker;
    }

    public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }

    public function set_nm_satker($nm_satker) {
        $this->_nm_satker = $nm_satker;
    }

    public function set_code_id($code_id) {
        $this->_code_id = $code_id;
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

    public function set_dana($dana) {
        $this->_dana = $dana;
    }

    public function set_bank($bank) {
        $this->_bank = $bank;
    }

    public function set_kewenangan($kewenangan) {
        $this->_kewenangan = $kewenangan;
    }

    public function set_lokasi($lokasi) {
        $this->_lokasi = $lokasi;
    }

    public function set_budget_type($budget_type) {
        $this->_budget_type = $budget_type;
    }

    public function set_currency_code($currency_code) {
        $this->_currency_code = $currency_code;
    }

    public function set_budget_amt($budget_amt) {
        $this->_budget_amt = $budget_amt;
    }

    public function set_encumbrance_amt($encumbrance_amt) {
        $this->_encumbrance_amt = $encumbrance_amt;
    }

    public function set_actual_amt($actual_amt) {
        $this->_actual_amt = $actual_amt;
    }

    public function set_balancing_amt($balancing_amt) {
        $this->_balancing_amt = $balancing_amt;
    }

    public function set_kdkegiatan($kdkegiatan) {
        $this->_kdkegiatan = $kdkegiatan;
    }

    public function set_nmkegiatan($nmkegiatan) {
        $this->_nmkegiatan = $nmkegiatan;
    }

    /*
     * getter
     */

    public function get_obligation() {
        return $this->_obligation;
    }

    public function get_block_amount() {
        return $this->_block_amount;
    }

    public function get_temp_block() {
        return $this->_temp_block;
    }

    public function get_cash_limit() {
        return $this->_cash_limit;
    }

    public function get_invoice() {
        return $this->_invoice;
    }

    public function get_nm_satker() {
        return $this->_nm_satker;
    }

    public function get_satker() {
        return $this->_satker;
    }

    public function get_code_id() {
        return $this->_code_id;
    }

    public function get_kppn() {
        return $this->_kppn;
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

    public function get_dana() {
        return $this->_dana;
    }

    public function get_bank() {
        return $this->_bank;
    }

    public function get_kewenangan() {
        return $this->_kewenangan;
    }

    public function get_lokasi() {
        return $this->_lokasi;
    }

    public function get_budget_type() {
        return $this->_budget_type;
    }

    public function get_currency_code() {
        return $this->_currency_code;
    }

    public function get_budget_amt() {
        return $this->_budget_amt;
    }

    public function get_encumbrance_amt() {
        return $this->_encumbrance_amt;
    }

    public function get_actual_amt() {
        return $this->_actual_amt;
    }

    function get_block_revisi() {
        return $this->_block_revisi;
    }

    function set_block_revisi($_block_revisi) {
        $this->_block_revisi = $_block_revisi;
    }

    public function get_balancing_amt() {
        return $this->_balancing_amt;
    }

    public function get_kdkegiatan() {
        return $this->_kdkegiatan;
    }

    public function get_nmkegiatan() {
        return $this->_nmkegiatan;
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
