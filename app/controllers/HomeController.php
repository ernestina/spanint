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
        if (Session::get('role')==SATKER) {
            header('location:' . URL . 'home/mingguan');
        } else {
            header('location:' . URL . 'home/harian');
        }
    }
    
    public function harian($kodeunit=null) {
        
        if (!isset($kodeunit)) {
            
            if (Session::get('role')==KPPN) {

                $this->view->render('kppn/homeDashboardHarianKPPN');
                
            } else if (Session::get('role')==SATKER) {
                
                $this->view->render('kppn/homeDashboardSatker');

            } else {

                if (Session::get('role')==KANWIL) {
                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
                } else {
                    $d_kanwil_list = new DataDashboard($this->registry);
                    $this->view->unit_list = $d_kanwil_list->get_kanwil();
                }

                $this->view->render('kppn/homeDashboardHarianRekap');

            }
            
        } else {
            
            $d_dashboard = new DataDashboard($this->registry);
            
            $this->view->kodeunit = $kodeunit;
            $this->view->namaunit = $d_dashboard->get_nama_unit($kodeunit);
            
            if (Session::get('role')==SATKER) {
                
                header('location:' . URL . 'home/mingguan');
                
            } else if (Session::get('role')==KPPN) {
                
                header('location:' . URL . 'home/harian');
                
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
                        header('location:' . URL . 'home/harian');
                    }
                    
                }
                
            }
            
            if ($kodeunit[0] != 'K') {
                
                $this->view->kodekanwil = "K".$d_dashboard->get_kanwil_kppn($kodeunit);
                $this->view->namakanwil = $d_dashboard->get_nama_unit($this->view->kodekanwil);

                $this->view->render('kppn/homeDashboardHarianKPPN');

            } else {

                $d_kppn_list = new DataUser($this->registry);
                $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(substr($kodeunit,1,2));

                $this->view->render('kppn/homeDashboardHarianRekap');

            }
            
        }
    }
    
    public function mingguan($kodeunit=null) {
        $this->view->mode = "Mingguan";
        if (!isset($kodeunit)) {
            
            if (Session::get('role')==KPPN){

                $this->view->render('kppn/homeDashboardPeriodeKPPN');
                
            } else if (Session::get('role')==SATKER) {
                
                $this->view->render('kppn/homeDashboardSatker');

            } else {

                if (Session::get('role')==KANWIL) {
                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
                } else {
                    $d_kanwil_list = new DataDashboard($this->registry);
                    $this->view->unit_list = $d_kanwil_list->get_kanwil();
                }

                $this->view->render('kppn/homeDashboardPeriodeRekap');

            }
            
        } else {
            
            $d_dashboard = new DataDashboard($this->registry);
            
            $this->view->kodeunit = $kodeunit;
            $this->view->namaunit = $d_dashboard->get_nama_unit($kodeunit);
            
            if (Session::get('role')==SATKER) {
                
                header('location:' . URL . 'home/mingguan');
                
            } else if (Session::get('role')==KPPN) {
                
                header('location:' . URL . 'home/mingguan');
                
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
                        header('location:' . URL . 'home/mingguan');
                    }
                    
                }
                
            }
            
            if ($kodeunit[0] != 'K') {
                
                $this->view->kodekanwil = "K".$d_dashboard->get_kanwil_kppn($kodeunit);
                $this->view->namakanwil = $d_dashboard->get_nama_unit($this->view->kodekanwil);

                $this->view->render('kppn/homeDashboardPeriodeKPPN');

            } else {

                $d_kppn_list = new DataUser($this->registry);
                $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(substr($kodeunit,1,2));

                $this->view->render('kppn/homeDashboardPeriodeRekap');

            }
            
        }
    }
    
    public function bulanan($kodeunit=null) {
        $this->view->mode = "Bulanan";
        if (!isset($kodeunit)) {
            
            if (Session::get('role')==KPPN){

                $this->view->render('kppn/homeDashboardPeriodeKPPN');
                
            } else if (Session::get('role')==SATKER) {
                
                $this->view->render('kppn/homeDashboardSatker');

            } else {

                if (Session::get('role')==KANWIL) {
                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
                } else {
                    $d_kanwil_list = new DataDashboard($this->registry);
                    $this->view->unit_list = $d_kanwil_list->get_kanwil();
                }

                $this->view->render('kppn/homeDashboardPeriodeRekap');

            }
            
        } else {
            
            if (Session::get('role')==SATKER) {
                
                header('location:' . URL . 'home/bulanan');
                
            } else if (Session::get('role')==KPPN) {
                
                header('location:' . URL . 'home/bulanan');
                
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
                        header('location:' . URL . 'home/bulanan');
                    }
                    
                }
                
            }
            
            $d_dashboard = new DataDashboard($this->registry);
            
            $this->view->kodeunit = $kodeunit;
            $this->view->namaunit = $d_dashboard->get_nama_unit($kodeunit);
            
            if ($kodeunit[0] != 'K') {
                
                $this->view->kodekanwil = "K".$d_dashboard->get_kanwil_kppn($kodeunit);
                $this->view->namakanwil = $d_dashboard->get_nama_unit($this->view->kodekanwil);

                $this->view->render('kppn/homeDashboardPeriodeKPPN');

            } else {

                $d_kppn_list = new DataUser($this->registry);
                $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(substr($kodeunit,1,2));

                $this->view->render('kppn/homeDashboardPeriodeRekap');

            }
            
        }
    }
    
    public function triwulanan($kodeunit=null) {
        $this->view->mode = "Triwulanan";
        if (!isset($kodeunit)) {
            
            if (Session::get('role')==KPPN){

                $this->view->render('kppn/homeDashboardPeriodeKPPN');
                
            } else if (Session::get('role')==SATKER) {
                
                $this->view->render('kppn/homeDashboardSatker');

            } else {

                if (Session::get('role')==KANWIL) {
                    $d_kppn_list = new DataUser($this->registry);
                    $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
                } else {
                    $d_kanwil_list = new DataDashboard($this->registry);
                    $this->view->unit_list = $d_kanwil_list->get_kanwil();
                }

                $this->view->render('kppn/homeDashboardPeriodeRekap');

            }
            
        } else {
            
            $d_dashboard = new DataDashboard($this->registry);
            
            $this->view->kodeunit = $kodeunit;
            $this->view->namaunit = $d_dashboard->get_nama_unit($kodeunit);
            
            if (Session::get('role')==SATKER) {
                
                header('location:' . URL . 'home/triwulanan');
                
            } else if (Session::get('role')==KPPN) {
                
                header('location:' . URL . 'home/bulanan');
                
            } else if (Session::get('role')==KANWIL) {
                
                header('location:' . URL . 'home/bulanan');
                
            }
            
            if ($kodeunit[0] != 'K') {
                
                $this->view->kodekanwil = "K".$d_dashboard->get_kanwil_kppn($kodeunit);
                $this->view->namakanwil = $d_dashboard->get_nama_unit($this->view->kodekanwil);

                $this->view->render('kppn/homeDashboardPeriodeKPPN');

            } else {

                $d_kppn_list = new DataUser($this->registry);
                $this->view->unit_list = $d_kppn_list->get_kppn_kanwil(substr($kodeunit,1,2));

                $this->view->render('kppn/homeDashboardPeriodeRekap');

            }
            
        }
    }
    
}

?>