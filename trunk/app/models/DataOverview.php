<?php

class DataOverview {
    
    private $db;
    
    private $_ba;
    private $_realisasi;
    private $_nmsatker;
    
    private $_table1 = 'PROSES_REVISI';
    private $_table2 = 'T_SATKER';
    private $_table3 = 'GL_BALANCES_V';
    private $_table4 = 'T_BA';
    private $_table5 = 'T_LOKASI';
    
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
    
    //Anggaran
    
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
        
        $sql = "SELECT A.*, B.NMBA FROM 
                (SELECT 
                SUBSTR(PROGRAM,1,3) BA,
                SUM(ACTUAL_AMT) REALISASI
                FROM " . $this->_table3 . "
                WHERE BUDGET_TYPE = '2'
                AND SUBSTR(BANK,1,1)  <= '9'
                AND SUBSTR(AKUN,1,1) IN ('5','6')
                AND SUMMARY_FLAG = 'N'
                AND NVL(BUDGET_AMT,0) + NVL(ACTUAL_AMT,0) + NVL(ENCUMBRANCE_AMT,0) > 0
                GROUP BY SUBSTR(PROGRAM,1,3)
                ORDER BY SUM(ACTUAL_AMT) DESC) A LEFT JOIN " .$this->_table4. " B ON A.BA=B.KDBA
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
            $d_data->set_realisasi($val['REALISASI']);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }
    
    public function percentageRealisasiTertinggiBA($filter=null) {
        
        $sql = "SELECT A.*, B.NMBA FROM (SELECT * FROM
                (SELECT 
                SUBSTR(PROGRAM,1,3) BA,
                SUM(ACTUAL_AMT) REALISASI,
                SUM(BUDGET_AMT) PAGU
                FROM " . $this->_table3 . "
                WHERE BUDGET_TYPE = '2'
                AND SUBSTR(BANK,1,1)  <= '9'
                AND SUBSTR(AKUN,1,1) IN ('5','6')
                AND SUMMARY_FLAG = 'N'
                AND NVL(BUDGET_AMT,0) + NVL(ACTUAL_AMT,0) + NVL(ENCUMBRANCE_AMT,0) > 0
                GROUP BY SUBSTR(PROGRAM,1,3))
                WHERE PAGU > 0 ORDER BY REALISASI/PAGU DESC) A LEFT JOIN " .$this->_table4. " B ON A.BA=B.KDBA
                WHERE ROWNUM <= 10 ORDER BY REALISASI/PAGU DESC
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
            $d_data->set_realisasi($val['REALISASI'] / $val['PAGU'] * 100);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }
    
    public function sumRealisasiTerendahBA($filter=null) {
        
        $sql = "SELECT A.*, B.NMBA FROM 
                (SELECT 
                SUBSTR(PROGRAM,1,3) BA,
                SUM(ACTUAL_AMT) REALISASI
                FROM " . $this->_table3 . "
                WHERE BUDGET_TYPE = '2'
                AND SUBSTR(BANK,1,1)  <= '9'
                AND SUBSTR(AKUN,1,1) IN ('5','6')
                AND SUMMARY_FLAG = 'N'
                AND NVL(BUDGET_AMT,0) + NVL(ACTUAL_AMT,0) + NVL(ENCUMBRANCE_AMT,0) > 0
                GROUP BY SUBSTR(PROGRAM,1,3)
                ORDER BY SUM(ACTUAL_AMT) ASC) A LEFT JOIN " .$this->_table4. " B ON A.BA=B.KDBA
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
            $d_data->set_realisasi($val['REALISASI']);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }
    
    public function percentageRealisasiTerendahBA($filter=null) {
        
        $sql = "SELECT A.*, B.NMBA FROM (SELECT * FROM
                (SELECT 
                SUBSTR(PROGRAM,1,3) BA,
                SUM(ACTUAL_AMT) REALISASI,
                SUM(BUDGET_AMT) PAGU
                FROM " . $this->_table3 . "
                WHERE BUDGET_TYPE = '2'
                AND SUBSTR(BANK,1,1)  <= '9'
                AND SUBSTR(AKUN,1,1) IN ('5','6')
                AND SUMMARY_FLAG = 'N'
                AND NVL(BUDGET_AMT,0) + NVL(ACTUAL_AMT,0) + NVL(ENCUMBRANCE_AMT,0) > 0
                GROUP BY SUBSTR(PROGRAM,1,3))
                WHERE PAGU > 0 ORDER BY REALISASI/PAGU ASC) A LEFT JOIN " .$this->_table4. " B ON A.BA=B.KDBA
                WHERE ROWNUM <= 10 ORDER BY REALISASI/PAGU ASC";
        
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
            $d_data->set_realisasi($val['REALISASI'] / $val['PAGU'] * 100);
            
            $data[] = $d_data;
        }
        
        return $data;
        
    }
    
    private function set_ba($ba) {
        $this->_ba = $ba;
    }
    
    private function set_realisasi($realisasi) {
        $this->_realisasi = $realisasi;    
    }
    
    private function set_nmsatker($nmsatker) {
        $this->_nmsatker = $nmsatker;    
    }
    
    public function get_ba() {
        return $this->_ba;
    }
    
    public function get_realisasi() {
        return $this->_realisasi;    
    }
    
    public function get_nmsatker() {
        return $this->_nmsatker;    
    }
    
    public function __destruct() {
        
    }
    
}

?>