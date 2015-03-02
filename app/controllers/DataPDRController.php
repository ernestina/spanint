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
                $filter[$no++] = " reg_no like '%" . $_POST['nip'] . "%'";
                $this->view->d_nip = $_POST['nip'];
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

    public function refKppn() {   //nama function
        $d_ref = new DataPDR($this->registry); //model
        $filter = array();

        if (isset($_POST['submit_file'])) {
            if ($_POST['nip'] != '') {
                $filter[$no++] = " kdkppn LIKE '" . $_POST['nip'] . "%'";
                $this->view->d_nip = $_POST['nip'];
            }

            if ($_POST['name'] != '') {
                $filter[$no++] = " upper(nmkppn) LIKE '%" . strtoupper($_POST['name']) . "%'";
                $this->view->d_name = $_POST['name'];
            }
            $this->view->judul = 'Referensi KPPN';
            $this->view->action = 'refKppn';
            $this->view->data = $d_ref->get_kppn($filter);
        }

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya('T_AKUN');

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        $this->view->render('admin/refAkun');
    }

    public function refAkun() {   //nama function
        $d_ref = new DataPDR($this->registry); //model
        $filter = array();

        if (isset($_POST['submit_file'])) {
            if ($_POST['nip'] != '') {
                $filter[$no++] = " flex_value LIKE '" . $_POST['nip'] . "%'";
                $this->view->d_nip = $_POST['nip'];
            }

            if ($_POST['name'] != '') {
                $filter[$no++] = " upper(description) LIKE '%" . strtoupper($_POST['name']) . "%'";
                $this->view->d_name = $_POST['name'];
            }
            $this->view->judul = 'Referensi Akun';
            $this->view->action = 'refAkun';
            $this->view->data = $d_ref->get_akun($filter);
        }

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya('T_AKUN');

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        $this->view->render('admin/refAkun');
    }

    public function refSdana() {   //nama function
        $d_ref = new DataPDR($this->registry); //model
        $filter = array();

        if (isset($_POST['submit_file'])) {
            if ($_POST['nip'] != '') {
                $filter[$no++] = " kd_dana LIKE '" . $_POST['nip'] . "%'";
                $this->view->d_nip = $_POST['nip'];
            }

            if ($_POST['name'] != '') {
                $filter[$no++] = " upper(deskripsi) LIKE '%" . strtoupper($_POST['name']) . "%'";
                $this->view->d_name = $_POST['name'];
            }
            $this->view->judul = 'Referensi Sumber Dana';
            $this->view->action = 'refSdana';
            $this->view->data = $d_ref->get_sdana($filter);
        }

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya('T_SDANA');

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        $this->view->render('admin/refAkun');
    }

    public function refLokasi() {   //nama function
        $d_ref = new DataPDR($this->registry); //model
        $filter = array();

        if (isset($_POST['submit_file'])) {
            if ($_POST['nip'] != '') {
                $filter[$no++] = " kdlokasi LIKE '" . $_POST['nip'] . "%'";
                $this->view->d_nip = $_POST['nip'];
            }

            if ($_POST['name'] != '') {
                $filter[$no++] = " upper(nmlokasi) LIKE '%" . strtoupper($_POST['name']) . "%'";
                $this->view->d_name = $_POST['name'];
            }
            $this->view->judul = 'Referensi Lokasi';
            $this->view->action = 'refLokasi';
            $this->view->data = $d_ref->get_lokasi($filter);
        }

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya('T_LOKASI');

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        $this->view->render('admin/refAkun');
    }

    public function refSatker() {   //nama function
        $d_ref = new DataPDR($this->registry); //model
        $filter = array();

        if (isset($_POST['submit_file'])) {
            if ($_POST['nip'] != '') {
                $filter[$no++] = " kdsatker LIKE '" . $_POST['nip'] . "%'";
                $this->view->d_nip = $_POST['nip'];
            }

            if ($_POST['name'] != '') {
                $filter[$no++] = " upper(nmsatker) LIKE '%" . strtoupper($_POST['name']) . "%'";
                $this->view->d_name = $_POST['name'];
            }
            $this->view->judul = 'Referensi Satuan Kerja';
            $this->view->action = 'refSatker';
            $this->view->carikode='Kode Satker';
            $this->view->data = $d_ref->get_satker($filter);
        }

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya('T_SDANA');

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        $this->view->render('admin/refSatker');
    }

    
    public function __destruct() {
        
    }

}
