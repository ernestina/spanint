<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PanduanController extends BaseController {
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

    public function lihatPanduan1() {
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        $this->view->render('kppn/panduan1');
        $d_log->tambah_log("Sukses");
    }

    public function PanduanUAT() {
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        $this->view->render('kppn/panduanUAT');
        $d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
