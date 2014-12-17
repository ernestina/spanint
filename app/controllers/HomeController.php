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
    
    //For Dash
    private function pieJenisSP2D($periode, $kodeunit = null) {
        
        $d_dashboard = new DataDashboard($this->registry);

        if ((Session::get('role') == SATKER) or (isset($kodeunit) and (strlen($kodeunit) >= 6))) {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('kd_satker');
            }

            $unitfilter = " SEGMENT1='" . $kodeunit . "' ";

            return $d_dashboard->get_sp2d_rekap_num_pie($periode, $unitfilter);
            
        } else if ((Session::get('role') == KPPN) or (isset($kodeunit) and ($kodeunit[0] != 'K'))) {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $unitfilter = " kdkppn = '" . $kodeunit . "' ";

            return $d_dashboard->get_sp2d_rekap_num_pie($periode, $unitfilter);
            
        } else if ((Session::get('role') == KANWIL) or (isset($kodeunit) and ($kodeunit[0] == 'K'))) {

            if (!isset($kodeunit)) {
                $kodeunit = 'K' . Session::get('id_user');
            }

            $unitfilter = " kdkppn in (select kdkppn from t_kppn where kdkanwil='" . substr($kodeunit, 1, 2) . "') ";

            return $d_dashboard->get_sp2d_rekap_num_pie($periode, $unitfilter);
            
        } else {

            $unitfilter = " CHECK_NUMBER is not null ";

            return $d_dashboard->get_sp2d_rekap_num_pie($periode, $unitfilter);
            
        }

    }

    private function pieNominalSP2D($periode, $kodeunit = null) {
        
        $d_dashboard = new DataDashboard($this->registry);

        if ((Session::get('role') == SATKER) or (isset($kodeunit) and (strlen($kodeunit) >= 6))) {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('kd_satker');
            }

            $unitfilter = " SEGMENT1='" . $kodeunit . "' ";

            return $d_dashboard->get_sp2d_rekap_vol_pie($periode, $unitfilter);
            
        } else if ((Session::get('role') == KPPN) or (isset($kodeunit) and ($kodeunit[0] != 'K'))) {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $unitfilter = " kdkppn = '" . $kodeunit . "' ";

            return $d_dashboard->get_sp2d_rekap_vol_pie($periode, $unitfilter);
            
        } else if ((Session::get('role') == KANWIL) or (isset($kodeunit) and ($kodeunit[0] == 'K'))) {

            if (!isset($kodeunit)) {
                $kodeunit = 'K' . Session::get('id_user');
            }

            $unitfilter = " kdkppn in (select kdkppn from t_kppn where kdkanwil='" . substr($kodeunit, 1, 2) . "') ";

            return $d_dashboard->get_sp2d_rekap_vol_pie($periode, $unitfilter);
            
        } else {

            $unitfilter = " CHECK_NUMBER is not null ";

            return $d_dashboard->get_sp2d_rekap_vol_pie($periode, $unitfilter);
            
        }

    }

    private function pieReturSP2D($kodeunit = null) {
        
        $d_dashboard = new DataDashboard($this->registry);

        if ((Session::get('role') == SATKER) or (isset($kodeunit) and (strlen($kodeunit) >= 6))) {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('kd_satker');
            }

            $returfilter = " KDSATKER='" . $kodeunit . "' ";

            return $d_dashboard->get_sp2d_retur($returfilter);
            
        } else if ((Session::get('role') == KPPN) or (isset($kodeunit) and ($kodeunit[0] != 'K'))) {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $returfilter = " KDKPPN='" . $kodeunit . "' ";

            return $d_dashboard->get_sp2d_retur($returfilter);
            
        } else if ((Session::get('role') == KANWIL) or (isset($kodeunit) and ($kodeunit[0] == 'K'))) {

            if (!isset($kodeunit)) {
                $kodeunit = 'K' . Session::get('id_user');
            }

            $returfilter = " KDKPPN in (select kdkppn from t_kppn where kdkanwil='" . substr($kodeunit, 1, 2) . "') ";

            return $d_dashboard->get_sp2d_retur($returfilter);
            
        } else {

            $returfilter = " KDKPPN is not null ";
            
            return $d_dashboard->get_sp2d_retur($returfilter);
            
        }

    }

    private function pieStatusLHP($periode, $kodeunit = null) {
        
        $d_dashboard = new DataDashboard($this->registry);

        //$this->view->periode = $periode;

        if ((Session::get('role') == KPPN) or (isset($kodeunit) and ($kodeunit[0] != 'K'))) {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $lhpfilter = " KPPN='" . $kodeunit . "' ";

            return $d_dashboard->get_lhp_rekap($periode, $lhpfilter);
            
        } else if ((Session::get('role') == KANWIL) or (isset($kodeunit) and ($kodeunit[0] == 'K'))) {

            if (!isset($kodeunit)) {
                $kodeunit = 'K' . Session::get('id_user');
            }

            $lhpfilter = " KPPN in (select kdkppn from t_kppn where kdkanwil='" . substr($kodeunit, 1, 2) . "') ";

            return $d_dashboard->get_lhp_rekap($periode, $lhpfilter);
            
        } else {

            $lhpfilter = " KPPN is not null ";

            return $d_dashboard->get_lhp_rekap($periode, $lhpfilter);
            
        }

    }

    private function pieStatusDIPA($kodeunit = null) {

        $d_spm1 = new DataFA($this->registry);
        $filter = array();
        $no = 0;
        
        $filter[$no++] = " A.SATKER =  '" . Session::get('kd_satker') . "'";

        return $d_spm1->get_fa_summary_filter($filter);
    }

    private function listSPMOngoing($hari, $kodeunit = null) {
        
        $d_dashboard = new DataDashboard($this->registry);

        if ((Session::get('role') == KPPN) or (isset($kodeunit) and (strlen($kodeunit) < 6))) {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $filter_pos_spm = array();
            $filter_pos_spm[] = "KDKPPN = '" . $kodeunit . "'";
            
            return $d_dashboard->get_hist_spm_filter($filter_pos_spm);
            
        } else {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('kd_satker');
            }

            $filter_pos_spm = array();
            $filter_pos_spm[] = "SUBSTR(INVOICE_NUM,7,6) = '" . $kodeunit . "'";
            
            return $d_dashboard->get_hist_spm_filter($filter_pos_spm);
            
        }

    }

    private function listSP2DFinished($hari, $kodeunit = null) {
        
        $d_dashboard = new DataDashboard($this->registry);

        if ((Session::get('role') == KPPN) or (isset($kodeunit) and (strlen($kodeunit) < 6))) {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $unitfilter = " KDKPPN = '" . $kodeunit . "' ";

            $unitfilter .= "and check_date = to_date('" . date("Ymd", time()) . "','yyyymmdd')";

            return $d_dashboard->get_list_sp2d_selesai($unitfilter);
            
        } else {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('kd_satker');
            }

            $unitfilter = " SEGMENT1='" . $kodeunit . "' ";

            $unitfilter .= "and (check_date between to_date('" . date("Ymd", time() - ($hari - 1) * 24 * 60 * 60) . "','yyyymmdd') and to_date('" . date("Ymd", time()) . "','yyyymmdd'))";

            return $d_dashboard->get_list_sp2d_selesai($unitfilter);
            
        }
    }

    private function summaryUnit($kodeunit = null, $tanggal_lhp = null) {

        $d_dashboard = new DataDashboard($this->registry);

        $summary_result = (object) 'Test';
        
        $summary_result->nama_unit = $kodeunit;
        $summary_result->nama_lengkap_unit = $d_dashboard->get_nama_unit($kodeunit);

        if ($kodeunit[0] != 'K') {

            //Rekap SP2D
            $unitfilter = " KDKPPN = '" . $kodeunit . "' ";
            $summary_result->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(1, $unitfilter);

            //Rekap Retur
            $returfilter = " KDKPPN = '" . $kodeunit . "' ";
            $summary_result->data_retur = $d_dashboard->get_sp2d_retur($returfilter);

            //Rekap LHP
            $lhpfilter = " KPPN='" . $kodeunit . "' ";
            $summary_result->data_lhp_rekap = $d_dashboard->get_lhp_rekap_tanggal($tanggal_lhp, $lhpfilter);

            //SPM dalam proses
            $filter_pos_spm = array();
            $filter_pos_spm[1] = "KDKPPN = '" . $kodeunit . "'";
            $summary_result->data_pos_spm = $d_dashboard->get_hist_spm_count($filter_pos_spm);
            
            return $summary_result;

        } else {

            //Rekap SP2D
            $unitfilter = " KDKPPN in (select kdkppn from t_kppn where kdkanwil='" . substr($kodeunit, 1, 2) . "')  ";
            $summary_result->data_sp2d_rekap = $d_dashboard->get_sp2d_rekap(1, $unitfilter);

            //Rekap Retur
            $returfilter = " KDKPPN in (select kdkppn from t_kppn where kdkanwil='" . substr($kodeunit, 1, 2) . "') ";
            $summary_result->data_retur = $d_dashboard->get_sp2d_retur($returfilter);

            //Rekap LHP
            $lhpfilter = " KPPN in (select kdkppn from t_kppn where kdkanwil='" . substr($kodeunit, 1, 2) . "') ";
            $summary_result->data_lhp_rekap = $d_dashboard->get_lhp_rekap_tanggal($tanggal_lhp, $lhpfilter);

            //SPM dalam proses
            $filter_pos_spm = array();
            $filter_pos_spm[1] = "KDKPPN in (select kdkppn from t_kppn where kdkanwil='" . substr($kodeunit, 1, 2) . "') ";
            $summary_result->data_pos_spm = $d_dashboard->get_hist_spm_count($filter_pos_spm);
            
            return $summary_result;

        }

    }

    private function lineHistSP2D($periode, $kodeunit = null) {

        //$this->view->periode = $periode;
        
        if ((Session::get('role') == KPPN) or (isset($kodeunit) and ($kodeunit[0] != 'K'))) {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('id_user');
            }

            $unitfilter = " KDKPPN = '" . $kodeunit . "' ";

            $d_dashboard = new DataDashboard($this->registry);

            return $d_dashboard->get_sp2d_rekap_num($periode, $unitfilter);
            
        } else if ((Session::get('role') == KANWIL) or (isset($kodeunit) and ($kodeunit[0] == 'K'))) {

            if (!isset($kodeunit)) {
                $kodeunit = 'K' . Session::get('id_user');
            }

            $unitfilter = " KDKPPN in (select kdkppn from t_kppn where kdkanwil='" . substr($kodeunit, 1, 2) . "') ";

            $d_dashboard = new DataDashboard($this->registry);

            return $d_dashboard->get_sp2d_rekap_num($periode, $unitfilter);
            
        } else if (Session::get('role') == SATKER) {

            if (!isset($kodeunit)) {
                $kodeunit = Session::get('kd_satker');
            }

            $unitfilter = " SEGMENT1='" . $kodeunit . "' ";

            $d_dashboard = new DataDashboard($this->registry);

            return $d_dashboard->get_sp2d_rekap_num($periode, $unitfilter);
            
        } else {

            $unitfilter = " CHECK_NUMBER is not null ";

            $d_dashboard = new DataDashboard($this->registry);

            return $d_dashboard->get_sp2d_rekap_num($periode, $unitfilter);
            
        }
        
    }

    private function lastUpdate() {

        $d_dashboard = new DataDashboard($this->registry);
        return $d_dashboard->get_last_update_all();
        
    }
    
    public function dashboard($periode, $kodeunit = null) {
        
        $d_dashboard = new DataDashboard($this->registry);
        
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if ($periode == 'harian') {
            
            $this->view->mode = "Harian";
            
            if (!isset($kodeunit)) {
                
                $this->view->pieJenisSP2D = $this->pieJenisSP2D(1);
                $this->view->pieNominalSP2D = $this->pieNominalSP2D(1);
                $this->view->pieReturSP2D = $this->pieReturSP2D();
                
                if (Session::get('role')==SATKER) {
                    $this->view->pieStatusDIPA = $this->pieStatusDIPA();
                } else {
                    $this->view->pieStatusLHP = $this->pieStatusLHP(1);
                }

                if (Session::get('role')==KANWIL) {
                    
                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
                    
                    $this->view->summaryUnit = array();
                
                    foreach ($this->view->unit_list as $unit_list) {

                        if ($unit_list->get_kd_d_kppn() != 'K00') {
                            $this->view->summaryUnit[] = $this->summaryUnit($unit_list->get_kd_d_kppn(), $this->view->pieStatusLHP[0]->get_tgl_lhp());
                        }

                    }
                    
                } else if (Session::get('role')==ADMIN) {
                    
                    $d_kanwil_list = new DataDashboard($this->registry);
                    $this->view->unit_list = $d_kanwil_list->get_kanwil();
                    
                    $this->view->summaryUnit = array();
                
                    foreach ($this->view->unit_list as $unit_list) {

                        if ($unit_list->get_kd_d_kppn() != 'K00') {
                            $this->view->summaryUnit[] = $this->summaryUnit($unit_list->get_kd_d_kppn(), $this->view->pieStatusLHP[0]->get_tgl_lhp());
                        }

                    }
                    
                } else {
                    
                    $this->view->SPMOngoing = $this->listSPMOngoing(1);
                    $this->view->SP2DFinished = $this->listSP2DFinished(1);
                    
                }
                
                $this->view->last_update = $this->lastUpdate();

            } else {

                $d_dashboard = new DataDashboard($this->registry);

                $this->view->kodeunit = $kodeunit;
                $this->view->namaunit = $d_dashboard->get_nama_unit($kodeunit);

                if (Session::get('role')==SATKER) {

                    header('location:' . URL . 'home/dashboard/mingguan');

                } else if (Session::get('role')==KPPN) {

                    header('location:' . URL . 'home/dashboard/harian');

                } else if (Session::get('role')==KANWIL) {

                    if ($kodeunit != Session::get('id_user')) {
                        $d_kppn_list = new DataUser($this->registry);
                        $unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));

                        $inList = false;
                        foreach ($unit_list as $list) {
                            if ($list->get_kd_d_kppn() == $kodeunit) {
                                $inList = true;
                            }
                        }

                        if ($inList == false) {
                            header('location:' . URL . 'home/dashboard/harian');
                        }

                    }

                }

                if ($kodeunit[0] != 'K') {

                    $this->view->kodekanwil = "K".$d_dashboard->get_kanwil_kppn($kodeunit);
                    $this->view->namakanwil = $d_dashboard->get_nama_unit($this->view->kodekanwil);
                    
                    $this->view->SPMOngoing = $this->listSPMOngoing(1, $kodeunit);
                    $this->view->SP2DFinished = $this->listSP2DFinished(1, $kodeunit);

                } else {

                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(substr($kodeunit,1,2));

                }
                
                $this->view->pieJenisSP2D = $this->pieJenisSP2D(1, $kodeunit);
                $this->view->pieNominalSP2D = $this->pieNominalSP2D(1, $kodeunit);
                $this->view->pieReturSP2D = $this->pieReturSP2D($kodeunit);
                $this->view->pieStatusLHP = $this->pieStatusLHP(1, $kodeunit);
                
                if (isset($this->view->unit_list)) {
                    $this->view->summaryUnit = array();

                    foreach ($this->view->unit_list as $unit_list) {

                        if ($unit_list->get_kd_d_kppn() != 'K00') {
                            $this->view->summaryUnit[] = $this->summaryUnit($unit_list->get_kd_d_kppn(), $this->view->pieStatusLHP[0]->get_tgl_lhp());
                        }

                    }
                }
                
                $this->view->last_update = $this->lastUpdate();

            }
            
        } else if ($periode == 'mingguan') {
            
            $this->view->mode = "Mingguan";
            
            if (!isset($kodeunit)) {

                if (Session::get('role')==KANWIL) {
                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
                } else {
                    $d_kanwil_list = new DataDashboard($this->registry);
                    $this->view->unit_list = $d_kanwil_list->get_kanwil();
                }
                
                $this->view->pieJenisSP2D = $this->pieJenisSP2D(7);
                $this->view->pieNominalSP2D = $this->pieNominalSP2D(7);
                $this->view->pieReturSP2D = $this->pieReturSP2D();
                if (Session::get('role')==SATKER) {
                    $this->view->pieStatusDIPA = $this->pieStatusDIPA();
                } else {
                    $this->view->pieStatusLHP = $this->pieStatusLHP(7);
                }
                
                $this->view->lineHistSP2D = $this->lineHistSP2D(7);
                
                //var_dump($this->view->lineHistSP2D);
                
                $this->view->periode = 7;
                
                $this->view->last_update = $this->lastUpdate();

            } else {

                $this->view->kodeunit = $kodeunit;
                $this->view->namaunit = $d_dashboard->get_nama_unit($kodeunit);

                if (Session::get('role')==SATKER) {

                    header('location:' . URL . 'home/dashboard/mingguan');

                } else if (Session::get('role')==KPPN) {

                    header('location:' . URL . 'home/dashboard/mingguan');

                } else if (Session::get('role')==KANWIL) {

                    if ($kodeunit != Session::get('id_user')) {
                        $d_kppn_list = new DataUser($this->registry);
                        $unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));

                        $inList = false;
                        foreach ($unit_list as $list) {
                            if ($list->get_kd_d_kppn() == $kodeunit) {
                                $inList = true;
                            }
                        }

                        if ($inList == false) {
                            header('location:' . URL . 'home/dashboard/mingguan');
                        }

                    }

                }

                if ($kodeunit[0] != 'K') {

                    $this->view->kodekanwil = "K".$d_dashboard->get_kanwil_kppn($kodeunit);
                    $this->view->namakanwil = $d_dashboard->get_nama_unit($this->view->kodekanwil);

                } else {

                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(substr($kodeunit,1,2));

                }
                
                $this->view->pieJenisSP2D = $this->pieJenisSP2D(7, $kodeunit);
                $this->view->pieNominalSP2D = $this->pieNominalSP2D(7, $kodeunit);
                $this->view->pieReturSP2D = $this->pieReturSP2D($kodeunit);
                $this->view->pieStatusLHP = $this->pieStatusLHP(7, $kodeunit);
                
                $this->view->lineHistSP2D = $this->lineHistSP2D(7, $kodeunit);
                
                $this->view->periode = 7;
                
                $this->view->last_update = $this->lastUpdate();

            }
            
        } else if ($periode == 'bulanan') {
            
            $this->view->mode = "Bulanan";
            
            if (!isset($kodeunit)) {

                if (Session::get('role')==KANWIL) {
                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
                } else {
                    $d_kanwil_list = new DataDashboard($this->registry);
                    $this->view->unit_list = $d_kanwil_list->get_kanwil();
                }
                
                $this->view->pieJenisSP2D = $this->pieJenisSP2D(30);
                $this->view->pieNominalSP2D = $this->pieNominalSP2D(30);
                $this->view->pieReturSP2D = $this->pieReturSP2D();
                if (Session::get('role')==SATKER) {
                    $this->view->pieStatusDIPA = $this->pieStatusDIPA();
                } else {
                    $this->view->pieStatusLHP = $this->pieStatusLHP(30);
                }
                
                $this->view->lineHistSP2D = $this->lineHistSP2D(30);
                
                $this->view->periode = 30;
                
                $this->view->last_update = $this->lastUpdate();

            } else {

                if (Session::get('role')==SATKER) {

                    header('location:' . URL . 'home/dashboard/bulanan');

                } else if (Session::get('role')==KPPN) {

                    header('location:' . URL . 'home/dashboard/bulanan');

                } else if (Session::get('role')==KANWIL) {

                    if ($kodeunit != Session::get('id_user')) {
                        $d_kppn_list = new DataUser($this->registry);
                        $unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));

                        $inList = false;
                        foreach ($unit_list as $list) {
                            if ($list->get_kd_d_kppn() == $kodeunit) {
                                $inList = true;
                            }
                        }

                        if ($inList == false) {
                            header('location:' . URL . 'home/dashboard/bulanan');
                        }

                    }

                }

                $this->view->kodeunit = $kodeunit;
                $this->view->namaunit = $d_dashboard->get_nama_unit($kodeunit);

                if ($kodeunit[0] != 'K') {

                    $this->view->kodekanwil = "K".$d_dashboard->get_kanwil_kppn($kodeunit);
                    $this->view->namakanwil = $d_dashboard->get_nama_unit($this->view->kodekanwil);

                } else {

                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(substr($kodeunit,1,2));

                }
                
                $this->view->pieJenisSP2D = $this->pieJenisSP2D(30, $kodeunit);
                $this->view->pieNominalSP2D = $this->pieNominalSP2D(30, $kodeunit);
                $this->view->pieReturSP2D = $this->pieReturSP2D($kodeunit);
                $this->view->pieStatusLHP = $this->pieStatusLHP(30, $kodeunit);
                
                $this->view->lineHistSP2D = $this->lineHistSP2D(30, $kodeunit);
                
                $this->view->periode = 30;
                
                $this->view->last_update = $this->lastUpdate();

            }
            
        } else if ($periode == 'triwulanan') {
            
            $this->view->mode = "Triwulanan";
            
            $this->view->mode = "Bulanan";
            
            if (!isset($kodeunit)) {

                if (Session::get('role')==KANWIL) {
                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
                } else {
                    $d_kanwil_list = new DataDashboard($this->registry);
                    $this->view->unit_list = $d_kanwil_list->get_kanwil();
                }
                
                $this->view->pieJenisSP2D = $this->pieJenisSP2D(90);
                $this->view->pieNominalSP2D = $this->pieNominalSP2D(90);
                $this->view->pieReturSP2D = $this->pieReturSP2D();
                if (Session::get('role')==SATKER) {
                    $this->view->pieStatusDIPA = $this->pieStatusDIPA();
                } else {
                    $this->view->pieStatusLHP = $this->pieStatusLHP(90);
                }
                
                $this->view->lineHistSP2D = $this->lineHistSP2D(90);
                
                $this->view->periode = 90;
                
                $this->view->last_update = $this->lastUpdate();

            } else {

                if (Session::get('role')==SATKER) {

                    header('location:' . URL . 'home/dashboard/bulanan');

                } else if (Session::get('role')==KPPN) {

                    header('location:' . URL . 'home/dashboard/bulanan');

                } else if (Session::get('role')==KANWIL) {

                    if ($kodeunit != Session::get('id_user')) {
                        $d_kppn_list = new DataUser($this->registry);
                        $unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));

                        $inList = false;
                        foreach ($unit_list as $list) {
                            if ($list->get_kd_d_kppn() == $kodeunit) {
                                $inList = true;
                            }
                        }

                        if ($inList == false) {
                            header('location:' . URL . 'home/dashboard/bulanan');
                        }

                    }

                }

                $this->view->kodeunit = $kodeunit;
                $this->view->namaunit = $d_dashboard->get_nama_unit($kodeunit);

                if ($kodeunit[0] != 'K') {

                    $this->view->kodekanwil = "K".$d_dashboard->get_kanwil_kppn($kodeunit);
                    $this->view->namakanwil = $d_dashboard->get_nama_unit($this->view->kodekanwil);

                } else {

                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(substr($kodeunit,1,2));

                }
                
                $this->view->pieJenisSP2D = $this->pieJenisSP2D(90, $kodeunit);
                $this->view->pieNominalSP2D = $this->pieNominalSP2D(90, $kodeunit);
                $this->view->pieReturSP2D = $this->pieReturSP2D($kodeunit);
                $this->view->pieStatusLHP = $this->pieStatusLHP(90, $kodeunit);
                
                $this->view->lineHistSP2D = $this->lineHistSP2D(90, $kodeunit);
                
                $this->view->periode = 90;
                
                $this->view->last_update = $this->lastUpdate();

            }
            
        }
        
        $this->view->render('admin/dashboard');
        
		
		$d_log->tambah_log("Sukses");
        
    }
    
    public function dahboardPengeluaranPenerimaan($periode, $kodeunit = null) {
        
        $this->view->render('admin/dashboard-pengeluaran-penerimaan');
        
    }
    
    public function dashboardPenerbitan($kodeunit = null) {
        
        if (!isset($kodeunit)) {
                
            $this->view->pieJenisSP2D = $this->pieJenisSP2D(1);
            $this->view->pieNominalSP2D = $this->pieNominalSP2D(1);
            $this->view->pieReturSP2D = $this->pieReturSP2D();
            $this->view->pieStatusLHP = $this->pieStatusLHP(1);

            if (Session::get('role')==KANWIL) {

                $d_kppn_list = new DataUser($this->registry);
                $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));

                $this->view->summaryUnit = array();

                foreach ($this->view->unit_list as $unit_list) {

                    if ($unit_list->get_kd_d_kppn() != 'K00') {
                        $this->view->summaryUnit[] = $this->summaryUnit($unit_list->get_kd_d_kppn(), $this->view->pieStatusLHP[0]->get_tgl_lhp());
                    }

                }

            } else if (Session::get('role')==ADMIN) {

                $d_kanwil_list = new DataDashboard($this->registry);
                $this->view->unit_list = $d_kanwil_list->get_kanwil();

                $this->view->summaryUnit = array();

                foreach ($this->view->unit_list as $unit_list) {

                    if ($unit_list->get_kd_d_kppn() != 'K00') {
                        $this->view->summaryUnit[] = $this->summaryUnit($unit_list->get_kd_d_kppn(), $this->view->pieStatusLHP[0]->get_tgl_lhp());
                    }

                }

            }

            $this->view->last_update = $this->lastUpdate();

        } else {

            $d_dashboard = new DataDashboard($this->registry);

            $this->view->kodeunit = $kodeunit;
            $this->view->namaunit = $d_dashboard->get_nama_unit($kodeunit);

            if (Session::get('role')==KANWIL) {

                if ($kodeunit != Session::get('id_user')) {
                    $d_kppn_list = new DataUser($this->registry);
                    $unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));

                    $inList = false;
                    foreach ($unit_list as $list) {
                        if ($list->get_kd_d_kppn() == $kodeunit) {
                            $inList = true;
                        }
                    }

                    if ($inList == false) {
                        header('location:' . URL . 'home/dashboard/harian');
                    }

                }

            }

            if ($kodeunit[0] != 'K') {

                $this->view->kodekanwil = "K".$d_dashboard->get_kanwil_kppn($kodeunit);
                $this->view->namakanwil = $d_dashboard->get_nama_unit($this->view->kodekanwil);

                $this->view->SPMOngoing = $this->listSPMOngoing(1, $kodeunit);
                $this->view->SP2DFinished = $this->listSP2DFinished(1, $kodeunit);

            } else {

                $d_kppn_list = new DataUser($this->registry);
                $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(substr($kodeunit,1,2));

            }

            $this->view->pieJenisSP2D = $this->pieJenisSP2D(1, $kodeunit);
            $this->view->pieNominalSP2D = $this->pieNominalSP2D(1, $kodeunit);
            $this->view->pieReturSP2D = $this->pieReturSP2D($kodeunit);
            $this->view->pieStatusLHP = $this->pieStatusLHP(1, $kodeunit);

            if (isset($this->view->unit_list)) {
                $this->view->summaryUnit = array();

                foreach ($this->view->unit_list as $unit_list) {

                    if ($unit_list->get_kd_d_kppn() != 'K00') {
                        $this->view->summaryUnit[] = $this->summaryUnit($unit_list->get_kd_d_kppn(), $this->view->pieStatusLHP[0]->get_tgl_lhp());
                    }

                }
            }

            $this->view->last_update = $this->lastUpdate();

        }  
                
        $this->view->render('admin/dashboard-penerbitan');
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
            
        } elseif ($whereto == 'spm-sp2d') {
            
            $d_log = new DataLog($this->registry);
            $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
            
            $kodeunit = Session::get('id_user');

            $d_dashboard = new DataDashboard($this->registry);

            $this->view->data = $d_dashboard->get_hist_spm_sp2d_filter_tv($kodeunit);
            
            $d_log->tambah_log("Sukses");
            
            $this->view->render('tv/tickerSPM-SP2D');
            
        }
    }
    
    public function __destruct() {
        
    }
    
}

?>