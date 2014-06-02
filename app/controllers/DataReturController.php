<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataReturController extends BaseController {
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
	
	public function monitoringRetur() {
		$d_retur = new DataRetur($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="KDKPPN = ".$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="KDKPPN = ".Session::get('id_user');
				}
				if ($_POST['nosp2d']!=''){
					$filter[$no++]="SP2D_NUMBER = ".$_POST['nosp2d'];
					$this->view->d_nosp2d = $_POST['nosp2d'];
				}
				if ($_POST['barsp2d']!=''){
					$filter[$no++]="RECEIPT_NUMBER = ".$_POST['barsp2d'];
					$this->view->d_barsp2d = $_POST['barsp2d'];
				}
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="KDSATKER = '".$_POST['kdsatker']."'";
					$this->view->d_kdsatker = $_POST['kdsatker'];
				}
				if ($_POST['bank']!=''){
					if ($_POST['bank']!='SEMUA_BANK'){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
					}
					$this->view->d_bank = $_POST['bank'];
				}
				if ($_POST['status'] != ''){
					if ($_POST['status'] != 'SEMUA' ){
						$filter[$no++] = "STATUS_RETUR = '".$_POST['status']."'";
					}
					$this->view->d_status = $_POST['status'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "STATEMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($_POST['tgl_awal'])).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($_POST['tgl_akhir'])).",'YYYYMMDD')  ";
					
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				if (Session::get('role')==SATKER){
					$filter[$no++]=" KDSATKER = '".Session::get('kd_satker')."'";
					$this->view->d_satker = Session::get('kd_satker');
				}
				$this->view->data = $d_retur->get_retur_filter($filter);
			}	
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/daftarRetur');
	}
	
    public function __destruct() {
        
    }

}
