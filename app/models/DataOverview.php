<?php

class DataOverview {
    
    private $db;

    private $_unit;
    
    private $_ba;
    private $_realisasi;
    private $_pagu;
    private $_nmsatker;

    private $_open;
    private $_closed;
    private $_canceled;

    private $_nilai_kontrak;
    private $_pencairan;

    private $_sisa_hari_up;
    private $_sisa_hari_tup;

    private $_retur_sudah_proses;
    private $_retur_belum_proses;

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

    private $_penerimaan_41;
    private $_penerimaan_42;

    private $_lhp_completed;
    private $_lhp_validated;
    private $_lhp_error;
    private $_lhp_etc;

    private $_vol_lhp_completed;
    private $_vol_lhp_validated;
    private $_vol_lhp_error;
    private $_vol_lhp_etc;

    private $_gaji;
    private $_non_gaji;
    private $_lainnya;
    private $_retur;
    private $_void;

    private $_nama_unit;
    private $_kode_unit;
    
    private $_table1 = 'PROSES_REVISI';
    private $_table2 = 'T_SATKER';
    private $_table3 = 'GL_BALANCES_V';
    private $_table4 = 'T_BA';
    private $_table5 = 'T_LOKASI';
    private $_table6 = 'AP_INVOICES_ALL_V';
    private $_table7 = 'ENCUMBRANCES';
    private $_table8 = 'GL_CODE_COMBINATIONS';
    private $_table9 = 'KARWAS_UP_V';
    private $_table10 = 'RETUR_SPAN_V';
    private $_table11 = 'T_KPPN';
    private $_table12 = 'KARWAS_TUP_V';
    private $_table13 = 'AP_CHECKS_ALL_V';
    
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

    //Helpers

    public function fetchNamaUnit($mode, $references) {

        if ($mode == 1) { //Satker

            $sql = "SELECT KDSATKER KODE_UNIT, NMSATKER NAMA_UNIT FROM " . $this->_table2 . " WHERE KDSATKER IN (";

        } else if ($mode == 2) { //KPPN

            $sql = "SELECT KDKPPN KODE_UNIT, NMKPPN NAMA_UNIT FROM T_KPPN WHERE KDKPPN IN (";

        } else if ($mode == 3) { //Kanwil

            $sql = "SELECT KDKANWIL KODE_UNIT, NMKANWIL NAMA_UNIT FROM T_KANWIL WHERE KDKANWIL IN (";

        } else if ($mode == 4) { //ES1

            $sql = "SELECT KDES1 KODE_UNIT, NMES1 NAMA_UNIT FROM T_ESELON1 WHERE KDES1 IN (";

        } else { //BA

            $sql = "SELECT KDBA KODE_UNIT, NMBA NAMA_UNIT FROM T_BA WHERE KDBA IN (";

        }

        foreach ($references as $rid=>$reference) {

            if ($rid > 0) { $sql .= ", "; }

            $sql .= "'" . $reference . "'";

        }

        $sql .= ")";

        $result = $this->db->select($sql);

        $d_data = array();
        
        foreach ($result as $val) {

            $data = new $this($this->registry);

            $data->set_kode_unit($val['KODE_UNIT']);        
            $data->set_nama_unit($val['NAMA_UNIT']);

            $d_data[] = $data;

        }
        
        return $d_data;

    }

    //Details

