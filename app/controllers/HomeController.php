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
        $this->view->render('kppn/home');
    }
    
    public function dashboard() {
        $this->view->render('kppn/home');
    }
    
    public function ticker($whereto) {
        
        if ($whereto == 'spm') {
            
            $d_spm1 = new DataHistSPM($this->registry);
            $filter = array();
            $no = 0;
            //untuk mencatat log user
            $d_log = new DataLog($this->registry);
            $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

            $filter[$no++] = "KDKPPN = '" . Session::get('id_user')."'";

            $d_last_update = new DataLastUpdate($this->registry);
            $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

            $this->view->data = $d_spm1->get_hist_spm_filter($filter);

            $d_log->tambah_log("Sukses");
            
            $this->view->render('tv/tickerSPM');
            
        } elseif ($whereto == 'sp2d') {
            
            $d_log = new DataLog($this->registry);
            $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
            
            $kodeunit = Session::get('id_user');

            $unitfilter = " substr(CHECK_NUMBER,3,3)='" . $kodeunit . "' ";

            $unitfilter .= "and check_date = to_date('" . date("Ymd", time()) . "','yyyymmdd')";

            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data = $d_dashboard->get_list_sp2d_selesai($unitfilter);
            
            $d_log->tambah_log("Sukses");
            
            $this->view->render('tv/tickerSP2D');
            
        }
    }
    
    public function __destruct() {
        
    }
    
}

?>