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
        $this->view->render('kppn/homeDashboardDailySE');
    }
    
    public function mingguan() {
        $this->view->render('kppn/homeDashboardWeeklySE');
    }
    
    public function bulanan() {
        $this->view->render('kppn/homeDashboardMonthlySE');
    }
    
    public function harianJSON() {
        $d_dashboard = new DataDashboard($this->registry);
        
        $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(1);
        $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap(1);
		$filter_pos_spm = array ();
        $filter_pos_spm[1]="SUBSTR(OU_NAME,1,3) = ".Session::get('id_user');
		$this->view->data_pos_spm = $d_dashboard->get_hist_spm_filter($filter_pos_spm);
        $this->view->data_list_sp2d = $d_dashboard->get_list_sp2d_selesai();
        
        $this->view->load('kppn/homeDashboardDailyJSON');
    }
    
    public function mingguanJSON() {
        $d_dashboard = new DataDashboard($this->registry);
        
        $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(7);
        $this->view->data_lhp_rekap  = $d_dashboard->get_lhp_rekap(7);
		$filter_pos_spm = array ();
        $filter_pos_spm[1]="SUBSTR(OU_NAME,1,3) = ".Session::get('id_user');
		$this->view->data_pos_spm = $d_dashboard->get_hist_spm_filter($filter_pos_spm);
        
        $this->view->load('kppn/homeDashboardWeeklyJSON');
    }
    
    public function bulananJSON() {
        $d_dashboard = new DataDashboard($this->registry);
        
        $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(30);
        $this->view->data_lhp_rekap  = $d_dashboard->get_lhp_rekap(30);
		$filter_pos_spm = array ();
        $filter_pos_spm[1]="SUBSTR(OU_NAME,1,3) = ".Session::get('id_user');
		$this->view->data_pos_spm = $d_dashboard->get_hist_spm_filter($filter_pos_spm);
        
        $this->view->load('kppn/homeDashboardMonthlyJSON');
    }
}

?>