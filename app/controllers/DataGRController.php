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
				if ($_POST['bulan']!=''){
					//if ($_POST['bulan']!='SEMUA_BULAN'){
						$filter[$no++]="BULAN = '".$_POST['bulan']."'";
					//}
					$this->view->d_bulan = $_POST['bulan'];
				} 
				
			} else {
					$filter[$no++]="BULAN = '".date('m', time())."'";
					$this->view->d_bulan = date('m', time());
				}
			
		$this->view->data = $d_spm1->get_gr_ijp_filter($filter);
		//var_dump($d_spm->get_gr_status_filter($filter));
		$this->view->render('kppn/GR_IJP');
	}
	
<<<<<<< .mine
	public function GR_STATUS_LHP() {
		$d_spm1 = new DataGR_STATUS_LHP($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bulan']!=''){
					if ($_POST['bulan']!='SEMUA_BULAN'){
						$filter[$no++]="BULAN = '".$_POST['bulan']."'";
					}
					$this->view->d_bulan = $_POST['bulan'];
				} 
				
			} else {
					$filter[$no++]="BULAN = '".date('m', time())."'";
					$this->view->d_bulan = date('m', time());
				}
			
		$this->view->data = $d_spm1->get_gr_status_lhp_filter($filter);
		//var_dump($d_spm->get_gr_status_filter($filter));
		$this->view->render('kppn/statusGR_LHP');
	}
=======
	public function grStatusHarian() {
		$d_spm1 = new DataGR_IJP($this->registry);			
		$this->view->data = $d_spm1->get_gr_status_harian($filter);
		$this->view->render('kppn/GRStatusHarian');
	}
>>>>>>> .r84
	
	public function detailLhpRekap($tgl=null) {
		$d_spm1 = new DataGR_STATUS($this->registry);
		$filter = array ();
		$no=0;
			if (!is_null($tgl)) {
				$filter[$no++]="CONT_GL_DATE =  '" .$tgl."'";
				$this->view->d_tgl = substr($tgl, 6, 2)."-".substr($tgl, 4, 2)."-".substr($tgl, 0, 4);
			}
		$this->view->data = $d_spm1->get_detail_lhp_rekap($filter);
		//var_dump($d_spm->get_gr_status_filter($filter));
		$this->view->render('kppn/detailLhpRekap');
	}
	
	public function detailPenerimaan($file_name=null) {
		$d_spm1 = new DataGR_STATUS($this->registry);
		$filter = array ();
		$no=0;
			if (!is_null($file_name)) {
				$filter[$no++]="FILE_NAME =  '" .$file_name."'";
				$this->view->d_tgl = $file_name;
			}
		$this->view->data = $d_spm1->get_detail_penerimaan($filter);
		//var_dump($d_spm->get_gr_status_filter($filter));
		$this->view->render('kppn/detailPenerimaan');
	}
	
    public function __destruct() {
        
    }
}
