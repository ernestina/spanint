<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataGR_IJP {

    private $db;
    private $_kppn;
    private $_nama_kppn;
    private $_tahun;
    private $_bulan;
    //private $_gl_date_char;
    private $_bank_code;
    private $_bank_branch_code;
    private $_bank_account_num;
    //private $_transaksi;
    //private $_baris;
    private $_n01;
    private $_n02;
    private $_n03;
    private $_n04;
    private $_n05;
    private $_n06;
    private $_n07;
    private $_n08;
    private $_n09;
    private $_n10;
    private $_n11;
    private $_n12;
    private $_n13;
    private $_n14;
    private $_n15;
    private $_n16;
    private $_n17;
    private $_n18;
    private $_n19;
    private $_n20;
    private $_n21;
    private $_n22;
    private $_n23;
    private $_n24;
    private $_n25;
    private $_n26;
    private $_n27;
    private $_n28;
    private $_n29;
    private $_n30;
    private $_n31;
    private $_r01;
    private $_r02;
    private $_r03;
    private $_r04;
    private $_r05;
    private $_r06;
    private $_r07;
    private $_r08;
    private $_r09;
    private $_r10;
    private $_r11;
    private $_r12;
    private $_r13;
    private $_r14;
    private $_r15;
    private $_r16;
    private $_r17;
    private $_r18;
    private $_r19;
    private $_r20;
    private $_r21;
    private $_r22;
    private $_r23;
    private $_r24;
    private $_r25;
    private $_r26;
    private $_r27;
    private $_r28;
    private $_r29;
    private $_r30;
    private $_r31;
    private $_jml_rek;
    private $_jumlah;
    private $_table = 'SPGR_MPN_RECEIPTS_ALL_LEVEL1';
    private $_table1 = 'SPGR_MPN_RECEIPTS_ALL_V_RIJP';
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

    public function get_gr_ijp_filter($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table1 . " 
				 WHERE 
				1=1 AND TAHUN = '".Session::get('ta')."'"

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " ORDER BY BANK_CODE, BANK_ACCOUNT_NUM ";
        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kppn($val['KPPN']);
            $d_data->set_bulan($val['BULAN']);
            //$d_data->set_gl_date_char($val['GL_DATE_CHAR']);
            $d_data->set_bank_code($val['BANK_CODE']);
            $d_data->set_bank_branch_code($val['BANK_BRANCH_CODE']);
            $d_data->set_bank_account_num($val['BANK_ACCOUNT_NUM']);
            //$d_data->set_transaksi($val['TRANSAKSI']);
            //$d_data->set_baris($val['BARIS']);
            $d_data->set_n01($val['01']);
            $d_data->set_n02($val['02']);
            $d_data->set_n03($val['03']);
            $d_data->set_n04($val['04']);
            $d_data->set_n05($val['05']);
            $d_data->set_n06($val['06']);
            $d_data->set_n07($val['07']);
            $d_data->set_n08($val['08']);
            $d_data->set_n09($val['09']);
            $d_data->set_n10($val['10']);
            $d_data->set_n11($val['11']);
            $d_data->set_n12($val['12']);
            $d_data->set_n13($val['13']);
            $d_data->set_n14($val['14']);
            $d_data->set_n15($val['15']);
            $d_data->set_n16($val['16']);
            $d_data->set_n17($val['17']);
            $d_data->set_n18($val['18']);
            $d_data->set_n19($val['19']);
            $d_data->set_n20($val['20']);
            $d_data->set_n21($val['21']);
            $d_data->set_n22($val['22']);
            $d_data->set_n23($val['23']);
            $d_data->set_n24($val['24']);
            $d_data->set_n25($val['25']);
            $d_data->set_n26($val['26']);
            $d_data->set_n27($val['27']);
            $d_data->set_n28($val['28']);
            $d_data->set_n29($val['29']);
            $d_data->set_n30($val['30']);
            $d_data->set_n31($val['31']);
            $d_data->set_jumlah($val['JUMLAH']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_gr_status_harian($filter) {
        Session::get('id_user');
        $sql = "SELECT a.*
				FROM "
                . $this->_table . " a
				WHERE 
				1=1 AND TAHUN = '".Session::get('ta')."'"

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " ORDER BY a.BULAN, a.kppn ";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kppn($val['KPPN']);
            //$d_data->set_nama_kppn($val['NAMA_KPPN']);
            $d_data->set_tahun($val['TAHUN']);
            $d_data->set_bulan($val['BULAN']);
            $d_data->set_n01($val['LHP01']);
            $d_data->set_n02($val['LHP02']);
            $d_data->set_n03($val['LHP03']);
            $d_data->set_n04($val['LHP04']);
            $d_data->set_n05($val['LHP05']);
            $d_data->set_n06($val['LHP06']);
            $d_data->set_n07($val['LHP07']);
            $d_data->set_n08($val['LHP08']);
            $d_data->set_n09($val['LHP09']);
            $d_data->set_n10($val['LHP10']);
            $d_data->set_n11($val['LHP11']);
            $d_data->set_n12($val['LHP12']);
            $d_data->set_n13($val['LHP13']);
            $d_data->set_n14($val['LHP14']);
            $d_data->set_n15($val['LHP15']);
            $d_data->set_n16($val['LHP16']);
            $d_data->set_n17($val['LHP17']);
            $d_data->set_n18($val['LHP18']);
            $d_data->set_n19($val['LHP19']);
            $d_data->set_n20($val['LHP20']);
            $d_data->set_n21($val['LHP21']);
            $d_data->set_n22($val['LHP22']);
            $d_data->set_n23($val['LHP23']);
            $d_data->set_n24($val['LHP24']);
            $d_data->set_n25($val['LHP25']);
            $d_data->set_n26($val['LHP26']);
            $d_data->set_n27($val['LHP27']);
            $d_data->set_n28($val['LHP28']);
            $d_data->set_n29($val['LHP29']);
            $d_data->set_n30($val['LHP30']);
            $d_data->set_n31($val['LHP31']);
            $d_data->set_r01($val['R01']);
            $d_data->set_r02($val['R02']);
            $d_data->set_r03($val['R03']);
            $d_data->set_r04($val['R04']);
            $d_data->set_r05($val['R05']);
            $d_data->set_r06($val['R06']);
            $d_data->set_r07($val['R07']);
            $d_data->set_r08($val['R08']);
            $d_data->set_r09($val['R09']);
            $d_data->set_r10($val['R10']);
            $d_data->set_r11($val['R11']);
            $d_data->set_r12($val['R12']);
            $d_data->set_r13($val['R13']);
            $d_data->set_r14($val['R14']);
            $d_data->set_r15($val['R15']);
            $d_data->set_r16($val['R16']);
            $d_data->set_r17($val['R17']);
            $d_data->set_r18($val['R18']);
            $d_data->set_r19($val['R19']);
            $d_data->set_r20($val['R20']);
            $d_data->set_r21($val['R21']);
            $d_data->set_r22($val['R22']);
            $d_data->set_r23($val['R23']);
            $d_data->set_r24($val['R24']);
            $d_data->set_r25($val['R25']);
            $d_data->set_r26($val['R26']);
            $d_data->set_r27($val['R27']);
            $d_data->set_r28($val['R28']);
            $d_data->set_r29($val['R29']);
            $d_data->set_r30($val['R30']);
            $d_data->set_r31($val['R31']);
            $d_data->set_jml_rek($val['JML_REK']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_jml_rek_dep($kppn) {
        Session::get('id_user');
        $sql = "SELECT JML_REK
				FROM "
                . $this->_table . " 
				 WHERE 
				KPPN = '" . $kppn . "'"

        ;
        $no = 0;
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = 0;
        foreach ($result as $val) {
            $data = ($val['JML_REK']);
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }

    public function set_nama_kppn($nama_kppn) {
        $this->_nama_kppn = $nama_kppn;
    }

    public function set_tahun($tahun) {
        $this->_tahun = $tahun;
    }

    public function set_bulan($bulan) {
        $this->_bulan = $bulan;
    }

    public function set_bank_code($bank_code) {
        $this->_bank_code = $bank_code;
    }

    public function set_bank_branch_code($bank_branch_code) {
        $this->_bank_branch_code = $bank_branch_code;
    }

    public function set_bank_account_num($bank_account_num) {
        $this->_bank_account_num = $bank_account_num;
    }

    public function set_n01($n01) {
        $this->_n01 = $n01;
    }

    public function set_n02($n02) {
        $this->_n02 = $n02;
    }

    public function set_n03($n03) {
        $this->_n03 = $n03;
    }

    public function set_n04($n04) {
        $this->_n04 = $n04;
    }

    public function set_n05($n05) {
        $this->_n05 = $n05;
    }

    public function set_n06($n06) {
        $this->_n06 = $n06;
    }

    public function set_n07($n07) {
        $this->_n07 = $n07;
    }

    public function set_n08($n08) {
        $this->_n08 = $n08;
    }

    public function set_n09($n09) {
        $this->_n09 = $n09;
    }

    public function set_n10($n10) {
        $this->_n10 = $n10;
    }

    public function set_n11($n11) {
        $this->_n11 = $n11;
    }

    public function set_n12($n12) {
        $this->_n12 = $n12;
    }

    public function set_n13($n13) {
        $this->_n13 = $n13;
    }

    public function set_n14($n14) {
        $this->_n14 = $n14;
    }

    public function set_n15($n15) {
        $this->_n15 = $n15;
    }

    public function set_n16($n16) {
        $this->_n16 = $n16;
    }

    public function set_n17($n17) {
        $this->_n17 = $n17;
    }

    public function set_n18($n18) {
        $this->_n18 = $n18;
    }

    public function set_n19($n19) {
        $this->_n19 = $n19;
    }

    public function set_n20($n20) {
        $this->_n20 = $n20;
    }

    public function set_n21($n21) {
        $this->_n21 = $n21;
    }

    public function set_n22($n22) {
        $this->_n22 = $n22;
    }

    public function set_n23($n23) {
        $this->_n23 = $n23;
    }

    public function set_n24($n24) {
        $this->_n24 = $n24;
    }

    public function set_n25($n25) {
        $this->_n25 = $n25;
    }

    public function set_n26($n26) {
        $this->_n26 = $n26;
    }

    public function set_n27($n27) {
        $this->_n27 = $n27;
    }

    public function set_n28($n28) {
        $this->_n28 = $n28;
    }

    public function set_n29($n29) {
        $this->_n29 = $n29;
    }

    public function set_n30($n30) {
        $this->_n30 = $n30;
    }

    public function set_n31($n31) {
        $this->_n31 = $n31;
    }

    public function set_r01($r01) {
        $this->_r01 = $r01;
    }

    public function set_r02($r02) {
        $this->_r02 = $r02;
    }

    public function set_r03($r03) {
        $this->_r03 = $r03;
    }

    public function set_r04($r04) {
        $this->_r04 = $r04;
    }

    public function set_r05($r05) {
        $this->_r05 = $r05;
    }

    public function set_r06($r06) {
        $this->_r06 = $r06;
    }

    public function set_r07($r07) {
        $this->_r07 = $r07;
    }

    public function set_r08($r08) {
        $this->_r08 = $r08;
    }

    public function set_r09($r09) {
        $this->_r09 = $r09;
    }

    public function set_r10($r10) {
        $this->_r10 = $r10;
    }

    public function set_r11($r11) {
        $this->_r11 = $r11;
    }

    public function set_r12($r12) {
        $this->_r12 = $r12;
    }

    public function set_r13($r13) {
        $this->_r13 = $r13;
    }

    public function set_r14($r14) {
        $this->_r14 = $r14;
    }

    public function set_r15($r15) {
        $this->_r15 = $r15;
    }

    public function set_r16($r16) {
        $this->_r16 = $r16;
    }

    public function set_r17($r17) {
        $this->_r17 = $r17;
    }

    public function set_r18($r18) {
        $this->_r18 = $r18;
    }

    public function set_r19($r19) {
        $this->_r19 = $r19;
    }

    public function set_r20($r20) {
        $this->_r20 = $r20;
    }

    public function set_r21($r21) {
        $this->_r21 = $r21;
    }

    public function set_r22($r22) {
        $this->_r22 = $r22;
    }

    public function set_r23($r23) {
        $this->_r23 = $r23;
    }

    public function set_r24($r24) {
        $this->_r24 = $r24;
    }

    public function set_r25($r25) {
        $this->_r25 = $r25;
    }

    public function set_r26($r26) {
        $this->_r26 = $r26;
    }

    public function set_r27($r27) {
        $this->_r27 = $r27;
    }

    public function set_r28($r28) {
        $this->_r28 = $r28;
    }

    public function set_r29($r29) {
        $this->_r29 = $r29;
    }

    public function set_r30($r30) {
        $this->_r30 = $r30;
    }

    public function set_r31($r31) {
        $this->_r31 = $r31;
    }

    public function set_jml_rek($jml_rek) {
        $this->_jml_rek = $jml_rek;
    }

    public function set_jumlah($jumlah) {
        $this->_jumlah = $jumlah;
    }

    public function set_tabel($table) {
        $this->_table = $table;
    }

    public function set_tabel1($table1) {
        $this->_table1 = $table1;
    }

    /*
     * getter
     */

    public function get_kppn() {
        return $this->_kppn;
    }

    public function get_nama_kppn() {
        return $this->_nama_kppn;
    }

    public function get_tahun() {
        return $this->_tahun;
    }

    public function get_bulan() {
        return $this->_bulan;
    }

    public function get_bank_code() {
        return $this->_bank_code;
    }

    public function get_bank_branch_code() {
        return $this->_bank_branch_code;
    }

    public function get_bank_account_num() {
        return $this->_bank_account_num;
    }

    public function get_n01() {
        return $this->_n01;
    }

    public function get_n02() {
        return $this->_n02;
    }

    public function get_n03() {
        return $this->_n03;
    }

    public function get_n04() {
        return $this->_n04;
    }

    public function get_n05() {
        return $this->_n05;
    }

    public function get_n06() {
        return $this->_n06;
    }

    public function get_n07() {
        return $this->_n07;
    }

    public function get_n08() {
        return $this->_n08;
    }

    public function get_n09() {
        return $this->_n09;
    }

    public function get_n10() {
        return $this->_n10;
    }

    public function get_n11() {
        return $this->_n11;
    }

    public function get_n12() {
        return $this->_n12;
    }

    public function get_n13() {
        return $this->_n13;
    }

    public function get_n14() {
        return $this->_n14;
    }

    public function get_n15() {
        return $this->_n15;
    }

    public function get_n16() {
        return $this->_n16;
    }

    public function get_n17() {
        return $this->_n17;
    }

    public function get_n18() {
        return $this->_n18;
    }

    public function get_n19() {
        return $this->_n19;
    }

    public function get_n20() {
        return $this->_n20;
    }

    public function get_n21() {
        return $this->_n21;
    }

    public function get_n22() {
        return $this->_n22;
    }

    public function get_n23() {
        return $this->_n23;
    }

    public function get_n24() {
        return $this->_n24;
    }

    public function get_n25() {
        return $this->_n25;
    }

    public function get_n26() {
        return $this->_n26;
    }

    public function get_n27() {
        return $this->_n27;
    }

    public function get_n28() {
        return $this->_n28;
    }

    public function get_n29() {
        return $this->_n29;
    }

    public function get_n30() {
        return $this->_n30;
    }

    public function get_n31() {
        return $this->_n31;
    }

    public function get_r01() {
        return $this->_r01;
    }

    public function get_r02() {
        return $this->_r02;
    }

    public function get_r03() {
        return $this->_r03;
    }

    public function get_r04() {
        return $this->_r04;
    }

    public function get_r05() {
        return $this->_r05;
    }

    public function get_r06() {
        return $this->_r06;
    }

    public function get_r07() {
        return $this->_r07;
    }

    public function get_r08() {
        return $this->_r08;
    }

    public function get_r09() {
        return $this->_r09;
    }

    public function get_r10() {
        return $this->_r10;
    }

    public function get_r11() {
        return $this->_r11;
    }

    public function get_r12() {
        return $this->_r12;
    }

    public function get_r13() {
        return $this->_r13;
    }

    public function get_r14() {
        return $this->_r14;
    }

    public function get_r15() {
        return $this->_r15;
    }

    public function get_r16() {
        return $this->_r16;
    }

    public function get_r17() {
        return $this->_r17;
    }

    public function get_r18() {
        return $this->_r18;
    }

    public function get_r19() {
        return $this->_r19;
    }

    public function get_r20() {
        return $this->_r20;
    }

    public function get_r21() {
        return $this->_r21;
    }

    public function get_r22() {
        return $this->_r22;
    }

    public function get_r23() {
        return $this->_r23;
    }

    public function get_r24() {
        return $this->_r24;
    }

    public function get_r25() {
        return $this->_r25;
    }

    public function get_r26() {
        return $this->_r26;
    }

    public function get_r27() {
        return $this->_r27;
    }

    public function get_r28() {
        return $this->_r28;
    }

    public function get_r29() {
        return $this->_r29;
    }

    public function get_r30() {
        return $this->_r30;
    }

    public function get_r31() {
        return $this->_r31;
    }

    public function get_jml_rek() {
        return $this->_jml_rek;
    }

    public function get_jumlah() {
        return $this->_jumlah;
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
