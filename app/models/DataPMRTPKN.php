<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPMRTPKN {

    private $db;
    private $_kdkppn;
    private $_upload_date;
    private $_akun;
    private $_jml_spm_diterima_16;
    private $_nilai_spm_diterima_16;
    private $_jml_spm_diterbitkan_16;
    private $_nilai_spm_diterbitkan_16;
    private $_jml_spm_dlm_proses_16;
    private $_nilai_spm_dlm_proses_16;
    private $_jml_spm_diterima_17;
    private $_nilai_spm_diterima_17;
    private $_jml_spm_diterbitkan_17;
    private $_nilai_spm_diterbitkan_17;
    private $_jml_spm_dlm_proses_17;
    private $_nilai_spm_dlm_proses_17;
    private $_jml_spm_diterima_18;
    private $_nilai_spm_diterima_18;
    private $_jml_spm_diterbitkan_18;
    private $_nilai_spm_diterbitkan_18;
    private $_jml_spm_dlm_proses_18;
    private $_nilai_spm_dlm_proses_18;
    private $_jml_spm_diterima_19;
    private $_nilai_spm_diterima_19;
    private $_jml_spm_diterbitkan_19;
    private $_nilai_spm_diterbitkan_19;
    private $_jml_spm_dlm_proses_19;
    private $_nilai_spm_dlm_proses_19;
    private $_error;
    private $_valid = TRUE;
    private $_table1 = 'SPAN_PMRT_PKN';
    private $_table2 = 'SPAN_PMRT_PKN';
    private $_table3 = 'SPAN_PMRT_PKN';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    public function get_pmrt_pkn_filter($filter) {
       /* $sql = "SELECT KDKPPN,AKUN,
                MAX(JML_SPM_DITERIMA_16) JML_SPM_DITERIMA_16, MAX(NILAI_SPM_DITERIMA_16) NILAI_SPM_DITERIMA_16, 
                MAX(JML_SPM_DITERBITKAN_16) JML_SPM_DITERBITKAN_16, MAX(NILAI_SPM_DITERBITKAN_16) NILAI_SPM_DITERBITKAN_16, 
                MAX(JML_SPM_DLM_PROSES_16) JML_SPM_DLM_PROSES_16, MAX(NILAI_SPM_DLM_PROSES_16) NILAI_SPM_DLM_PROSES_16,
                MAX(JML_SPM_DITERIMA_17) JML_SPM_DITERIMA_17, MAX(NILAI_SPM_DITERIMA_17) NILAI_SPM_DITERIMA_17, 
                MAX(JML_SPM_DITERBITKAN_17) JML_SPM_DITERBITKAN_17, MAX(NILAI_SPM_DITERBITKAN_17) NILAI_SPM_DITERBITKAN_17, 
                MAX(JML_SPM_DLM_PROSES_17) JML_SPM_DLM_PROSES_17, MAX(NILAI_SPM_DLM_PROSES_17) NILAI_SPM_DLM_PROSES_17,
                MAX(JML_SPM_DITERIMA_18) JML_SPM_DITERIMA_18, MAX(NILAI_SPM_DITERIMA_18) NILAI_SPM_DITERIMA_18, 
                MAX(JML_SPM_DITERBITKAN_18) JML_SPM_DITERBITKAN_18, MAX(NILAI_SPM_DITERBITKAN_18) NILAI_SPM_DITERBITKAN_18, 
                MAX(JML_SPM_DLM_PROSES_18) JML_SPM_DLM_PROSES_18, MAX(NILAI_SPM_DLM_PROSES_18) NILAI_SPM_DLM_PROSES_18,
                MAX(JML_SPM_DITERIMA_19) JML_SPM_DITERIMA_19, MAX(NILAI_SPM_DITERIMA_19) NILAI_SPM_DITERIMA_19, 
                MAX(JML_SPM_DITERBITKAN_19) JML_SPM_DITERBITKAN_19, MAX(NILAI_SPM_DITERBITKAN_19) NILAI_SPM_DITERBITKAN_19, 
                MAX(JML_SPM_DLM_PROSES_19) JML_SPM_DLM_PROSES_19, MAX(NILAI_SPM_DLM_PROSES_19) NILAI_SPM_DLM_PROSES_19
                from(
                
                SELECT KDKPPN, AKUN, '_16' as kolom ,
                sum(JML_SPM_DITERIMA) as JML_SPM_DITERIMA_16, sum(NILAI_SPM_DITERIMA) as NILAI_SPM_DITERIMA_16, 
                sum(JML_SPM_DITERBITKAN) as JML_SPM_DITERBITKAN_16, sum(NILAI_SPM_DITERBITKAN) as NILAI_SPM_DITERBITKAN_16, 
                sum(JML_SPM_DLM_PROSES) as JML_SPM_DLM_PROSES_16, sum(NILAI_SPM_DLM_PROSES) as NILAI_SPM_DLM_PROSES_16, 
                null as JML_SPM_DITERIMA_17, null as NILAI_SPM_DITERIMA_17, 
                null as JML_SPM_DITERBITKAN_17, null as NILAI_SPM_DITERBITKAN_17, 
                null as JML_SPM_DLM_PROSES_17, null as NILAI_SPM_DLM_PROSES_17, 
                null as JML_SPM_DITERIMA_18, null as NILAI_SPM_DITERIMA_18, 
                null as JML_SPM_DITERBITKAN_18, null as NILAI_SPM_DITERBITKAN_18, 
                null as JML_SPM_DLM_PROSES_18, null as NILAI_SPM_DLM_PROSES_18,
                null as JML_SPM_DITERIMA_19, null as NILAI_SPM_DITERIMA_19, 
                null as JML_SPM_DITERBITKAN_19, null as NILAI_SPM_DITERBITKAN_19, 
                null as JML_SPM_DLM_PROSES_19, null as NILAI_SPM_DLM_PROSES_19 
                FROM SPAN_PMRT_PKN_1 WHERE 1=1 AND KDKPPN = '".$filter."' AND KDKPPN <> '999' AND UPLOAD_DATE < '201412_17'
                GROUP BY KDKPPN,AKUN 
                UNION
                
                SELECT KDKPPN, AKUN, '_17' as kolom ,
                null as JML_SPM_DITERIMA_16, null as NILAI_SPM_DITERIMA_16, 
                null as JML_SPM_DITERBITKAN_16, null as NILAI_SPM_DITERBITKAN_16, 
                null as JML_SPM_DLM_PROSES_16, null as NILAI_SPM_DLM_PROSES_16, 
                sum(JML_SPM_DITERIMA) as JML_SPM_DITERIMA_17, sum(NILAI_SPM_DITERIMA) as NILAI_SPM_DITERIMA_17, 
                sum(JML_SPM_DITERBITKAN) as JML_SPM_DITERBITKAN_17, sum(NILAI_SPM_DITERBITKAN) as NILAI_SPM_DITERBITKAN_17, 
                sum(JML_SPM_DLM_PROSES) as JML_SPM_DLM_PROSES_17, sum(NILAI_SPM_DLM_PROSES) as NILAI_SPM_DLM_PROSES_17, 
                null as JML_SPM_DITERIMA_18, null as NILAI_SPM_DITERIMA_18, 
                null as JML_SPM_DITERBITKAN_18, null as NILAI_SPM_DITERBITKAN_18, 
                null as JML_SPM_DLM_PROSES_18, null as NILAI_SPM_DLM_PROSES_18,
                null as JML_SPM_DITERIMA_19, null as NILAI_SPM_DITERIMA_19, 
                null as JML_SPM_DITERBITKAN_19, null as NILAI_SPM_DITERBITKAN_19, 
                null as JML_SPM_DLM_PROSES_19, null as NILAI_SPM_DLM_PROSES_19 
                FROM SPAN_PMRT_PKN_1 WHERE 1=1 AND KDKPPN = '".$filter."' AND KDKPPN <> '999' AND UPLOAD_DATE = '201412_17'
                GROUP BY KDKPPN,AKUN
                UNION
                
                SELECT KDKPPN, AKUN, '_18' as kolom ,
                null as JML_SPM_DITERIMA_16, null as NILAI_SPM_DITERIMA_16, 
                null as JML_SPM_DITERBITKAN_16, null as NILAI_SPM_DITERBITKAN_16, 
                null as JML_SPM_DLM_PROSES_16, null as NILAI_SPM_DLM_PROSES_16, 
                null as JML_SPM_DITERIMA_17, null as NILAI_SPM_DITERIMA_17, 
                null as JML_SPM_DITERBITKAN_17, null as NILAI_SPM_DITERBITKAN_17, 
                null as JML_SPM_DLM_PROSES_17, null as NILAI_SPM_DLM_PROSES_17, 
                sum(JML_SPM_DITERIMA) as JML_SPM_DITERIMA_18, sum(NILAI_SPM_DITERIMA) as NILAI_SPM_DITERIMA_18, 
                sum(JML_SPM_DITERBITKAN) as JML_SPM_DITERBITKAN_18, sum(NILAI_SPM_DITERBITKAN) as NILAI_SPM_DITERBITKAN_18, 
                sum(JML_SPM_DLM_PROSES) as JML_SPM_DLM_PROSES_18, sum(NILAI_SPM_DLM_PROSES) as NILAI_SPM_DLM_PROSES_18, 
                null as JML_SPM_DITERIMA_19, null as NILAI_SPM_DITERIMA_19, 
                null as JML_SPM_DITERBITKAN_19, null as NILAI_SPM_DITERBITKAN_19, 
                null as JML_SPM_DLM_PROSES_19, null as NILAI_SPM_DLM_PROSES_19 
                FROM SPAN_PMRT_PKN_1 WHERE 1=1 AND KDKPPN = '".$filter."' AND KDKPPN <> '999' AND UPLOAD_DATE = '201412_18'
                GROUP BY KDKPPN,UPLOAD_DATE,AKUN 
                UNION
                
                SELECT KDKPPN, AKUN, '_19' as kolom,
                null as JML_SPM_DITERIMA_16, null as NILAI_SPM_DITERIMA_16, 
                null as JML_SPM_DITERBITKAN_16, null as NILAI_SPM_DITERBITKAN_16, 
                null as JML_SPM_DLM_PROSES_16, null as NILAI_SPM_DLM_PROSES_16, 
                null as JML_SPM_DITERIMA_17, null as NILAI_SPM_DITERIMA_17, 
                null as JML_SPM_DITERBITKAN_17, null as NILAI_SPM_DITERBITKAN_17, 
                null as JML_SPM_DLM_PROSES_17, null as NILAI_SPM_DLM_PROSES_17, 
                null as JML_SPM_DITERIMA_18, null as NILAI_SPM_DITERIMA_18, 
                null as JML_SPM_DITERBITKAN_18, null as NILAI_SPM_DITERBITKAN_18, 
                null as JML_SPM_DLM_PROSES_18, null as NILAI_SPM_DLM_PROSES_18,
                sum(JML_SPM_DITERIMA) as JML_SPM_DITERIMA_19, sum(NILAI_SPM_DITERIMA) as NILAI_SPM_DITERIMA_19, 
                sum(JML_SPM_DITERBITKAN) as JML_SPM_DITERBITKAN_19, sum(NILAI_SPM_DITERBITKAN) as NILAI_SPM_DITERBITKAN_19, 
                sum(JML_SPM_DLM_PROSES) as JML_SPM_DLM_PROSES_19, sum(NILAI_SPM_DLM_PROSES) as NILAI_SPM_DLM_PROSES_19
                FROM SPAN_PMRT_PKN_1 WHERE 1=1 AND KDKPPN = '".$filter."' AND KDKPPN <> '999' AND UPLOAD_DATE > '201412_18'
                GROUP BY KDKPPN,AKUN
                )
                group by KDKPPN,AKUN
                ORDER BY AKUN ";*/
        //SP2D = 140_181301002823
        //xml = 520002000990_SP2D_O_20140408_101509_367.xml
        $sql = "SELECT 
                AKUN, 
                sum(JML_SPM_DLM_PROSES_16) as JML_SPM_DLM_PROSES_16, sum(NILAI_SPM_DLM_PROSES_16) as NILAI_SPM_DLM_PROSES_16,
                sum(JML_SPM_DITERIMA_17) as JML_SPM_DITERIMA_17, sum(NILAI_SPM_DITERIMA_17) as NILAI_SPM_DITERIMA_17, 
                sum(JML_SPM_DITERBITKAN_17) as JML_SPM_DITERBITKAN_17, sum(NILAI_SPM_DITERBITKAN_17) as NILAI_SPM_DITERBITKAN_17, 
                sum(JML_SPM_DLM_PROSES_17) as JML_SPM_DLM_PROSES_17, sum(NILAI_SPM_DLM_PROSES_17) as NILAI_SPM_DLM_PROSES_17, 
                sum(JML_SPM_DITERIMA_18) as JML_SPM_DITERIMA_18, sum(NILAI_SPM_DITERIMA_18) as NILAI_SPM_DITERIMA_18, 
                sum(JML_SPM_DITERBITKAN_18) as JML_SPM_DITERBITKAN_18, sum(NILAI_SPM_DITERBITKAN_18) as NILAI_SPM_DITERBITKAN_18, 
                sum(JML_SPM_DLM_PROSES_18) as JML_SPM_DLM_PROSES_18, sum(NILAI_SPM_DLM_PROSES_18) as NILAI_SPM_DLM_PROSES_18, 
                sum(JML_SPM_DITERIMA_19) as JML_SPM_DITERIMA_19, sum(NILAI_SPM_DITERIMA_19) as NILAI_SPM_DITERIMA_19, 
                sum(JML_SPM_DITERBITKAN_19) as JML_SPM_DITERBITKAN_19, sum(NILAI_SPM_DITERBITKAN_19) as NILAI_SPM_DITERBITKAN_19, 
                sum(JML_SPM_DLM_PROSES_19) as JML_SPM_DLM_PROSES_19, sum(NILAI_SPM_DLM_PROSES_19) as NILAI_SPM_DLM_PROSES_19
                FROM ".$this->_table1." WHERE 1 = 1 ";
        
        $no = 0;
        //var_dump($filter);
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY AKUN ORDER BY AKUN ";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_akun($val['AKUN']);
            $d_data->set_jml_spm_dlm_proses_16($val['JML_SPM_DLM_PROSES_16']);
            $d_data->set_nilai_spm_dlm_proses_16($val['NILAI_SPM_DLM_PROSES_16']);
            $d_data->set_jml_spm_diterima_17($val['JML_SPM_DITERIMA_17']);
            $d_data->set_nilai_spm_diterima_17($val['NILAI_SPM_DITERIMA_17']);
            $d_data->set_jml_spm_diterbitkan_17($val['JML_SPM_DITERBITKAN_17']);
            $d_data->set_nilai_spm_diterbitkan_17($val['NILAI_SPM_DITERBITKAN_17']);
            $d_data->set_jml_spm_dlm_proses_17($val['JML_SPM_DLM_PROSES_17']);
            $d_data->set_nilai_spm_dlm_proses_17($val['NILAI_SPM_DLM_PROSES_17']);
            $d_data->set_jml_spm_diterima_18($val['JML_SPM_DITERIMA_18']);
            $d_data->set_nilai_spm_diterima_18($val['NILAI_SPM_DITERIMA_18']);
            $d_data->set_jml_spm_diterbitkan_18($val['JML_SPM_DITERBITKAN_18']);
            $d_data->set_nilai_spm_diterbitkan_18($val['NILAI_SPM_DITERBITKAN_18']);
            $d_data->set_jml_spm_dlm_proses_18($val['JML_SPM_DLM_PROSES_18']);
            $d_data->set_nilai_spm_dlm_proses_18($val['NILAI_SPM_DLM_PROSES_18']);
            $d_data->set_jml_spm_diterima_19($val['JML_SPM_DITERIMA_19']);
            $d_data->set_nilai_spm_diterima_19($val['NILAI_SPM_DITERIMA_19']);
            $d_data->set_jml_spm_diterbitkan_19($val['JML_SPM_DITERBITKAN_19']);
            $d_data->set_nilai_spm_diterbitkan_19($val['NILAI_SPM_DITERBITKAN_19']);
            $d_data->set_jml_spm_dlm_proses_19($val['JML_SPM_DLM_PROSES_19']);
            $d_data->set_nilai_spm_dlm_proses_19($val['NILAI_SPM_DLM_PROSES_19']);
            $data[] = $d_data;
			//var_dump($d_data);
        }
        return $data;
    }
    
    public function get_pmrt_pkn_nihil_filter($filter) {
        $sql = "SELECT 
                AKUN, 
                sum(JML_SPM_DLM_PROSES_16) as JML_SPM_DLM_PROSES_16, sum(NILAI_SPM_DLM_PROSES_16) as NILAI_SPM_DLM_PROSES_16,
                sum(JML_SPM_DITERIMA_17) as JML_SPM_DITERIMA_17, sum(NILAI_SPM_DITERIMA_17) as NILAI_SPM_DITERIMA_17, 
                sum(JML_SPM_DITERBITKAN_17) as JML_SPM_DITERBITKAN_17, sum(NILAI_SPM_DITERBITKAN_17) as NILAI_SPM_DITERBITKAN_17, 
                sum(JML_SPM_DLM_PROSES_17) as JML_SPM_DLM_PROSES_17, sum(NILAI_SPM_DLM_PROSES_17) as NILAI_SPM_DLM_PROSES_17, 
                sum(JML_SPM_DITERIMA_18) as JML_SPM_DITERIMA_18, sum(NILAI_SPM_DITERIMA_18) as NILAI_SPM_DITERIMA_18, 
                sum(JML_SPM_DITERBITKAN_18) as JML_SPM_DITERBITKAN_18, sum(NILAI_SPM_DITERBITKAN_18) as NILAI_SPM_DITERBITKAN_18, 
                sum(JML_SPM_DLM_PROSES_18) as JML_SPM_DLM_PROSES_18, sum(NILAI_SPM_DLM_PROSES_18) as NILAI_SPM_DLM_PROSES_18, 
                sum(JML_SPM_DITERIMA_19) as JML_SPM_DITERIMA_19, sum(NILAI_SPM_DITERIMA_19) as NILAI_SPM_DITERIMA_19, 
                sum(JML_SPM_DITERBITKAN_19) as JML_SPM_DITERBITKAN_19, sum(NILAI_SPM_DITERBITKAN_19) as NILAI_SPM_DITERBITKAN_19, 
                sum(JML_SPM_DLM_PROSES_19) as JML_SPM_DLM_PROSES_19, sum(NILAI_SPM_DLM_PROSES_19) as NILAI_SPM_DLM_PROSES_19
                FROM ".$this->_table2." WHERE 1 = 1 ";
        
        $no = 0;
        //var_dump($filter);
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY AKUN ORDER BY AKUN ";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_akun($val['AKUN']);
            $d_data->set_jml_spm_dlm_proses_16($val['JML_SPM_DLM_PROSES_16']);
            $d_data->set_nilai_spm_dlm_proses_16($val['NILAI_SPM_DLM_PROSES_16']);
            $d_data->set_jml_spm_diterima_17($val['JML_SPM_DITERIMA_17']);
            $d_data->set_nilai_spm_diterima_17($val['NILAI_SPM_DITERIMA_17']);
            $d_data->set_jml_spm_diterbitkan_17($val['JML_SPM_DITERBITKAN_17']);
            $d_data->set_nilai_spm_diterbitkan_17($val['NILAI_SPM_DITERBITKAN_17']);
            $d_data->set_jml_spm_dlm_proses_17($val['JML_SPM_DLM_PROSES_17']);
            $d_data->set_nilai_spm_dlm_proses_17($val['NILAI_SPM_DLM_PROSES_17']);
            $d_data->set_jml_spm_diterima_18($val['JML_SPM_DITERIMA_18']);
            $d_data->set_nilai_spm_diterima_18($val['NILAI_SPM_DITERIMA_18']);
            $d_data->set_jml_spm_diterbitkan_18($val['JML_SPM_DITERBITKAN_18']);
            $d_data->set_nilai_spm_diterbitkan_18($val['NILAI_SPM_DITERBITKAN_18']);
            $d_data->set_jml_spm_dlm_proses_18($val['JML_SPM_DLM_PROSES_18']);
            $d_data->set_nilai_spm_dlm_proses_18($val['NILAI_SPM_DLM_PROSES_18']);
            $d_data->set_jml_spm_diterima_19($val['JML_SPM_DITERIMA_19']);
            $d_data->set_nilai_spm_diterima_19($val['NILAI_SPM_DITERIMA_19']);
            $d_data->set_jml_spm_diterbitkan_19($val['JML_SPM_DITERBITKAN_19']);
            $d_data->set_nilai_spm_diterbitkan_19($val['NILAI_SPM_DITERBITKAN_19']);
            $d_data->set_jml_spm_dlm_proses_19($val['JML_SPM_DLM_PROSES_19']);
            $d_data->set_nilai_spm_dlm_proses_19($val['NILAI_SPM_DLM_PROSES_19']);
            $data[] = $d_data;
			//var_dump($d_data);
        }
        return $data;
    }
    
    public function get_pmrt_pkn_bun_filter($filter) {
        $sql = "SELECT 
                AKUN, 
                sum(JML_SPM_DLM_PROSES_16) as JML_SPM_DLM_PROSES_16, sum(NILAI_SPM_DLM_PROSES_16) as NILAI_SPM_DLM_PROSES_16,
                sum(JML_SPM_DITERIMA_17) as JML_SPM_DITERIMA_17, sum(NILAI_SPM_DITERIMA_17) as NILAI_SPM_DITERIMA_17, 
                sum(JML_SPM_DITERBITKAN_17) as JML_SPM_DITERBITKAN_17, sum(NILAI_SPM_DITERBITKAN_17) as NILAI_SPM_DITERBITKAN_17, 
                sum(JML_SPM_DLM_PROSES_17) as JML_SPM_DLM_PROSES_17, sum(NILAI_SPM_DLM_PROSES_17) as NILAI_SPM_DLM_PROSES_17, 
                sum(JML_SPM_DITERIMA_18) as JML_SPM_DITERIMA_18, sum(NILAI_SPM_DITERIMA_18) as NILAI_SPM_DITERIMA_18, 
                sum(JML_SPM_DITERBITKAN_18) as JML_SPM_DITERBITKAN_18, sum(NILAI_SPM_DITERBITKAN_18) as NILAI_SPM_DITERBITKAN_18, 
                sum(JML_SPM_DLM_PROSES_18) as JML_SPM_DLM_PROSES_18, sum(NILAI_SPM_DLM_PROSES_18) as NILAI_SPM_DLM_PROSES_18, 
                sum(JML_SPM_DITERIMA_19) as JML_SPM_DITERIMA_19, sum(NILAI_SPM_DITERIMA_19) as NILAI_SPM_DITERIMA_19, 
                sum(JML_SPM_DITERBITKAN_19) as JML_SPM_DITERBITKAN_19, sum(NILAI_SPM_DITERBITKAN_19) as NILAI_SPM_DITERBITKAN_19, 
                sum(JML_SPM_DLM_PROSES_19) as JML_SPM_DLM_PROSES_19, sum(NILAI_SPM_DLM_PROSES_19) as NILAI_SPM_DLM_PROSES_19
                FROM ".$this->_table3." WHERE 1 = 1 ";
        
        $no = 0;
        //var_dump($filter);
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY AKUN ORDER BY AKUN ";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_akun($val['AKUN']);
            $d_data->set_jml_spm_dlm_proses_16($val['JML_SPM_DLM_PROSES_16']);
            $d_data->set_nilai_spm_dlm_proses_16($val['NILAI_SPM_DLM_PROSES_16']);
            $d_data->set_jml_spm_diterima_17($val['JML_SPM_DITERIMA_17']);
            $d_data->set_nilai_spm_diterima_17($val['NILAI_SPM_DITERIMA_17']);
            $d_data->set_jml_spm_diterbitkan_17($val['JML_SPM_DITERBITKAN_17']);
            $d_data->set_nilai_spm_diterbitkan_17($val['NILAI_SPM_DITERBITKAN_17']);
            $d_data->set_jml_spm_dlm_proses_17($val['JML_SPM_DLM_PROSES_17']);
            $d_data->set_nilai_spm_dlm_proses_17($val['NILAI_SPM_DLM_PROSES_17']);
            $d_data->set_jml_spm_diterima_18($val['JML_SPM_DITERIMA_18']);
            $d_data->set_nilai_spm_diterima_18($val['NILAI_SPM_DITERIMA_18']);
            $d_data->set_jml_spm_diterbitkan_18($val['JML_SPM_DITERBITKAN_18']);
            $d_data->set_nilai_spm_diterbitkan_18($val['NILAI_SPM_DITERBITKAN_18']);
            $d_data->set_jml_spm_dlm_proses_18($val['JML_SPM_DLM_PROSES_18']);
            $d_data->set_nilai_spm_dlm_proses_18($val['NILAI_SPM_DLM_PROSES_18']);
            $d_data->set_jml_spm_diterima_19($val['JML_SPM_DITERIMA_19']);
            $d_data->set_nilai_spm_diterima_19($val['NILAI_SPM_DITERIMA_19']);
            $d_data->set_jml_spm_diterbitkan_19($val['JML_SPM_DITERBITKAN_19']);
            $d_data->set_nilai_spm_diterbitkan_19($val['NILAI_SPM_DITERBITKAN_19']);
            $d_data->set_jml_spm_dlm_proses_19($val['JML_SPM_DLM_PROSES_19']);
            $d_data->set_nilai_spm_dlm_proses_19($val['NILAI_SPM_DLM_PROSES_19']);
            $data[] = $d_data;
			//var_dump($d_data);
        }
        return $data;
    }
    
    
    
    public function get_pmrt_pkn_xls_filter($filter) {
        $sql = "SELECT 
                AKUN, 
                sum(JML_SPM_DLM_PROSES_16) as JML_SPM_DLM_PROSES_16, sum(NILAI_SPM_DLM_PROSES_16) as NILAI_SPM_DLM_PROSES_16,
                sum(JML_SPM_DITERIMA_17) as JML_SPM_DITERIMA_17, sum(NILAI_SPM_DITERIMA_17) as NILAI_SPM_DITERIMA_17, 
                sum(JML_SPM_DITERBITKAN_17) as JML_SPM_DITERBITKAN_17, sum(NILAI_SPM_DITERBITKAN_17) as NILAI_SPM_DITERBITKAN_17, 
                sum(JML_SPM_DLM_PROSES_17) as JML_SPM_DLM_PROSES_17, sum(NILAI_SPM_DLM_PROSES_17) as NILAI_SPM_DLM_PROSES_17, 
                sum(JML_SPM_DITERIMA_18) as JML_SPM_DITERIMA_18, sum(NILAI_SPM_DITERIMA_18) as NILAI_SPM_DITERIMA_18, 
                sum(JML_SPM_DITERBITKAN_18) as JML_SPM_DITERBITKAN_18, sum(NILAI_SPM_DITERBITKAN_18) as NILAI_SPM_DITERBITKAN_18, 
                sum(JML_SPM_DLM_PROSES_18) as JML_SPM_DLM_PROSES_18, sum(NILAI_SPM_DLM_PROSES_18) as NILAI_SPM_DLM_PROSES_18, 
                sum(JML_SPM_DITERIMA_19) as JML_SPM_DITERIMA_19, sum(NILAI_SPM_DITERIMA_19) as NILAI_SPM_DITERIMA_19, 
                sum(JML_SPM_DITERBITKAN_19) as JML_SPM_DITERBITKAN_19, sum(NILAI_SPM_DITERBITKAN_19) as NILAI_SPM_DITERBITKAN_19, 
                sum(JML_SPM_DLM_PROSES_19) as JML_SPM_DLM_PROSES_19, sum(NILAI_SPM_DLM_PROSES_19) as NILAI_SPM_DLM_PROSES_19
                FROM ".$this->_table3." WHERE 1 = 1 ";
        
        $no = 0;
        //var_dump($filter);
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY AKUN ORDER BY AKUN ";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_akun($val['AKUN']);
            $d_data->set_jml_spm_dlm_proses_16($val['JML_SPM_DLM_PROSES_16']);
            $d_data->set_nilai_spm_dlm_proses_16($val['NILAI_SPM_DLM_PROSES_16']);
            $d_data->set_jml_spm_diterima_17($val['JML_SPM_DITERIMA_17']);
            $d_data->set_nilai_spm_diterima_17($val['NILAI_SPM_DITERIMA_17']);
            $d_data->set_jml_spm_diterbitkan_17($val['JML_SPM_DITERBITKAN_17']);
            $d_data->set_nilai_spm_diterbitkan_17($val['NILAI_SPM_DITERBITKAN_17']);
            $d_data->set_jml_spm_dlm_proses_17($val['JML_SPM_DLM_PROSES_17']);
            $d_data->set_nilai_spm_dlm_proses_17($val['NILAI_SPM_DLM_PROSES_17']);
            $d_data->set_jml_spm_diterima_18($val['JML_SPM_DITERIMA_18']);
            $d_data->set_nilai_spm_diterima_18($val['NILAI_SPM_DITERIMA_18']);
            $d_data->set_jml_spm_diterbitkan_18($val['JML_SPM_DITERBITKAN_18']);
            $d_data->set_nilai_spm_diterbitkan_18($val['NILAI_SPM_DITERBITKAN_18']);
            $d_data->set_jml_spm_dlm_proses_18($val['JML_SPM_DLM_PROSES_18']);
            $d_data->set_nilai_spm_dlm_proses_18($val['NILAI_SPM_DLM_PROSES_18']);
            $d_data->set_jml_spm_diterima_19($val['JML_SPM_DITERIMA_19']);
            $d_data->set_nilai_spm_diterima_19($val['NILAI_SPM_DITERIMA_19']);
            $d_data->set_jml_spm_diterbitkan_19($val['JML_SPM_DITERBITKAN_19']);
            $d_data->set_nilai_spm_diterbitkan_19($val['NILAI_SPM_DITERBITKAN_19']);
            $d_data->set_jml_spm_dlm_proses_19($val['JML_SPM_DLM_PROSES_19']);
            $d_data->set_nilai_spm_dlm_proses_19($val['NILAI_SPM_DLM_PROSES_19']);
            $data[] = $d_data;
			//var_dump($d_data);
        }
        return $data;
    }
    
    /*
     * setter
     */

    public function set_kdkppn($kdkppn) {
        $this->_kdkppn = $kdkppn;
    }

    public function set_upload_date($upload_date) {
        $this->_upload_date = $upload_date;
    }

    public function set_akun($akun) {
        $this->_akun = $akun;
    }

    public function set_jml_spm_diterima_16($jml_spm_diterima_16) {
        $this->_jml_spm_diterima_16 = $jml_spm_diterima_16;
    }

    public function set_nilai_spm_diterima_16($nilai_spm_diterima_16) {
        $this->_nilai_spm_diterima_16 = $nilai_spm_diterima_16;
    }

    public function set_jml_spm_diterbitkan_16($jml_spm_diterbitkan_16) {
        $this->_jml_spm_diterbitkan_16 = $jml_spm_diterbitkan_16;
    }

    public function set_nilai_spm_diterbitkan_16($nilai_spm_diterbitkan_16) {
        $this->_nilai_spm_diterbitkan_16 = $nilai_spm_diterbitkan_16;
    }

    public function set_jml_spm_dlm_proses_16($jml_spm_dlm_proses_16) {
        $this->_jml_spm_dlm_proses_16 = $jml_spm_dlm_proses_16;
    }

    public function set_nilai_spm_dlm_proses_16($nilai_spm_dlm_proses_16) {
        $this->_nilai_spm_dlm_proses_16 = $nilai_spm_dlm_proses_16;
    }

    public function set_jml_spm_diterima_17($jml_spm_diterima_17) {
        $this->_jml_spm_diterima_17 = $jml_spm_diterima_17;
    }

    public function set_nilai_spm_diterima_17($nilai_spm_diterima_17) {
        $this->_nilai_spm_diterima_17 = $nilai_spm_diterima_17;
    }

    public function set_jml_spm_diterbitkan_17($jml_spm_diterbitkan_17) {
        $this->_jml_spm_diterbitkan_17 = $jml_spm_diterbitkan_17;
    }

    public function set_nilai_spm_diterbitkan_17($nilai_spm_diterbitkan_17) {
        $this->_nilai_spm_diterbitkan_17 = $nilai_spm_diterbitkan_17;
    }

    public function set_jml_spm_dlm_proses_17($jml_spm_dlm_proses_17) {
        $this->_jml_spm_dlm_proses_17 = $jml_spm_dlm_proses_17;
    }

    public function set_nilai_spm_dlm_proses_17($nilai_spm_dlm_proses_17) {
        $this->_nilai_spm_dlm_proses_17 = $nilai_spm_dlm_proses_17;
    }

    public function set_jml_spm_diterima_18($jml_spm_diterima_18) {
        $this->_jml_spm_diterima_18 = $jml_spm_diterima_18;
    }

    public function set_nilai_spm_diterima_18($nilai_spm_diterima_18) {
        $this->_nilai_spm_diterima_18 = $nilai_spm_diterima_18;
    }

    public function set_jml_spm_diterbitkan_18($jml_spm_diterbitkan_18) {
        $this->_jml_spm_diterbitkan_18 = $jml_spm_diterbitkan_18;
    }

    public function set_nilai_spm_diterbitkan_18($nilai_spm_diterbitkan_18) {
        $this->_nilai_spm_diterbitkan_18 = $nilai_spm_diterbitkan_18;
    }

    public function set_jml_spm_dlm_proses_18($jml_spm_dlm_proses_18) {
        $this->_jml_spm_dlm_proses_18 = $jml_spm_dlm_proses_18;
    }

    public function set_nilai_spm_dlm_proses_18($nilai_spm_dlm_proses_18) {
        $this->_nilai_spm_dlm_proses_18 = $nilai_spm_dlm_proses_18;
    }

    public function set_jml_spm_diterima_19($jml_spm_diterima_19) {
        $this->_jml_spm_diterima_19 = $jml_spm_diterima_19;
    }

    public function set_nilai_spm_diterima_19($nilai_spm_diterima_19) {
        $this->_nilai_spm_diterima_19 = $nilai_spm_diterima_19;
    }

    public function set_jml_spm_diterbitkan_19($jml_spm_diterbitkan_19) {
        $this->_jml_spm_diterbitkan_19 = $jml_spm_diterbitkan_19;
    }

    public function set_nilai_spm_diterbitkan_19($nilai_spm_diterbitkan_19) {
        $this->_nilai_spm_diterbitkan_19 = $nilai_spm_diterbitkan_19;
    }

    public function set_jml_spm_dlm_proses_19($jml_spm_dlm_proses_19) {
        $this->_jml_spm_dlm_proses_19 = $jml_spm_dlm_proses_19;
    }

    public function set_nilai_spm_dlm_proses_19($nilai_spm_dlm_proses_19) {
        $this->_nilai_spm_dlm_proses_19 = $nilai_spm_dlm_proses_19;
    }

    /*
     * getter
     */

    public function get_kdkppn() {
        return $this->_kdkppn;
    }

    public function get_upload_date() {
        return $this->_upload_date;
    }

    public function get_akun() {
        return $this->_akun;
    }

    public function get_jml_spm_diterima_16() {
        return $this->_jml_spm_diterima_16;
    }

    public function get_nilai_spm_diterima_16() {
        return $this->_nilai_spm_diterima_16;
    }

    public function get_jml_spm_diterbitkan_16() {
        return $this->_jml_spm_diterbitkan_16;
    }

    public function get_nilai_spm_diterbitkan_16() {
        return $this->_nilai_spm_diterbitkan_16;
    }

    public function get_jml_spm_dlm_proses_16() {
        return $this->_jml_spm_dlm_proses_16;
    }

    public function get_nilai_spm_dlm_proses_16() {
        return $this->_nilai_spm_dlm_proses_16;
    }

    public function get_jml_spm_diterima_17() {
        return $this->_jml_spm_diterima_17;
    }

    public function get_nilai_spm_diterima_17() {
        return $this->_nilai_spm_diterima_17;
    }

    public function get_jml_spm_diterbitkan_17() {
        return $this->_jml_spm_diterbitkan_17;
    }

    public function get_nilai_spm_diterbitkan_17() {
        return $this->_nilai_spm_diterbitkan_17;
    }

    public function get_jml_spm_dlm_proses_17() {
        return $this->_jml_spm_dlm_proses_17;
    }

    public function get_nilai_spm_dlm_proses_17() {
        return $this->_nilai_spm_dlm_proses_17;
    }

    public function get_jml_spm_diterima_18() {
        return $this->_jml_spm_diterima_18;
    }

    public function get_nilai_spm_diterima_18() {
        return $this->_nilai_spm_diterima_18;
    }

    public function get_jml_spm_diterbitkan_18() {
        return $this->_jml_spm_diterbitkan_18;
    }

    public function get_nilai_spm_diterbitkan_18() {
        return $this->_nilai_spm_diterbitkan_18;
    }

    public function get_jml_spm_dlm_proses_18() {
        return $this->_jml_spm_dlm_proses_18;
    }

    public function get_nilai_spm_dlm_proses_18() {
        return $this->_nilai_spm_dlm_proses_18;
    }

    public function get_jml_spm_diterima_19() {
        return $this->_jml_spm_diterima_19;
    }

    public function get_nilai_spm_diterima_19() {
        return $this->_nilai_spm_diterima_19;
    }

    public function get_jml_spm_diterbitkan_19() {
        return $this->_jml_spm_diterbitkan_19;
    }

    public function get_nilai_spm_diterbitkan_19() {
        return $this->_nilai_spm_diterbitkan_19;
    }

    public function get_jml_spm_dlm_proses_19() {
        return $this->_jml_spm_dlm_proses_19;
    }

    public function get_nilai_spm_dlm_proses_19() {
        return $this->_nilai_spm_dlm_proses_19;
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

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
