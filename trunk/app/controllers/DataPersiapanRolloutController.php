<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPersiapanRolloutController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

    public function index() {
        
    }

    public function downloadPagu() {
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        $this->view->ekstensi = ".csv";
        $this->view->kppn_code = Session::get('kd_satker');
        $d_log->tambah_log("Sukses");
        $this->view->load('kppn/downloadPagu');
    }

    public function __destruct() {
        
    }

}
