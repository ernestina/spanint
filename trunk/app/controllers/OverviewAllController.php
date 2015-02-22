<?php

class DashboardControllerController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function index() {
        
    }

    public function dashboard($mode=null) {
        
        $fetch = new DataOverview($this->registry);
        $this->view->tiles = array();
        
        //Count Persentase Realisasi
        
        $this->view->tiles[] = (object)
            
            array('title'  => 'Realisasi Belanja',
                  'subtitle' => 'Persentase terhadap pagu',
                  'type' => 'notification',
                  'value' => $fetch->percentageRealisasiBelanja(),
                  'unit' => '%');
        
        //Count Jumlah Realisasi
        
        $this->view->tiles[] = (object)
            
            array('title'  => 'Realisasi Belanja',
                  'subtitle' => 'Jumlah dalam rupiah',
                  'type' => 'notification',
                  'value' => number_format($fetch->sumRealisasiBelanja() / 1000000000000),
                  'unit' => 'T');
        
        //Count Revisi DIPA Dalam Proses
        
        $this->view->tiles[] = (object)
            
            array('title'  => 'Revisi DIPA dalam Proses',
                  'subtitle' => 'Semua satker',
                  'type' => 'notification',
                  'value' => number_format($fetch->countRevisiDalamProses()));
        
        //Count Belanja Transfer Daerah
        
        $this->view->tiles[] = (object)
            
            array('title'  => 'Belanja Transfer Daerah',
                  'subtitle' => 'Jumlah dalam rupiah',
                  'type' => 'notification',
                  'value' => number_format($fetch->sumBelanjaTransferDaerah() / 1000000000000),
                  'unit' => 'T');
        
        //Count Line Chart
        if (isset($mode)) {
            if ($mode == 1) {
                $mainChartData = $fetch->sumRealisasiTertinggiBA();
                $title = 'Nominal Realisasi Belanja Tertinggi (BA)';
            } else if ($mode == 2) {
                $mainChartData = $fetch->percentageRealisasiTertinggiBA();
                $title = 'Persentase Realisasi Belanja Tertinggi (BA)';
            } else if ($mode == 3) {
                $mainChartData = $fetch->sumRealisasiTerendahBA();
                $title = 'Nominal Realisasi Belanja Terendah (BA)';
            } else if ($mode == 4) {
                $mainChartData = $fetch->percentageRealisasiTerendahBA();
                $title = 'Persentase Realisasi Belanja Terendah (BA)';
            } else if ($mode == 5) {
                $mainChartData = $fetch->sumRealisasiTertinggiSatker();
                $title = 'Nominal Realisasi Belanja Tertinggi (Satker)';
            } else if ($mode == 6) {
                $mainChartData = $fetch->percentageRealisasiTertinggiSatker();
                $title = 'Persentase Realisasi Belanja Tertinggi (Satker)';
            } else if ($mode == 7) {
                $mainChartData = $fetch->sumRealisasiTerendahSatker();
                $title = 'Nominal Realisasi Belanja Terendah (Satker)';
            } else {
                $mainChartData = $fetch->percentageRealisasiTerendahSatker();
                $title = 'Persentase Realisasi Belanja Terendah (Satker)';
            }
        } else {
            $mainChartData = $fetch->sumRealisasiTertinggiBA();
            $title = 'Nominal Realisasi Belanja Tertinggi (BA)';
        }
        
        $labels = array();
        $datasets = array();
        $values = array();
        $legends = array();
        
        foreach ($mainChartData as $chartData) {
            
            $labels[] = (object) array('text' => $chartData->get_ba(), 'color' => '#39c');
            $values[] = $chartData->get_realisasi();
            $legends[] = $chartData->get_nmsatker();
        
        }
        
        $datasets[] = (object)
            
            array('label' => $title,
                  'color' => '51,153,204',
                  'values' => $values);
        
        $this->view->main_chart = (object)
            
            array('title' => $title,
                  'labels' => $labels,
                  'datasets' => $datasets,
                  'legends' => $legends);
        
        $this->view->switchers = array();
        
        $this->view->switchers[] = (object) array('description' => 'Nominal Realisasi Belanja Tertinggi (BA)', 
                                                  'link' => URL.'overviewPenganggaran/overview');
        $this->view->switchers[] = (object) array('description' => 'Persentase Realisasi Belanja Tertinggi (BA)', 
                                                  'link' => URL.'overviewPenganggaran/overview/2');
        $this->view->switchers[] = (object) array('description' => 'Nominal Realisasi Belanja Terendah (BA)', 
                                                  'link' => URL.'overviewPenganggaran/overview/3');
        $this->view->switchers[] = (object) array('description' => 'Persentase Realisasi Belanja Terendah (BA)', 
                                                  'link' => URL.'overviewPenganggaran/overview/4');
        $this->view->switchers[] = (object) array('description' => 'Nominal Realisasi Belanja Tertinggi (Satker)', 
                                                  'link' => URL.'overviewPenganggaran/overview/5');
        $this->view->switchers[] = (object) array('description' => 'Persentase Realisasi Belanja Tertinggi (Satker)', 
                                                  'link' => URL.'overviewPenganggaran/overview/6');
        $this->view->switchers[] = (object) array('description' => 'Nominal Realisasi Belanja Terendah (Satker)', 
                                                  'link' => URL.'overviewPenganggaran/overview/7');
        $this->view->switchers[] = (object) array('description' => 'Persentase Realisasi Belanja Terendah (Satker)', 
                                                  'link' => URL.'overviewPenganggaran/overview/8');
        
        $this->view->page_title = 'Overview: Modul Penganggaran';
        $this->view->page_subtitle = 'ADMIN<br/>SAMPAI DENGAN HARI INI';
        
        $this->view->render('Template-Overview');
        
    }

    public function __destruct() {
        
    }
    
}

?>