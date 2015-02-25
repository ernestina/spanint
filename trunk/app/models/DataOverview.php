<?php

class DataOverview {
    
    private $db;
    
    private $_ba;
    private $_realisasi;
    private $_pagu;
    private $_nmsatker;

    private $_open;
    private $_closed;
    private $_canceled;

    private $_nilai_kontrak;
    private $_pencairan;
    
    private $_table1 = 'PROSES_REVISI';
    private $_table2 = 'T_SATKER';
    private $_table3 = 'GL_BALANCES_V';
    private $_table4 = 'T_BA';
    private $_table5 = 'T_LOKASI';
    private $_table6 = 'AP_INVOICES_ALL_V';
    private $_table7 = 'ENCUMBRANCES';
    private $_table8 = 'GL_CODE_COMBINATIONS';
    
    public $registry;
    
    public function __construct($registry = Registry) {
        
        $this->db = $registry->db;
        $this->registry = $registry;
        
        if ((''.Session::get('ta')) == date("Y")) {
            $this->_table3 = 'GL_BALANCES_V';
            $this->_table2 = 'T_SATKER';
        } else {
            $this->_table3 = 'GL_BALANCES_V_TL';
            $this->_table2 = 'T_SATKER_TL';
        }
        
    }

    //Kontrak

    public function fetchStatusRealisasiKontrak($filter=null) {

        $sql = "SELECT A.SEGMENT1, 
                    SUM(B.ENCUMBERED_AMOUNT) NILAI_KONTRAK, 
                    SUM(B.EQ_AMOUNT_BILLED) PENCAIRAN 

                FROM " . $this->_table8 ." A, 
                    " . $this->_table7 ." B 

                WHERE A.CODE_COMBINATION_ID = B.CODE_COMBINATION_ID ";

        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        $sql .= "GROUP BY A.SEGMENT1";

        //echo ($sql);

        $result = $this->db->select($sql);

        $data = new $this($this->registry);
        
        foreach ($result as $val) {

            $data = new $this($this->registry);
            
            $data->set_nilai_kontrak($val['NILAI_KONTRAK']);
            $data->set_pencairan($val['PENCAIRAN']);

        }
        
        return $data;

    }


    //SPM

    public function fetchStatusAntrianSPM($filter=null) {

        $sql = "SELECT STATUS, COUNT(STATUS) JUMLAH 
                FROM " . $this->_table6 . " 
                WHERE 1=1 ";

        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        $sql .= " GROUP BY STATUS";

        //echo ($sql);

        $result = $this->db->select($sql);

        $data = new $this($this->registry);
        
        foreach ($result as $val) {
            if ($val['STATUS'] == 'OPEN') {
                $data->set_open($val['JUMLAH']);
            } else if ($val['STATUS'] == 'CLOSED') {
                $data->set_closed($val['JUMLAH']);
            } else if ($val['STATUS'] == 'CANCELLED') {
                $data->set_cancelled($val['JUMLAH']);
            }
        }
        
        return $data;

    }
    
    //Anggaran

    public function fetchRealisasiPaguBelanja($filter=null) {
        
        $sql = "SELECT SUM(A.ACTUAL_AMT) REALISASI, 
                SUM(A.BUDGET_AMT) PAGU
                FROM "
                . $this->_table3 . " A
                WHERE A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('5','6')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
                "
        ;
        
        $no = 0;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        //echo ($sql);

        $result = $this->db->select($sql);
        
        foreach ($result as $val) {

            $data = new $this($this->registry);
            
            $data->set_realisasi($val['REALISASI']);
            $data->set_pagu($val['PAGU']);

        }
        
        return $data;
        
    }

    public function sumRealisasiPenerimaan($filter=null) {
        
        $sql = "SELECT SUM(A.ACTUAL_AMT) REALISASI
                FROM "
                . $this->_table3 . " A
                WHERE A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('4')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) <> 0
                "
        ;
        
        $no = 0;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        //echo ($sql);

        $result = $this->db->select($sql);
        
        foreach ($result as $val) {
            $data = $val['REALISASI'] * -1;
        }
        
