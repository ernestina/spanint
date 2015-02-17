<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BA_ES1Controller extends BaseController {
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

    public function DataRealisasiKegiatanBA() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		
		
        if (isset($_POST['submit_file'])) {

            if ($_POST['KEGIATAN'] != '') {
                $filter[$no++] = "SUBSTR(OUTPUT,1,4) = '" . $_POST['KEGIATAN'] . "'";
                $this->view->lokasi = $_POST['KEGIATAN'];
            }           
        }
		
        $filter[$no++] = "SUBSTR(PROGRAM,1,3) = '" . Session::get('kd_baes1')."'";
		
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        
		$this->view->data = $d_spm1->get_ba_kegiatan_filter($filter);
		
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiKegiatan');
    }
	
	public function DataRealisasiKegiatanES1() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		$this->view->data = $d_spm1->get_ba_kegiatan_filter($filter);
		
        if (isset($_POST['submit_file'])) {

            if ($_POST['KEGIATAN'] != '') {
                $filter[$no++] = "SUBSTR(OUTPUT,1,4) = '" . $_POST['KEGIATAN'] . "'";
                $this->view->lokasi = $_POST['KEGIATAN'];
            }           
        }
		
        $filter[$no++] = "SUBSTR(PROGRAM,1,5) = '" . Session::get('kd_baes1')."'";
		
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        
		$this->view->data = $d_spm1->get_ba_kegiatan_filter($filter);
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiKegiatan');
    }
	
	public function DataRealisasiPenerimaanBA() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if (Session::get('role') == KL){		
			$filter[$no++] =  "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1')."'";			
		}
		if (Session::get('role') == ES1){		
			$filter[$no++] =  "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1')."'";			
		}
		
		
        if (isset($_POST['submit_file'])) {

            if ($_POST['KEGIATAN'] != '') {
                $filter[$no++] = "SUBSTR(OUTPUT,1,4) = '" . $_POST['KEGIATAN'] . "'";
                $this->view->lokasi = $_POST['KEGIATAN'];
            }           
        }
		
        
		
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        
		$this->view->data = $d_spm1->get_ba_pendapatan_filter($filter);
		
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiPenerimaan');
    }
	
	public function DataRealisasiAkunBA() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		$filter[$no++] =  "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1')."'";
		
        if (isset($_POST['submit_file'])) {
            
            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }            
        }      

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());        
		
		$this->view->data = $d_spm1->get_realisasi_fa_global_kl_filter($filter);
		
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiBA');
    }
	
	public function DataRealisasiAkunES1() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		
		if (Session::get('role') == KL){		
			$filter[$no++] =  "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1')."'";			
		}
		if (Session::get('role') == ES1){		
			$filter[$no++] =  "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1')."'";			
		}
		
        if (isset($_POST['submit_file'])) {
            
            if ($_POST['satker'] != '') {
                $filter[$no++] = "b.kdsatker = '" . $_POST['satker'] . "'";
                $this->view->satker = $_POST['satker'];
            }            
        }      

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());        
		
		$this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);
		
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiES1');
    }
	
	public function DataRealisasiKewenanganBAES1() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if (Session::get('role') == KL){		
			$filter[$no++] =  "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1')."'";			
		}
		if (Session::get('role') == ES1){		
			$filter[$no++] =  "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1')."'";			
		}
		
        if (isset($_POST['submit_file'])) {
            
            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }            
        }      

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());        
		
		$this->view->data = $d_spm1->get_realisasi_fa_kewenangan_baes1_filter($filter);
		
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiKewenaganBAES1');
    }
	
	public function DataRealisasiSumberDanaBAES1() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if (Session::get('role') == KL){		
			$filter[$no++] =  "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1')."'";			
		}
		if (Session::get('role') == ES1){		
			$filter[$no++] =  "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1')."'";			
		}
		
        if (isset($_POST['submit_file'])) {
            
            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }            
        }      

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());        
		
		$this->view->data = $d_spm1->get_realisasi_fa_sumber_dana_baes1_filter($filter);
		
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiSumberDanaBAES1');
    }
	
	public function DataRealisasiWilayahBAES1() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if (Session::get('role') == KL){		
			$filter[$no++] =  "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1')."'";			
		}
		if (Session::get('role') == ES1){		
			$filter[$no++] =  "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1')."'";			
		}
		
        if (isset($_POST['submit_file'])) {
            
            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }            
        }      

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());        
		
		$this->view->data = $d_spm1->get_realisasi_fa_wilayah_baes1_filter($filter);
		
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiLokasiBAES1');
    }
	
	public function nmsatker() {
        $d_spm1 = new DataNamaSatker($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table4());
		
		if (Session::get('role') == KL){		
			$filter[$no++] =  "B.BA = '" . Session::get('kd_baes1')."'";			
		}
		if (Session::get('role') == ES1){		
			$filter[$no++] =  "B.BAES1 = '" . Session::get('kd_baes1')."'";			
		}
		
        if (isset($_POST['submit_file'])) {           

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "A.KDSATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->d_kd_satker = $_POST['kdsatker'];
            }
            if ($_POST['nmsatker'] != '') {
                $filter[$no++] = " UPPER(A.NMSATKER) LIKE UPPER('%" . $_POST['nmsatker'] . "%')";
                $this->view->d_nm_satker = $_POST['nmsatker'];
            }
			if ($_POST['eselon1'] != '') {
                $filter[$no++] = "B.BAES1 = '" . $_POST['eselon1'] . "'";
                $this->view->eselon1 = $_POST['eselon1'];
            }
            if ($_POST['revisi'] != '') {
                if ($_POST['revisi'] == '0') {
                    $filter[$no++] = "A.REV = 0";
                    $this->view->d_kd_revisi = $_POST['revisi'];
                }
				
                elseif ($_POST['revisi'] == '1') {
                    $filter[$no++] = "A.REV > 0";
                    $this->view->d_kd_revisi = $_POST['revisi'];
                }
            }                                   
                      		
        }
        
		$this->view->data = $d_spm1->get_baes1_dipa_filter($filter);
        $this->view->data1 = $d_spm1->get_es1_dipa_filter(); 
		
        if (Session::get('role') == ES1) {
            $this->view->render('baes1/NamaSatkerDIPA1');
        } 
		
		if (Session::get('role') == KL) {
            $this->view->render('baes1/NamaSatkerDIPA');
        }
        
        
        $d_log->tambah_log("Sukses");
        //var_dump($d_spm1->get_satker_filter($filter));
        //$this->view->render('kppn/NamaSatkerDIPA1');
    }
	
	public function ProsesRevisi($satker = NULL) {
        $d_spm1 = new proses_revisi($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if (Session::get('role') == KL){		
			$filter[$no++] =  "B.BA = '" . Session::get('kd_baes1')."'";			
		}
		if (Session::get('role') == ES1){		
			$filter[$no++] =  "B.BAES1 = '" . Session::get('kd_baes1')."'";			
		}
		
        if ($satker != '') {
            $filter[$no++] = " A.SATKER_CODE =  '" . $satker . "'";
            $this->view->satker_code = $satker;
        }
        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "A.KPPN_CODE = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            }
            /* else {
              $filter[$no++]="TS.KPPN = '".Session::get('id_user')."'";
              } */

            if ($_POST['satker'] != '') {
                $filter[$no++] = "A.SATKER_CODE = '" . $_POST['satker'] . "'";
                $this->view->d_kd_satker = $_POST['satker'];
            }
            if ($_POST['nmsatker'] != '') {
                $filter[$no++] = " UPPER(B.NMSATKER) LIKE UPPER('%" . $_POST['nmsatker'] . "%')";
                $this->view->d_nm_satker = $_POST['nmsatker'];
            }
        }
        
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_revisi_dipa($filter);

        $this->view->render('baes1/proses_revisi');
        $d_log->tambah_log("Sukses");
    }
	
	public function RekapSp2dBAES1() {
        $d_spm1 = new DataCheck($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		 
		 if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
		 }
		 else {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
		 }
		 
		if (Session::get('role') == KL){		
			$filter[$no++] =  "B.BA = '" . Session::get('kd_baes1')."'";			
		}
		if (Session::get('role') == ES1){		
			$filter[$no++] =  "B.BAES1 = '" . Session::get('kd_baes1')."'";			
		}
		 
        if (isset($_POST['submit_file'])) {
            

            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($_POST['tgl_awal'])) . "' AND '" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "'";

                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }			           
        
		}
        
        //$this->view->data = $d_spm1->get_sp2d_rekap_filter ($filter);
        //var_dump($d_spm1->get_error_spm_filter ($filter));
		
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		
		$this->view->data = $d_spm1->get_sp2d_rekap_baes1_filter ($filter);
		
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/RekapSP2D');
    }
	
	public function detailrekapsp2dBAES1($jenis_spm = null, $kppn = null, $tgl_awal = null, $tgl_akhir = null) {
        $d_spm1 = new DataCheck($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
		 }
		 else {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
		 }
		 
		if (Session::get('role') == KL){		
			$filter[$no++] =  "SEGMENT1 IN (SELECT KDSATKER FROM T_SATKER WHERE BA = '" . Session::get('kd_baes1')."')";			
		}
		if (Session::get('role') == ES1){		
			$filter[$no++] =  "SEGMENT1 IN (SELECT KDSATKER FROM T_SATKER WHERE BAES1 = '" . Session::get('kd_baes1')."')";			
		}
		 
        if ($jenis_spm != '') {
            $filter[$no++] = " JENDOK =  '" . $jenis_spm . "'";
            $this->view->jendok = $jenis_spm;
        }
        
        if ($tgl_awal != '' AND $tgl_akhir != '') {

            $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($tgl_awal)) . "' AND '" . date('Ymd', strtotime($tgl_akhir)) . "'";

            $this->view->d_tgl_awal = $tgl_awal;
            $this->view->d_tgl_akhir = $tgl_akhir;
        }

        $this->view->data = $d_spm1->get_sp2d_satker_filter($filter);

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/Rekap');
    }
	
	public function nmsatkerBAES1() {
        $d_spm1 = new DataNamaSatker($this->registry);
		
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
		 }
		 else {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
		 }
		
		
        if (isset($_POST['submit_file'])) {

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "SEGMENT1 = '" . $_POST['kdsatker'] . "'";
                $this->view->d_kd_satker = $_POST['kdsatker'];
            }
            if ($_POST['nmsatker'] != '') {
                $filter[$no++] = " UPPER(NMSATKER) LIKE UPPER('%" . $_POST['nmsatker'] . "%')";
                $this->view->d_nm_satker = $_POST['nmsatker'];
            }
			if ($_POST['eselon1'] != '') {
                $filter[$no++] = "B.BAES1 = '" . $_POST['eselon1'] . "'";
                $this->view->eselon1 = $_POST['eselon1'];
            }
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {

                $filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($_POST['tgl_awal'])) . "' AND '" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "'";

                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
                     		
        }
        if (Session::get('role') == KL){		
			$filter[$no++] =  "B.BA = '" . Session::get('kd_baes1')."'";			
		}
		if (Session::get('role') == ES1){		
			$filter[$no++] =  "B.BAES1 = '" . Session::get('kd_baes1')."'";			
		}
        
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table2());
		
		$this->view->data1 = $d_spm1->get_es1_dipa_filter(); 
		$this->view->data = $d_spm1->get_baes1_satker_filter($filter);
        
        $this->view->render('baes1/NamaSatker');
        $d_log->tambah_log("Sukses");
    }

    //author by jhon

    public function __destruct() {
        
    }

}
