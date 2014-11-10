<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPMRTController extends BaseController {
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

    public function cekPMRT() {
        $d_pmrt = new DataPMRT($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        /*if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            //$filter[$no++] = "KPPN_CODE = '" . Session::get('kd_satker') . "'";
        }
        if (Session::get('role') == SATKER) {
            //$filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
        }*/

        if (isset($_POST['submit_file'])) {
            $file=$_FILES['file_pmrt']['name'];
            $nama_file = $_FILES['file_pmrt']['tmp_name'];
            move_uploaded_file($_FILES["file_pmrt"]["tmp_name"], $file);
            //var_dump($file);
            
            //DocXConversion::set_filename($nama_file);
            //$docObj = new DocXConversion ($file);
            $this->view->d_pmrt = $d_pmrt->create_pmrt_from_file($file);
            //var_dump($this->view->d_pmrt);
        /*
            $this->view->data = $d_supp->get_supp_filter($filter);
        }*/
        }

        // untuk mengambil data last update 
        //$d_last_update = new DataLastUpdate($this->registry);
        //$this->view->last_update = $d_last_update->get_last_updatenya($d_pmrt->get_table());

        $this->view->render('kppn/cekPMRT');
        $d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