        return $data;
        
    }
    
    public function sumRealisasiBelanja($filter=null) {
        
        $sql = "SELECT SUM(A.ACTUAL_AMT) REALISASI
				FROM "
                . $this->_table3 . " A
				WHERE A.BUDGET_TYPE = '2'
				AND SUBSTR(A.BANK,1,1)  <= '9'
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND A.SUMMARY_FLAG = 'N'
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
				"
        ;
        
        $no = 0;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        //echo ($sql);

        $result = $this->db->select($sql);
        
        foreach ($result as $val) {
            $data = $val['REALISASI'];
        }
        
        return $data;
        
    }
    
    public function percentageRealisasiBelanja($filter=null) {
        
        $sql = "SELECT SUM(A.ACTUAL_AMT) REALISASI, 
                SUM(A.BUDGET_AMT) PAGU
				FROM "
                . $this->_table3 . " A
				WHERE A.BUDGET_TYPE = '2'
				AND SUBSTR(A.BANK,1,1)  <= '9'
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND A.SUMMARY_FLAG = 'N'
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
				"
        ;
        
        $no = 0;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        //echo ($sql);

        $result = $this->db->select($sql);
        
        foreach ($result as $val) {
            $data = round($val['REALISASI'] / $val['PAGU'] * 10000) / 100;
        }
        
        return $data;
        
    }
    
    public function countRevisiDalamProses($filter=null) {
        
        $sql = "SELECT COUNT(DISTINCT A.SATKER_CODE) JUMLAH
				FROM "
                . $this->_table1 . " A, "
                . $this->_table2 . " B 
				WHERE A.MEANING IS NOT NULL
				AND A.SATKER_CODE=B.KDSATKER
				";
        
        $no = 0;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }
        
        $result = $this->db->select($sql);
        
        $data = 0;
        
        foreach ($result as $val) {
            $data = $val['JUMLAH'];
        }
        
        return $data;
    }
    
    public function sumBelanjaTransferDaerah($filter=null) {
          
        $sql = "SELECT  SUM(A.ACTUAL_AMT) REALISASI
                FROM " 
                . $this->_table3 . " A, "
                . $this->_table2 . " B, "
                . $this->_table5 . " C 
                WHERE 
                SUBSTR(A.AKUN,1,1) IN ('6')
                AND SUBSTR(PROGRAM,1,5) = '99905'
                AND A.BUDGET_TYPE = '2' 
                AND A.SATKER=B.KDSATKER
                AND A.LOKASI=C.KDLOKASI
				"
        ;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        //var_dump ($sql);
        
        $result = $this->db->select($sql);
        
        $data = 0;
        
        foreach ($result as $val) {
            $data = ($val['REALISASI']);
        }
        return $data;
        
    }
    
    public function sumRealisasiTertinggiBA($filter=null) {
        
        $sql = "SELECT * FROM 
                (SELECT 
                SUBSTR(A.PROGRAM,1,3) BA,
                B.NMBA,
                SUM(NVL(A.ACTUAL_AMT,0)) REALISASI
                FROM " . $this->_table3 . " A JOIN " . $this->_table4 . " B ON SUBSTR(A.PROGRAM,1,3)=B.KDBA
                WHERE A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('5','6')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
                GROUP BY SUBSTR(A.PROGRAM,1,3), B.NMBA
                ORDER BY SUM(NVL(A.ACTUAL_AMT,0)) DESC)
                WHERE ROWNUM <= 10
				"
        ;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }
        
        //echo ($sql);

        $result = $this->db->select($sql);
        
        $data = array();
        
        foreach ($result as $val) {
            
            $d_data = new $this($this->registry);
            
            $d_data->set_ba($val['BA']);
            $d_data->set_nmsatker($val['NMBA']);
            $d_data->set_realisasi(round($val['REALISASI'] / 10000000000) / 100);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }
    
    public function percentageRealisasiTertinggiBA($filter=null) {
        
        $sql = "SELECT * FROM 
                (SELECT 
                SUBSTR(A.PROGRAM,1,3) BA,
                B.NMBA,
                SUM(NVL(A.ACTUAL_AMT,0)) REALISASI,
                SUM(NVL(A.BUDGET_AMT,0)) PAGU
                FROM " . $this->_table3 . " A JOIN " . $this->_table4 . " B ON SUBSTR(A.PROGRAM,1,3)=B.KDBA
                WHERE A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('5','6')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
                GROUP BY SUBSTR(A.PROGRAM,1,3), B.NMBA
                ORDER BY SUM(NVL(A.ACTUAL_AMT,0))/SUM(NVL(A.BUDGET_AMT,0)) DESC) WHERE ROWNUM <= 10
				"
        ;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }
        
        //echo($sql);

        $result = $this->db->select($sql);
        
        $data = array();
        
        foreach ($result as $val) {
            
            $d_data = new $this($this->registry);
            
            $d_data->set_ba($val['BA']);
            $d_data->set_nmsatker($val['NMBA']);
            $d_data->set_realisasi(round($val['REALISASI'] / $val['PAGU'] * 10000) / 100);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }
    
    public function sumRealisasiTerendahBA($filter=null) {
        
        $sql = "SELECT * FROM 
                (SELECT 
                SUBSTR(A.PROGRAM,1,3) BA,
                B.NMBA,
                SUM(NVL(A.ACTUAL_AMT,0)) REALISASI
                FROM " . $this->_table3 . " A JOIN " . $this->_table4 . " B ON SUBSTR(A.PROGRAM,1,3)=B.KDBA
                WHERE A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('5','6')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
                GROUP BY SUBSTR(A.PROGRAM,1,3), B.NMBA
                ORDER BY SUM(NVL(A.ACTUAL_AMT,0)) ASC)
                WHERE ROWNUM <= 10
				"
        ;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        $result = $this->db->select($sql);
        
        $data = array();
        
        foreach ($result as $val) {
            
            $d_data = new $this($this->registry);
            
            $d_data->set_ba($val['BA']);
            $d_data->set_nmsatker($val['NMBA']);
            $d_data->set_realisasi(round($val['REALISASI'] / 10000000000) / 100);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }
    
    public function percentageRealisasiTerendahBA($filter=null) {
        
        $sql = "SELECT * FROM 
                (SELECT 
                SUBSTR(A.PROGRAM,1,3) BA,
                B.NMBA,
                SUM(NVL(A.ACTUAL_AMT,0)) REALISASI,
                SUM(NVL(A.BUDGET_AMT,0)) PAGU
                FROM " . $this->_table3 . " A JOIN " . $this->_table4 . " B ON SUBSTR(A.PROGRAM,1,3)=B.KDBA
                WHERE A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('5','6')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
                GROUP BY SUBSTR(A.PROGRAM,1,3), B.NMBA
                ORDER BY SUM(NVL(A.ACTUAL_AMT,0))/SUM(NVL(A.BUDGET_AMT,0)) ASC) WHERE ROWNUM <= 10
                ";
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        $result = $this->db->select($sql);
        
        $data = array();
        
        foreach ($result as $val) {
            
            $d_data = new $this($this->registry);
            
            $d_data->set_ba($val['BA']);
            $d_data->set_nmsatker($val['NMBA']);
            $d_data->set_realisasi(round($val['REALISASI'] / $val['PAGU'] * 10000) / 100);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }
    
    public function sumRealisasiTertinggiSatker($filter=null) {
        
        $sql = "SELECT * FROM 
                (SELECT 
                A.SATKER,
                B.NMSATKER,
                SUM(NVL(A.ACTUAL_AMT,0)) REALISASI
                FROM " . $this->_table3 . " A JOIN " . $this->_table2 . " B ON A.SATKER=B.KDSATKER
                WHERE A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('5','6')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
                GROUP BY A.SATKER, B.NMSATKER
                ORDER BY SUM(NVL(A.ACTUAL_AMT,0)) DESC)
                WHERE ROWNUM <= 10
				"
        ;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }
        
        //echo ($sql);

        $result = $this->db->select($sql);
        
        $data = array();
        
        foreach ($result as $val) {
            
            $d_data = new $this($this->registry);
            
            $d_data->set_ba($val['SATKER']);
            $d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_realisasi(round($val['REALISASI'] / 10000000000) / 100);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }
    
    public function percentageRealisasiTertinggiSatker($filter=null) {
        
        $sql = "SELECT * FROM (SELECT * FROM
                (SELECT 
                A.SATKER, B.NMSATKER,
                SUM(NVL(A.ACTUAL_AMT,0)) REALISASI,
                SUM(NVL(A.BUDGET_AMT,0)) PAGU
                FROM " . $this->_table3 . " A JOIN " . $this->_table2 . " B ON A.SATKER=B.KDSATKER
                WHERE A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('5','6')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
                GROUP BY SATKER, NMSATKER) WHERE PAGU > 0 ORDER BY REALISASI/PAGU DESC) WHERE ROWNUM <= 10
				"
        ;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }
        
        //echo($sql);

        $result = $this->db->select($sql);
        
        $data = array();
        
        foreach ($result as $val) {
            
            $d_data = new $this($this->registry);
            
            $d_data->set_ba($val['SATKER']);
            $d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_realisasi(round($val['REALISASI'] / $val['PAGU'] * 10000) / 100);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }
    
    public function sumRealisasiTerendahSatker($filter=null) {
        
        $sql = "SELECT * FROM (SELECT * FROM
                (SELECT 
                A.SATKER,
                B.NMSATKER,
                SUM(NVL(A.ACTUAL_AMT,0)) REALISASI
                FROM " . $this->_table3 . " A JOIN " . $this->_table2 . " B ON A.SATKER=B.KDSATKER
                WHERE A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('5','6')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
                GROUP BY A.SATKER, B.NMSATKER
                ORDER BY SUM(NVL(A.ACTUAL_AMT,0)) ASC) WHERE REALISASI >= 0)
                WHERE ROWNUM <= 10
				"
        ;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }
        
        //echo ($sql);

        $result = $this->db->select($sql);
        
        $data = array();
        
        foreach ($result as $val) {
            
            $d_data = new $this($this->registry);
            
            $d_data->set_ba($val['SATKER']);
            $d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_realisasi(round($val['REALISASI'] / 10000000000) / 100);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }
    
    public function percentageRealisasiTerendahSatker($filter=null) {
        
        $sql = "SELECT * FROM (SELECT * FROM
                (SELECT 
                A.SATKER, B.NMSATKER,
                SUM(NVL(A.ACTUAL_AMT,0)) REALISASI,
                SUM(NVL(A.BUDGET_AMT,0)) PAGU
                FROM " . $this->_table3 . " A JOIN " . $this->_table2 . " B ON A.SATKER=B.KDSATKER
                WHERE A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('5','6')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
                GROUP BY SATKER, NMSATKER) WHERE PAGU > 0 AND REALISASI >= 0 ORDER BY REALISASI/PAGU ASC) WHERE ROWNUM <= 10
				"
        ;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        $result = $this->db->select($sql);
        
        $data = array();
        
        //echo($sql);
        
        foreach ($result as $val) {
            
            $d_data = new $this($this->registry);
            
            $d_data->set_ba($val['SATKER']);
            $d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_realisasi(round($val['REALISASI'] / $val['PAGU'] * 10000) / 100);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }

    //Set
    
    private function set_ba($ba) {
        $this->_ba = $ba;
    }
    
    private function set_realisasi($realisasi) {
        $this->_realisasi = $realisasi;    
    }
    
    private function set_nmsatker($nmsatker) {
        $this->_nmsatker = $nmsatker;    
    }

    private function set_open($open) {
        $this->_open = $open;    
    }

    private function set_closed($closed) {
        $this->_closed = $closed;    
    }

    private function set_pagu($pagu) {
        $this->_pagu = $pagu;    
    }

    private function set_canceled($canceled) {
        $this->_canceled = $canceled;    
    }

    private function set_nilai_kontrak($nilai_kontrak) {
        $this->_nilai_kontrak = $nilai_kontrak;    
    }

    private function set_pencairan($pencairan) {
        $this->_pencairan = $pencairan;    
    }

    //Get
    
    public function get_ba() {
        return $this->_ba;
    }
    
    public function get_realisasi() {
        return $this->_realisasi;    
    }
    
    public function get_nmsatker() {
        return $this->_nmsatker;    
    }

    public function get_open() {
        return $this->_open;    
    }

    public function get_closed() {
        return $this->_closed;    
    }

    public function get_canceled() {
        return $this->_canceled;    
    }

    public function get_pagu() {
        return $this->_pagu;    
    }

    public function get_nilai_kontrak() {
        return $this->_nilai_kontrak;    
    }

    public function get_pencairan() {
        return $this->_pencairan;    
    }
    
    public function __destruct() {
        
    }
    
}

?>