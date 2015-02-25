<?php

class DashboardController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function index() {
        
    }

    public function overviewSatker($mode=null) {
        
        $fetch = new DataOverview($this->registry);

        $filter1 = array();
        $filter1[] = "SATKER = '" . Session::get('kd_satker') . "'";

        $filter2 = array();
        $filter2[] = "substr(INVOICE_NUM,8, 6) = '" . Session::get('kd_satker') . "'";

        $filter3 = array();
        $filter3[] = "A.SEGMENT1 = '" . Session::get('kd_satker') . "'";

        $belanjaHariIni = $fetch->fetchRealisasiPaguBelanja($filter1);
        $penerimaanHariIni = $fetch->sumRealisasiPenerimaan($filter1);
        $spmHariIni = $fetch->fetchStatusAntrianSPM($filter2);
        $kontrakHariIni =  $fetch->fetchStatusRealisasiKontrak($filter3);

        $this->view->content = (object) array(

            'title' => 'Dashboard',
            'type' => 'overview-default',

            'status_tiles' => array(

                (object) array(

                    'type' => 'pie',
                    'title' => 'Penyelesaian SPM',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Selesai',
                          'value' => $spmHariIni->get_closed()

                          ),

                        (object) array(

                          'name' => 'Dalam Proses',
                          'value' => $spmHariIni->get_open()

                          ),

                        (object) array(

                          'name' => 'Dibatalkan',
                          'value' => $spmHariIni->get_canceled()

                          )

                      ),

                    'colors' => array('#409ACA', '#F6CE40', '#FF6666')

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Realisasi Belanja',
                    'subtitle' => round($belanjaHariIni->get_realisasi() / 100000000) / 10 . ' Miliar (' . round($belanjaHariIni->get_realisasi() / $belanjaHariIni->get_pagu() * 1000) / 10 . ' %) <br/>Dari Pagu Belanja ' . round($belanjaHariIni->get_pagu() / 100000000) / 10 .' Miliar ',
                    'value' => round($belanjaHariIni->get_realisasi() / 100000000) / 10,
                    'max_value' => round($belanjaHariIni->get_pagu() / 100000000) / 10

                  ),

                (object) array(

                    'type' => 'pie',
                    'title' => 'Status SP2D',
                    'datasets' => array(

                        (object) array(

                          'name' => 'Sukses',
                          'value' => $spmHariIni->get_closed()

                          ),

                        (object) array(

                          'name' => 'Menunggu Konfirmasi',
                          'value' => $spmHariIni->get_canceled()

                          ),

                        (object) array(

                          'name' => 'Void',
                          'value' => $spmHariIni->get_open()

                          )

                      )

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

                  ),

                (object) array(

                    'type' => 'gauge',
                    'title' => 'Uang Persediaan',
                    'subtitle' => round($kontrakHariIni->get_pencairan() / 100000000) / 10 . ' Miliar (' . round($kontrakHariIni->get_pencairan() / $kontrakHariIni->get_nilai_kontrak() * 1000) / 10 . ' %) <br/>Dari Total Nilai Kontrak ' . round($kontrakHariIni->get_nilai_kontrak() / 100000000) / 10 .' Miliar ',
                    'value' => round($kontrakHariIni->get_pencairan() / 100000000) / 10,
                    'max_value' => round($kontrakHariIni->get_nilai_kontrak() / 100000000) / 10

                  ),

              ),

            'main_tile' => (object) array(

                'type' => 'bar',
                'stacked' => true,
                'title' => 'Persentase Realisasi Belanja Berdasarkan Jenis Belanja',

                'datasets' => array(

                    (object) array(

                      'name' => 'Data A',
                      'values' => array(1,2,3,4,5,6,7,8,9)

                      ),

                    (object) array(

                      'name' => 'Data B',
                      'values' => array(1,2,3,4,5,6,7,8,9)

                      ),

                    (object) array(

                      'name' => 'Data C',
                      'values' => array(1,2,3,4,5,6,7,8,9)

                      )

                  ),

                'categories' => array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I')

              ),

            'notifications' => array(

                (object) array(

                    'type' => 'warning',
                    'label' => 'Contoh Notifikasi',
                    'link' => '#'

                  )

              )

          );
        
        //echo(json_encode($this->view->content));

        $this->view->render('Template-Overview');
        
    }

    public function __destruct() {
        
    }
    
}

?>