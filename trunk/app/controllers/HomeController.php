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
        if (Session::get('role')==KANWIL){
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        $this->view->render('kppn/homeDashboardDailySE');
    }
    
    public function mingguan() {
        if (Session::get('role')==KANWIL){
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        $this->view->render('kppn/homeDashboardWeeklySE');
    }
    
    public function bulanan() {
        if (Session::get('role')==KANWIL){
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        $this->view->render('kppn/homeDashboardMonthlySE');
    }
    
    public function harianJSON($kodeunit=null) {   
        	
        if (Session::get('role')==KANWIL){
            
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            
            if (!isset($kodeunit)) {
                
                $this->view->is_rekap = true;
                
                $this->view->data_list_kppn = array();
                $this->view->data_sp2d_rekap = array();
                $this->view->data_lhp_rekap = array();
                $this->view->data_pos_spm = array ();
                $this->view->data_list_sp2d = array();
                
                foreach ($this->view->kppn_list as $val) {
                    
                    $kodeunit = "".$val->get_kd_d_kppn();
                    $d_dashboard = new DataDashboard($this->registry);
                    
                    $this->view->data_sp2d_rekap[] = $d_dashboard->get_sp2d_rekap(1, " substr(CHECK_NUMBER,3,3)='".$kodeunit."' ");
                    $this->view->data_lhp_rekap[] = $d_dashboard->get_lhp_rekap(1, " KPPN='".$kodeunit."' ");
                    $this->view->data_retur[] = $d_dashboard->get_sp2d_retur(" KDKPPN='".$kodeunit."' ");
                    $this->view->data_list_sp2d[] = $d_dashboard->get_list_sp2d_selesai(" substr(CHECK_NUMBER,3,3)='".$kodeunit."' ");
                    
                    $filter_pos_spm = array ();
                    $filter_pos_spm[1]="SUBSTR(OU_NAME,1,3) = '".$kodeunit."'";
                    $this->view->data_pos_spm[] = $d_dashboard->get_hist_spm_filter($filter_pos_spm);
                }
                
                //var_dump($this->view->data_sp2d_rekap);
                //var_dump($this->view->data_lhp_rekap);
                //var_dump($this->view->data_pos_spm);
                //var_dump($this->view->data_list_sp2d);
                
                $this->view->data_last_update = $d_dashboard->get_last_update_all();
                
            } else {
                
                $this->view->data_kode_unit = $kodeunit;
                
                $this->view->is_rekap = false;
                
                $unitfilter .= " substr(CHECK_NUMBER,3,3)='".$kodeunit."' ";
                $returfilter .= " KDKPPN='".$kodeunit."' ";
                $lhpfilter .= " KPPN='".$kodeunit."' ";
            
                $d_dashboard = new DataDashboard($this->registry);

                $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(1, $unitfilter);
                $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap(1, $lhpfilter);
                $this->view->data_list_sp2d = $d_dashboard->get_list_sp2d_selesai($unitfilter);
                $this->view->data_retur = $d_dashboard->get_sp2d_retur($returfilter);
                $this->view->data_last_update = $d_dashboard->get_last_update_all();

                $filter_pos_spm = array ();
                $filter_pos_spm[1]="SUBSTR(OU_NAME,1,3) = '".$kodeunit."'";
                $this->view->data_pos_spm = $d_dashboard->get_hist_spm_filter($filter_pos_spm);
                
            }
            
        } else {
            
            $this->view->data_kode_unit = Session::get('id_user');
        
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(1);
            $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap(1);
            $this->view->data_list_sp2d = $d_dashboard->get_list_sp2d_selesai();
            $this->view->data_retur = $d_dashboard->get_sp2d_retur();
            $this->view->data_last_update = $d_dashboard->get_last_update_all();

            $filter_pos_spm = array ();
            $filter_pos_spm[1]="SUBSTR(OU_NAME,1,3) = ".Session::get('id_user');
            $this->view->data_pos_spm = $d_dashboard->get_hist_spm_filter($filter_pos_spm);
            
        }
        
        $this->view->load('kppn/homeDashboardDailyJSON');
    }
    
    public function mingguanJSON($kodeunit=null) {
        
        if (Session::get('role')==KANWIL){
            
            $d_kppn_list = new DataUser($this->registry);
            $kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            
            if (!isset($kodeunit)) {
                
                $unitfilter = "(";
                foreach ($kppn_list as $val) {
                    if ($unitfilter != "(") {
                        $unitfilter .= " OR ";
                    }
                    $unitfilter .= "substr(CHECK_NUMBER,3,3)='".$val->get_kd_d_kppn()."'";
                }
                $unitfilter .= ")";
                
                $returfilter = "(";
                foreach ($kppn_list as $val) {
                    if ($returfilter != "(") {
                        $returfilter .= " OR ";
                    }
                    $returfilter .= "KDKPPN='".$val->get_kd_d_kppn()."'";
                }
                $returfilter .= ")";
                
                $lhpfilter = "(";
                foreach ($kppn_list as $val) {
                    if ($lhpfilter != "(") {
                        $lhpfilter .= " OR ";
                    }
                    $lhpfilter .= "KPPN='".$val->get_kd_d_kppn()."'";
                }
                $lhpfilter .= ")";
                
                //var_dump($unitfilter);
                //var_dump($returfilter);
                //var_dump($lhpfilter);
                
                $d_dashboard = new DataDashboard($this->registry);

                $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(7, $unitfilter);
                $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap(7, $lhpfilter);
                $this->view->data_retur = $d_dashboard->get_sp2d_retur($returfilter);
                $this->view->data_last_update = $d_dashboard->get_last_update_all();
                
            } else {
                
                $unitfilter .= " substr(CHECK_NUMBER,3,3)='".$kodeunit."' ";
                $returfilter .= " KDKPPN='".$kodeunit."' ";
                $lhpfilter .= " KPPN='".$kodeunit."' ";
            
                $d_dashboard = new DataDashboard($this->registry);

                $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(7, $unitfilter);
                $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap(7, $lhpfilter);
                $this->view->data_list_sp2d = $d_dashboard->get_list_sp2d_selesai($unitfilter);
                $this->view->data_retur = $d_dashboard->get_sp2d_retur($returfilter);
                $this->view->data_last_update = $d_dashboard->get_last_update_all();

                $filter_pos_spm = array ();
                $filter_pos_spm[1]="SUBSTR(OU_NAME,1,3) = '".$kodeunit."'";
                $this->view->data_pos_spm = $d_dashboard->get_hist_spm_filter($filter_pos_spm);
                
            }
            
        } else {
        
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(7);
            $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap(7);
            $this->view->data_retur = $d_dashboard->get_sp2d_retur();
            $this->view->data_last_update = $d_dashboard->get_last_update_all();
            
        }
        
        $this->view->load('kppn/homeDashboardWeeklyJSON');
    }
    
    public function bulananJSON($kodeunit=null) {
        
        if (Session::get('role')==KANWIL){
            
            $d_kppn_list = new DataUser($this->registry);
            $kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            
            if (!isset($kodeunit)) {
                
                $unitfilter = "(";
                foreach ($kppn_list as $val) {
                    if ($unitfilter != "(") {
                        $unitfilter .= " OR ";
                    }
                    $unitfilter .= "substr(CHECK_NUMBER,3,3)='".$val->get_kd_d_kppn()."'";
                }
                $unitfilter .= ")";
                
                $returfilter = "(";
                foreach ($kppn_list as $val) {
                    if ($returfilter != "(") {
                        $returfilter .= " OR ";
                    }
                    $returfilter .= "KDKPPN='".$val->get_kd_d_kppn()."'";
                }
                $returfilter .= ")";
                
                $lhpfilter = "(";
                foreach ($kppn_list as $val) {
                    if ($lhpfilter != "(") {
                        $lhpfilter .= " OR ";
                    }
                    $lhpfilter .= "KPPN='".$val->get_kd_d_kppn()."'";
                }
                $lhpfilter .= ")";
                
                //var_dump($unitfilter);
                //var_dump($returfilter);
                //var_dump($lhpfilter);
                
                $d_dashboard = new DataDashboard($this->registry);

                $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(30, $unitfilter);
                $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap(30, $lhpfilter);
                $this->view->data_retur = $d_dashboard->get_sp2d_retur($returfilter);
                $this->view->data_last_update = $d_dashboard->get_last_update_all();
                $this->view->data_list_sp2d = $d_dashboard->get_list_sp2d_selesai($unitfilter);
                
            } else {
                
                $unitfilter .= " substr(CHECK_NUMBER,3,3)='".$kodeunit."' ";
                $returfilter .= " KDKPPN='".$kodeunit."' ";
                $lhpfilter .= " KPPN='".$kodeunit."' ";
            
                $d_dashboard = new DataDashboard($this->registry);

                $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(30, $unitfilter);
                $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap(30, $lhpfilter);
                $this->view->data_list_sp2d = $d_dashboard->get_list_sp2d_selesai($unitfilter);
                $this->view->data_retur = $d_dashboard->get_sp2d_retur($returfilter);
                $this->view->data_last_update = $d_dashboard->get_last_update_all();
                
            }
            
        } else {
        
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(30);
            $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap(30);
            $this->view->data_retur = $d_dashboard->get_sp2d_retur();
            $this->view->data_last_update = $d_dashboard->get_last_update_all();
            
        }
        
        $this->view->load('kppn/homeDashboardMonthlyJSON');
    }
}

?>