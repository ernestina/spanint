<?php

class DataJSONController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */
    
    public function pieJenisSP2D($periode, $kodeunit=null) {
        
        if ((Session::get('role')==KPPN) or (isset($kodeunit) and ($kodeunit[0] != 'K'))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $unitfilter = " substr(CHECK_NUMBER,3,3)='".$kodeunit."' ";

            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap($periode, $unitfilter);
            
        } else if ((Session::get('role')==KANWIL) or (isset($kodeunit) and ($kodeunit[0] == 'K'))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = 'K'.Session::get('id_user');
            }
            
            $unitfilter = " substr(check_number,3,3) in (select kdkppn from t_kppn where kdkanwil='".substr($kodeunit,1,2)."') ";
            
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap($periode, $unitfilter);
            
        } else {
            
            $unitfilter = " CHECK_NUMBER is not null ";
            
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap($periode, $unitfilter);
            
        }
        
        $this->view->load('json/pieJenisSP2D');
    }
    
    public function pieNominalSP2D($periode, $kodeunit=null) {
        
        if ((Session::get('role')==KPPN) or (isset($kodeunit) and ($kodeunit[0] != 'K'))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $unitfilter = " substr(CHECK_NUMBER,3,3)='".$kodeunit."' ";

            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap($periode, $unitfilter);
            
        } else if ((Session::get('role')==KANWIL) or (isset($kodeunit) and ($kodeunit[0] == 'K'))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = 'K'.Session::get('id_user');
            }
            
            $unitfilter = " substr(check_number,3,3) in (select kdkppn from t_kppn where kdkanwil='".substr($kodeunit,1,2)."') ";
            
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap($periode, $unitfilter);
            
        } else {
            
            $unitfilter = " CHECK_NUMBER is not null ";
            
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap($periode, $unitfilter);
            
        }
        
        $this->view->load('json/pieNominalSP2D');
        
    }
    
    public function pieReturSP2D($kodeunit=null) {
        
        if ((Session::get('role')==KPPN) or (isset($kodeunit) and ($kodeunit[0] != 'K'))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $returfilter = " KDKPPN='".$kodeunit."' ";

            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_retur = $d_dashboard->get_sp2d_retur($returfilter);
            
        } else if ((Session::get('role')==KANWIL) or (isset($kodeunit) and ($kodeunit[0] == 'K'))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = 'K'.Session::get('id_user');
            }
            
            $returfilter = " KDKPPN in (select kdkppn from t_kppn where kdkanwil='".substr($kodeunit,1,2)."') ";
            
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_retur = $d_dashboard->get_sp2d_retur($returfilter);
            
        } else {
            
            $returfilter = " KDKPPN is not null ";
            
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_retur = $d_dashboard->get_sp2d_retur($returfilter);
            
        }
        
        $this->view->load('json/pieReturSP2D');
        
    }
    
    public function pieStatusLHP($periode, $kodeunit=null) {
        
        $this->view->periode = $periode;
        
        if ((Session::get('role')==KPPN) or (isset($kodeunit) and ($kodeunit[0] != 'K'))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $lhpfilter = " KPPN='".$kodeunit."' ";

            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap($periode, $lhpfilter);
            
        } else if ((Session::get('role')==KANWIL) or (isset($kodeunit) and ($kodeunit[0] == 'K'))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = 'K'.Session::get('id_user');
            }
            
            $lhpfilter = " KPPN in (select kdkppn from t_kppn where kdkanwil='".substr($kodeunit,1,2)."') ";
            
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap($periode, $lhpfilter);
            
        } else {
            
            $lhpfilter = " KPPN is not null ";
            
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap($periode, $lhpfilter);
            
        }
        
        $this->view->load('json/pieStatusLHP');
        
    }
    
    public function listSPMOngoing($kodeunit=null) {
        
        if ((Session::get('role')==KPPN) or (isset($kodeunit))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $d_dashboard = new DataDashboard($this->registry);

            $filter_pos_spm = array ();
            $filter_pos_spm[1]="SUBSTR(OU_NAME,1,3) = '".$kodeunit."'";
            $this->view->data_pos_spm = $d_dashboard->get_hist_spm_filter($filter_pos_spm);
            
        } else {
            
        }
        
        $this->view->load('json/listSPMOngoing');
        
    }
    
    public function listSP2DFinished($kodeunit=null) {
        
        if ((Session::get('role')==KPPN) or (isset($kodeunit))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $unitfilter = " substr(CHECK_NUMBER,3,3)='".$kodeunit."' ";

            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_list_sp2d = $d_dashboard->get_list_sp2d_selesai($unitfilter);
            
        } else {
            
        }
        
        $this->view->load('json/listSP2DFinished');
        
    }
    
    public function summaryUnit($kodeunit=null, $tanggal_lhp=null) {
        
        if (!isset($kodeunit)) {
            $this->view->load('json/summaryUnit');
        } else {
            
            $d_dashboard = new DataDashboard($this->registry);
            
            $this->view->nama_unit = $kodeunit;
            $this->view->nama_lengkap_unit = $d_dashboard->get_nama_unit($kodeunit);
            
            if ($kodeunit[0] != 'K') {
                
                //Rekap SP2D
                $unitfilter = " substr(CHECK_NUMBER,3,3)='".$kodeunit."' ";
                $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(1, $unitfilter);
                
                //Rekap Retur
                $returfilter = " KDKPPN='".$kodeunit."' ";
                $this->view->data_retur = $d_dashboard->get_sp2d_retur($returfilter);
                
                //Rekap LHP
                $lhpfilter = " KPPN='".$kodeunit."' ";
                $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap_tanggal($tanggal_lhp, $lhpfilter);
                
                //SPM dalam proses
                $filter_pos_spm = array ();
                $filter_pos_spm[1]="SUBSTR(OU_NAME,1,3) = '".$kodeunit."'";
                $this->view->data_pos_spm = $d_dashboard->get_hist_spm_filter($filter_pos_spm);
                
            } else {
                
                //Rekap SP2D
                $unitfilter = " substr(check_number,3,3) in (select kdkppn from t_kppn where kdkanwil='".substr($kodeunit,1,2)."')  ";
                $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(1, $unitfilter);
                
                //Rekap Retur
                $returfilter = " KDKPPN in (select kdkppn from t_kppn where kdkanwil='".substr($kodeunit,1,2)."') ";
                $this->view->data_retur = $d_dashboard->get_sp2d_retur($returfilter);
                
                //Rekap LHP
                $lhpfilter = " KPPN in (select kdkppn from t_kppn where kdkanwil='".substr($kodeunit,1,2)."') ";
                $this->view->data_lhp_rekap = $d_dashboard->get_lhp_rekap_tanggal($tanggal_lhp, $lhpfilter);
                
                //SPM dalam proses
                $filter_pos_spm = array ();
                $filter_pos_spm[1]="SUBSTR(OU_NAME,1,3) in (select kdkppn from t_kppn where kdkanwil='".substr($kodeunit,1,2)."') ";
                $this->view->data_pos_spm = $d_dashboard->get_hist_spm_filter($filter_pos_spm);
                
            }
            
            $this->view->load('json/rowSummaryUnit');
            
        }
        
    }
    
    public function lineHistSP2D($periode, $kodeunit=null) {
        
        $this->view->periode = $periode;
        
        if ((Session::get('role')==KPPN) or (isset($kodeunit) and ($kodeunit[0] != 'K'))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $unitfilter = " substr(CHECK_NUMBER,3,3)='".$kodeunit."' ";

            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap($periode, $unitfilter);
            
        } else if ((Session::get('role')==KANWIL) or (isset($kodeunit) and ($kodeunit[0] == 'K'))) {
            
            if (!isset($kodeunit)) {
                $kodeunit = 'K'.Session::get('id_user');
            }
            
            $unitfilter = " substr(check_number,3,3) in (select kdkppn from t_kppn where kdkanwil='".substr($kodeunit,1,2)."') ";
            
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap($periode, $unitfilter);
            
        } else {
            
            $unitfilter = " CHECK_NUMBER is not null ";
            
            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap($periode, $unitfilter);
            
        }
        
        $this->view->load('json/lineHistSP2D');
        
    }
    
    public function lastUpdate() {
        
        $d_dashboard = new DataDashboard($this->registry);
        echo '{ "lastUpdate" : "'.$d_dashboard->get_last_update_all().'" }';
        
    }
    
}

?>