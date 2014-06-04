<?php

class homeController extends BaseController {
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
        //Rekap Jenis SP2D
		$d_sppm_jenis = new DataSppm($this->registry);
        $filter_jenis[$no++]=" KDKPPN = ".Session::get('id_user');
        $filter_jenis[$no++] = "PAYMENT_DATE BETWEEN TO_DATE ('".date('Ymd',(time()-(7*24*60*60)))."','YYYYMMDD') AND TO_DATE ('".date('Ymd',time())."','YYYYMMDD')  ";
        $this->view->dataJenisSP2D = $d_sppm_jenis->get_sp2d_rekap($filter_jenis);
        
        //Rekap Status SP2D
        $d_sppm_status = new DataSppm($this->registry);
        $filter_status[$no++]="KDKPPN = ".Session::get('id_user');
        $filter_status[$no++] = "PAYMENT_DATE BETWEEN TO_DATE ('".date('Ymd',(time()-(7*24*60*60)))."','YYYYMMDD') AND TO_DATE ('".date('Ymd',time())."','YYYYMMDD')  ";
        $this->view->dataStatusSP2D = $d_sppm_status->get_sppm_filter($filter_status);	
        
        $this->view->render('kppn/homeDashboard');
    }
}

?>