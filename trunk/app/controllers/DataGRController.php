<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataGRController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

	
	public function GRstatus() {
		$d_spm1 = new DataGR_STATUS($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['status']!=''){
					$filter[$no++]="status = '" .$_POST['status']."'";
				}
				
				if ($_POST['nama_file']!=''){
					$filter[$no++]=" file_name = '".$_POST['nama_file']."'";
				}
				
			}
		$this->view->data = $d_spm1->get_gr_status_filter($filter);
		//var_dump($d_spm->get_gr_status_filter($filter));
		$this->view->render('kppn/statusGR');
	}
	
	public function GR_IJP() {
		$d_spm1 = new DataGR_IJP($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['status']!=''){
					$filter[$no++]="status = '" .$_POST['status']."'";
				}
				
				if ($_POST['nama_file']!=''){
					$filter[$no++]=" file_name = '".$_POST['nama_file']."'";
				}
				
			}
		$this->view->data = $d_spm1->get_gr_ijp_filter($filter);
		//var_dump($d_spm->get_gr_status_filter($filter));
		$this->view->render('kppn/GR_IJP');
	}
	
	
	
	
    public function __destruct() {
        
    }
}
