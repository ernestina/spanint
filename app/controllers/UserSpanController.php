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
            $this->view->page_subtitle  .= "NIP: " . $this->view->d_nip1;
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
    
    public function invoiceProses($kdkppn=null) {
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
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        
        if (isset($kdkppn)) {
            $filter[$no++] = " KDKPPN = '" . $kdkppn . "'";
                $this->view->d_kd_kppn = $kdkppn;
            
        }

        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = " KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
                
            }
        } 
        //var_dump($this->view->d_kd_kppn);
        $this->view->data = $d_user->get_spm_gantung($filter);
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
        
        $this->view->posisi_user = $d_user->get_posisi_user();

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        
        if (Session::get('role') == UMADMIN) {
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
        //var_dump($this->view->data);
        
        if (isset($_POST['add_d_user'])) {
            
            $kdkppn = $_POST['kdkppn'];
            $nip1 = $_POST['nip1'];
            $nip2 = $_POST['nip2'];
            $nama1 = $_POST['nama1'];
            $nama2 = $_POST['nama2'];
            $email1 = $_POST['email1'];
            $email2 = $_POST['email2'];
            $posisi1 = $_POST['posisi1'];
            $posisi2 = $_POST['posisi2'];
            $surat = $_POST['surat'];
            $tanggal_awal = $_POST['tanggal_awal'];
            if(isset($_POST['tanggal_akhir'])){
                $tanggal_akhir = $_POST['tanggal_akhir'];  
                $this->view->tanggal_akhir = $_POST['tanggal_akhir'];  
            }
            $status1 = $_POST['status1'];
            $status2 = $_POST['status2'];
            if (isset($_POST['catatan'])){
                $catatan = $_POST['catatan'];
                $this->view->catatan = $_POST['catatan'];
            }
            
            
            $this->view->kdkppn = $_POST['kdkppn'];
            $this->view->nip1 = $_POST['nip1'];
            $this->view->nip2 = $_POST['nip2'];
            $this->view->nama1 = $_POST['nama1'];
            $this->view->nama2 = $_POST['nama2'];
            $this->view->email1 = $_POST['email1'];
            $this->view->email2 = $_POST['email2'];
            $this->view->posisi1 = $_POST['posisi1'];
            $this->view->posisi2 = $_POST['posisi2'];
            $this->view->surat = $_POST['surat'];
            $this->view->tanggal_awal = $_POST['tanggal_awal'];
            //var_dump($_POST['tanggal_awal']);
            $this->view->status1 = $_POST['status1'];
            $this->view->status2 = $_POST['status2'];
            
            
            $d_user->set_kode_unit($kdkppn);
            
            $d_user->set_nama_usr_awal($nama1);
            $d_user->set_nip_usr_awal($nip1);
            $d_user->set_email_usr_awal($email1);
            $d_user->set_posisi_user_awal($posisi1);
            
            $d_user->set_nama_usr_pengganti($nama2);
            $d_user->set_nip_usr_pengganti($nip2);
            $d_user->set_email_usr_pengganti($email2);
            $d_user->set_posisi_user_pengganti($posisi2);
            
            $d_user->set_tanggal_awal($tanggal_awal);
            $d_user->set_tanggal_akhir($tanggal_akhir);
            $d_user->set_surat($surat);
            $d_user->set_status_setup_awal($status1);
            $d_user->set_status_setup_akhir($status2);
            $d_user->set_catatan($catatan);
            
            if (!$d_user->add_d_user()) {
                $this->view->d_rekam = $d_user;
                $this->view->error = $d_user->get_error();
            }
        }

        if (isset($_POST['submit_file'])) {
            if(isset($_POST['kdkppn'])){
                if ($_POST['kdkppn'] != 'SEMUAKPPN') {
                    $filter[$no++] = " KODE_UNIT = '" . $_POST['kdkppn'] . "'";
                    $d_kppn = new DataUser($this->registry);
                    $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                    $this->view->d_kd_kppn = $_POST['kdkppn'];
                }
                //$this->view->d_posisi = $d_posisi->get_posisi_user($_POST['kd_posisi'])
            } 

            if ($_POST['d_nip1'] != '') {
                $filter[$no++] = " NIP_USR_AWAL = '". $_POST['d_nip1'] . "'";
                $this->view->d_nip1 = $_POST['d_nip1'];
            }

            if ($_POST['d_nip2'] != '') {
                $filter[$no++] = " NIP_USR_PENGGANTI = '". $_POST['d_nip2'] . "'";
                $this->view->d_nip2 = $_POST['d_nip2'];
            }

            if ($_POST['d_catatan'] != '') {
                $filter[$no++] = " upper(CATATAN) like upper('%" . $_POST['d_catatan'] . "%')";
                $this->view->d_catatan = $_POST['d_catatan'];
            }

        } 
        
        $this->view->data = $d_user->get_ganti_user($filter);
        //var_dump ($d_user->get_spm_gantung($filter));
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_user->get_table4());
		
        $this->view->render('kppn/gantiUserSpan');
		$d_log->tambah_log("Sukses");
    }
    
    /*
     * tambah data user
     */

    public function addDataUserSpan($id = null) {
        
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            
            //$d_posisi = array();
            //$this->view->posisi = $d_posisi->get_posisi_user();
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
        
        $d_user = new DataUserSPAN($this->registry);
        $filter = array();
        $no = 0;
        
        if (isset($_POST['add_d_user'])) {
            
            $kdkppn = $_POST['kdkppn'];
            $nip1 = $_POST['nip1'];
            $nip2 = $_POST['nip2'];
            $nama1 = $_POST['nama1'];
            $nama2 = $_POST['nama2'];
            $email1 = $_POST['email1'];
            $email2 = $_POST['email2'];
            $posisi1 = $_POST['posisi1'];
            $posisi2 = $_POST['posisi2'];
            $surat = $_POST['surat'];
            $tanggal_awal = $_POST['tanggal_awal'];
            if(isset($_POST['tanggal_akhir'])){
                $tanggal_akhir = $_POST['tanggal_akhir'];  
                $this->view->d_tanggal_akhir = $_POST['akhir'];  
            }
            $status1 = $_POST['status1'];
            $status2 = $_POST['status2'];
            if (isset($_POST['catatan'])){
                $catatan = $_POST['catatan'];
                $this->view->d_catatan = $_POST['catatan'];
            }
            
            
            $this->view->d_kdkppn = $_POST['kdkppn'];
            $this->view->d_nip1 = $_POST['nip1'];
            $this->view->d_nip2 = $_POST['nip2'];
            $this->view->d_nama1 = $_POST['nama1'];
            $this->view->d_nama2 = $_POST['nama2'];
            $this->view->d_email1 = $_POST['email1'];
            $this->view->d_email2 = $_POST['email2'];
            $this->view->d_posisi1 = $_POST['posisi1'];
            $this->view->d_posisi2 = $_POST['posisi2'];
            $this->view->d_surat = $_POST['surat'];
            $this->view->d_tanggal_awal = $_POST['tanggal_awal'];
            $this->view->d_status1 = $_POST['status1'];
            $this->view->d_status2 = $_POST['status2'];
            
            
            $d_user->set_kode_unit($kdkppn);
            
            $d_user->set_nama_usr_awal($nama1);
            $d_user->set_nip_usr_awal($nip1);
            $d_user->set_email_usr_awal($email1);
            $d_user->set_posisi_user_awal($posisi1);
            
            $d_user->set_nama_usr_pengganti($nama2);
            $d_user->set_nip_usr_pengganti($nip2);
            $d_user->set_email_usr_pengganti($email2);
            $d_user->set_posisi_user_pengganti($posisi2);
            
            $d_user->set_tanggal_awal($tanggal_awal);
            $d_user->set_tanggal_akhir($tanggal_akhir);
            $d_user->set_surat($surat);
            $d_user->set_status_setup_awal($status1);
            $d_user->set_status_setup_akhir($status2);
            $d_user->set_catatan($catatan);
            
            if (!$d_user->add_d_user()) {
                $this->view->d_rekam = $d_user;
                $this->view->error = $d_user->get_error();
            }
        }
        //var_dump($catatan);
        
        if (!is_null($id)) {
            $d_user->set_kd_d_user($id);
            $this->view->d_ubah = $d_user->get_d_user_by_id($d_user);
        }
        $this->view->data = $d_user->get_ganti_user($filter);
        $this->view->render('kppn/gantiUserSpan');
    }
    
    public function kontrakProses($kdkppn=null) {
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
            $filter[$no++] = " KPPN = '" . Session::get('id_user') . "'";
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        
        if (isset($kdkppn)) {
            $filter[$no++] = " KPPN = '" . $kdkppn . "'";
            $this->view->d_kd_kppn = $kdkppn;
        }

        if (isset($_POST['submit_file'])) {
            if ($_POST['kppn'] != '') {
                $filter[$no++] = " KPPN = '" . $_POST['kppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kppn'];
                
            }
        } 
        $this->view->data = $d_user->get_kontrak_gantung($filter);
        //var_dump ($d_user->get_spm_gantung($filter));
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_user->get_table1());
		
        $this->view->render('kppn/kontrakProses');
		$d_log->tambah_log("Sukses");
    
    }
    
    public function supplierProses($kdkppn=null) {
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
            $filter[$no++] = " SUBSTR(POSITION_HIERARCHY, 1, 3) = '" . Session::get('id_user') . "'";
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        
        if (isset($kdkppn)) {
            $filter[$no++] = " SUBSTR(POSITION_HIERARCHY, 1, 3) = '" . $kdkppn . "'";
            $this->view->d_kd_kppn = $kdkppn;
        }

        if (isset($_POST['submit_file'])) {
            if ($_POST['kppn'] != '') {
                $filter[$no++] = " KPPN = '" . $_POST['kppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kppn'];
                
            }
        } 
        $this->view->data = $d_user->get_supplier_gantung($filter);
        //var_dump ($d_user->get_spm_gantung($filter));
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_user->get_table1());
		
        $this->view->render('kppn/supplierProses');
		$d_log->tambah_log("Sukses");
    
    }
    
    

    public function __destruct() {
        
    }

}
