<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataBLUController extends BaseController {
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

    /*
      public function infoSP2D() {
      $d_spm = new DataSPM($this->registry);
      d_spm->get_spm_filter();
      //var_dump($d_spm1->get_sppm_filter($filter));
      $this->view->render('kppn/isianSPM');
      }
     */

    public function KarwasBLU() {
        $d_spm1 = new DataBLU($this->registry);
        $filter = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		
		
		if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN_CODE = '" . $_POST['kdkppn']."'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				
            } else {
                $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
            }
					
			
            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "SATKER_CODE = '" . $_POST['kdsatker'] . "'";
				$this->view->nmsatker = $d_spm1->get_nama_satker_pnbp($_POST['kdsatker']);
            }
       
		}
		
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KDKPPN = '" . Session::get('id_user')."'";			
        }
		$this->view->data = $d_spm1->get_rekap_sp3b($filter);
        
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        //var_dump($d_last_update->get_last_updatenya($d_spm1->get_table1()));
		
		$d_log->tambah_log("Sukses");
		
		
        $this->view->render('blu/karwasBLU');
    }
	
	public function DaftarSP3($bulan, $satker) {
        $d_spm1 = new DataBLU($this->registry);
        $filter = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		
		if ($bulan != '') {           
                $filter[$no++] = " TO_CHAR(CHECK_DATE,'MM') =  '" .$bulan. "'";
				$this->view->bulan = $bulan;				
        }
		
		if ($satker != '') {           
                $filter[$no++] = " SUBSTR(INVOICE_NUM,8,6) =  '" .$satker. "'";
				$this->view->satker = $satker;
				
        }
		
		
		if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN_CODE = '" . $_POST['kdkppn']."'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				
            } else {
                $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
            }
									
            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "SATKER_CODE = '" . $_POST['kdsatker'] . "'";
				
            }
       
		}
		
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KDKPPN = '" . Session::get('id_user')."'";			
        }
		$this->view->data = $d_spm1->get_daftar_sp3b($filter);
		$this->view->data1 = $d_spm1->get_kdsatker_blu($satker);
        
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table2());
		
		$d_log->tambah_log("Sukses");
		
		
        $this->view->render('blu/daftarSP3');
    }
	
	public function CariSP3B() {
        $d_spm1 = new DataBLU($this->registry);
        $filter = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		
		
		if (isset($_POST['submit_file'])) {
            /*if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN_CODE = '" . $_POST['kdkppn']."'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				
            } else {
                $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
            }*/
						
			
            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "SEGMENT1 = '" . $_POST['kdsatker'] . "'";
				$this->view->kdsatkerr = $_POST['kdsatker'];
            }
			if ($_POST['invoice'] != '') {
                $filter[$no++] = "INVOICE_NUM = '" . $_POST['invoice'] . "'";
				$this->view->invoice = $_POST['invoice'];
            }
			
			if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "TO_CHAR(INVOICE_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($_POST['tgl_awal'])) . "' AND '" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "'";

                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
		$this->view->data = $d_spm1->get_cari_sp3b($filter);
		}
		
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KDKPPN = '" . Session::get('id_user')."'";			
        }
		
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table3());
		
		$d_log->tambah_log("Sukses");
		
		
        $this->view->render('blu/cariSP3');
    }
	
	public function DataRealisasiBLU() {
        $d_spm1 = new DataBLU($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
		
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if (isset($_POST['submit_file'])) {
            /* if ($_POST['kdkppn'] != '') {
				if ($_POST['kdkppn'] != 'SEMUA') {
					$filter[$no++] = "A.KPPN = '" . $_POST['kdkppn'] . "'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
					$this->view->d_kd_kppn = $_POST['kdkppn'];
				}
            } else {
                $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
            } */

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "A.SATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->satker_code = $_POST['kdsatker'];
            }
			if ($_POST['SumberDana'] != '') {
                $filter[$no++] = "SUBSTR(A.DANA,1,1) = '" . $_POST['SumberDana'] . "'";
                $this->view->SumberDana = $_POST['SumberDana'];
            }
			if ($_POST['Rumpun'] != '') {
				
				if ($_POST['Rumpun'] == 'Kesehatan'){
					 $filter[$no++] = "C.RUMPUN = 'Kesehatan'";
				}
				if ($_POST['Rumpun'] == 'Pendidikan'){
					 $filter[$no++] = "C.RUMPUN = 'Pendidikan'";
				}
				if ($_POST['Rumpun'] == 'Pengelola'){
					 $filter[$no++] = "C.RUMPUN = 'Pengelola Dana'";
				}
				if ($_POST['Rumpun'] == 'Kawasan'){
					 $filter[$no++] = "C.RUMPUN = 'Kawasan'";
				}
				if ($_POST['Rumpun'] == 'Barang'){
					 $filter[$no++] = "C.RUMPUN = 'Barang Jasa Lainnya'";
				}
				$this->view->Rumpun = $_POST['Rumpun'];
                
            }
            			
			
        }

        //----------------------------------------------------
        $this->view->data = $d_spm1->get_realisasi_blu($filter);
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table4());

        $d_log->tambah_log("Sukses");

        $this->view->render('blu/RealisasiBLU');
    }
	
	public function DataRealisasiBelanjaBLU() {
        $d_spm1 = new DataBLU($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
		
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if (isset($_POST['submit_file'])) {
            /* if ($_POST['kdkppn'] != '') {
				if ($_POST['kdkppn'] != 'SEMUA') {
					$filter[$no++] = "A.KPPN = '" . $_POST['kdkppn'] . "'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
					$this->view->d_kd_kppn = $_POST['kdkppn'];
				}
            } else {
                $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
            } */

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "A.SATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->satker_code = $_POST['kdsatker'];
            }
			if ($_POST['SumberDana'] != '') {
                $filter[$no++] = "SUBSTR(A.DANA,1,1) = '" . $_POST['SumberDana'] . "'";
                $this->view->SumberDana = $_POST['SumberDana'];
            }
			if ($_POST['Rumpun'] != '') {
				
				if ($_POST['Rumpun'] == 'Kesehatan'){
					 $filter[$no++] = "C.RUMPUN = 'Kesehatan'";
				}
				if ($_POST['Rumpun'] == 'Pendidikan'){
					 $filter[$no++] = "C.RUMPUN = 'Pendidikan'";
				}
				if ($_POST['Rumpun'] == 'Pengelola'){
					 $filter[$no++] = "C.RUMPUN = 'Pengelola Dana'";
				}
				if ($_POST['Rumpun'] == 'Kawasan'){
					 $filter[$no++] = "C.RUMPUN = 'Kawasan'";
				}
				if ($_POST['Rumpun'] == 'Barang'){
					 $filter[$no++] = "C.RUMPUN = 'Barang Jasa Lainnya'";
				}
				
               
            }
            			
			
        }

        //----------------------------------------------------
        $this->view->data = $d_spm1->get_realisasi_belanja_blu($filter);

        //$d_last_update = new DataLastUpdate($this->registry);
        //$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->render('blu/RealisasiBelanjaBLU');
    }
	
    //author by jhon

    public function __destruct() {
        
    }

}
