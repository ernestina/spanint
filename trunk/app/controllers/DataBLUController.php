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
      //var_dump($d_sppm->get_sppm_filter($filter));
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
			
			if ($_POST['ppp'] != '') {
                //$filter[$no++] = "SATKER_CODE = '" . $_POST['kdsatker'] . "'";
				$this->view->ppp = $_POST['ppp'];
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
				$this->view->nmsatker = $d_spm1->get_nama_satker_pnbp($_POST['kdsatker']);
            }
       
		}
		
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KDKPPN = '" . Session::get('id_user')."'";			
        }
		$this->view->data = $d_spm1->get_daftar_sp3b($filter);
		$this->view->data1 = $d_spm1->get_kdsatker_blu($satker);
		
		$d_log->tambah_log("Sukses");
		
		
        $this->view->render('blu/daftarSP3');
    }
    //author by jhon

    public function __destruct() {
        
    }

}
