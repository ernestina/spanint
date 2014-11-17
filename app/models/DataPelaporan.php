<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPelaporan {

    private $db;
    private $_request_id;
    private $_program_short_name;
    private $_argument_text;
    private $_requested_start_date;
    private $_actual_start_date;
    private $_actual_completion_date;
    private $_file_hash;
    private $_timestamp;
    private $_tgl_awal_laporan;
    private $_tgl_akhir_laporan;
    private $_kppn;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'SPCO_CONCURRENT_REQUESTS';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    public function get_laporan($filter) {
        $sql = "SELECT REQUEST_ID, PROGRAM_SHORT_NAME,ARGUMENT_TEXT, TO_DATE(substr(ARGUMENT_TEXT,0,10), 'yyyy/mm/dd') TGL_AWAL_LAPORAN,TO_DATE(substr(ARGUMENT_TEXT,22,10), 'yyyy/mm/dd') TGL_AKHIR_LAPORAN,REQUESTED_START_DATE, ACTUAL_START_DATE
, ACTUAL_COMPLETION_DATE, FILE_HASH, TIMESTAMP
				FROM " . $this->_table . "
				WHERE FILE_HASH <> ' ' ";
        $no = 0;
        //var_dump($filter);
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " ORDER BY REQUEST_ID DESC";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_request_id($val['REQUEST_ID']);
            $d_data->set_program_short_name($val['PROGRAM_SHORT_NAME']);
            $d_data->set_kppn(substr($val['ARGUMENT_TEXT'],-3,3));
            //$d_data->set_actual_start_date(date("d-m-Y", strtotime(substr($val['ARGUMENT_TEXT'],0,10))));
            //$d_data->set_actual_completion_date(date("d-m-Y", strtotime(substr($val['ARGUMENT_TEXT'],21,10))));
            if (substr($val['ARGUMENT_TEXT'],22,4) > 2010 && substr($val['ARGUMENT_TEXT'],22,4) < 2020) {
            $d_data->set_argument_text(date("d-m-Y", strtotime(substr($val['ARGUMENT_TEXT'],0,10)))." s.d ".date("d-m-Y", strtotime(substr($val['ARGUMENT_TEXT'],22,10))));
            } else {
                $d_data->set_argument_text("Per Tanggal : ".date("d-m-Y", strtotime(substr($val['ARGUMENT_TEXT'],0,10))));
                
            }
            if($val['PROGRAM_SHORT_NAME']=='SPGLR00258'){
                $tahun = substr($val['ARGUMENT_TEXT'],6,4);
                $bulan = substr($val['ARGUMENT_TEXT'],19,3);
                $tgl = substr($val['ARGUMENT_TEXT'],27,2);
                $d_data->set_tgl_akhir_laporan(date("d-m-Y", strtotime($tgl."-".$bulan."-".$tahun)));                
            } else if ($val['PROGRAM_SHORT_NAME']=='SPGLR00264'){
                $tahun = substr($val['ARGUMENT_TEXT'],6,4);
                $bulan = substr($val['ARGUMENT_TEXT'],19,3);
                $tgl = substr($val['ARGUMENT_TEXT'],27,2);
                $d_data->set_tgl_akhir_laporan(date("d-m-Y", strtotime($tgl."-".$bulan."-".$tahun)));              
            } else if ($val['PROGRAM_SHORT_NAME']=='SPCMR00051'){
                $d_data->set_tgl_akhir_laporan(date("d-m-Y", strtotime(substr($val['ARGUMENT_TEXT'],0,10))));                
            }
            //$d_data->set_file_hash($val['FILE_HASH']);
            //$d_data->set_timestamp($val['TIMESTAMP']);
            $data[] = $d_data;
			//var_dump($d_data);
        }
        return $data;
    }

    public function get_laporan_kppn($filter) {
        $sql = "SELECT REQUEST_ID, PROGRAM_SHORT_NAME,ARGUMENT_TEXT
				FROM " . $this->_table . "
				WHERE FILE_HASH <> ' ' ";
        $no = 0;
        //var_dump($filter);
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " ORDER BY REQUEST_ID DESC";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_request_id($val['REQUEST_ID']);
            $d_data->set_program_short_name($val['PROGRAM_SHORT_NAME']);
            $d_data->set_kppn(substr($val['ARGUMENT_TEXT'],-3,3));
            if($val['PROGRAM_SHORT_NAME']=='SPGLR00258'){
                $tahun = substr($val['ARGUMENT_TEXT'],6,4);
                $bulan = substr($val['ARGUMENT_TEXT'],19,3);
                $tgl = substr($val['ARGUMENT_TEXT'],27,2);
                $d_data->set_tgl_akhir_laporan(date("d-m-Y", strtotime($tgl."-".$bulan."-".$tahun)));              
            } else if ($val['PROGRAM_SHORT_NAME']=='SPGLR00264'){
                $tahun = substr($val['ARGUMENT_TEXT'],6,4);
                $bulan = substr($val['ARGUMENT_TEXT'],19,3);
                $tgl = substr($val['ARGUMENT_TEXT'],27,2);
                $d_data->set_tgl_akhir_laporan(date("d-m-Y", strtotime($tgl."-".$bulan."-".$tahun)));               
            } else if ($val['PROGRAM_SHORT_NAME']=='SPCMR00051'){
                $d_data->set_tgl_akhir_laporan(date("d-m-Y", strtotime(substr($val['ARGUMENT_TEXT'],0,10))));                
            }
            $data[] = $d_data;
			//var_dump($d_data);
        }
        return $data;
    }

    public function get_laporan_pkn_bm($filter) {
        $sql = "SELECT REQUEST_ID, PROGRAM_SHORT_NAME, TO_DATE(substr(ARGUMENT_TEXT,0,10), 'yyyy/mm/dd') TGL_AWAL_LAPORAN,TO_DATE(substr(ARGUMENT_TEXT,22,10), 'yyyy/mm/dd') TGL_AKHIR_LAPORAN
				FROM " . $this->_table . "
				WHERE FILE_HASH <> ' ' ";
        $no = 0;
        //var_dump($filter);
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " ORDER BY REQUEST_ID DESC";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_request_id($val['REQUEST_ID']);
            $d_data->set_program_short_name($val['PROGRAM_SHORT_NAME']);
            $d_data->set_tgl_awal_laporan(date("d-m-Y", strtotime($val['TGL_AWAL_LAPORAN'])));
            $d_data->set_tgl_akhir_laporan(date("d-m-Y", strtotime($val['TGL_AKHIR_LAPORAN'])));
            $d_data->set_argument_text((date("d-m-Y", strtotime($val['TGL_AWAL_LAPORAN'])))." s.d ".(date("d-m-Y", strtotime($val['TGL_AKHIR_LAPORAN']))));
            $data[] = $d_data;
			//var_dump($d_data);
        }
        return $data;
    }

    public function get_laporan_pkn_bb($filter) {
        $sql = "SELECT REQUEST_ID, PROGRAM_SHORT_NAME, TO_DATE(substr(ARGUMENT_TEXT,0,10), 'yyyy/mm/dd') TGL_AKHIR_LAPORAN
				FROM " . $this->_table . "
				WHERE FILE_HASH <> ' ' ";
        $no = 0;
        //var_dump($filter);
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " ORDER BY REQUEST_ID DESC";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_request_id($val['REQUEST_ID']);
            $d_data->set_program_short_name($val['PROGRAM_SHORT_NAME']);
            $d_data->set_tgl_akhir_laporan(date("d-m-Y", strtotime($val['TGL_AKHIR_LAPORAN'])));
            $d_data->set_argument_text(" Per Tanggal : ".(date("d-m-Y", strtotime($val['TGL_AKHIR_LAPORAN']))));
            $data[] = $d_data;
			//var_dump($d_data);
        }
        return $data;
    }
    
    public function get_laporan_terakhir_bukumerah() {
        $sql = "SELECT MAX(TIMESTAMP) TIMESTAMP, 
                MAX(REQUEST_ID) REQUEST_ID, 
                PROGRAM_SHORT_NAME, 
                MAX(ARGUMENT_TEXT) ARGUMENT_TEXT, 
                MAX(REQUESTED_START_DATE) REQUESTED_START_DATE, 
                MAX(ACTUAL_START_DATE) ACTUAL_START_DATE, 
                MAX(ACTUAL_COMPLETION_DATE) ACTUAL_COMPLETION_DATE
                FROM  " . $this->_table . "
                WHERE PROGRAM_SHORT_NAME in (
                'SPGLR00008',
                'SPGLR00016',
                'SPGLR00018',
                'SPGLR00010',
                'SPGLR00009',
                'SPGLR00015',
                'SPGLR00013',
                'SPGLR00012',
                'SPGLR00011',
                'SPGLR00017',
                'SPGLR00014') AND FILE_HASH <> ' ' 
                GROUP BY PROGRAM_SHORT_NAME 
                ORDER BY PROGRAM_SHORT_NAME";
        $no = 0;
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_request_id($val['REQUEST_ID']);
            $d_data->set_program_short_name($val['PROGRAM_SHORT_NAME']);
            $d_data->set_argument_text(date("d-m-Y", strtotime(substr($val['ARGUMENT_TEXT'],0,10)))." s.d ".date("d-m-Y", strtotime(substr($val['ARGUMENT_TEXT'],21,10))));
            $d_data->set_requested_start_date(date("d-m-Y", strtotime($val['REQUESTED_START_DATE'])));
            $d_data->set_actual_start_date(date("d-m-Y", strtotime($val['ACTUAL_START_DATE'])));
            $d_data->set_actual_completion_date(date("d-m-Y", strtotime(substr($val['ARGUMENT_TEXT'],21,10))));
            switch ($val['PROGRAM_SHORT_NAME']) {
                              case "SPGLR00008":
                                $url_link="Laporan Arus Kas BUN dan KPPN";
                                break;
                              case "SPGLR00009":
                                $url_link="Laporan Rincian Belanja Pemerintah Pusat";
                                break;
                              case "SPGLR00010":
                                $url_link="Laporan Realisasi APBN";
                                break;
                              case "SPGLR00011":
                                $url_link="Laporan Rincian Penerimaan Perpajakan";
                                break;
                              case "SPGLR00012":
                                $url_link="Laporan Rincian Penerimaan Pembiayaan";
                                break;
                              case "SPGLR00013":
                                $url_link="Laporan Rincian Penerimaan Negara Bukan Pajak";
                                break;
                              case "SPGLR00014":
                                $url_link="Laporan Rincian Transfer Daerah";
                                break;
                              case "SPGLR00015":
                                $url_link="Laporan Rincian Penerimaan Hibah";
                                break;
                              case "SPGLR00016":
                                $url_link="Laporan Penerimaan dan Pengeluaran Non Anggaran Lainnya";
                                break;
                              case "SPGLR00017":
                                $url_link="Laporan Rincian Pengeluaran Pembiayaan";
                                break;
                              case "SPGLR00018":
                                $url_link="Laporan Penerimaan dan Pengeluaran PFK";
                                break;
                              default:
                                //do nothing
                            }
            $d_data->set_file_hash($url_link);
            $d_data->set_timestamp($val['TIMESTAMP']);
            $data[] = $d_data;
			//var_dump($d_data);
        }
        return $data;
    }
    
    public function get_laporan_terakhir_bukubiru() {
        $sql = "SELECT MAX(TIMESTAMP) TIMESTAMP, 
                MAX(REQUEST_ID) REQUEST_ID, 
                PROGRAM_SHORT_NAME, 
                MAX(ARGUMENT_TEXT) ARGUMENT_TEXT, 
                MAX(REQUESTED_START_DATE) REQUESTED_START_DATE, 
                MAX(ACTUAL_START_DATE) ACTUAL_START_DATE, 
                MAX(ACTUAL_COMPLETION_DATE) ACTUAL_COMPLETION_DATE
                FROM  " . $this->_table . "
                WHERE PROGRAM_SHORT_NAME in (
                'SPCMR00028',
                'SPCMR00028B',
                'SPCMR00029',
                'SPCMR00030',
                'SPCMR00032',
                'SPCMR00032D',
                'SPCMR00033',
                'SPCMR00054',
                'SPCMR00055',
                'SPCMR00060',
                'SPCMR00063',
                'SPCMR00064',
                'SPCMR00065',
                'SPCMR00066',
                'SPCMR00067',
                'SPCMR00002') AND FILE_HASH <> ' ' 
                GROUP BY PROGRAM_SHORT_NAME 
                ORDER BY PROGRAM_SHORT_NAME";
        $no = 0;
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_request_id($val['REQUEST_ID']);
            $d_data->set_program_short_name($val['PROGRAM_SHORT_NAME']);
            $d_data->set_argument_text($val['ARGUMENT_TEXT']);
            $d_data->set_requested_start_date(date("d-m-Y", strtotime($val['REQUESTED_START_DATE'])));
            $d_data->set_actual_start_date(date("d-m-Y", strtotime($val['ACTUAL_START_DATE'])));
            $d_data->set_actual_completion_date(date("d-m-Y", strtotime(substr($val['ARGUMENT_TEXT'],0,10))));
            switch ($val['PROGRAM_SHORT_NAME']) {
                              case "SPCMR00028":
                                $url_link="Ikhtisar Posisi dan Arus Kas  Rekening BUN di Bank Indonesia";
                                break;
                              case "SPCMR00028B":
                                $url_link="Laporan Rincian Ikhtisar Posisi dan Arus Kas Rekening Penempatan di BI";
                                break;
                              case "SPCMR00029":
                                $url_link="Laporan Rincian Saldo Rekening Dana Reboisasi";
                                break;
                              case "SPCMR00030":
                                $url_link="Laporan Rincian Saldo Rekening Dana Bergulir Program UKM pada Bank Umum";
                                break;
                              case "SPCMR00032":
                                $url_link="Laporan Rincian Saldo Dana BAPERTARUM";
                                break;
                              case "SPCMR00032D":
                                $url_link="Laporan Rincian Saldo Dana BAPERTARUM-Detail";
                                break;
                              case "SPCMR00033":
                                $url_link="Laporan Rincian Saldo Akhir BLU";
                                break;
                              case "SPCMR00054":
                                $url_link="Laporan Rincian Saldo Reksus";
                                break;
                              case "SPCMR00055":
                                $url_link="Daftar Saldo Rekening Dana Cadangan";
                                break;
                              case "SPCMR00060":
                                $url_link="Laporan Posisi Saldo Akhir KPPN";
                                break;
                              case "SPCMR00063":
                                $url_link="Laporan Kas Pemerintah";
                                break;
                              case "SPCMR00064":
                                $url_link="Laporan Proporsi Kas Pemerintah";
                                break;
                              case "SPCMR00065":
                                $url_link="Posisi Dan Arus Kas Pemerintah Yang Likuid";
                                break;
                              case "SPCMR00066":
                                $url_link="Posisi Dan Arus Kas Pemerintah Lainnya Yang Cukup Likuid";
                                break;
                              case "SPCMR00067":
                                $url_link="Posisi Dan Arus Kas Pemerintah Lainnya Yang Tidak Likuid";
                                break;
                              case "SPCMR00002":
                                $url_link="Laporan kas Posisi";
                                break;
                              default:
                                //do nothing
                            }
            $d_data->set_file_hash($url_link);
            $d_data->set_timestamp($val['TIMESTAMP']);
            $data[] = $d_data;
			//var_dump($d_data);
        }
        return $data;
    }
    
    public function get_laporan_terakhir_laporankppn() {
        $sql = "SELECT MAX(TIMESTAMP) TIMESTAMP, 
                MAX(REQUEST_ID) REQUEST_ID, 
                PROGRAM_SHORT_NAME, 
                MAX(ARGUMENT_TEXT) ARGUMENT_TEXT, 
                MAX(REQUESTED_START_DATE) REQUESTED_START_DATE, 
                MAX(ACTUAL_START_DATE) ACTUAL_START_DATE, 
                MAX(ACTUAL_COMPLETION_DATE) ACTUAL_COMPLETION_DATE
                FROM  " . $this->_table . "
                WHERE PROGRAM_SHORT_NAME in (
                'SPGLR00258',
                'SPGLR00264',
                'SPCMR00051') AND FILE_HASH <> ' ' 
                GROUP BY PROGRAM_SHORT_NAME 
                ORDER BY PROGRAM_SHORT_NAME";
        $no = 0;
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_request_id($val['REQUEST_ID']);
            $d_data->set_program_short_name($val['PROGRAM_SHORT_NAME']);
            $d_data->set_argument_text($val['ARGUMENT_TEXT']);
            $d_data->set_requested_start_date(date("d-m-Y", strtotime($val['REQUESTED_START_DATE'])));
            $d_data->set_actual_start_date(date("d-m-Y", strtotime($val['ACTUAL_START_DATE'])));
            $d_data->set_actual_completion_date(date("d-m-Y", strtotime($val['ACTUAL_COMPLETION_DATE'])));
            switch ($val['PROGRAM_SHORT_NAME']) {
                              case "SPGLR00258":
                                $url_link="Laporan Arus Kas per Akun Tingkat KPPN";
                                break;
                              case "SPGLR00264":
                                $url_link="Laporan Realisasi Anggaran Tingkat KPPN";
                                break;
                              case "SPCMR00051":
                                $url_link="Laporan Konsolidasi Saldo Kas KPPN";
                                break;
                              default:
                                //do nothing
                            }
            $d_data->set_file_hash($url_link);
            $d_data->set_timestamp($val['TIMESTAMP']);
            $data[] = $d_data;
			//var_dump($d_data);
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_request_id($request_id) {
        $this->_request_id = $request_id;
    }

    public function set_program_short_name($program_short_name) {
        $this->_program_short_name = $program_short_name;
    }

    public function set_argument_text($argument_text) {
        $this->_argument_text = $argument_text;
    }

    public function set_requested_start_date($requested_start_date) {
        $this->_requested_start_date = $requested_start_date;
    }

    public function set_actual_start_date($actual_start_date) {
        $this->_actual_start_date = $actual_start_date;
    }

    public function set_actual_completion_date($actual_completion_date) {
        $this->_actual_completion_date = $actual_completion_date;
    }

    public function set_file_hash($file_hash) {
        $this->_file_hash = $file_hash;
    }

    public function set_timestamp($timestamp) {
        $this->_timestamp = $timestamp;
    }

    public function set_tgl_awal_laporan($tgl_awal_laporan) {
        $this->_tgl_awal_laporan = $tgl_awal_laporan;
    }

    public function set_tgl_akhir_laporan($tgl_akhir_laporan) {
        $this->_tgl_akhir_laporan = $tgl_akhir_laporan;
    }

    public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }

    /*
     * getter
     */

    public function get_request_id() {
        return $this->_request_id;
    }

    public function get_program_short_name() {
        return $this->_program_short_name;
    }

    public function get_argument_text() {
        return $this->_argument_text;
    }

    public function get_requested_start_date() {
        return $this->_requested_start_date;
    }

    public function get_actual_start_date() {
        return $this->_actual_start_date;
    }

    public function get_actual_completion_date() {
        return $this->_actual_completion_date;
    }

    public function get_file_hash() {
        return $this->_file_hash;
    }

    public function get_timestamp() {
        return $this->_timestamp;
    }

    public function get_tgl_awal_laporan() {
        return $this->_tgl_awal_laporan;
    }

    public function get_tgl_akhir_laporan() {
        return $this->_tgl_akhir_laporan;
    }

    public function get_kppn() {
        return $this->_kppn;
    }

    public function get_table() {
        return $this->_table;
    }

    public function get_error() {
        return $this->_error;
    }

    public function get_valid() {
        return $this->_valid;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
