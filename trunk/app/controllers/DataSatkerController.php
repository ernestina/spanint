<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataSatkerController extends BaseController {
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
		$d_adk = new DataAdk($this->registry);
		$this->view->adk = $d_adk->get_adk_list('019');
		$d_user = new DataUser($this->registry);
		$this->view->satker = $d_user->get_d_user_by_id(Session::get('id_user'));
		$this->view->render('satker/uploadfile');
    }
	
	public function upload_file(){
		$d_adk = new DataAdk($this->registry);
		$d_user = new DataUser($this->registry);
		$this->view->satker = $d_user->get_d_user_by_id(Session::get('id_user'));
		if (isset($_POST['submit_file'])) {
			$kd_kppn = $_POST['kd_kppn'];;
            $kd_satker = $_POST['kd_satker']; ;
            $kd_tgl = date("y-m-d"); 
            $kd_adk_name = $_FILES['fupload']['name'];;
			$kd_jml_pdf = $_POST['kd_jml_pdf'];
			$kd_file_name = $_POST['kd_file_name'].$_FILES['fupload']['name'].".zip";
			$kd_status = '0';
			$d_adk->set_kd_kppn($kd_kppn);
			$d_adk->set_kd_satker($kd_satker);
			$d_adk->set_kd_tgl($kd_tgl);
			$d_adk->set_kd_adk_name($kd_adk_name);
			$d_adk->set_kd_jml_pdf($kd_jml_pdf);
			$d_adk->set_kd_file_name($kd_file_name);
			$d_adk->set_kd_status($kd_status);
			
			if (!$d_adk->add_adk()) {
				$this->view->d_rekam = $d_adk;
			}
		}
		$this->view->adk = $d_adk->get_adk_list('019');
		$this->view->render('satker/uploadfile');
    }
	
    public function __destruct() {
        
    }

}
