<?php

class PelaporanController extends BaseController {
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
        
    }
    
    private function checkFileExists($url) {
        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_NOBODY, true);
        
        $result = curl_exec($curl);
        
        $ret = false;
        
        if ($result !== false) {
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($statusCode == 200) {
                $ret = true;
            }
        }
        
        curl_close($curl);
        
        return $ret;
    }
    
    public function listLaporanPKN($jenis_laporan=null) {
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        $d_laporan = new DataPelaporan($this->registry);
        
        
        if (strpos(URL, 'kemenkeu') == false || strpos(URL, 'perbendaharaan') == false){
            $this->view->fileURL = 'http://spanint.kemenkeu.go.id/span/report/';
        } else {
            $this->view->fileURL = $_SERVER['HTTP_REFERER'].'span/report/';
        }  
        
        switch ($jenis_laporan) {
          case "BukuMerah":
            $this->view->data = $d_laporan -> get_laporan_terakhir_bukumerah();
			$this->view->judul_halaman = "Daftar Laporan Buku Merah";
            $this->view->fileURLdepan = URL."pelaporan/downloadLaporanPKNBM/" ; 
            break;
          case "BukuBiru":
            $this->view->data = $d_laporan -> get_laporan_terakhir_bukubiru();
			$this->view->judul_halaman = "Daftar Laporan Buku Biru";
            $this->view->fileURLdepan = URL."pelaporan/downloadLaporanPKNBB/" ; 
            break;
          default:
            //do nothing
        }
        
        $this->view->render('kppn/listLaporan');
        $d_log->tambah_log("Sukses");
    }
    
    public function listLaporanSingle($jenis_laporan=null) {
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        $d_laporan = new DataPelaporan($this->registry);
        
        switch ($jenis_laporan) {
          case "SPCMR00005":
            $this->view->data = $d_laporan -> get_laporan_ikhtisar($jenis_laporan);
            $this->view->page_title = "Laporan Ikhtisar Kebutuhan Dana Harian"; 
            break;
          default:
            //do nothing
        }
        
        if (strpos(URL, 'kemenkeu') == false || strpos(URL, 'perbendaharaan') == false){
            $this->view->fileURL = 'http://spanint.kemenkeu.go.id/span/report/';
        } else {
            $this->view->fileURL = $_SERVER['HTTP_REFERER'].'span/report/';
        }  
        
        
        
        $this->view->fileURLdepan = URL."pelaporan/downloadLaporanKPPN/" ; 
        
        $this->view->render('pkn/listLaporanPKN');
        $d_log->tambah_log("Sukses");
    }
    
    public function listLaporanKPPN($jenis_laporan=null) {
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        $d_laporan = new DataPelaporan($this->registry);
        
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            }
        }
        
        switch ($jenis_laporan) {
          case "laporanKPPN":
            $this->view->data = $d_laporan -> get_laporan_terakhir_laporankppn();
            break;
          default:
            //do nothing
        }
        
        if (strpos(URL, 'kemenkeu') == false || strpos(URL, 'perbendaharaan') == false){
            $this->view->fileURL = 'http://spanint.kemenkeu.go.id/span/report/';
        } else {
            $this->view->fileURL = $_SERVER['HTTP_REFERER'].'span/report/';
        }  
        
        $this->view->fileURLdepan = URL."pelaporan/downloadLaporanKPPN/" ; 
        
        $this->view->render('kppn/listLaporan');
        $d_log->tambah_log("Sukses");
    }
    
    /*public function downloadLaporanKPPN($tipe) {
        
        $d_user = new DataUserSPAN($this->registry); //model
        $filter = array();
        
        if ($tipe == 'LAK') {
        
            $folder = 'SPGLR00258';
            $this->view->page_title = "Laporan Arus Kas Tingkat KPPN"; 
            
        } else if ($tipe == 'LRA') {
            
            $folder = 'SPGLR00264';
            $this->view->page_title = "Laporan Realisasi Anggaran Tingkat KPPN";
            
        } else if ($tipe == 'LKP') {
            
            $folder = 'SPCMR00051';
            $this->view->page_title = "Laporan Konsolidasi Saldo Kas KPPN";
            
        } else {
            
            //Back to Home
            
        }
        
        /*if (strpos(URL, 'dev2') == false) {
        
            $fileURL = substr(URL, 0, -8).'span/report/';
            
        } else {
            
            $fileURL = substr(URL, 0, -5).'span/report/';
            
        }
        
        if (strpos(URL, 'kemenkeu') == false || strpos(URL, 'perbendaharaan') == false){
            $fileURL = 'http://spanint.kemenkeu.go.id/span/report/';
        } else {
            $fileURL = $_SERVER['HTTP_REFERER'].'span/report/';
        }
        
        //var_dump($fileURL);

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if (Session::get('role') == ADMIN || Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        
        if (Session::get('role') == KPPN) {
            $d_kppn_list = new DataUser($this->registry);
            $_POST['kdkppn'] = Session::get('id_user');
        }

        if (isset($_POST['submit_file']) || (Session::get('role') == KPPN)) {
            if (($_POST['tgl_awal'] != '' && $_POST['tgl_akhir'] != '') || (Session::get('role') == KPPN)) {
                if ($_POST['kdkppn'] != '' && $_POST['kdkppn'] != 'ALL') {
                    $d_kppn = new DataUser($this->registry);
                    $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                    $this->view->d_kd_kppn = $_POST['kdkppn'];
                }
                
                if (Session::get('role') == KPPN) {
                    
                    if (!isset($_POST['tgl_awal']) && !isset($_POST['tgl_akhir'])) {
                        $_POST['tgl_awal'] = '01-01-2014';
                        $_POST['tgl_akhir'] = date('d-m-Y', time());
                    }
                    
                }
                
                //var_dump($_POST['tgl_awal']);
                //var_dump($_POST['tgl_akhir']);
                
                $start_date = date('d-M-Y', strtotime($_POST['tgl_awal']));
                $end_date = date('d-M-Y', strtotime($_POST['tgl_akhir']));
                
                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
                
                $data = array();

                if (isset($this->view->kppn_list) && $_POST['kdkppn'] == 'ALL') {
                    foreach ($this->view->kppn_list as $kppn_list) {
                        
                        $unit = $kppn_list->get_kd_d_kppn();
                        
                        $pointer_date = date('d-M-Y', strtotime($_POST['tgl_akhir']));
                        
                        $i = 0;
                        
                        do {
                            
                            $curl = curl_init($fileURL.$folder.'/'.$unit.'/'.$folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf');
        
                            curl_setopt($curl, CURLOPT_NOBODY, true);

                            $result = curl_exec($curl);

                            $ret = false;

                            if ($result !== false) {
                                $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                                if ($statusCode == 200) {
                                    $ret = true;
                                }
                            }

                            curl_close($curl);
                        
                            if ($ret) {
                                $data[] = (object) array('kode_unit' => $unit, 'tanggal' => str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))), 'nama_file' => $folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf', 'url' => $fileURL.$folder.'/'.$unit.'/'.$folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf');
                            }
                            
                            $i++;
                            
                            $pointer_date = date('d-M-Y', strtotime($_POST['tgl_akhir']) - (60*60*24*$i));
                            
                        } while (strtotime($pointer_date) >= strtotime($start_date));
                        
                    }
                } else if ($_POST['kdkppn'] != '') {
                    $unit = $_POST['kdkppn'];
                        
                    $pointer_date = date('d-M-Y', strtotime($_POST['tgl_akhir']));

                    $i = 0;

                    do {

                        $curl = curl_init($fileURL.$folder.'/'.$unit.'/'.$folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf');

                        curl_setopt($curl, CURLOPT_NOBODY, true);

                        $result = curl_exec($curl);

                        $ret = false;

                        if ($result !== false) {
                            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                            if ($statusCode == 200) {
                                $ret = true;
                            }
                        }

                        curl_close($curl);

                        if ($ret) {
                            $data[] = (object) array('kode_unit' => $unit, 'tanggal' => str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))), 'nama_file' => $folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf', 'url' => $fileURL.$folder.'/'.$unit.'/'.$folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf');
                        }

                        $i++;

                        $pointer_date = date('d-M-Y', strtotime($_POST['tgl_akhir']) - (60*60*24*$i));

                    } while (strtotime($pointer_date) >= strtotime($start_date));
                }
                
                $this->view->data = $data;
            }
        }

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        
        $this->view->render('kppn/downloadPDFLaporanKPPN');
        
    }*/
    
    public function downloadLaporanKPPN($tipe) {
        
        $filter = array();
        $no=0;
        
        if ($tipe == 'SPGLR00258') {
        
            $folder = 'SPGLR00258';
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Arus Kas per Akun Tingkat KPPN"; 
            
        } else if ($tipe == 'SPGLR00264') {
            
            $folder = 'SPGLR00264';
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Realisasi Anggaran Tingkat KPPN";
            
        } else if ($tipe == 'SPCMR00051') {
            
            $folder = 'SPCMR00051';
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Konsolidasi Saldo Kas KPPN";
            
        } else {
            
            //Back to Home
            
        }
        
        if (strpos(URL, 'kemenkeu') == false || strpos(URL, 'perbendaharaan') == false){
            $fileURL = 'http://spanint.kemenkeu.go.id/span/report/';
        } else {
            $fileURL = $_SERVER['HTTP_REFERER'].'span/report/';
        }
        $this->view->fileURL = $fileURL;
        
        //var_dump($fileURL);
        
        
        $d_pelaporan = new DataPelaporan($this->registry);

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        

        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = " substr(ARGUMENT_TEXT,-3,3) = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            }
            $this->view->data = $d_pelaporan->get_laporan_kppn($filter);
        }
        
        if (Session::get('role') == ADMIN || Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        
        if (Session::get('role') == KPPN) {
            $d_kppn_list = new DataUser($this->registry);
            $_POST['kdkppn'] = Session::get('id_user');
            $filter[$no++] = " substr(ARGUMENT_TEXT,-3,3) = '" . Session::get('id_user') . "'";
            $this->view->data = $d_pelaporan->get_laporan_kppn($filter);
        }

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        
        $this->view->render('kppn/downloadPDFLaporanKPPN2');
        
    }
    
    public function downloadLaporanPKN($tipe) {
        
        $filter = array();
        $no=0;
        
        if ($tipe == 'SPGLR00008') {
        
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Arus Kas BUN dan KPPN"; 
            
        } else if ($tipe == 'SPGLR00009') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Belanja Pemerintah Pusat";
            
        } else if ($tipe == 'SPGLR00010') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Realisasi APBN";
            
        }else if ($tipe == 'SPGLR00011') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Penerimaan Perpajakan";
            
        }else if ($tipe == 'SPGLR00012') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Penerimaan Pembiayaan";
            
        }else if ($tipe == 'SPGLR00013') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Penerimaan Negara Bukan Pajak";
            
        }else if ($tipe == 'SPGLR00014') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Transfer Daerah";
            
        }else if ($tipe == 'SPGLR00015') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Penerimaan Hibah";
            
        }else if ($tipe == 'SPGLR00016') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Penerimaan dan Pengeluaran Non Anggaran Lainnya";
            
        }else if ($tipe == 'SPGLR00017') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Pengeluaran Pembiayaan";
            
        }else if ($tipe == 'SPGLR00018') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Penerimaan dan Pengeluaran PFK";
            
        } else {
            
            
            switch ($tipe) {
                              case "SPCMR00028":
                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Ikhtisar Posisi dan Arus Kas  Rekening BUN di Bank Indonesia";
                                break;
                              case "SPCMR00028B":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Ikhtisar Posisi dan Arus Kas Rekening Penempatan di BI";
                                break;
                              case "SPCMR00029":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Rekening Dana Reboisasi";
                                break;
                              case "SPCMR00030":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Rekening Dana Bergulir Program UKM pada Bank Umum";
                                break;
                              case "SPCMR00032":
                               $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Dana BAPERTARUM";
                                break;
                              case "SPCMR00032D":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Dana BAPERTARUM-Detail";
                                break;
                              case "SPCMR00033":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Akhir BLU";
                                break;
                              case "SPCMR00054":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Reksus";
                                break;
                              case "SPCMR00055":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Daftar Saldo Rekening Dana Cadangan";
                                break;
                              case "SPCMR00060":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Posisi Saldo Akhir KPPN";
                                break;
                              case "SPCMR00063":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Kas Pemerintah";
                                break;
                              case "SPCMR00064":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Proporsi Kas Pemerintah";
                                break;
                              case "SPCMR00065":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Posisi Dan Arus Kas Pemerintah Yang Likuid";
                                break;
                              case "SPCMR00066":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Posisi Dan Arus Kas Pemerintah Lainnya Yang Cukup Likuid";
                                break;
                              case "SPCMR00067":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Posisi Dan Arus Kas Pemerintah Lainnya Yang Tidak Likuid";
                                break;
                              case "SPCMR00002":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan kas Posisi";
                                break;
                              default:
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '12345' ";
            $this->view->page_title = "Laporan tidak diketemukan";
                            }
            
        }
        
        
        
        /*if (strpos(URL, 'dev2') == false) {
        
            $fileURL = substr(URL, 0, -8).'span/report/';
            
        } else {
            
            $fileURL = substr(URL, 0, -5).'span/report/';
            
        }*/
        
        if (strpos(URL, 'kemenkeu') == false || strpos(URL, 'perbendaharaan') == false){
            $fileURL = 'http://spanint.kemenkeu.go.id/span/report/';
        } else {
            $fileURL = $_SERVER['HTTP_REFERER'].'span/report/';
        }
        $this->view->fileURL = $fileURL;
        
        //var_dump($fileURL);
        
        
        $d_pelaporan = new DataPelaporan($this->registry);

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if (Session::get('role') == ADMIN || Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        
        $this->view->data = $d_pelaporan->get_laporan_pkn_bm($filter);

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        
        $this->view->render('pkn/downloadPDFLaporanPKN');
        
    }
    
    public function downloadLaporanPKNBM($tipe) {
        
        $filter = array();
        $no=0;
        
        if ($tipe == 'SPGLR00008') {
        
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Arus Kas BUN dan KPPN"; 
            
        } else if ($tipe == 'SPGLR00009') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Belanja Pemerintah Pusat";
            
        } else if ($tipe == 'SPGLR00010') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Realisasi APBN";
            
        }else if ($tipe == 'SPGLR00011') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Penerimaan Perpajakan";
            
        }else if ($tipe == 'SPGLR00012') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Penerimaan Pembiayaan";
            
        }else if ($tipe == 'SPGLR00013') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Penerimaan Negara Bukan Pajak";
            
        }else if ($tipe == 'SPGLR00014') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Transfer Daerah";
            
        }else if ($tipe == 'SPGLR00015') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Penerimaan Hibah";
            
        }else if ($tipe == 'SPGLR00016') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Penerimaan dan Pengeluaran Non Anggaran Lainnya";
            
        }else if ($tipe == 'SPGLR00017') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Pengeluaran Pembiayaan";
            
        }else if ($tipe == 'SPGLR00018') {
            
            $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Penerimaan dan Pengeluaran PFK";
            
        } else {
            $folder = 12345;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Tidak Ada";
        }
        
        if (strpos(URL, 'kemenkeu') == false || strpos(URL, 'perbendaharaan') == false){
            $fileURL = 'http://spanint.kemenkeu.go.id/span/report/';
        } else {
            $fileURL = $_SERVER['HTTP_REFERER'].'span/report/';
        }
        $this->view->fileURL = $fileURL;
                
        $d_pelaporan = new DataPelaporan($this->registry);

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if (Session::get('role') == ADMIN || Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        
        $this->view->data = $d_pelaporan->get_laporan_pkn_bm($filter);

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        
        $this->view->render('pkn/downloadPDFLaporanPKN');
        
    }
    
    public function downloadLaporanPKNBB($tipe) {
        
        $filter = array();
        $no=0;
            
            
            switch ($tipe) {
                              case "SPCMR00028":
                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Ikhtisar Posisi dan Arus Kas  Rekening BUN di Bank Indonesia";
                                break;
                              case "SPCMR00028B":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Ikhtisar Posisi dan Arus Kas Rekening Penempatan di BI";
                                break;
                              case "SPCMR00029":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Rekening Dana Reboisasi";
                                break;
                              case "SPCMR00030":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Rekening Dana Bergulir Program UKM pada Bank Umum";
                                break;
                              case "SPCMR00032":
                               $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Dana BAPERTARUM";
                                break;
                              case "SPCMR00032D":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Dana BAPERTARUM-Detail";
                                break;
                              case "SPCMR00033":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Akhir BLU";
                                break;
                              case "SPCMR00054":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Rincian Saldo Reksus";
                                break;
                              case "SPCMR00055":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Daftar Saldo Rekening Dana Cadangan";
                                break;
                              case "SPCMR00060":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Posisi Saldo Akhir KPPN";
                                break;
                              case "SPCMR00063":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Kas Pemerintah";
                                break;
                              case "SPCMR00064":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan Proporsi Kas Pemerintah";
                                break;
                              case "SPCMR00065":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Posisi Dan Arus Kas Pemerintah Yang Likuid";
                                break;
                              case "SPCMR00066":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Posisi Dan Arus Kas Pemerintah Lainnya Yang Cukup Likuid";
                                break;
                              case "SPCMR00067":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Posisi Dan Arus Kas Pemerintah Lainnya Yang Tidak Likuid";
                                break;
                              case "SPCMR00002":
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '".$folder."' ";
            $this->view->page_title = "Laporan kas Posisi";
                                break;
                              default:
                                $folder = $tipe;
            $filter[$no++] = " PROGRAM_SHORT_NAME = '12345' ";
            $this->view->page_title = "Laporan tidak diketemukan";
                            }
            
        
        
        if (strpos(URL, 'kemenkeu') == false || strpos(URL, 'perbendaharaan') == false){
            $fileURL = 'http://spanint.kemenkeu.go.id/span/report/';
        } else {
            $fileURL = $_SERVER['HTTP_REFERER'].'span/report/';
        }
        $this->view->fileURL = $fileURL;
        
        //var_dump($fileURL);
        
        
        $d_pelaporan = new DataPelaporan($this->registry);

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if (Session::get('role') == ADMIN || Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        
        $this->view->data = $d_pelaporan->get_laporan_pkn_bb($filter);

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
        
        $this->view->render('pkn/downloadPDFLaporanPKN');
        
    }
    
    public function lihatLaporan() {
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        $this->view->render('kppn/listLaporan');
        $d_log->tambah_log("Sukses");
    }
    
    public function __destruct() {
        
    }
    
}

?>