<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataMpnBiController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

    public function MpnBi() {
        $d_mpnbi = new DataMpnBi($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $kdkcbi = $d_mpnbi->getKdKdkcbi(Session::get('id_user'));
            if ($kdkcbi == 3) {
                $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            } else {
                $filter[$no++] = "KDKPPN_KBI = '" . Session::get('id_user') . "'";
            }
        }
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                if ($_POST['kdkppn'] != 'SEMUA KPPN') {
                    $kdkcbi = $d_mpnbi->getKdKdkcbi($_POST['kdkppn']);
                    if ($kdkcbi == 3) {
                        $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                    } else {
                        $filter[$no++] = "KDKPPN_KBI = '" . $_POST['kdkppn'] . "'";
                    }
                    $d_kppn = new DataUser($this->registry);
                    $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                    $this->view->d_kd_kppn = $_POST['kdkppn'];
                }
            } else {
                $filter[$no++] = "KDKPPN_KBI = '" . Session::get('id_user') . "'";
            }
            
            
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "TO_DATE(TANGGAL_GL,'YYYYMMDD') BETWEEN TO_DATE ('" . date('Ymd', strtotime($_POST['tgl_awal'])) . "','YYYYMMDD') AND TO_DATE ('" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "','YYYYMMDD')  ";
                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
        }
        
        
        $this->view->data = $d_mpnbi->get_mpn_bi_filter($filter,$kdkcbi);
        $this->view->kdkcbi = $kdkcbi;
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_mpnbi->get_table());

        $this->view->render('kppn/daftarMpnBi');
        $d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
