<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataSPMController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

   
	/*
	public function infoSP2D() {
		$d_spm = new DataSPM($this->registry);
		d_spm->get_spm_filter();
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/isianSPM');
	}
	*/
    

	public function posisiSpm() {
		$d_spm1 = new DataHistSPM($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['invoice']!=''){
					$filter[$no++]="invoice_num = '".$_POST['invoice']."'";
				}
				
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_awal']!=''){
					$filter[$no++]=$_POST['tgl_awal'];
					$filter[$no++]=$_POST['tgl_akhir'];
				}
				$this->view->data = $d_spm1->get_hist_spm_filter ($filter);
			}
			else{	
				$filter[$no++]=" STATUS = 'OPEN'";
		
				$this->view->data = $d_spm1->get_hist_spm_filter ($filter);
			}
		//var_dump($d_spm->get_hist_spm_filter());
		$this->view->render('kppn/posisiSPM');
	}
	
	public function HoldSpm() {
		$d_spm1 = new DataHoldSPM($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['invoice']!=''){
					$filter[$no++]="invoice_num = '".$_POST['invoice']."'";
				}
				
			}	
		$this->view->data = $d_spm1->get_hold_spm_filter($filter);
		//var_dump($d_spm1->get_hold_spm_filter ($filter));
		$this->view->render('kppn/holdSPM');
	}
	
	
	public function errorSpm() {
		$d_spm1 = new DataUploadSPM($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['invoice']!=''){
					$filter[$no++]="invoice_num = '".$_POST['invoice'] . "'";
				}
				
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "INVOICE_DATE BETWEEN '".$_POST['tgl_awal']."' AND '".$_POST['tgl_akhir']."'";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				
				
			}	
		$this->view->data = $d_spm1->get_error_spm_filter ($filter);
		//var_dump($d_spm1->get_error_spm_filter ($filter));
		
	}
	$this->view->render('kppn/uploadSPM');
	}
	
	public function HistorySpm() {
		$d_spm1 = new DataHistorySPM($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['invoice']!=''){
					$filter[$no++]="'".$_POST['invoice']."'";
					$this->view->d_invoice = $_POST['invoice'];
				}
			$this->view->data = $d_spm1->get_history_spm_filter ($filter);
			}	
			
			
		//var_dump($d_spm->get_hist_spm_filter());
		$this->view->render('kppn/historySPM');
	}
	
	
	public function DurasiSpm() {
		$d_spm1 = new DataDurasiSPM($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['invoice']!=''){
					$filter[$no++]="invoice_num = '".$_POST['invoice'] . "'";
				}
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="substr(invoice_num,8,6) = '".$_POST['kdsatker'] . "'";
				}
				if ($_POST['JenisSPM']!=''){
					$filter[$no++]="jendok = '".$_POST['JenisSPM'] . "'";
				}
				if ($_POST['durasi']!=''){
					$filter[$no++]="durasi2 ".$_POST['durasi'] . "'";
				}
				
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "TANGGAL_UPLOAD BETWEEN '".$_POST['tgl_awal']."' AND '".$_POST['tgl_akhir']."'";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
			$this->view->data = $d_spm1->get_durasi_spm_filter ($filter);	
			}
		ELSE {	
		$filter[$no++] = " ROWNUM <= '100' ";
		$this->view->data = $d_spm1->get_durasi_spm_filter ($filter);
		//var_dump($d_spm1->get_error_spm_filter ($filter));
		}
		$this->view->render('kppn/DurasiSPM');
	}
	
			
	
    public function __destruct() {
        
    }
}
