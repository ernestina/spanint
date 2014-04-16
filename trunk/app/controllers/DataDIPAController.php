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
					$filter[$no++]="satker_code = '".$_POST['kd_satker']."'";
				}
				
				if ($_POST['akun']!=''){
					$filter[$no++]="account_code = '".$_POST['akun']."'";
				}
				if ($_POST['output']!=''){
					$filter[$no++]="output_code = '".$_POST['output']."'";
				}
				if ($_POST['program']!=''){
					$filter[$no++]="program_code = '".$_POST['program']."'";
				}
				$this->view->data = $d_spm1->get_dipa_filter($filter);
			}	
		
		//var_dump($d_spm->get_hist_spm_filter());
		$this->view->render('kppn/revisiDIPA');
	}
	
	
	
	
	
	
    public function __destruct() {
        
    }
}
