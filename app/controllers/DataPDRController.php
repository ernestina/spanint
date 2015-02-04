<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPDRController extends BaseController {
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

    public function registerDJPU() {   //nama function
        $d_ref = new DataPDR($this->registry); //model
        $filter = array();
        
        if (isset($_POST['submit_file'])) {
            if ($_POST['nip'] != '') {
                $filter[$no++] = " reg_no = '" . $_POST['nip'] . "'";
                $this->view->d_nip= $_POST['nip'];
            }
            
            if ($_POST['name'] != '') {
                $filter[$no++] = " upper(name) LIKE '%" . strtoupper($_POST['name']) . "%'";
                $this->view->d_name = $_POST['name'];
            }
            
            $this->view->data = $d_ref->get_djpu_register($filter);
        }

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya('DJPU_REGISTER');

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        $this->view->render('admin/referensiRegisterDJPU');
    }

    public function __destruct() {
        
    }

}
