<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataNODController extends BaseController {
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

    public function daftarNOD() {
        $d_nod = new DataNOD($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }

        //if (isset($_POST['submit_file'])) {
        
            if ($_POST['wa_number'] != '') {
                $filter[$no++] = "WA_NUMBER  = '".$_POST['wa_number']."'";
                $this->view->d_wa_number = $_POST['wa_number'];
            } 

            if ($_POST['register_number'] != '') {
                $filter[$no++] = "REGISTER_NUMBER  = '".$_POST['register_number']."'";
                $this->view->d_register_number = $_POST['register_number'];
            } 

            if ($_POST['apdpl_number'] != '') {
                $filter[$no++] = "APDPL_NUMBER  = '".$_POST['apdpl_number']."'";
                $this->view->d_apdpl_number = $_POST['apdpl_number'];
            } 

            if ($_POST['type'] != '') {
                if ($_POST['type'] != 'SEMUA') {
                    $filter[$no++] = "TYPE = '" . $_POST['type'] . "'";
                }
                $this->view->d_type = $_POST['type'];
            }
        
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                
                $filter[$no++] = "TO_DATE(BOOK_DATE,'YYYYMMDD') BETWEEN TO_DATE('" . date('Ymd', strtotime($_POST['tgl_awal'])) . "' ,'YYYYMMDD') AND TO_DATE( '" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "','YYYYMMDD') ";
                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
        //}
        
        $this->view->data = $d_nod->get_nod_filter($filter);

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_nod->get_table());

        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/daftarNOD');
    }
    
    public function downloadNOD() {
        $d_nod = new DataNOD($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if (count($_POST['checkbox']) != 0) {
            $array = array("checkbox" => $_POST['checkbox']);
            $ids = implode("','", $array['checkbox']);
            $this->view->judul = "NOD";
        } else {
            echo "<script>alert ('Belum ada yang dipilih (centang/checkmark))</script>";
            header('location:' . URL . 'dataNOD/daftarNOD');
        }
        $this->view->data = $d_nod->get_download_nod($ids);
        //$this->view->data2 = $d_supp->get_tgl_download_sp2d($ids);

        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/downloadNOD');
    }
    
    public function __destruct() {
        
    }

}
