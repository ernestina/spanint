<?php

class DashboardController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function index() {
        
    }

    public function overviewAdmin($mode=null) {

        $fetch = new DataOverview($this->registry);

        $belanjaHariIni = $fetch->fetchRealisasiPaguBelanja();
        $penerimaanHariIni = $fetch->sumRealisasiPenerimaan();
        $kontrakHariIni =  $fetch->fetchStatusRealisasiKontrak();
        $sp2dHariIni = $fetch->fetchRekapSP2DTahunIni($filter2);

        if (!isset($mode) || ($mode == 1)) {

          $detailRealisasi = $fetch->get_realisasi_dash_filter();

          $mainchartData = array();

          if ($detailRealisasi[0]->get_pagu_51() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_51() / $detailRealisasi[0]->get_pagu_51() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_52() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_52() / $detailRealisasi[0]->get_pagu_52() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_53() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_53() / $detailRealisasi[0]->get_pagu_53() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_54() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_54() / $detailRealisasi[0]->get_pagu_54() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_55() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_55() / $detailRealisasi[0]->get_pagu_55() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_56() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_56() / $detailRealisasi[0]->get_pagu_56() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_57() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_57() / $detailRealisasi[0]->get_pagu_57() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_58() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_58() / $detailRealisasi[0]->get_pagu_58() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_61() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_61() / $detailRealisasi[0]->get_pagu_61() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer'),
            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' %', $mainchartData[1] . ' %', $mainchartData[2] . ' %', $mainchartData[3] . ' %', $mainchartData[4] . ' %', $mainchartData[5] . ' %', $mainchartData[6] . ' %', $mainchartData[7] . ' %', $mainchartData[8] . ' %'),
                'colors' => array('#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4')

              )

          );

        }  else if ($mode == 2) {

          $detailRealisasi = $fetch->get_realisasi_numbers_dash_filter();

          $mainchartData = array();
          $mainchartData2 = array();

          if ($detailRealisasi[0]->get_belanja_51() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_51() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_52() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_52() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_53() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_53() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_54() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_54() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_55() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_55() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_56() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_56() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_57() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_57() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_58() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_58() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_61() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_61() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_41() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_41()  * -1 / 10000000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData2[] = 0;
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_42() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_42()  * -1 / 10000000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData2[] = 0;
            $mainchartData[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis',

            'datasets' => array(

                (object) array(

                  'name' => 'Realisasi Belanja (dalam Triliun Rupiah)',
                  'values' => $mainchartData

                  ),
                (object) array(

                  'name' => 'Realisasi Penerimaan (dalam Triliun Rupiah)',
                  'values' => $mainchartData2

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer', 'Pajak', 'PNBP'),

            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' Miliar', $mainchartData[1] . ' Miliar', $mainchartData[2] . ' Miliar', $mainchartData[3] . ' Miliar', $mainchartData[4] . ' Miliar', $mainchartData[5] . ' Miliar', $mainchartData[6] . ' Miliar', $mainchartData[7] . ' Miliar', $mainchartData[8] . ' Miliar', $mainchartData2[9] . ' Miliar', $mainchartData2[10] . ' Miliar'),
                'colors' => array('#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#1f77b4', '#1f77b4')

              ),

            'colors' => array('#f6ce40', '#1f77b4')

          );
          
        } else if ($mode == 3) {

          $filtermain = array();

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnit(1,1);

          $mainchartData = array();
          $mainchartLabel = array();
          $mainchartColor = array();
          $mainchartLegend = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();
            $mainchartColor[] = '#1f77b4';

          }

          $legendLabels = $fetch->fetchNamaUnit(1, $mainchartLabel);

          foreach ($mainchartLabel as $lid=>$label) {

            foreach ($legendLabels as $legend) {

              if ($label == $legend->get_kode_unit()) {

                $mainchartLegend[$lid] = $legend->get_nama_unit();

              }

            }

          }

          //var_dump($legendLabels);

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Tertinggi per Satker',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel,
            'legends' => (object) array(

                'labels' => $mainchartLegend,
                'colors' => $mainchartColor

              )

          );
        } else if ($mode == 4) {

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnit(1,2);

          $mainchartData = array();
          $mainchartLabel = array();
          $mainchartColor = array();
          $mainchartLegend = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();
            $mainchartColor[] = '#1f77b4';

          }

          $legendLabels = $fetch->fetchNamaUnit(1, $mainchartLabel);

          foreach ($mainchartLabel as $lid=>$label) {

            foreach ($legendLabels as $legend) {

              if ($label == $legend->get_kode_unit()) {

                $mainchartLegend[$lid] = $legend->get_nama_unit();

              }

            }

          }

          //var_dump($legendLabels);

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Terendah per Satker',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel,
            'legends' => (object) array(

                'labels' => $mainchartLegend,
                'colors' => $mainchartColor

              )

          );

        } else if ($mode == 5) {

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnitBAES1(3,1);

          $mainchartData = array();
          $mainchartLabel = array();
          $mainchartColor = array();
          $mainchartLegend = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();
            $mainchartColor[] = '#1f77b4';

          }

          $legendLabels = $fetch->fetchNamaUnit(5, $mainchartLabel);

          foreach ($mainchartLabel as $lid=>$label) {

            foreach ($legendLabels as $legend) {

              if ($label == $legend->get_kode_unit()) {

                $mainchartLegend[$lid] = $legend->get_nama_unit();

              }

            }

          }

          //var_dump($legendLabels);

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Tertinggi per K/L',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel,
            'legends' => (object) array(

                'labels' => $mainchartLegend,
                'colors' => $mainchartColor

              )

          );

        } else if ($mode == 6) {

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnitBAES1(3,2);

          $mainchartData = array();
          $mainchartLabel = array();
          $mainchartColor = array();
          $mainchartLegend = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();
            $mainchartColor[] = '#1f77b4';

          }

          $legendLabels = $fetch->fetchNamaUnit(5, $mainchartLabel);

          foreach ($mainchartLabel as $lid=>$label) {

            foreach ($legendLabels as $legend) {

              if ($label == $legend->get_kode_unit()) {

                $mainchartLegend[$lid] = $legend->get_nama_unit();

              }

            }

          }

          //var_dump($legendLabels);

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Terendah per K/L',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel,
            'legends' => (object) array(

                'labels' => $mainchartLegend,
                'colors' => $mainchartColor

              )

          );

        }

        $this->view->content = (object) array(

            'title' => 'Dashboard',
            'type' => 'overview-default',

            'status_tiles' => array(

                (object) array(

                    'type' => 'pie',
                    'title' => 'Penerbitan SP2D',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Gaji',
                          'value' => $sp2dHariIni->get_gaji()

                          ),

                        (object) array(

                          'name' => 'Non Gaji',
                          'value' => $sp2dHariIni->get_non_gaji()

                          ),

                        (object) array(

                          'name' => 'Retur',
                          'value' => $sp2dHariIni->get_retur()

                          ),

                        (object) array(

                          'name' => 'Lainnya',
                          'value' => $sp2dHariIni->get_lainnya()

                          ),

                        (object) array(

                          'name' => 'Void',
                          'value' => $sp2dHariIni->get_void()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40', '#CF8CD7', '#CCCCCC', '#FF6666')

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Belanja',
                    'subtitle' => round($belanjaHariIni->get_realisasi() / 100000000000) / 10 . ' Triliun (' . round($belanjaHariIni->get_realisasi() / $belanjaHariIni->get_pagu() * 1000) / 10 . ' %) <br/>Dari Pagu Belanja ' . round($belanjaHariIni->get_pagu() / 100000000000) / 10 .' Triliun ',
                    'value' => round($belanjaHariIni->get_realisasi() / 100000000000) / 10,
                    'max_value' => round($belanjaHariIni->get_pagu() / 100000000000) / 10

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Penerimaan',
                    'subtitle' => round($penerimaanHariIni / 100000000000) / 10 . ' Triliun <br/>Tidak ada data pagu',
                    'value' => round($penerimaanHariIni / 100000000000) / 10,
                    'max_value' => round($penerimaanHariIni / 100000000000) / 10

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Pencairan Kontrak',
                    'subtitle' => round($kontrakHariIni->get_pencairan() / 100000000000) / 10 . ' Triliun (' . round($kontrakHariIni->get_pencairan() / $kontrakHariIni->get_nilai_kontrak() * 1000) / 10 . ' %) <br/>Dari Total Nilai Kontrak ' . round($kontrakHariIni->get_nilai_kontrak() / 100000000000) / 10 .' Triliun ',
                    'value' => round($kontrakHariIni->get_pencairan() / 100000000000) / 10,
                    'max_value' => round($kontrakHariIni->get_nilai_kontrak() / 100000000000) / 10

                  )

              ),

            'main_tile' => $main_tile,

            'notifications' => array()

          );

        $this->view->switchers = array();
        $this->view->switchers[] = 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja';
        $this->view->switchers[] = 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Tertinggi per Satker';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Terendah per Satker';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Tertinggi per K/L';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Terendah per K/L';

        $this->view->baseURL = URL . 'dashboard/overviewAdmin/';
        
        //echo(json_encode($this->view->content));

        $this->view->render('Template-Overview');
        
    }

    public function overviewKanwil($mode=null) {

        $fetch = new DataOverview($this->registry);

        $filter1 = array();
        $filter1[] = "SATKER IN (SELECT KDSATKER FROM T_SATKER WHERE KANWIL_DJPB = '" . Session::get('kd_satker') . "') ";

        $filter2 = array();
        $filter2[] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . substr(Session::get('kd_satker'),1,2) . "') ";

        $filter3 = array();
        $filter3[] = "A.SEGMENT1 IN (SELECT KDSATKER FROM T_SATKER WHERE KANWIL_DJPB = '" . Session::get('kd_satker') . "') ";

        $filter5 = array();
        $filter5[] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL =  '" . substr(Session::get('kd_satker'),1,2) . "') ";

        $belanjaHariIni = $fetch->fetchRealisasiPaguBelanja($filter1);
        $penerimaanHariIni = $fetch->sumRealisasiPenerimaan($filter1);
        $kontrakHariIni =  $fetch->fetchStatusRealisasiKontrak($filter3);
        $returHariIni = $fetch->fetchStatusRetur($filter5);
        $lhpHariIni = $fetch->get_lhp_rekap(1, " KANWIL = '" . substr(Session::get('kd_satker'),1,2) . "' ");
        $sp2dHariIni = $fetch->fetchRekapSP2DTahunIni($filter2);

        if (!isset($mode) || ($mode == 1)) {

          $filter5 = array();
          $filter5[] = "B.KANWIL_DJPB = '" . Session::get('kd_satker') . "'";

          $detailRealisasi = $fetch->get_realisasi_dash_filter($filter5);

          $mainchartData = array();

          if ($detailRealisasi[0]->get_pagu_51() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_51() / $detailRealisasi[0]->get_pagu_51() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_52() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_52() / $detailRealisasi[0]->get_pagu_52() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_53() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_53() / $detailRealisasi[0]->get_pagu_53() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_54() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_54() / $detailRealisasi[0]->get_pagu_54() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_55() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_55() / $detailRealisasi[0]->get_pagu_55() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_56() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_56() / $detailRealisasi[0]->get_pagu_56() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_57() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_57() / $detailRealisasi[0]->get_pagu_57() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_58() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_58() / $detailRealisasi[0]->get_pagu_58() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_61() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_61() / $detailRealisasi[0]->get_pagu_61() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer'),
            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' %', $mainchartData[1] . ' %', $mainchartData[2] . ' %', $mainchartData[3] . ' %', $mainchartData[4] . ' %', $mainchartData[5] . ' %', $mainchartData[6] . ' %', $mainchartData[7] . ' %', $mainchartData[8] . ' %'),
                'colors' => array('#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4')

              )

          );

        } else if ($mode == 2) {

          $filter5 = array();
          $filter5[] = "B.KANWIL_DJPB = '" . Session::get('kd_satker') . "'";

          $detailRealisasi = $fetch->get_realisasi_numbers_dash_filter($filter5);

          $mainchartData = array();
          $mainchartData2 = array();

          if ($detailRealisasi[0]->get_belanja_51() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_51() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_52() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_52() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_53() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_53() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_54() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_54() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_55() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_55() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_56() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_56() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_57() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_57() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_58() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_58() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_61() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_61() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_41() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_41()  * -1 / 10000000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData2[] = 0;
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_42() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_42()  * -1 / 10000000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData2[] = 0;
            $mainchartData[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis',

            'datasets' => array(

                (object) array(

                  'name' => 'Realisasi Belanja (dalam Triliun Rupiah)',
                  'values' => $mainchartData

                  ),
                (object) array(

                  'name' => 'Realisasi Penerimaan (dalam Triliun Rupiah)',
                  'values' => $mainchartData2

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer', 'Pajak', 'PNBP'),

            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' Miliar', $mainchartData[1] . ' Miliar', $mainchartData[2] . ' Miliar', $mainchartData[3] . ' Miliar', $mainchartData[4] . ' Miliar', $mainchartData[5] . ' Miliar', $mainchartData[6] . ' Miliar', $mainchartData[7] . ' Miliar', $mainchartData[8] . ' Miliar', $mainchartData2[9] . ' Miliar', $mainchartData2[10] . ' Miliar'),
                'colors' => array('#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#1f77b4', '#1f77b4')

              ),

            'colors' => array('#f6ce40', '#1f77b4')

          );

        }  else if ($mode == 3) {

          $filtermain = array();
          $filtermain[] = "KANWIL = '" . substr(Session::get('kd_satker'),1,2) . "' ";

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnit(1,1,$filtermain);

          $mainchartData = array();
          $mainchartLabel = array();
          $mainchartColor = array();
          $mainchartLegend = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();
            $mainchartColor[] = '#1f77b4';

          }

          $legendLabels = $fetch->fetchNamaUnit(1, $mainchartLabel);

          foreach ($mainchartLabel as $lid=>$label) {

            foreach ($legendLabels as $legend) {

              if ($label == $legend->get_kode_unit()) {

                $mainchartLegend[$lid] = $legend->get_nama_unit();

              }

            }

          }

          //var_dump($legendLabels);

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Tertinggi per Satker',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel,
            'legends' => (object) array(

                'labels' => $mainchartLegend,
                'colors' => $mainchartColor

              )

          );

        } else if ($mode == 4) {

          $filtermain = array();
          $filtermain[] = "KANWIL = '" . substr(Session::get('kd_satker'),1,2) . "' ";

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnit(1,2,$filtermain);

          $mainchartData = array();
          $mainchartLabel = array();
          $mainchartColor = array();
          $mainchartLegend = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();
            $mainchartColor[] = '#1f77b4';

          }

          $legendLabels = $fetch->fetchNamaUnit(1, $mainchartLabel);

          foreach ($mainchartLabel as $lid=>$label) {

            foreach ($legendLabels as $legend) {

              if ($label == $legend->get_kode_unit()) {

                $mainchartLegend[$lid] = $legend->get_nama_unit();

              }

            }

          }

          //var_dump($legendLabels);

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Terendah per Satker',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel,
            'legends' => (object) array(

                'labels' => $mainchartLegend,
                'colors' => $mainchartColor

              )

          );

        } else if ($mode == 5) {

          $filtermain = array();
          $filtermain[] = "KANWIL = '" . substr(Session::get('kd_satker'),1,2) . "' ";

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnitAll(2,$filtermain);

          $mainchartData = array();
          $mainchartLabel = array();
          $mainchartColor = array();
          $mainchartLegend = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();
            $mainchartColor[] = '#1f77b4';

          }

          $legendLabels = $fetch->fetchNamaUnit(2, $mainchartLabel);

          foreach ($mainchartLabel as $lid=>$label) {

            foreach ($legendLabels as $legend) {

              if ($label == $legend->get_kode_unit()) {

                $mainchartLegend[$lid] = $legend->get_nama_unit();

              }

            }

          }

          //var_dump($legendLabels);

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja per KPPN',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel,
            'legends' => (object) array(

                'labels' => $mainchartLegend,
                'colors' => $mainchartColor

              )

          );

        }

        $this->view->content = (object) array(

            'title' => 'Dashboard',
            'type' => 'overview-default',

            'status_tiles' => array(

                (object) array(

                    'type' => 'pie',
                    'title' => 'Penerbitan SP2D',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Gaji',
                          'value' => $sp2dHariIni->get_gaji()

                          ),

                        (object) array(

                          'name' => 'Non Gaji',
                          'value' => $sp2dHariIni->get_non_gaji()

                          ),

                        (object) array(

                          'name' => 'Retur',
                          'value' => $sp2dHariIni->get_retur()

                          ),

                        (object) array(

                          'name' => 'Lainnya',
                          'value' => $sp2dHariIni->get_lainnya()

                          ),

                        (object) array(

                          'name' => 'Void',
                          'value' => $sp2dHariIni->get_void()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40', '#CF8CD7', '#CCCCCC', '#FF6666')

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Belanja',
                    'subtitle' => round($belanjaHariIni->get_realisasi() / 100000000000) / 10 . ' Triliun (' . round($belanjaHariIni->get_realisasi() / $belanjaHariIni->get_pagu() * 1000) / 10 . ' %) <br/>Dari Pagu Belanja ' . round($belanjaHariIni->get_pagu() / 100000000000) / 10 .' Triliun ',
                    'value' => round($belanjaHariIni->get_realisasi() / 100000000000) / 10,
                    'max_value' => round($belanjaHariIni->get_pagu() / 100000000000) / 10

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Penerimaan',
                    'subtitle' => round($penerimaanHariIni / 100000000000) / 10 . ' Triliun <br/>Tidak ada data pagu',
                    'value' => round($penerimaanHariIni / 100000000000) / 10,
                    'max_value' => round($penerimaanHariIni / 100000000000) / 10

                  ),

                (object) array(

                    'type' => 'pie',
                    'title' => 'Retur SP2D',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Sudah Proses',
                          'value' => $returHariIni->get_retur_sudah_proses()

                          ),

                        (object) array(

                          'name' => 'Belum Proses',
                          'value' => $returHariIni->get_retur_belum_proses()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40')

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Pencairan Kontrak',
                    'subtitle' => round($kontrakHariIni->get_pencairan() / 100000000000) / 10 . ' Triliun (' . round($kontrakHariIni->get_pencairan() / $kontrakHariIni->get_nilai_kontrak() * 1000) / 10 . ' %) <br/>Dari Total Nilai Kontrak ' . round($kontrakHariIni->get_nilai_kontrak() / 100000000000) / 10 .' Triliun ',
                    'value' => round($kontrakHariIni->get_pencairan() / 100000000000) / 10,
                    'max_value' => round($kontrakHariIni->get_nilai_kontrak() / 100000000000) / 10

                  ),

                (object) array(

                    'type' => 'pie',
                    'title' => 'Status LHP (' . $lhpHariIni[0]->get_tgl_lhp() . ')',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Selesai',
                          'value' => $lhpHariIni[0]->get_lhp_completed()

                          ),

                        (object) array(

                          'name' => 'Divalidasi',
                          'value' => $lhpHariIni[0]->get_lhp_validated()

                          ),

                        (object) array(

                          'name' => 'Error',
                          'value' => $lhpHariIni[0]->get_lhp_error()

                          ),

                        (object) array(

                          'name' => 'Lainnya',
                          'value' => $lhpHariIni[0]->get_lhp_etc()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40', '#FF6666', '#C995E2')

                  )

              ),

            'main_tile' => $main_tile,

            'notifications' => array()

          );
        
        //echo(json_encode($this->view->content));

        $this->view->switchers = array();
        $this->view->switchers[] = 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja';
        $this->view->switchers[] = 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Tertinggi per Satker';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Terendah per Satker';
        $this->view->switchers[] = 'Persentase Realisasi Belanja per KPPN';

        $this->view->baseURL = URL . 'dashboard/overviewKanwil/';

        $this->view->render('Template-Overview');
        
    }

    public function overviewKPPN($mode=null) {

        $fetch = new DataOverview($this->registry);

        $filter1 = array();
        $filter1[] = "SATKER IN (SELECT KDSATKER FROM T_SATKER WHERE KPPN = '" . Session::get('kd_satker') . "') ";

        $filter2 = array();
        $filter2[] = "substr(INVOICE_NUM,8, 6) IN (SELECT KDSATKER FROM T_SATKER WHERE KPPN = '" . Session::get('kd_satker') . "') ";

        $filter3 = array();
        $filter3[] = "A.SEGMENT1 IN (SELECT KDSATKER FROM T_SATKER WHERE KPPN = '" . Session::get('kd_satker') . "') ";

        $filter5 = array();
        $filter5[] = "KDKPPN = '" . Session::get('kd_satker') . "'";

        $belanjaHariIni = $fetch->fetchRealisasiPaguBelanja($filter1);
        $penerimaanHariIni = $fetch->sumRealisasiPenerimaan($filter1);
        $kontrakHariIni =  $fetch->fetchStatusRealisasiKontrak($filter3);
        $returHariIni = $fetch->fetchStatusRetur($filter5);
        $lhpHariIni = $fetch->get_lhp_rekap(1);

        $filter6 = array();
        $filter6[] = "KDKPPN = '" . Session::get('kd_satker') . "' ";
        $sp2dHariIni = $fetch->fetchRekapSP2DTahunIni($filter6);

        if (!isset($mode) || ($mode == 1)) {

          $filter5 = array();
          $filter5[] = "B.KPPN = '" . Session::get('kd_satker') . "'";

          $detailRealisasi = $fetch->get_realisasi_dash_filter($filter5);

          $mainchartData = array();

          if ($detailRealisasi[0]->get_pagu_51() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_51() / $detailRealisasi[0]->get_pagu_51() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_52() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_52() / $detailRealisasi[0]->get_pagu_52() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_53() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_53() / $detailRealisasi[0]->get_pagu_53() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_54() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_54() / $detailRealisasi[0]->get_pagu_54() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_55() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_55() / $detailRealisasi[0]->get_pagu_55() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_56() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_56() / $detailRealisasi[0]->get_pagu_56() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_57() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_57() / $detailRealisasi[0]->get_pagu_57() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_58() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_58() / $detailRealisasi[0]->get_pagu_58() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_61() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_61() / $detailRealisasi[0]->get_pagu_61() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer'),
            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' %', $mainchartData[1] . ' %', $mainchartData[2] . ' %', $mainchartData[3] . ' %', $mainchartData[4] . ' %', $mainchartData[5] . ' %', $mainchartData[6] . ' %', $mainchartData[7] . ' %', $mainchartData[8] . ' %'),
                'colors' => array('#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4')

              )

          );

        } else if ($mode == 2) {

          $filter5 = array();
          $filter5[] = "B.KPPN = '" . Session::get('kd_satker') . "'";

          $detailRealisasi = $fetch->get_realisasi_numbers_dash_filter($filter5);

          $mainchartData = array();
          $mainchartData2 = array();

          if ($detailRealisasi[0]->get_belanja_51() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_51() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_52() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_52() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_53() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_53() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_54() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_54() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_55() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_55() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_56() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_56() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_57() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_57() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_58() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_58() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_61() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_61() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_41() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_41()  * -1 / 10000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_42() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_42()  * -1 / 10000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis',

            'datasets' => array(

                (object) array(

                  'name' => 'Realisasi Belanja (dalam Miliar Rupiah)',
                  'values' => $mainchartData

                  ),
                (object) array(

                  'name' => 'Realisasi Penerimaan (dalam Miliar Rupiah)',
                  'values' => $mainchartData2

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer', 'Pajak', 'PNBP'),

            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' Miliar', $mainchartData[1] . ' Miliar', $mainchartData[2] . ' Miliar', $mainchartData[3] . ' Miliar', $mainchartData[4] . ' Miliar', $mainchartData[5] . ' Miliar', $mainchartData[6] . ' Miliar', $mainchartData[7] . ' Miliar', $mainchartData[8] . ' Miliar', $mainchartData2[9] . ' Miliar', $mainchartData2[10] . ' Miliar'),
                'colors' => array('#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#1f77b4', '#1f77b4')

              ),

            'colors' => array('#f6ce40', '#1f77b4')

          );

        } else if ($mode == 3) {

          $filtermain = array();
          $filtermain[] = "KPPN = '" . Session::get('kd_satker') . "' ";

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnit(1,1,$filtermain);

          $mainchartData = array();
          $mainchartLabel = array();
          $mainchartColor = array();
          $mainchartLegend = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();
            $mainchartColor[] = '#1f77b4';

          }

          $legendLabels = $fetch->fetchNamaUnit(1, $mainchartLabel);

          foreach ($mainchartLabel as $lid=>$label) {

            foreach ($legendLabels as $legend) {

              if ($label == $legend->get_kode_unit()) {

                $mainchartLegend[$lid] = $legend->get_nama_unit();

              }

            }

          }

          //var_dump($legendLabels);

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Tertinggi per Satker',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel,
            'legends' => (object) array(

                'labels' => $mainchartLegend,
                'colors' => $mainchartColor

              )

          );

        } else if ($mode == 4) {

          $filtermain = array();
          $filtermain[] = "KPPN = '" . Session::get('kd_satker') . "' ";

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnit(1,2,$filtermain);

          $mainchartData = array();
          $mainchartLabel = array();
          $mainchartColor = array();
          $mainchartLegend = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();
            $mainchartColor[] = '#1f77b4';

          }

          $legendLabels = $fetch->fetchNamaUnit(1, $mainchartLabel);

          foreach ($mainchartLabel as $lid=>$label) {

            foreach ($legendLabels as $legend) {

              if ($label == $legend->get_kode_unit()) {

                $mainchartLegend[$lid] = $legend->get_nama_unit();

              }

            }

          }

          //var_dump($legendLabels);

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Terendah per Satker',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel,
            'legends' => (object) array(

                'labels' => $mainchartLegend,
                'colors' => $mainchartColor

              )

          );

        }

        $this->view->content = (object) array(

            'title' => 'Dashboard',
            'type' => 'overview-default',

            'status_tiles' => array(

                (object) array(

                    'type' => 'pie',
                    'title' => 'Penerbitan SP2D',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Gaji',
                          'value' => $sp2dHariIni->get_gaji()

                          ),

                        (object) array(

                          'name' => 'Non Gaji',
                          'value' => $sp2dHariIni->get_non_gaji()

                          ),

                        (object) array(

                          'name' => 'Retur',
                          'value' => $sp2dHariIni->get_retur()

                          ),

                        (object) array(

                          'name' => 'Lainnya',
                          'value' => $sp2dHariIni->get_lainnya()

                          ),

                        (object) array(

                          'name' => 'Void',
                          'value' => $sp2dHariIni->get_void()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40', '#CF8CD7', '#CCCCCC', '#FF6666')

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Belanja',
                    'subtitle' => round($belanjaHariIni->get_realisasi() / 100000000000) / 10 . ' Triliun (' . round($belanjaHariIni->get_realisasi() / $belanjaHariIni->get_pagu() * 1000) / 10 . ' %) <br/>Dari Pagu Belanja ' . round($belanjaHariIni->get_pagu() / 100000000000) / 10 .' Triliun ',
                    'value' => round($belanjaHariIni->get_realisasi() / 100000000000) / 10,
                    'max_value' => round($belanjaHariIni->get_pagu() / 100000000000) / 10

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Penerimaan',
                    'subtitle' => round($penerimaanHariIni / 100000000000) / 10 . ' Triliun <br/>Tidak ada data pagu',
                    'value' => round($penerimaanHariIni / 100000000000) / 10,
                    'max_value' => round($penerimaanHariIni / 100000000000) / 10

                  ),

                (object) array(

                    'type' => 'pie',
                    'title' => 'Retur SP2D',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Sudah Proses',
                          'value' => $returHariIni->get_retur_sudah_proses()

                          ),

                        (object) array(

                          'name' => 'Belum Proses',
                          'value' => $returHariIni->get_retur_belum_proses()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40')

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Pencairan Kontrak',
                    'subtitle' => round($kontrakHariIni->get_pencairan() / 100000000000) / 10 . ' Triliun (' . round($kontrakHariIni->get_pencairan() / $kontrakHariIni->get_nilai_kontrak() * 1000) / 10 . ' %) <br/>Dari Total Nilai Kontrak ' . round($kontrakHariIni->get_nilai_kontrak() / 100000000000) / 10 .' Triliun ',
                    'value' => round($kontrakHariIni->get_pencairan() / 100000000000) / 10,
                    'max_value' => round($kontrakHariIni->get_nilai_kontrak() / 100000000000) / 10

                  ),

                (object) array(

                    'type' => 'pie',
                    'title' => 'Status LHP (' . $lhpHariIni[0]->get_tgl_lhp() . ')',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Selesai',
                          'value' => $lhpHariIni[0]->get_lhp_completed()

                          ),

                        (object) array(

                          'name' => 'Divalidasi',
                          'value' => $lhpHariIni[0]->get_lhp_validated()

                          ),

                        (object) array(

                          'name' => 'Error',
                          'value' => $lhpHariIni[0]->get_lhp_error()

                          ),

                        (object) array(

                          'name' => 'Lainnya',
                          'value' => $lhpHariIni[0]->get_lhp_etc()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40', '#FF6666', '#C995E2')

                  )

              ),

            'main_tile' => $main_tile,

            'notifications' => array()

          );
        
        //echo(json_encode($this->view->content));

        $this->view->switchers = array();
        $this->view->switchers[] = 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja';
        $this->view->switchers[] = 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Tertinggi per Satker';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Terendah per Satker';

        $this->view->baseURL = URL . 'dashboard/overviewKPPN/';

        $this->view->render('Template-Overview');
        
    }

    public function overviewKL($mode=null) {

        $fetch = new DataOverview($this->registry);

        $filter1 = array();
        $filter1[] = "SATKER IN (SELECT KDSATKER FROM T_SATKER WHERE BA = '" . substr(Session::get('kd_satker'),2,3) . "') ";

        $filter2 = array();
        $filter2[] = "substr(INVOICE_NUM,8, 6) IN (SELECT KDSATKER FROM T_SATKER WHERE BA = '" . substr(Session::get('kd_satker'),2,3) . "') ";

        $filter3 = array();
        $filter3[] = "substr(segment4,0,3) = '" . substr(Session::get('kd_satker'),2,3) . "'";

        $belanjaHariIni = $fetch->fetchRealisasiPaguBelanja($filter1);
        $penerimaanHariIni = $fetch->sumRealisasiPenerimaan($filter1);
        $kontrakHariIni =  $fetch->fetchStatusRealisasiKontrak($filter3);

        $filter6 = array();
        $filter6[] = "SEGMENT1 IN (SELECT KDSATKER FROM T_SATKER WHERE BA = '" . substr(Session::get('kd_satker'),2,3) . "') ";
        $sp2dHariIni = $fetch->fetchRekapSP2DTahunIni($filter6);

        if (!isset($mode) || ($mode == 1)) {

          $filter5 = array();
          $filter5[] = "B.BA = '" . substr(Session::get('kd_satker'),2,3) . "'";

          $detailRealisasi = $fetch->get_realisasi_dash_filter($filter5);

          $mainchartData = array();

          if ($detailRealisasi[0]->get_pagu_51() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_51() / $detailRealisasi[0]->get_pagu_51() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_52() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_52() / $detailRealisasi[0]->get_pagu_52() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_53() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_53() / $detailRealisasi[0]->get_pagu_53() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_54() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_54() / $detailRealisasi[0]->get_pagu_54() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_55() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_55() / $detailRealisasi[0]->get_pagu_55() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_56() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_56() / $detailRealisasi[0]->get_pagu_56() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_57() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_57() / $detailRealisasi[0]->get_pagu_57() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_58() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_58() / $detailRealisasi[0]->get_pagu_58() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_61() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_61() / $detailRealisasi[0]->get_pagu_61() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer'),
            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' %', $mainchartData[1] . ' %', $mainchartData[2] . ' %', $mainchartData[3] . ' %', $mainchartData[4] . ' %', $mainchartData[5] . ' %', $mainchartData[6] . ' %', $mainchartData[7] . ' %', $mainchartData[8] . ' %'),
                'colors' => array('#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4')

              )

          );

        } else if ($mode == 2) {

          $filter5 = array();
          $filter5[] = "B.BA = '" . substr(Session::get('kd_satker'),2,3) . "'";

          $detailRealisasi = $fetch->get_realisasi_numbers_dash_filter($filter5);

          $mainchartData = array();
          $mainchartData2 = array();

          if ($detailRealisasi[0]->get_belanja_51() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_51() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_52() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_52() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_53() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_53() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_54() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_54() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_55() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_55() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_56() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_56() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_57() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_57() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_58() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_58() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_61() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_61() / 10000000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_41() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_41()  * -1 / 10000000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_42() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_42()  * -1 / 10000000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis',

            'datasets' => array(

                (object) array(

                  'name' => 'Realisasi Belanja (dalam Triliun Rupiah)',
                  'values' => $mainchartData

                  ),
                (object) array(

                  'name' => 'Realisasi Penerimaan (dalam Triliun Rupiah)',
                  'values' => $mainchartData2

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer', 'Pajak', 'PNBP'),

            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' Miliar', $mainchartData[1] . ' Miliar', $mainchartData[2] . ' Miliar', $mainchartData[3] . ' Miliar', $mainchartData[4] . ' Miliar', $mainchartData[5] . ' Miliar', $mainchartData[6] . ' Miliar', $mainchartData[7] . ' Miliar', $mainchartData[8] . ' Miliar', $mainchartData2[9] . ' Miliar', $mainchartData2[10] . ' Miliar'),
                'colors' => array('#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#1f77b4', '#1f77b4')

              ),

            'colors' => array('#f6ce40', '#1f77b4')

          );

        } else if ($mode == 3) {

          $filtermain = array();
          $filtermain[] = "B.BA = '" . substr(Session::get('kd_satker'),2,3) . "' ";

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnitBAES1(1,1,$filtermain);

          $mainchartData = array();
          $mainchartLabel = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();

          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Tertinggi per Satker',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel

          );

        } else if ($mode == 4) {

          $filtermain = array();
          $filtermain[] = "B.BA = '" . substr(Session::get('kd_satker'),2,3) . "' ";

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnitBAES1(1,2,$filtermain);

          $mainchartData = array();
          $mainchartLabel = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();

          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Terendah per Satker',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel

          );

        }  else if ($mode == 5) {

          $filtermain = array();
          $filtermain[] = "B.BA = '" . substr(Session::get('kd_satker'),2,3) . "' ";

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnitBAES1(2,1,$filtermain);

          $mainchartData = array();
          $mainchartLabel = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();

          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Tertinggi per ES1',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel

          );

        } else if ($mode == 6) {

          $filtermain = array();
          $filtermain[] = "B.BA = '" . substr(Session::get('kd_satker'),2,3) . "' ";

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnitBAES1(2,2,$filtermain);

          $mainchartData = array();
          $mainchartLabel = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();

          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Terendah per ES1',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel

          );

        }

        $this->view->content = (object) array(

            'title' => 'Dashboard',
            'type' => 'overview-default',

            'status_tiles' => array(

                (object) array(

                    'type' => 'pie',
                    'title' => 'Penerbitan SP2D',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Gaji',
                          'value' => $sp2dHariIni->get_gaji()

                          ),

                        (object) array(

                          'name' => 'Non Gaji',
                          'value' => $sp2dHariIni->get_non_gaji()

                          ),

                        (object) array(

                          'name' => 'Retur',
                          'value' => $sp2dHariIni->get_retur()

                          ),

                        (object) array(

                          'name' => 'Lainnya',
                          'value' => $sp2dHariIni->get_lainnya()

                          ),

                        (object) array(

                          'name' => 'Void',
                          'value' => $sp2dHariIni->get_void()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40', '#CF8CD7', '#CCCCCC', '#FF6666')

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Belanja',
                    'subtitle' => round($belanjaHariIni->get_realisasi() / 100000000000) / 10 . ' Triliun (' . round($belanjaHariIni->get_realisasi() / $belanjaHariIni->get_pagu() * 1000) / 10 . ' %) <br/>Dari Pagu Belanja ' . round($belanjaHariIni->get_pagu() / 100000000000) / 10 .' Triliun ',
                    'value' => round($belanjaHariIni->get_realisasi() / 100000000000) / 10,
                    'max_value' => round($belanjaHariIni->get_pagu() / 100000000000) / 10

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Penerimaan',
                    'subtitle' => round($penerimaanHariIni / 100000000000) / 10 . ' Triliun <br/>Tidak ada data pagu',
                    'value' => round($penerimaanHariIni / 100000000000) / 10,
                    'max_value' => round($penerimaanHariIni / 100000000000) / 10

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Pencairan Kontrak',
                    'subtitle' => round($kontrakHariIni->get_pencairan() / 100000000000) / 10 . ' Triliun (' . round($kontrakHariIni->get_pencairan() / $kontrakHariIni->get_nilai_kontrak() * 1000) / 10 . ' %) <br/>Dari Total Nilai Kontrak ' . round($kontrakHariIni->get_nilai_kontrak() / 100000000000) / 10 .' Triliun ',
                    'value' => round($kontrakHariIni->get_pencairan() / 100000000000) / 10,
                    'max_value' => round($kontrakHariIni->get_nilai_kontrak() / 100000000000) / 10

                  )

              ),

            'main_tile' => $main_tile,

            'notifications' => array()

          );
        
        $this->view->switchers = array();
        $this->view->switchers[] = 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja';
        $this->view->switchers[] = 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Tertinggi per Satker';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Terendah per Satker';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Tertinggi per ES1';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Terendah per ES1';

        $this->view->baseURL = URL . 'dashboard/overviewKL/';

        $this->view->render('Template-Overview');
        
    }

    public function overviewES1($mode=null) {
        
        $fetch = new DataOverview($this->registry);

        $filter1 = array();
        $filter1[] = "SATKER IN (SELECT KDSATKER FROM T_SATKER WHERE BAES1 = '" . substr(Session::get('kd_satker'),1,5) . "') ";

        $filter2 = array();
        $filter2[] = "substr(INVOICE_NUM,8, 6) IN (SELECT KDSATKER FROM T_SATKER WHERE BAES1 = '" . substr(Session::get('kd_satker'),1,5) . "') ";

        $filter3 = array();
        $filter3[] = "substr(segment4,0,5) = '" . substr(Session::get('kd_satker'),1,5) . "'";

        $belanjaHariIni = $fetch->fetchRealisasiPaguBelanja($filter1);
        $penerimaanHariIni = $fetch->sumRealisasiPenerimaan($filter1);
        $kontrakHariIni =  $fetch->fetchStatusRealisasiKontrak($filter3);

        $filter6 = array();
        $filter6[] = "SEGMENT1 IN (SELECT KDSATKER FROM T_SATKER WHERE BAES1 = '" . substr(Session::get('kd_satker'),1,5) . "') ";
        $sp2dHariIni = $fetch->fetchRekapSP2DTahunIni($filter6);

        if (!isset($mode) || ($mode == 1)) {

          $filter5 = array();
          $filter5[] = "B.BAES1 = '" . substr(Session::get('kd_satker'),1,5) . "'";

          $detailRealisasi = $fetch->get_realisasi_dash_filter($filter5);

          $mainchartData = array();

          if ($detailRealisasi[0]->get_pagu_51() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_51() / $detailRealisasi[0]->get_pagu_51() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_52() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_52() / $detailRealisasi[0]->get_pagu_52() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_53() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_53() / $detailRealisasi[0]->get_pagu_53() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_54() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_54() / $detailRealisasi[0]->get_pagu_54() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_55() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_55() / $detailRealisasi[0]->get_pagu_55() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_56() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_56() / $detailRealisasi[0]->get_pagu_56() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_57() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_57() / $detailRealisasi[0]->get_pagu_57() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_58() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_58() / $detailRealisasi[0]->get_pagu_58() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_61() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_61() / $detailRealisasi[0]->get_pagu_61() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer'),
            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' %', $mainchartData[1] . ' %', $mainchartData[2] . ' %', $mainchartData[3] . ' %', $mainchartData[4] . ' %', $mainchartData[5] . ' %', $mainchartData[6] . ' %', $mainchartData[7] . ' %', $mainchartData[8] . ' %'),
                'colors' => array('#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4')

              )

          );

        } else if ($mode == 2) {

          $filter5 = array();
          $filter5[] = "B.BAES1 = '" . substr(Session::get('kd_satker'),1,5) . "'";

          $detailRealisasi = $fetch->get_realisasi_numbers_dash_filter($filter5);

          $mainchartData = array();
          $mainchartData2 = array();

          if ($detailRealisasi[0]->get_belanja_51() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_51() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_52() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_52() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_53() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_53() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_54() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_54() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_55() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_55() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_56() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_56() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_57() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_57() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_58() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_58() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_61() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_61() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_41() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_41()  * -1 / 10000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_42() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_42()  * -1 / 10000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis',

            'datasets' => array(

                (object) array(

                  'name' => 'Realisasi Belanja (dalam Miliar Rupiah)',
                  'values' => $mainchartData

                  ),
                (object) array(

                  'name' => 'Realisasi Penerimaan (dalam Miliar Rupiah)',
                  'values' => $mainchartData2

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer', 'Pajak', 'PNBP'),

            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' Miliar', $mainchartData[1] . ' Miliar', $mainchartData[2] . ' Miliar', $mainchartData[3] . ' Miliar', $mainchartData[4] . ' Miliar', $mainchartData[5] . ' Miliar', $mainchartData[6] . ' Miliar', $mainchartData[7] . ' Miliar', $mainchartData[8] . ' Miliar', $mainchartData2[9] . ' Miliar', $mainchartData2[10] . ' Miliar'),
                'colors' => array('#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#1f77b4', '#1f77b4')

              ),

            'colors' => array('#f6ce40', '#1f77b4')

          );

        } else if ($mode == 3) {

          $filtermain = array();
          $filtermain[] = "B.BAES1 = '" . substr(Session::get('kd_satker'),1,5) . "' ";

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnitBAES1(1,1,$filtermain);

          $mainchartData = array();
          $mainchartLabel = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();

          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Tertinggi per Satker',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel

          );

        } else if ($mode == 4) {

          $filtermain = array();
          $filtermain[] = "B.BAES1 = '" . substr(Session::get('kd_satker'),1,5) . "' ";

          $realisasiPerUnit = $fetch->fetchRealisasiPaguBelanjaPerUnitBAES1(1,2,$filtermain);

          $mainchartData = array();
          $mainchartLabel = array();

          foreach ($realisasiPerUnit as $unitData) { 

            $mainchartData[] = round($unitData->get_realisasi() / $unitData->get_pagu() * 1000) / 10;
            $mainchartLabel[] = $unitData->get_unit();

          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Terendah per Satker',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => $mainchartLabel

          );

        }

        $this->view->content = (object) array(

            'title' => 'Dashboard',
            'type' => 'overview-default',

            'status_tiles' => array(

                (object) array(

                    'type' => 'pie',
                    'title' => 'Penerbitan SP2D',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Gaji',
                          'value' => $sp2dHariIni->get_gaji()

                          ),

                        (object) array(

                          'name' => 'Non Gaji',
                          'value' => $sp2dHariIni->get_non_gaji()

                          ),

                        (object) array(

                          'name' => 'Retur',
                          'value' => $sp2dHariIni->get_retur()

                          ),

                        (object) array(

                          'name' => 'Lainnya',
                          'value' => $sp2dHariIni->get_lainnya()

                          ),

                        (object) array(

                          'name' => 'Void',
                          'value' => $sp2dHariIni->get_void()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40', '#CF8CD7', '#CCCCCC', '#FF6666')

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Belanja',
                    'subtitle' => round($belanjaHariIni->get_realisasi() / 100000000) / 10 . ' Miliar (' . round($belanjaHariIni->get_realisasi() / $belanjaHariIni->get_pagu() * 1000) / 10 . ' %) <br/>Dari Pagu Belanja ' . round($belanjaHariIni->get_pagu() / 100000000) / 10 .' Miliar ',
                    'value' => round($belanjaHariIni->get_realisasi() / 100000000) / 10,
                    'max_value' => round($belanjaHariIni->get_pagu() / 100000000) / 10

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Penerimaan',
                    'subtitle' => round($penerimaanHariIni / 100000000) / 10 . ' Miliar <br/>Tidak ada data pagu',
                    'value' => round($penerimaanHariIni / 100000000) / 10,
                    'max_value' => round($penerimaanHariIni / 100000000) / 10

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Pencairan Kontrak',
                    'subtitle' => round($kontrakHariIni->get_pencairan() / 100000000) / 10 . ' Miliar (' . round($kontrakHariIni->get_pencairan() / $kontrakHariIni->get_nilai_kontrak() * 1000) / 10 . ' %) <br/>Dari Total Nilai Kontrak ' . round($kontrakHariIni->get_nilai_kontrak() / 100000000) / 10 .' Miliar ',
                    'value' => round($kontrakHariIni->get_pencairan() / 100000000) / 10,
                    'max_value' => round($kontrakHariIni->get_nilai_kontrak() / 100000000) / 10

                  )

              ),

            'main_tile' => $main_tile,

            'notifications' => array()

          );
        
        //echo(json_encode($this->view->content));

        $this->view->switchers = array();
        $this->view->switchers[] = 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja';
        $this->view->switchers[] = 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Tertinggi per Satker';
        $this->view->switchers[] = 'Persentase Realisasi Belanja Terendah per Satker';

        $this->view->baseURL = URL . 'dashboard/overviewES1/';

        $this->view->render('Template-Overview');
        
    }

    public function overviewSatker($mode=null) {
        
        $fetch = new DataOverview($this->registry);

        $filter1 = array();
        $filter1[] = "SATKER = '" . Session::get('kd_satker') . "'";

        $filter2 = array();
        $filter2[] = "substr(INVOICE_NUM,8, 6) = '" . Session::get('kd_satker') . "'";

        $filter3 = array();
        $filter3[] = "A.SEGMENT1 = '" . Session::get('kd_satker') . "'";

        $filter4 = array();
        $filter4[] = "SATKER_CODE = '" . Session::get('kd_satker') . "'";

        $filter5 = array();
        $filter5[] = "KDSATKER = '" . Session::get('kd_satker') . "'";

        $filter6 = array();
        $filter6[] = "SEGMENT1 = '" . Session::get('kd_satker') . "'";

        $belanjaHariIni = $fetch->fetchRealisasiPaguBelanja($filter1);
        $penerimaanHariIni = $fetch->sumRealisasiPenerimaan($filter1);
        $sp2dHariIni = $fetch->fetchRekapSP2DTahunIni($filter6);
        $kontrakHariIni =  $fetch->fetchStatusRealisasiKontrak($filter3);
        $upHariIni = $fetch->fetchTimerUP($filter4);
        $returHariIni = $fetch->fetchStatusRetur($filter5);

        if ($upHariIni->get_sisa_hari_tup() != null) {
          $stat_tup = $upHariIni->get_sisa_hari_tup() . ' Hari';
        } else {
          $stat_tup = 'N/A';
        }

        if (!isset($mode) || ($mode == 1)) {

          $filter5 = array();
          $filter5[] = "A.SATKER = '" . Session::get('kd_satker') . "'";

          $detailRealisasi = $fetch->get_realisasi_dash_filter($filter5);

          $mainchartData = array();

          if ($detailRealisasi[0]->get_pagu_51() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_51() / $detailRealisasi[0]->get_pagu_51() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_52() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_52() / $detailRealisasi[0]->get_pagu_52() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_53() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_53() / $detailRealisasi[0]->get_pagu_53() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_54() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_54() / $detailRealisasi[0]->get_pagu_54() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_55() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_55() / $detailRealisasi[0]->get_pagu_55() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_56() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_56() / $detailRealisasi[0]->get_pagu_56() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_57() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_57() / $detailRealisasi[0]->get_pagu_57() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_58() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_58() / $detailRealisasi[0]->get_pagu_58() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_pagu_61() > 0) {
            $mainchartData[] = (round($detailRealisasi[0]->get_belanja_61() / $detailRealisasi[0]->get_pagu_61() * 1000) / 10);
          } else {
            $mainchartData[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja',

            'datasets' => array(

                (object) array(

                  'name' => 'Persentase Realisasi',
                  'values' => $mainchartData

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer'),
            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' %', $mainchartData[1] . ' %', $mainchartData[2] . ' %', $mainchartData[3] . ' %', $mainchartData[4] . ' %', $mainchartData[5] . ' %', $mainchartData[6] . ' %', $mainchartData[7] . ' %', $mainchartData[8] . ' %'),
                'colors' => array('#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4', '#1f77b4')

              )

          );

        } else if ($mode == 2) {

           $filter5 = array();
          $filter5[] = "A.SATKER = '" . Session::get('kd_satker') . "'";

          $detailRealisasi = $fetch->get_realisasi_numbers_dash_filter($filter5);

          $mainchartData = array();
          $mainchartData2 = array();

          if ($detailRealisasi[0]->get_belanja_51() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_51() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_52() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_52() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_53() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_53() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_54() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_54() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_55() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_55() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_56() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_56() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_57() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_57() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_58() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_58() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_belanja_61() != null) {
            $mainchartData[] = round($detailRealisasi[0]->get_belanja_61() / 10000000) / 100;
            $mainchartData2[] = 0;
          } else {
            $mainchartData[] = 0;
            $mainchartData2[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_41() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_41()  * -1 / 10000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData2[] = 0;
            $mainchartData[] = 0;
          }

          if ($detailRealisasi[0]->get_penerimaan_42() != null) {
            $mainchartData2[] = round($detailRealisasi[0]->get_penerimaan_42()  * -1 / 10000000) / 100;
            $mainchartData[] = 0;
          } else {
            $mainchartData2[] = 0;
            $mainchartData[] = 0;
          }

          $main_tile = (object) array(

            'type' => 'bar',
            'stacked' => true,
            'title' => 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis',

            'datasets' => array(

                (object) array(

                  'name' => 'Realisasi Belanja (dalam Miliar Rupiah)',
                  'values' => $mainchartData

                  ),
                (object) array(

                  'name' => 'Realisasi Penerimaan (dalam Miliar Rupiah)',
                  'values' => $mainchartData2

                  )

              ),

            'categories' => array('Pegawai', 'Barang', 'Modal', 'Bunga', 'Subsidi', 'Hibah', 'BanSos', 'Lain-lain', 'Transfer', 'Pajak', 'PNBP'),

            'legends' => (object) array(

                'labels' => array($mainchartData[0] . ' Miliar', $mainchartData[1] . ' Miliar', $mainchartData[2] . ' Miliar', $mainchartData[3] . ' Miliar', $mainchartData[4] . ' Miliar', $mainchartData[5] . ' Miliar', $mainchartData[6] . ' Miliar', $mainchartData[7] . ' Miliar', $mainchartData[8] . ' Miliar', $mainchartData2[9] . ' Miliar', $mainchartData2[10] . ' Miliar'),
                'colors' => array('#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#f6ce40', '#1f77b4', '#1f77b4')

              ),

            'colors' => array('#f6ce40', '#1f77b4')

          );

        }

        $this->view->content = (object) array(

            'title' => 'Dashboard',
            'type' => 'overview-default',

            'status_tiles' => array(

                (object) array(

                    'type' => 'pie',
                    'title' => 'Penerbitan SP2D',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Gaji',
                          'value' => $sp2dHariIni->get_gaji()

                          ),

                        (object) array(

                          'name' => 'Non Gaji',
                          'value' => $sp2dHariIni->get_non_gaji()

                          ),

                        (object) array(

                          'name' => 'Retur',
                          'value' => $sp2dHariIni->get_retur()

                          ),

                        (object) array(

                          'name' => 'Lainnya',
                          'value' => $sp2dHariIni->get_lainnya()

                          ),

                        (object) array(

                          'name' => 'Void',
                          'value' => $sp2dHariIni->get_void()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40', '#CF8CD7', '#CCCCCC', '#FF6666')

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Belanja',
                    'subtitle' => round($belanjaHariIni->get_realisasi() / 100000000) / 10 . ' Miliar (' . round($belanjaHariIni->get_realisasi() / $belanjaHariIni->get_pagu() * 1000) / 10 . ' %) <br/>Dari Pagu Belanja ' . round($belanjaHariIni->get_pagu() / 100000000) / 10 .' Miliar ',
                    'value' => round($belanjaHariIni->get_realisasi() / 100000000) / 10,
                    'max_value' => round($belanjaHariIni->get_pagu() / 100000000) / 10

                  ),                

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Penerimaan',
                    'subtitle' => round($penerimaanHariIni / 100000000) / 10 . ' Miliar <br/>Tidak ada data pagu',
                    'value' => round($penerimaanHariIni / 100000000) / 10,
                    'max_value' => round($penerimaanHariIni / 100000000) / 10

                  ),

                (object) array(

                    'type' => 'pie',
                    'title' => 'Retur SP2D',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Sudah Proses',
                          'value' => $returHariIni->get_retur_sudah_proses()

                          ),

                        (object) array(

                          'name' => 'Belum Proses',
                          'value' => $returHariIni->get_retur_belum_proses()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40')

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Pencairan Kontrak',
                    'subtitle' => round($kontrakHariIni->get_pencairan() / 100000000) / 10 . ' Miliar (' . round($kontrakHariIni->get_pencairan() / $kontrakHariIni->get_nilai_kontrak() * 1000) / 10 . ' %) <br/>Dari Total Nilai Kontrak ' . round($kontrakHariIni->get_nilai_kontrak() / 100000000) / 10 .' Miliar ',
                    'value' => round($kontrakHariIni->get_pencairan() / 100000000) / 10,
                    'max_value' => round($kontrakHariIni->get_nilai_kontrak() / 100000000) / 10

                  ),

                (object) array(

                    'type' => 'bar',
                    'title' => 'Sisa Waktu UP & TUP',
                    'subtitle' => 'UP: ' . $upHariIni->get_sisa_hari_up() . ' Hari<br/>TUP: ' . $stat_tup,
                    'datasets' => array(

                      (object) array(

                        'name' => 'Sisa Waktu',
                        'values' => array(

                            $upHariIni->get_sisa_hari_up(),
                            (0 + $upHariIni->get_sisa_hari_tup())

                          )

                        )

                      ),

                    'categories' => array('UP', 'TUP')

                  )

              ),

            'main_tile' => $main_tile,

            'notifications' => array()

          );
        
        //echo(json_encode($this->view->content));

        if ($upHariIni->get_sisa_hari_up() <= 7) {

          if ($upHariIni->get_sisa_hari_up() > 0) {

            $this->view->notifications[] = (object) array(

              'type' => 'warning',
              'message' => 'Batas pertanggungjawaban UP Satuan Kerja Anda akan jatuh tempo dalam ' . $upHariIni->get_sisa_hari_up() . ' hari lagi.'

            );

          } else {

            $this->view->notifications[] = (object) array(

              'type' => 'danger',
              'message' => 'Pertanggungjawaban UP Satuan Kerja Anda telah jatuh tempo sejak ' . $upHariIni->get_sisa_hari_up() * -1 . ' hari lalu.'

            );

          }

        }

        if ($stat_tup != 'N/A') {

          if ($upHariIni->get_sisa_hari_tup() <= 7) {

            if ($upHariIni->get_sisa_hari_tup() > 0) {

              $this->view->notifications[] = (object) array(

                'type' => 'warning',
                'message' => 'Batas pertanggungjawaban TUP Satuan Kerja Anda akan jatuh tempo dalam ' . $upHariIni->get_sisa_hari_tup() . ' hari lagi.'

              );

            } else {

              $this->view->notifications[] = (object) array(

                'type' => 'danger',
                'message' => 'Pertanggungjawaban TUP Satuan Kerja Anda telah jatuh tempo sejak ' . $upHariIni->get_sisa_hari_tup() * -1 . ' hari lalu.'

              );

            }

          }

        }

        $this->view->switchers = array();
        $this->view->switchers[] = 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja';
        $this->view->switchers[] = 'Nominal Realisasi Penerimaan & Belanja Berdasarkan Jenis';

        $this->view->baseURL = URL . 'dashboard/overviewSatker/';

        $this->view->render('Template-Overview');
        
    }

    public function __destruct() {
        
    }
    
}

?>