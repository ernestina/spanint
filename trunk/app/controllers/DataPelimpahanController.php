<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPelimpahanController extends BaseController {
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

    public function monitoringPelimpahan() {
        $d_limpah = new DataPelimpahan($this->registry);
        $filter = array();
        $no = 0;
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN_ANAK = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            } else {
                $filter[$no++] = "KPPN_ANAK= '" . Session::get('id_user')."'";
            }
           
            if ($_POST['status'] != '') {
                if ($_POST['status'] != 'SEMUA') {
                    $filter[$no++] = "STATUS = '" . $_POST['status'] . "'";
                }
                $this->view->d_status = $_POST['status'];
            }
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "TGL_LIMPAH BETWEEN TO_DATE ('" . date('Ymd', strtotime($_POST['tgl_awal'])) . "','YYYYMMDD') 
								AND TO_DATE ('" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "','YYYYMMDD')  ";

                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
            if (Session::get('role') == SATKER) {
                $filter[$no++] = " KDSATKER = '" . Session::get('kd_satker') . "'";
                $this->view->d_satker = Session::get('kd_satker');
            }
            $this->view->data = $d_limpah->get_limpah_filter($filter);
        }
        if (Session::get('role') == ADMIN OR Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_limpah->get_table());

        //var_dump($d_sppm->get_sppm_filter($filter));
        $this->view->render('kppn/daftarPelimpahan');
    }

    public function __destruct() {
        
    }

}
