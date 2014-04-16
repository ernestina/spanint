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
				
			}	
		$this->view->data = $d_spm1->get_hist_spm_filter ($filter);
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
				
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_awal']!=''){
					$filter[$no++]=$_POST['tgl_awal'];
					$filter[$no++]=$_POST['tgl_akhir'];
				}
				
			}	
		$this->view->data = $d_spm1->get_error_spm_filter ($filter);
		var_dump($d_spm1->get_error_spm_filter ($filter));
		$this->view->render('kppn/uploadSPM');
	}
	
    public function __destruct() {
        
    }
}