    public function fetchRealisasiPaguBelanjaPerUnitBAES1($mode, $sort, $filter=null) {
        
        if ($mode == 1) {

            $guide = 'B.KDSATKER';

        } else if ($mode == 2) {

            $guide = 'B.BAES1';

        } else if ($mode == 3) {

            $guide = 'B.BA';

        }

        $sql = "SELECT * FROM (SELECT " . $guide .",  SUM(A.ACTUAL_AMT) REALISASI, 
                SUM(A.BUDGET_AMT) PAGU
                FROM "
                . $this->_table3 . " A, "
                . $this->_table2. " B 
                WHERE A.SATKER = B.KDSATKER
                AND A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('5','6')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
                AND NVL(A.ACTUAL_AMT,0) > 0 AND NVL(A.BUDGET_AMT,0) > 0
                "
        ;
        
        $no = 0;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        $sql .= ' GROUP BY ' . $guide;

        if ($sort == 1) {

            $sql .= ' ORDER BY (SUM(A.ACTUAL_AMT)/SUM(A.BUDGET_AMT)) DESC) WHERE ROWNUM < 11';

        } else {

            $sql .= ' ORDER BY (SUM(A.ACTUAL_AMT)/SUM(A.BUDGET_AMT)) ASC) WHERE ROWNUM < 11';

        }

        //echo ($sql);

        $result = $this->db->select($sql);

        $d_data = array();
        
        foreach ($result as $val) {

            $data = new $this($this->registry);

            //echo(substr($guide,2,99));

            $data->set_unit($val[substr($guide,2,99)]);        
            $data->set_realisasi($val['REALISASI']);
            $data->set_pagu($val['PAGU']);

            $d_data[] = $data;

        }
        
        return $d_data;
        
    }

    public function fetchRealisasiPaguBelanjaPerUnitAll($mode, $filter=null) {
        
        if ($mode == 1) {

            $guide = 'SATKER';

        } else if ($mode == 2) {

            $guide = 'KPPN';

        } else if ($mode == 3) {

            $guide = 'KANWIL';

        }

        $sql = "SELECT " . $guide .",  SUM(A.ACTUAL_AMT) REALISASI, 
                SUM(A.BUDGET_AMT) PAGU
                FROM "
                . $this->_table3 . " A
                WHERE A.BUDGET_TYPE = '2'
                AND SUBSTR(A.BANK,1,1)  <= '9'
                AND SUBSTR(A.AKUN,1,1) IN ('5','6')
                AND A.SUMMARY_FLAG = 'N'
                AND NVL(A.BUDGET_AMT,0) + NVL(A.ACTUAL_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) > 0
                AND NVL(A.ACTUAL_AMT,0) > 0 AND NVL(A.BUDGET_AMT,0) > 0
                "
        ;
        
        $no = 0;
        
        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        $sql .= ' GROUP BY ' . $guide;

        $sql .= ' ORDER BY ' . $guide;
        //echo ($sql);

        $result = $this->db->select($sql);

        $d_data = array();
        
        foreach ($result as $val) {

            $data = new $this($this->registry);

            $data->set_unit($val[$guide]);        
            $data->set_realisasi($val['REALISASI']);
            $data->set_pagu($val['PAGU']);

            $d_data[] = $data;

        }
        
        return $d_data;
        
    }

    public function fetchRealisasiPaguBelanjaPerUnit($mode, $sort, $filter=null) {
        
        if ($mode == 1) {

            $guide = 'SATKER';

        } else if ($mode == 2) {

            $guide = 'KPPN';

        } else if ($mode == 3) {

            $guide = 'KANWIL';

        }

        $sql = "SELECT * FROM (SELECT * FROM (SELECT " . $guide .",  SUM(A.ACTUAL_AMT) REALISASI, 
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

        $sql .= ' GROUP BY ' . $guide;

        if ($sort == 1) {

            $sql .= ' ) WHERE NVL(PAGU,0) > 0 AND NVL(REALISASI,0) > 0 ORDER BY REALISASI/PAGU DESC) WHERE ROWNUM < 11';

        } else {

            $sql .= ' ) WHERE NVL(PAGU,0) > 0 AND NVL(REALISASI,0) > 0 ORDER BY REALISASI/PAGU ASC) WHERE ROWNUM < 11';

        }

        //echo ($sql);

        $result = $this->db->select($sql);

        $d_data = array();

        $i = 0;
        
        foreach ($result as $val) {

            $data = new $this($this->registry);

            $data->set_unit($val[$guide]);        
            $data->set_realisasi($val['REALISASI']);
            $data->set_pagu($val['PAGU']);

            $d_data[] = $data;

        }
        
        return $d_data;
        
    }

