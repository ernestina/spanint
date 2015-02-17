<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserSpanController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

    public function monitoringUserSpan() {   //nama function
        $d_user = new DataUserSPAN($this->registry); //model
        $filter = array();

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = " KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            } else {
                $filter[$no++] = " KDKPPN = " . Session::get('id_user');
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            }
            if ($_POST['nip'] != '') {
                $filter[] = " USER_NAME = '" . $_POST['nip'] . "'";
                $this->view->d_nip = $_POST['nip'];
            }
            
            $this->data = $d_user->get_user_filter($filter);
            
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = " KDKPPN = " . Session::get('id_user');
            $this->data = $d_user->get_user_filter($filter);
        }
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_user->get_table());

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        
        //Konfigurasi Template
        //Judul dan Subjudul
        
        //$this->view->page_title ---> Judul halaman (string)
        //$this->view->page_subtitle ---> Subjudul halaman (string)
        
        $this->view->page_title = 'Monitoring User Aktif';
        $this->view->page_subtitle = '';
        
        if (isset($this->view->d_nama_kppn)) {
            foreach ($this->view->d_nama_kppn as $kppn) {
                $this->view->page_subtitle = $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ") <br>";
                $kode_kppn = $kppn->get_kd_satker();
            }
        }
        if (isset($this->view->d_nip)) {
            $this->view->page_subtitle  .= "NIP: " . $this->view->d_nip;
        }

        //PDF & XLS 
        if (Session::get('role') == ADMIN || Session::get('role') == KANWIL) {
            if (isset($this->view->d_kd_kppn) || isset($this->view->d_nip)) {
                if (isset($this->view->d_kd_kppn)) {
                    $kdkppn = $this->view->d_kd_kppn;
                } else {
                    $kdkppn = 'null';
                }
                if (isset($this->view->d_nip)) {
                    $kdnip = $this->view->d_nip;
                } else {
                    $kdnip = 'null';
                }
            }
        }
        if (Session::get('role') == KPPN) {
            if (isset($this->view->d_kd_kppn)) {
                $kdkppn = $this->view->d_kd_kppn;
            } else {
                $kdkppn = Session::get('id_user');
            }
            if (isset($this->view->d_nip)) {
                $kdnip = $this->view->d_nip;
            } else {
                $kdnip = 'null';
            }
        }
        
        //$this->view->pdf_url ---> URL untuk download PDF (string)
        //$this->view->xls_url ---> URL untuk download XLS (string)
        
        $this->view->pdf_url = URL . 'PDF/monitoringUserSpan_PDF/' . $kdkppn . '/' . $kdnip . '/PDF';
        $this->view->xls_url = URL . 'PDF/monitoringUserSpan_PDF/' . $kdkppn . '/' . $kdnip . '/PDF';
        
        //Konfigurasi Tabel
        //$this->view->table_config ---> String dipisahkan spasi
        //Parameter tersedia:
        //numbered ---> untuk menyalakan penomoran tabel
        //font-size:x% ---> ukuran font, dalam persentase
        
        $this->view->table_config = 'numbered';
        
        //Kolom dan Konfigurasi Kolom
        $this->view->table_columns = array();
        
        //contoh: $this->view->table_columns[] = (object) array('title' => 'Nama', 'config' => 'align-left');
        //title ---> judul kolom (string)
        //config ---> konfigurasi kolom (string dipisah spasi)
        //parameter tersedia untuk config:
        //align-left, align-right, align-center ---> perataan teks
        //number-format ---> memisahkan angka dengan pemisah desimal
        
        $this->view->table_columns[] = (object) array('title' => 'Nama', 'config' => 'align-left');
        $this->view->table_columns[] = (object) array('title' => 'User Name', 'config' => 'align-center');
        $this->view->table_columns[] = (object) array('title' => 'NIP', 'config' => 'align-center');
        $this->view->table_columns[] = (object) array('title' => 'Posisi', 'config' => 'align-center');
        $this->view->table_columns[] = (object) array('title' => 'E-Mail Depkeu', 'config' => 'align-center');
        $this->view->table_columns[] = (object) array('title' => 'Tanggal Mulai Aktif', 'config' => 'align-center');
        $this->view->table_columns[] = (object) array('title' => 'Tanggal Berakhir', 'config' => 'align-center');
        
        //Baris
        $this->view->table_rows = array();
        
        //$this->view->table_rows ---> array dua dimensi, dimensi pertama untuk baris, dimensi kedua untuk kolom
        
        if (isset($this->data)) {
            foreach ($this->data as $value) {
                $this->view->table_rows[] = array($value->get_last_name(), $value->get_user_name(), $value->get_attribute1(), $value->get_name(),
                                                  $value->get_email_address(), $value->get_start_date(), $value->get_end_date()); 
            }
        }
        
        //Filter dan Konfigurasi Filter
        $this->view->filters = array();
        
        //KPPN
        $options = array();
        if(isset($kppn_list)){
            foreach ($kppn_list as $value1) {
                $options[] = (object) array('value' => $value1->get_kd_d_kppn(), 'text' => $value1->get_kd_d_kppn() . ' | ' . $value1->get_nama_user());   
        }
        
        $this->view->filters[] = (object) array('label' => 'KPPN', 'name' => 'kdkppn', 'type' => 'select', 'options' => $options, 'selected' => $_POST['kdkppn']);
        }
        //NIP
        $this->view->filters[] = (object) array('label' => 'NIP', 'name' => 'nip', 'type' => 'number', 'size' => '18');
        
        $this->view->render('Template-Default');
    }
    
    public function invoiceProses() {
        $d_user = new DataUserSPAN($this->registry);
        $filter = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        /*
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        */
        if (Session::get('role') == KPPN) {
            $filter[$no++] = " KDKPPN = '" . Session::get('id_user') . "'";
            $this->view->data = $d_user->get_spm_gantung($filter);
            
        }

        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = " KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            } else {
                $filter[$no++] = " KDKPPN = " . Session::get('id_user');
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            }

            $this->view->data = $d_user->get_spm_gantung($filter);
        } 
        //var_dump ($d_user->get_spm_gantung($filter));
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_user->get_table1());
		
        $this->view->render('kppn/invoiceProses');
		$d_log->tambah_log("Sukses");
    
    }
    
    public function pergantianUser(){
        $d_user = new DataUserSPAN($this->registry);
        $filter = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        /*
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        */
        if (Session::get('role') == KPPN) {
            $filter[$no++] = " KODE_UNIT = '" . Session::get('id_user') . "'";
            $this->view->data = $d_user->get_ganti_user($filter);
            
        }

        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = " KODE_UNIT = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            } else {
                $filter[$no++] = " KODE_UNIT = " . Session::get('id_user');
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            }

            $this->view->data = $d_user->get_ganti_user($filter);
        } 
        //var_dump ($d_user->get_spm_gantung($filter));
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_user->get_table4());
		
        $this->view->render('kppn/gantiUserSpan');
		$d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
