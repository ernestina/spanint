<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataDropingController extends BaseController {
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
	
	public function monitoringDroping() {
		$d_sppm = new DataDroping($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bank']!=''){
					if ($_POST['bank']!='SEMUA_BANK'){
						$filter[$no++]="BANK = '".$_POST['bank']."'";
					}
					$this->view->d_bank = $_POST['bank'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($_POST['tgl_awal'])).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($_POST['tgl_akhir'])).",'YYYYMMDD')  ";
					
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				$this->view->data = $d_sppm->get_droping_filter($filter);
			}	
			if (Session::get('role')==ADMIN OR Session::get('role')==PKN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			// untuk mengambil data last update 
			$d_last_update = new DataLastUpdate($this->registry);
			$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		$this->view->render('pkn/droping');
	}
	
	public function detailDroping($bank=null, $tanggal=null) {
		$d_sppm = new DataDroping($this->registry);
		$filter = array ();
		$no=0;
		if (!is_null($bank)){
			if ($bank != "SEMUA_BANK"){
				$filter[$no++]="BANK = '".$bank."'";
			}
			$this->view->d_bank = $bank;
		} 	
		if (!is_null($tanggal)){
			$filter[$no++]="TO_CHAR(CREATION_DATE,'DD-MM-YYYY') = '".$tanggal."'";
			$this->view->d_tanggal = $tanggal;
		} 
		$this->view->data = $d_sppm->get_droping_detail_filter($filter);
		
		// untuk mengambil data last update 
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table1());
		
		$this->view->render('pkn/dropingDetail');
	}
	
	
    public function __destruct() {
        
    }

}
