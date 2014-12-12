<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPMRTPKNController extends BaseController {
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
    
    public function DataSPMAkhirTahun() {
        $d_pmrtpkn = new DataPMRTPKN($this->registry);
        $filter = array();
        $no = 0;
        $this->view->judul = "Data SPM Akhir Tahun 2014";

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        //narik list kppn
        $d_kppn_list = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();

        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            } else {
                $this->view->d_kd_kppn = 'SEMUA';
            }
            $this->view->data = $d_pmrtpkn->get_pmrt_pkn_filter($filter);
        }
        
        //$filter[$no++] = " KDKPPN <> '999'  ";

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_pmrtpkn->get_table1());

        $this->view->render('kppn/daftarPmrtPkn');
        $d_log->tambah_log("Sukses");
    }

    public function DataSPMAkhirTahunXls($ex,$kppn=null) {
        $d_pmrtpkn = new DataPMRTPKN($this->registry);
        $filter = array();
        $no = 0;
        $this->view->judul = "ALL";
        $this->view->ex=$ex;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        //narik list kppn
        $d_kppn_list = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();

        
        if ($kppn != '') {
            if($kppn !='SEMUA'){
                $filter[$no++] = "KDKPPN = '" . $kppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kppn);
                $this->view->d_kd_kppn = $kppn;
            }
            $this->view->data = $d_pmrtpkn->get_pmrt_pkn_xls_filter($filter); 
        }
        
        //$filter[$no++] = " KDKPPN <> '999'  ";

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_pmrtpkn->get_table1());

        $this->view->load('pkn/daftarPmrtPknbXls');
        $d_log->tambah_log("Sukses");
    }
    
    public function DataSPMAkhirTahunNihil() {
        $d_pmrtpkn = new DataPMRTPKN($this->registry);
        $filter = array();
        $no = 0;
        $this->view->judul = "Data SPM GU Nihil Akhir Tahun 2014";

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        //narik list kppn
        $d_kppn_list = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();

        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            } else {
                $this->view->d_kd_kppn = 'SEMUA';
            }
            $this->view->data = $d_pmrtpkn->get_pmrt_pkn_nihil_filter($filter);
        }
        
        //$filter[$no++] = " KDKPPN <> '999'  ";

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_pmrtpkn->get_table2());

        $this->view->render('kppn/daftarPmrtPkn');
        $d_log->tambah_log("Sukses");
    }
    
    public function DataSPMAkhirTahunNihilXls($ex,$kppn=null) {
        $d_pmrtpkn = new DataPMRTPKN($this->registry);
        $filter = array();
        $no = 0;
        $this->view->judul = "NIHIL";
        $this->view->ex=$ex;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        //narik list kppn
        $d_kppn_list = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();

        
        if ($kppn != '') {
            if($kppn !='SEMUA'){
                $filter[$no++] = "KDKPPN = '" . $kppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kppn);
                $this->view->d_kd_kppn = $kppn;
            }
            $this->view->data = $d_pmrtpkn->get_pmrt_pkn_nihil_filter($filter);
        }
        
        //$filter[$no++] = " KDKPPN <> '999'  ";

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_pmrtpkn->get_table2());

        $this->view->load('pkn/daftarPmrtPknbXls');
        $d_log->tambah_log("Sukses");
    }
    
    public function DataSPMAkhirTahunBUN() {
        $d_pmrtpkn = new DataPMRTPKN($this->registry);
        $filter = array();
        $no = 0;
        $this->view->judul = "Data SPM Satker BUN Akhir Tahun 2014";

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        //narik list kppn
        $d_kppn_list = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();

        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            } else {
                $this->view->d_kd_kppn = 'SEMUA';
            }
            $this->view->data = $d_pmrtpkn->get_pmrt_pkn_bun_filter($filter);
        }
        
        //$filter[$no++] = " KDKPPN <> '999'  ";

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_pmrtpkn->get_table3());

        $this->view->render('kppn/daftarPmrtPkn');
        $d_log->tambah_log("Sukses");
    }
    
    public function DataSPMAkhirTahunBUNXls($ex,$kppn=null) {
        $d_pmrtpkn = new DataPMRTPKN($this->registry);
        $filter = array();
        $no = 0;
        $this->view->judul = "BUN";
        $this->view->ex=$ex;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        //narik list kppn
        $d_kppn_list = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();

        
        if ($kppn != '') {
            if($kppn !='SEMUA'){
                $filter[$no++] = "KDKPPN = '" . $kppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kppn);
                $this->view->d_kd_kppn = $kppn;
            }
            $this->view->data = $d_pmrtpkn->get_pmrt_pkn_bun_filter($filter);
        }
        
        //$filter[$no++] = " KDKPPN <> '999'  ";

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_pmrtpkn->get_table3());

        $this->view->load('pkn/daftarPmrtPknbXls');
        $d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