    public function get_realisasi_numbers_dash_filter($filter=null) {
        
        $sql = "select sum(decode(substr(a.akun,1,2),'51',a.actual_amt,0)) belanja_51
                , sum(decode(substr(a.akun,1,2),'52',a.actual_amt,0)) belanja_52
                , sum(decode(substr(a.akun,1,2),'53',a.actual_amt,0)) belanja_53
                , sum(decode(substr(a.akun,1,2),'54',a.actual_amt,0)) belanja_54
                , sum(decode(substr(a.akun,1,2),'55',a.actual_amt,0)) belanja_55
                , sum(decode(substr(a.akun,1,2),'56',a.actual_amt,0)) belanja_56
                , sum(decode(substr(a.akun,1,2),'57',a.actual_amt,0)) belanja_57
                , sum(decode(substr(a.akun,1,2),'58',a.actual_amt,0)) belanja_58
                , sum(decode(substr(a.akun,1,2),'59',a.actual_amt,0)) belanja_59
                , sum(decode(substr(a.akun,1,1),'6',a.actual_amt,0)) belanja_61
                , sum(decode(substr(a.akun,1,2),'41',a.actual_amt,0)) penerimaan_41
                , sum(decode(substr(a.akun,1,2),'42',a.actual_amt,0)) penerimaan_42
                FROM "
                . $this->_table3 . " a,"
                . $this->_table2 . " b 
                where 1=1
                and a.budget_type = '2' 
                and a.satker=b.kdsatker 
                and a.kppn=b.kppn
                AND SUBSTR(a.akun,1,1) in ('4','5','6')
                and nvl(a.budget_amt,0) + nvl(a.actual_amt,0) + nvl(a.encumbrance_amt,0) <> 0
                
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
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);

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

            $d_data->set_penerimaan_41($val['PENERIMAAN_41']);
            $d_data->set_penerimaan_42($val['PENERIMAAN_42']);

