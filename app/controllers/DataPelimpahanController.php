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
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
        if (Session::get('role') == ADMIN || Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_anak = $d_kppn_list->get_kppn_kanwil();
            $this->view->kppn_induk = $d_kppn_list->get_induk_limpah();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            //$this->view->kppn_anak = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            //$this->view->kppn_induk = $d_kppn_list->get_induk_limpah(Session::get('id_user'));
            $this->view->kppn_anak = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $this->view->kppn_induk = $d_kppn_list->get_induk_limpah(Session::get('id_user'));
        }
        if (Session::get('role') == KPPN) {
            $d_kppn_list = new DataUser($this->registry);
			$kppn_list = $d_kppn_list->get_induk_limpah_kppn(Session::get('id_user'));
			if (count($kppn_list)>0){
				$filter[$no++] = "KPPN_INDUK= '" . Session::get('id_user')."'";
			}
            $this->view->kppn_anak = $kppn_list;
        }
		
        if (isset($_POST['submit_file'])) {
            if ($_POST['kppn_anak'] != '') {
				if ($_POST['kppn_anak'] != 'SEMUA') {
					$filter[$no++] = "KPPN_ANAK = '" . $_POST['kppn_anak'] . "'";
				} /*else if ($_POST['kppn_anak'] == Session::get('kd_satker')){
					$filter[$no++] = "KPPN_ANAK= '" . Session::get('id_user')."'";
				}*/
				$this->view->d_kppn_anak = $_POST['kppn_anak'];
            } else {
				$filter[$no++] = "KPPN_ANAK= '" . Session::get('id_user')."'";
			}
			
			if ($_POST['kppn_induk'] != '') {
				if ($_POST['kppn_induk'] != 'SEMUA') {
					$filter[$no++] = "KPPN_INDUK = '" . $_POST['kppn_induk'] . "'";
				} 
				$this->view->d_kppn_induk = $_POST['kppn_induk'];
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
            $this->view->data = $d_limpah->get_limpah_filter($filter);
        }

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_limpah->get_table());
		

        //var_dump($d_sppm->get_sppm_filter($filter));
        $this->view->render('kppn/daftarPelimpahan');
		
		$d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
