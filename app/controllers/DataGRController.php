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

	
	public function GR_PFK() {
		$d_spm1 = new DataPFK($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bulan']!=''){
					//if ($_POST['bulan']!='SEMUA_BULAN'){
						$filter[$no++]= $_POST['bulan'];
					//}
					$this->view->d_bulan = $_POST['bulan'];
				} 
				
			} else {
					$filter[$no++]= "MEI";
					$this->view->d_bulan = "MEI";
				}
			
		$this->view->data = $d_spm1->get_gr_pfk_filter($filter);
		//var_dump($d_spm->get_gr_status_filter($filter));
		$this->view->render('kppn/test');
	}
	
	/*public function GR_PFK_DETAIL($akun=null) {
		$d_spm1 = new DataPFK_DETAIL($this->registry);
		$filter = array ();
		$no=0;
		/*if (!is_null($akun)) {
				$filter[$no++]="AKUN = '" .$akun."'";
				$this->view->akun = $akun;
			}
		$filter[$no++]="AKUN = '811131'";
		$this->view->data = $d_spm1->get_gr_pfk_detail_filter($filter);
		//var_dump($d_spm->get_gr_status_filter($filter));
		$this->view->render('kppn/GR_PFK');
	}*/
	
	public function GR_PFK_DETAIL($akun=null, $bulan=null) {
		$d_spm1 = new DataPFK_DETAIL($this->registry);
		$filter = array ();
		$no=0;
			if (!is_null($akun)) {
				$filter[$no++]="akun =  '" .$akun."'";
				$this->view->d_tgl = $akun;
			}
			if (!is_null($bulan)) {
				$filter[$no++]="TRIM(to_char(tanggal_buku,'month')) =  '" .$bulan."'";
				$this->view->bulan = $bulan;
			}
		$this->view->data = $d_spm1->get_gr_pfk_detail_filter($filter);
		//var_dump($d_spm->get_gr_status_filter($filter));
		$this->view->render('kppn/GR_PFK');
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

	public function grStatusHarian() {
		$d_spm1 = new DataGR_IJP($this->registry);			
		$this->view->data = $d_spm1->get_gr_status_harian($filter);
		$this->view->render('kppn/GRStatusHarian');
	}
	
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
