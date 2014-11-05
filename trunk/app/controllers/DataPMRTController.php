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
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN_CODE = '" . $_POST['kdkppn'] . "'";
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            }

            if ($_POST['tipesup'] != '') {
                $filter[$no++] = "substr(TIPE_SUPP,1,1) = '" . $_POST['tipesup'] . "'";
                $this->view->d_tipesup = $_POST['tipesup'];
            }

            if ($_POST['nrs'] != '') {
                $filter[$no++] = " upper(v_supplier_number) like 'upper(%" . $_POST['nrs'] . "%')";
                $this->view->d_nrs = $_POST['nrs'];
            }

            if ($_POST['namasupplier'] != '') {
                $filter[$no++] = " upper(nama_supplier) like upper('%" . $_POST['namasupplier'] . "%')";
                $this->view->d_namasupplier = $_POST['namasupplier'];
            }

            if ($_POST['npwpsupplier'] != '') {
                $filter[$no++] = " upper(npwp_supplier) like upper('%" . $_POST['npwpsupplier'] . "%')";
                $this->view->d_npwpsupplier = $_POST['npwpsupplier'];
            }

            if ($_POST['nip'] != '') {
                $filter[$no++] = " upper(nip_penerima) like upper('%" . $_POST['nip'] . "%')";
                $this->view->d_nip = $_POST['nip'];
            }

            if ($_POST['namapenerima'] != '') {
                $filter[$no++] = " upper(nm_penerima) like upper('%" . $_POST['namapenerima'] . "%')";
                $this->view->d_namapenerima = $_POST['namapenerima'];
            }

            if ($_POST['norek'] != '') {
                $filter[$no++] = " upper(norek_bank) like upper('%" . $_POST['norek'] . "%')";
                $this->view->d_norek = $_POST['norek'];
            }

            if ($_POST['namarek'] != '') {
                $filter[$no++] = " upper(nm_pemilik_rek) like upper('%" . $_POST['namarek'] . "%')";
                $this->view->d_namarek = $_POST['namarek'];
            }

            if ($_POST['npwppenerima'] != '') {
                $filter[$no++] = " upper(npwp_penerima) like upper('%" . $_POST['npwppenerima'] . "%')";
                $this->view->d_npwppenerima = $_POST['npwppenerima'];
            }
            $this->view->data = $d_supp->get_supp_filter($filter);
        }*/

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_pmrt->get_table());

        $this->view->render('kppn/cekPMRT');
        $d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
