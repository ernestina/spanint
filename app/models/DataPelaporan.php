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
        $sql = "SELECT REQUEST_ID, PROGRAM_SHORT_NAME, ARGUMENT_TEXT, REQUESTED_START_DATE, ACTUAL_START_DATE, ACTUAL_COMPLETION_DATE, FILE_HASH, TIMESTAMP
				FROM " . $this->_table . "
				WHERE 1=1 ";
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
            $d_data->set_argument_text($val['ARGUMENT_TEXT']);
            $d_data->set_requested_start_date(date("d-m-Y", strtotime($val['REQUESTED_START_DATE'])));
            $d_data->set_actual_start_date(date("d-m-Y", strtotime($val['ACTUAL_START_DATE'])));
            $d_data->set_actual_completion_date(date("d-m-Y", strtotime($val['ACTUAL_COMPLETION_DATE'])));
            $d_data->set_file_hash($val['FILE_HASH']);
            $d_data->set_timestamp($val['TIMESTAMP']);
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
                'SPGLR00014')
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