            $data[] = $d_data;
        }

        return $data;

    }

    public function get_realisasi_dash_filter($filter=null) {
        Session::get('id_user');
        $sql = "select sum(decode(substr(a.akun,1,2),'51',a.budget_amt,0)) pagu_51
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
                FROM "
                . $this->_table3 . " a,"
                . $this->_table2 . " b 
                where 1=1
                and a.budget_type = '2' 
                and a.satker=b.kdsatker 
                and a.kppn=b.kppn
                AND SUBSTR(a.akun,1,1) in ('5','6')
                and nvl(a.budget_amt,0) + nvl(a.actual_amt,0) + nvl(a.encumbrance_amt,0) <> 0
                
                "
        ;

        $no = 0;

        if (isset($filter)) {

            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }

        }

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);

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

            $data[] = $d_data;
        }
        return $data;
    }

    //LHP

    public function get_lhp_rekap($hari, $unitfilter = null) {
        $data = array();
        for ($i = 0; $i < $hari; $i++) {

            if (!isset($unitfilter)) {
                if ($hari == 1) {
                    $sql = "select to_char(tanggal, 'DD-MM-YYYY') tanggal, jumlah, nominal, status from spgr_mpn_dashboard where kppn = '" . Session::get('id_user') . "' and tanggal=(select max(tanggal) from spgr_mpn_dashboard where kppn = '" . Session::get('id_user') . "')";
                } else {
                    $sql = "select to_char(tanggal, 'DD-MM-YYYY') tanggal, jumlah, nominal, status from spgr_mpn_dashboard where kppn = '" . Session::get('id_user') . "' and tanggal = to_date('" . date("Ymd", time() - ($i * 24 * 60 * 60)) . "','yyyymmdd')";
                }
            } else {
                if ($hari == 1) {
                    $sql = "select to_char(tanggal, 'DD-MM-YYYY') tanggal, jumlah, nominal, status from spgr_mpn_dashboard where " . $unitfilter . " and tanggal=(select * from (select * from (select tanggal from spgr_mpn_dashboard where " . $unitfilter . " order by tanggal desc) where rownum < 3 order by tanggal asc) where rownum < 2)";
                } else {
                    $sql = "select to_char(tanggal, 'DD-MM-YYYY') tanggal, jumlah, nominal, status from spgr_mpn_dashboard where " . $unitfilter . " and tanggal = to_date('" . date("Ymd", time() - ($i * 24 * 60 * 60)) . "','yyyymmdd')";
                }
            }

            //echo($sql);

            $result = $this->db->select($sql);
            $d_data = new $this($this->registry);
            //var_dump($result);

            $d_data->set_tgl_lhp(0);
            $d_data->set_lhp_completed(0);
            $d_data->set_vol_lhp_completed(0);
            $d_data->set_lhp_validated(0);
            $d_data->set_vol_lhp_validated(0);
            $d_data->set_lhp_error(0);
            $d_data->set_vol_lhp_error(0);
            $d_data->set_lhp_etc(0);
            $d_data->set_vol_lhp_etc(0);

            foreach ($result as $val) {
                $d_data->set_tgl_lhp($val['TANGGAL']);
                if ($val['STATUS'] == 'Completed') {
                    $d_data->set_lhp_completed($d_data->get_lhp_completed() + $val['JUMLAH']);
                    $d_data->set_vol_lhp_completed($d_data->get_vol_lhp_completed() + $val['NOMINAL']);
                } else if ($val['STATUS'] == 'Validated') {
                    $d_data->set_lhp_validated($d_data->get_lhp_validated() + $val['JUMLAH']);
                    $d_data->set_vol_lhp_validated($d_data->get_vol_lhp_validated() + $val['NOMINAL']);
                } else if ($val['STATUS'] == 'Error') {
                    $d_data->set_lhp_error($d_data->get_lhp_error() + $val['JUMLAH']);
                    $d_data->set_vol_lhp_error($d_data->get_vol_lhp_error() + $val['NOMINAL']);
                } else {
                    $d_data->set_lhp_etc($d_data->get_lhp_etc() + $val['JUMLAH']);
                    $d_data->set_vol_lhp_etc($d_data->get_vol_lhp_etc() + $val['NOMINAL']);
                }
            }
            $data[$i] = $d_data;
        }

        //var_dump($data);

        return $data;
    }

    //SP2D

    public function fetchRekapSP2DTahunIni($filter = null) {
        
        $sql = "select status_lookup_code, jenis_sp2d, count(check_number) jumlah from (select distinct(check_number), status_lookup_code, jenis_sp2d, amount, segment1 from (select kdkppn, check_number, status_lookup_code, jenis_sp2d, amount, exchange_rate, check_date, segment1 from " . $this->_table13 . " where TO_CHAR(CHECK_DATE,'YYYY') = '" . Session::get('ta') . "') where 1=1 "; 

        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        $sql .= ") group by status_lookup_code, jenis_sp2d";

        //echo($sql);
        $result = $this->db->select($sql);
        //var_dump($result);
        $d_data = new $this($this->registry);

        $d_data->set_void(0);
        $d_data->set_gaji(0);
        $d_data->set_non_gaji(0);
        $d_data->set_retur(0);
        $d_data->set_lainnya(0);

        foreach ($result as $val) {
            if ($val['STATUS_LOOKUP_CODE'] == 'VOIDED') {
                $d_data->set_void($d_data->get_void() + $val['JUMLAH']);
            } else {
                if ($val['JENIS_SP2D'] == 'GAJI') {
                    $d_data->set_gaji($d_data->get_gaji() + $val['JUMLAH']);
                } else if ($val['JENIS_SP2D'] == 'NON GAJI') {
                    $d_data->set_non_gaji($d_data->get_non_gaji() + $val['JUMLAH']);
                } else if ($val['JENIS_SP2D'] == 'RETUR') {
                    $d_data->set_retur($d_data->get_retur() + $val['JUMLAH']);
                } else {
                    $d_data->set_lainnya($d_data->get_lainnya() + $val['JUMLAH']);
                }
            }
        }
        //var_dump($data);
        return $d_data;
    }

    public function fetchStatusRetur($filter=null) {

        $sql = "SELECT      STATUS_RETUR,
                            COUNT(STATUS_RETUR) JUMLAH
                FROM        " . $this->_table10 . " 
                WHERE 1=1 ";

        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }

        $sql .= " GROUP BY STATUS_RETUR ";

        //echo($sql);

        $result = $this->db->select($sql);

        $data = new $this($this->registry);

        $data->set_retur_sudah_proses(0);
        $data->set_retur_belum_proses(0);
        
        foreach ($result as $val) {

            if ($val["STATUS_RETUR"] == "SUDAH PROSES") {
                $data->set_retur_sudah_proses($data->get_retur_sudah_proses() + $val["JUMLAH"]);
            } else {
                $data->set_retur_belum_proses($data->get_retur_belum_proses() + $val["JUMLAH"]);
            }

        }
        
        return $data;

    }

    //UP

    public function fetchTimerUP($filter=null) {

        $sql = "SELECT (TO_DATE(BATAS_TEGURAN, 'DD-MM-YYYY') - TO_DATE('20150302', 'YYYYMMDD')) SISA_HARI
                FROM " . $this->_table9 . " 
                WHERE 1=1 ";

        $sql2 = "SELECT SISA_HARI 
                 FROM " . $this->_table12 . " 
                 WHERE SISA > 0 ";

        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
                $sql2 .= " AND " . $filter;
            }
        }

        $result = $this->db->select($sql);
        $result2 = $this->db->select($sql2);

        $data = new $this($this->registry);
        
        foreach ($result as $val) {
            $data->set_sisa_hari_up($val["SISA_HARI"]);
        }

        foreach ($result2 as $val) {
            $data->set_sisa_hari_tup($val["SISA_HARI"]);
        }

        //var_dump($data);
        
        return $data;

    }

    //Kontrak

    public function fetchStatusRealisasiKontrak($filter=null) {

        $sql = "SELECT 
                    SUM(B.ENCUMBERED_AMOUNT) NILAI_KONTRAK, 
                    SUM(B.EQ_AMOUNT_BILLED) PENCAIRAN 

                FROM " . $this->_table8 ." A, 
                    " . $this->_table7 ." B 

                WHERE A.CODE_COMBINATION_ID = B.CODE_COMBINATION_ID 
                AND NEED_BY_DATE BETWEEN TO_DATE ('".Session::get('ta')."0101','YYYYMMDD') 
                AND TO_DATE ('".Session::get('ta')."1231','YYYYMMDD') ";

        if (isset($filter)) {
            foreach ($filter as $filter) {
                $sql .= " AND " . $filter;
            }
        }


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
                WHERE CREATION_DATE BETWEEN TO_DATE ('".Session::get('ta')."0101','YYYYMMDD') 
                AND TO_DATE ('".Session::get('ta')."1231','YYYYMMDD')";

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
            } else if ($val['STATUS'] == 'CANCELED') {
                $data->set_canceled($val['JUMLAH']);
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

    private function set_total_up($total_up) {
        $this->_total_up = $total_up;    
    }

    private function set_pemakaian_up($pemakaian_up) {
        $this->_pemakaian_up = $pemakaian_up;    
    }

    private function set_sp2d_sukses($sp2d_sukses) {
        $this->_sp2d_sukses = $sp2d_sukses;    
    }

    private function set_sp2d_tunggu($sp2d_tunggu) {
        $this->_sp2d_tunggu = $sp2d_tunggu;    
    }

    private function set_sp2d_lainnya($sp2d_lainnya) {
        $this->_sp2d_lainnya = $sp2d_lainnya;    
    }

    public function set_retur_sudah_proses($retur_sudah_proses) {
        $this->_retur_sudah_proses = $retur_sudah_proses;
    }

    public function set_retur_belum_proses($retur_belum_proses) {
        $this->_retur_belum_proses = $retur_belum_proses;
    }

    public function set_sisa_hari_up($sisa_hari_up) {
        $this->_sisa_hari_up = $sisa_hari_up;
    }

    public function set_sisa_hari_tup($sisa_hari_tup) {
        $this->_sisa_hari_tup = $sisa_hari_tup;
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

    public function set_penerimaan_41($penerimaan_41) {
        $this->_penerimaan_41 = $penerimaan_41;
    }

    public function set_penerimaan_42($penerimaan_42) {
        $this->_penerimaan_42 = $penerimaan_42;
    }

    public function set_lhp_completed($lhp_completed) {
        $this->_lhp_completed = $lhp_completed;
    }

    public function set_vol_lhp_completed($vol_lhp_completed) {
        $this->_vol_lhp_completed = $vol_lhp_completed;
    }

    public function set_lhp_validated($lhp_validated) {
        $this->_lhp_validated = $lhp_validated;
    }

    public function set_vol_lhp_validated($vol_lhp_validated) {
        $this->_vol_lhp_validated = $vol_lhp_validated;
    }

    public function set_lhp_error($lhp_error) {
        $this->_lhp_error = $lhp_error;
    }

    public function set_vol_lhp_error($vol_lhp_error) {
        $this->_vol_lhp_error = $vol_lhp_error;
    }

    public function set_lhp_etc($lhp_etc) {
        $this->_lhp_etc = $lhp_etc;
    }

    public function set_vol_lhp_etc($vol_lhp_etc) {
        $this->_vol_lhp_etc = $vol_lhp_etc;
    }

    public function set_tgl_lhp($tgl_lhp) {
        $this->_tgl_lhp = $tgl_lhp;
    }

    public function set_unit($unit) {
        $this->_unit = $unit;
    }

    public function set_gaji($gaji) {
        $this->_gaji = $gaji;
    }

    public function set_non_gaji($non_gaji) {
        $this->_non_gaji = $non_gaji;
    }

    public function set_retur($retur) {
        $this->_retur = $retur;
    }

    public function set_void($void) {
        $this->_void = $void;
    }

    public function set_lainnya($lainnya) {
        $this->_lainnya = $lainnya;
    }

    public function set_kode_unit($kode_unit) {
        $this->_kode_unit = $kode_unit;
    }

    public function set_nama_unit($nama_unit) {
        $this->_nama_unit = $nama_unit;
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

    public function get_total_up() {
        return $this->_total_up;    
    }

    public function get_pemakaian_up() {
        return $this->_pemakaian_up;    
    }

    public function get_sp2d_sukses() {
        return $this->_sp2d_sukses;    
    }

    public function get_sp2d_tunggu() {
        return $this->_sp2d_tunggu;    
    }

    public function get_sp2d_lainnya() {
        return $this->_sp2d_lainnya;    
    }

    public function get_retur_sudah_proses() {
        return $this->_retur_sudah_proses;
    }

    public function get_retur_belum_proses() {
        return $this->_retur_belum_proses;
    }

    public function get_sisa_hari_up() {
        return $this->_sisa_hari_up;
    }

    public function get_sisa_hari_tup() {
        return $this->_sisa_hari_tup;
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

    public function get_penerimaan_41() {
        return $this->_penerimaan_41;
    }

    public function get_penerimaan_42() {
        return $this->_penerimaan_42;
    }

    public function get_lhp_completed() {
        return $this->_lhp_completed;
    }

    public function get_vol_lhp_completed() {
        return $this->_vol_lhp_completed;
    }

    public function get_lhp_validated() {
        return $this->_lhp_validated;
    }

    public function get_vol_lhp_validated() {
        return $this->_vol_lhp_validated;
    }

    public function get_lhp_error() {
        return $this->_lhp_error;
    }

    public function get_vol_lhp_error() {
        return $this->_vol_lhp_error;
    }

    public function get_lhp_etc() {
        return $this->_lhp_etc;
    }

    public function get_vol_lhp_etc() {
        return $this->_vol_lhp_etc;
    }

    public function get_tgl_lhp() {
        return $this->_tgl_lhp;
    }

    public function get_unit() {
        return $this->_unit;
    }

    public function get_gaji() {
        return $this->_gaji;
    }

    public function get_non_gaji() {
        return $this->_non_gaji;
    }

    public function get_retur() {
        return $this->_retur;
    }

    public function get_void() {
        return $this->_void;
    }

    public function get_lainnya() {
        return $this->_lainnya;
    }

    public function get_kode_unit() {
        return $this->_kode_unit;
    }

    public function get_nama_unit() {
        return $this->_nama_unit;
    }
    
    public function __destruct() {
        
    }
    
}

?>