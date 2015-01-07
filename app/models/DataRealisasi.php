<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataRealisasi {

    private $db;
    private $_satker;
    private $_kppn;
    private $_dipa;
    private $_ba;
    private $_nmba;
    private $_pagu;
	private $_realisasi;
    private $_lokasi;
    private $_nmlokasi;
    private $_encumbrance;
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
    private $_pagu_pembiayaan;
    private $_table1 = 'GL_BALANCES_V';
    private $_table2 = 't_satker';
    private $_table3 = 't_ba';
    private $_table4 = 't_lokasi';
    private $_table5 = 'gl_balances_transfer';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
        
        if ((''.Session::get('ta')) == date("Y")) {
            $this->_table1 = 'GL_BALANCES_V';
        } else {
            $this->_table1 = 'GL_BALANCES_V_TL';
        }
    }

    /*
     * mendapatkan data dari tabel Data Tetap
     * @param limit batas default null
     * return array objek Data Tetap */

    public function get_realisasi_fa_global_filter($filter) {
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
                . $this->_table1 . " a,"
                . $this->_table2 . " b 
				where 1=1
				and a.budget_type = '2' 
				and a.satker=b.kdsatker 
				and a.kppn=b.kppn
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
            $d_data->set_encumbrance($val['ENCUMBRANCE']);
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

    public function get_realisasi_fa_lokasi_global_filter($filter) {
        Session::get('id_user');
        $sql = "select a.satker
				, a.lokasi
				, a.kppn
				, b.nmsatker
				, sum(a.budget_amt) Pagu
				, sum(decode(substr(a.akun,1,2),'51',a.actual_amt,0)) belanja_51
				, sum(decode(substr(a.akun,1,2),'52',a.actual_amt,0)) belanja_52
				, sum(decode(substr(a.akun,1,2),'53',a.actual_amt,0)) belanja_53
				, sum(decode(substr(a.akun,1,2),'54',a.actual_amt,0)) belanja_54
				, sum(decode(substr(a.akun,1,2),'55',a.actual_amt,0)) belanja_55
				, sum(decode(substr(a.akun,1,2),'56',a.actual_amt,0)) belanja_56
				, sum(decode(substr(a.akun,1,2),'57',a.actual_amt,0)) belanja_57
				, sum(decode(substr(a.akun,1,2),'58',a.actual_amt,0)) belanja_58
				, sum(decode(substr(a.akun,1,2),'59',a.actual_amt,0)) belanja_59
				, sum(ENCUMBRANCE_AMT) encumbrance 
				FROM "
                . $this->_table1 . " a,"
                . $this->_table2 . " b 
				where 1=1
				and a.budget_type = '2' 
				and a.satker=b.kdsatker
				and a.kppn=b.kppn
				
				"
        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " group by a.satker ,b.nmsatker, a.kppn, a.lokasi ";
        $sql .= " ORDER by a.lokasi, a.satker ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['SATKER']);
            $d_data->set_kppn($val['KPPN']);
            $d_data->set_lokasi($val['LOKASI']);
            $d_data->set_pagu($val['PAGU']);
            $d_data->set_dipa($val['NMSATKER']);
            $d_data->set_encumbrance($val['ENCUMBRANCE']);
            $d_data->set_belanja_51($val['BELANJA_51']);
            $d_data->set_belanja_52($val['BELANJA_52']);
            $d_data->set_belanja_53($val['BELANJA_53']);
            $d_data->set_belanja_54($val['BELANJA_54']);
            $d_data->set_belanja_55($val['BELANJA_55']);
            $d_data->set_belanja_56($val['BELANJA_56']);
            $d_data->set_belanja_57($val['BELANJA_57']);
            $d_data->set_belanja_58($val['BELANJA_58']);
            $d_data->set_belanja_59($val['BELANJA_59']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_realisasi_fa_global_ba_filter($filter) {
        Session::get('id_user');
        $sql = "select 
				substr(a.program,1,3) BA
				, b.nmba
				, sum(a.budget_amt) Pagu
				, sum(a.actual_amt) Total_realisasi
				, sum(decode(substr(a.akun,1,2),'72',a.budget_amt,0)) pagu_pembiayaan
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
				, sum(decode(substr(a.akun,1,2),'72',a.actual_amt,0)) belanja_71
				, sum(decode(substr(a.akun,1,1),'6',a.actual_amt,0)) belanja_61
				, sum(ENCUMBRANCE_AMT) encumbrance 
				FROM "
                . $this->_table1 . " a,"
                . $this->_table3 . " b 
				where 1=1
				and a.budget_type = '2'			
				and substr(a.program,1,3)=b.kdba
				and substr(a.bank,1,1)  <= '9'
				and substr(a.akun,1,1) in ('5','6')
				and a.summary_flag = 'N'
				and nvl(a.budget_amt,0) + nvl(a.actual_amt,0) + nvl(a.encumbrance_amt,0) > 0
				"
        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " group by substr(a.program,1,3), b.nmba ";
        $sql .= " ORDER by substr(a.program,1,3) ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_nmba($val['NMBA']);
            $d_data->set_ba($val['BA']);
            $d_data->set_pagu($val['PAGU']);
            $d_data->set_encumbrance($val['ENCUMBRANCE']);
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
            $d_data->set_belanja_71($val['BELANJA_71']);
            $d_data->set_belanja_61($val['BELANJA_61']);
			$d_data->set_realisasi($val['TOTAL_REALISASI']);
            $d_data->set_pagu_pembiayaan($val['PAGU_PEMBIAYAAN']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_realisasi_lokasi($kppn = null) {
        Session::get('id_user');
        $sql = "select distinct
				a.lokasi , b.nmlokasi 
				FROM "
                . $this->_table1 . " a ,"
                . $this->_table4 . " b 
				
				where 
				substr(a.akun,1,1) in ('5','6')
				and a.lokasi=b.kdlokasi
				and a.budget_type = '2'
				and a.kppn = '" . $kppn . "' 				
				"
        ;
        //$no=0;
        //foreach ($filter as $filter) {
        //$sql .= " AND ".$filter;
        //}
        //$sql .= " group by substr(a.program,1,3), b.nmba " ;
        $sql .= " ORDER by a.lokasi ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_lokasi($val['LOKASI']);
            $d_data->set_nmlokasi($val['NMLOKASI']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_realisasi_lokasi_kanwil() {
        Session::get('id_user');
        $sql = "select distinct
				a.lokasi , b.nmlokasi 
				FROM "
                . $this->_table1 . " a ,"
                . $this->_table4 . " b 
				
				where 
				substr(a.akun,1,1) in ('5','6')
				and a.lokasi=b.kdlokasi
				and a.budget_type = '2' 				
				"
        ;
        //$no=0;
        //foreach ($filter as $filter) {
        //$sql .= " AND ".$filter;
        //}
        //$sql .= " group by substr(a.program,1,3), b.nmba " ;
        $sql .= " ORDER by a.lokasi ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_lokasi($val['LOKASI']);
            $d_data->set_nmlokasi($val['NMLOKASI']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_realisasi_satker_transfer($transfer = null) {
        Session::get('id_user');
        $sql = "select distinct
				b.kdsatker , b.nmsatker
				FROM "
                . $this->_table5 . " a ,"
                . $this->_table2 . " b 
				
				where 
				substr(a.akun,1,1) in ('6')
				and a.satker=b.kdsatker
				and a.budget_type = '2'
				 				
				"
        ;
        /* 		
          if ($transfer != '') {
          $sql .= " AND b.kppn ='".$transfer."'";
          }
          $no=0;
          foreach ($filter as $filter) {
          $sql .= " AND ".$filter;
          }

          $sql .= " group by substr(a.program,1,3), b.nmba " */;
        $sql .= " ORDER by b.kdsatker ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDSATKER']);
            $d_data->set_dipa($val['NMSATKER']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	
	public function get_nama_BA($kppn) {
       
        $sql = "SELECT DISTINCT A.* 
				FROM T_BA A, GL_BALANCES_V B
				WHERE 
				SUBSTR(B.PROGRAM,1,3)=A.KDBA
				AND B.KPPN = '".$kppn."'
				"
        ;
       
        $sql .= " ORDER by NMBA ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['NMBA']);
            $d_data->set_dipa($val['KDBA']);
            $data[] = $d_data;
        }
        return $data;
    }
	

    public function get_realisasi_satker_transfer_kanwil($transfer = null) {
        Session::get('id_user');
        $sql = "select distinct
				b.kdsatker , b.nmsatker, b.kppn 
				FROM "
                . $this->_table5 . " a ,"
                . $this->_table2 . " b 
				
				where 
				substr(a.akun,1,1) in ('6')
				and a.satker=b.kdsatker
				and a.budget_type = '2'
				and substr(b.kanwil_djpb,2,2) = '" . $transfer . "' 				
				"
        ;
        //$no=0;
        //foreach ($filter as $filter) {
        //$sql .= " AND ".$filter;
        //}
        //$sql .= " group by substr(a.program,1,3), b.nmba " ;
        $sql .= " ORDER by b.kdsatker ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDSATKER']);
            $d_data->set_dipa($val['NMSATKER']);
            $d_data->set_kppn($val['KPPN']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_realisasi_nmsatker_transfer($satker = null) {
        Session::get('id_user');
        $sql = "select distinct
				b.kdsatker , b.nmsatker, b.kppn 
				FROM "
                . $this->_table5 . " a ,"
                . $this->_table2 . " b 
				
				where 
				substr(a.akun,1,1) in ('6')
				and a.satker=b.kdsatker
				and a.budget_type = '2'
				 				
				"
        ;

        if ($satker != '') {
            $sql .= " AND A.SATKER = '" . $satker . "'";
        }
        //$no=0;
        //foreach ($filter as $filter) {
        //$sql .= " AND ".$filter;
        //}
        //$sql .= " group by substr(a.program,1,3), b.nmba " ;
        $sql .= " ORDER by b.kdsatker ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDSATKER']);
            $d_data->set_dipa($val['NMSATKER']);
            $d_data->set_kppn($val['KPPN']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_realisasi_transfer_global_filter($filter) {
        Session::get('id_user');
        $sql = "select 
				 a.kppn
				, a.lokasi
				, c.nmlokasi
				, sum(a.actual_amt) Realisasi
				, sum(decode(substr(a.akun,1,2),'61',a.actual_amt,0)) belanja_61
				, sum(decode(substr(a.akun,1,2),'62',a.actual_amt,0)) belanja_62
				, sum(decode(substr(a.akun,1,2),'63',a.actual_amt,0)) belanja_63
				, sum(decode(substr(a.akun,1,2),'64',a.actual_amt,0)) belanja_64
				, sum(decode(substr(a.akun,1,2),'65',a.actual_amt,0)) belanja_65
				, sum(decode(substr(a.akun,1,2),'66',a.actual_amt,0)) belanja_66
				, sum(decode(substr(a.akun,1,2),'67',a.actual_amt,0)) belanja_67
				, sum(decode(substr(a.akun,1,2),'68',a.actual_amt,0)) belanja_68
				, sum(decode(substr(a.akun,1,2),'69',a.actual_amt,0)) belanja_69
				FROM "
                . $this->_table1 . " a,"
                . $this->_table2 . " b, "
                . $this->_table4 . " c 
				where 
				substr(a.akun,1,1) in ('6')
				and substr(program,1,5) = '99905'
				and a.budget_type = '2' 
				and a.satker=b.kdsatker
				and a.lokasi=c.kdlokasi
				"
        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " group by a.kppn, a.lokasi, c.nmlokasi ";
        $sql .= " ORDER by a.lokasi ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['SATKER']);
            $d_data->set_kppn($val['KPPN']);
            $d_data->set_lokasi($val['LOKASI']);
            $d_data->set_nmlokasi($val['NMLOKASI']);
            $d_data->set_pagu($val['PAGU']);
            $d_data->set_dipa($val['NMSATKER']);
            $d_data->set_encumbrance($val['ENCUMBRANCE']);
            $d_data->set_realisasi($val['REALISASI']);
			$d_data->set_belanja_51($val['BELANJA_61']);
            $d_data->set_belanja_52($val['BELANJA_62']);
            $d_data->set_belanja_53($val['BELANJA_63']);
            $d_data->set_belanja_54($val['BELANJA_64']);
            $d_data->set_belanja_55($val['BELANJA_65']);
            $d_data->set_belanja_56($val['BELANJA_66']);
            $d_data->set_belanja_57($val['BELANJA_67']);
            $d_data->set_belanja_58($val['BELANJA_68']);
            $d_data->set_belanja_59($val['BELANJA_69']);
            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_nmlokasi($nmlokasi) {
        $this->_nmlokasi = $nmlokasi;
    }

    public function set_lokasi($lokasi) {
        $this->_lokasi = $lokasi;
    }

    public function set_pagu($pagu) {
        $this->_pagu = $pagu;
    }
	

    public function set_pagu_pembiayaan($pagu_pembiayaan) {
        $this->_pagu_pembiayaan = $pagu_pembiayaan;
    }

    public function set_realisasi($realisasi) {
        $this->_realisasi = $realisasi;
    }

    public function set_nmba($nmba) {
        $this->_nmba = $nmba;
    }

    public function set_satker($satker) {
        $this->_satker = $satker;
    }

    public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }

    public function set_encumbrance($encumbrance) {
        $this->_encumbrance = $encumbrance;
    }

    public function set_dipa($dipa) {
        $this->_dipa = $dipa;
    }

    public function set_ba($ba) {
        $this->_ba = $ba;
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

    /*
     * getter
     */

    public function get_realisasi() {
        return $this->_realisasi;
    }

    public function get_nmlokasi() {
        return $this->_nmlokasi;
    }

    public function get_lokasi() {
        return $this->_lokasi;
    }

    public function get_nmba() {
        return $this->_nmba;
    }

    public function get_pagu() {
        return $this->_pagu;
    }


    public function get_pagu_pembiayaan() {
        return $this->_pagu_pembiayaan;
    }

    public function get_dipa() {
        return $this->_dipa;
    }

    public function get_encumbrance() {
        return $this->_encumbrance;
    }

    public function get_satker() {
        return $this->_satker;
    }

    public function get_kppn() {
        return $this->_kppn;
    }

    public function get_ba() {
        return $this->_ba;
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

    public function get_table5() {
        return $this->_table5;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
