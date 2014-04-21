<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataDIPAController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

   
    
	public function RevisiDipa() {
		$d_spm1 = new DataDIPA($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['kd_satker']!=''){
					$filter[$no++]="SATKER_CODE = '".$_POST['kd_satker']."'";
					$this->view->satker_code = $_POST['satker_code'];
				}
				if ($_POST['akun']!=''){
					$filter[$no++]="ACCOUNT_CODE = '".$_POST['akun']."'";
					$this->view->account_code = $_POST['account_code'];
				}
				if ($_POST['output']!=''){
					$filter[$no++]="OUTPUT_CODE = '".$_POST['output']."'";
					$this->view->output_code = $_POST['output_code'];
				}
				if ($_POST['program']!=''){
					$filter[$no++]="PROGRAM_CODE = '".$_POST['program']."'";
					$this->view->program_code = $_POST['program_code'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "TANGGAL_POSTING_REVISI BETWEEN '".$_POST['tgl_awal']."' AND '".$_POST['tgl_akhir']."'";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				$this->view->data = $d_spm1->get_dipa_filter($filter);
			}	

		//var_dump($d_spm->get_hist_spm_filter());
		$this->view->render('kppn/revisiDIPA');
	}
	
	public function RealisasiFA() {
		$d_spm1 = new DataFA($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="SATKER = '".$_POST['kdsatker']."'";
					$this->view->satker_code = $_POST['satker_code'];
				}
				if ($_POST['akun']!=''){
					$filter[$no++]="AKUN = '".$_POST['akun']."'";
					$this->view->account_code = $_POST['account_code'];
				}
				if ($_POST['output']!=''){
					$filter[$no++]="OUTPUT = '".$_POST['output']."'";
					$this->view->output_code = $_POST['output_code'];
				}
				if ($_POST['program']!=''){
					$filter[$no++]="PROGRAM = '".$_POST['program']."'";
					$this->view->program_code = $_POST['program_code'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "TANGGAL_POSTING_REVISI BETWEEN '".$_POST['tgl_awal']."' AND '".$_POST['tgl_akhir']."'";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				$this->view->data = $d_spm1->get_fa_filter($filter);
			}	

		//var_dump($d_spm->get_hist_spm_filter());
		$this->view->render('kppn/realisasiFA');
	}
	
	
	
	
	
    public function __destruct() {
        
    }
}
