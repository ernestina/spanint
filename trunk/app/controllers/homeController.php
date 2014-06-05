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
        $filter_jenis = array ();
        $filter_jenis[$no++]=" KDKPPN = ".Session::get('id_user');
        $filter_jenis[$no++] = "PAYMENT_DATE BETWEEN TO_DATE ('".date('Ymd',(time()-(6*24*60*60)))."','YYYYMMDD') AND TO_DATE ('".date('Ymd',time())."','YYYYMMDD')  ";
        $this->view->dataJenisSP2D = $d_sppm_jenis->get_sp2d_rekap($filter_jenis);
        
        //Rekap Status SP2D
        $d_sppm_status = new DataSppm($this->registry);
        $filter_status = array ();
        $filter_status[$no++]="KDKPPN = ".Session::get('id_user');
        $filter_status[$no++] = "PAYMENT_DATE BETWEEN TO_DATE ('".date('Ymd',(time()-(6*24*60*60)))."','YYYYMMDD') AND TO_DATE ('".date('Ymd',time())."','YYYYMMDD')  ";
        $this->view->dataStatusSP2D = $d_sppm_status->get_sppm_status_home($filter_status);
        
        //Posisi SPM Open
        $d_hist_spm = new DataHistSPM($this->registry);
		$filter_hist_spm = array ();
		$no=0;
        $filter_hist_spm[$no++]="SUBSTR(OU_NAME,1,3) = ".Session::get('id_user');
		$this->view->dataHistSPM = $d_hist_spm->get_hist_spm_filter($filter_hist_spm);
        
        //Rekap Status LHP
        $d_rekap_lhp = new DataGR_STATUS($this->registry);
		$filter_rekap_lhp = array ();
		$no=0;
        $filter_rekap_lhp[$no++]="(CONT_GL_DATE =  '".date('Ymd',time())."' OR CONT_GL_DATE = '".date('Ymd',time()-(1*24*60*60))."' OR CONT_GL_DATE = '".date('Ymd',time()-(2*24*60*60))."' OR CONT_GL_DATE = '".date('Ymd',time()-(3*24*60*60))."' OR CONT_GL_DATE = '".date('Ymd',time()-(4*24*60*60))."' OR CONT_GL_DATE = '".date('Ymd',time()-(5*24*60*60))."' OR CONT_GL_DATE = '".date('Ymd',time()-(6*24*60*60))."')";
		$filter_rekap_lhp[$no++]="substr(RESP_NAME,1,3) = '".Session::get('id_user')."'";
		$this->view->dataLHP = $d_rekap_lhp->get_detail_lhp_rekap($filter_rekap_lhp);
        
        $this->view->render('kppn/homeDashboard');
    }
}

?>