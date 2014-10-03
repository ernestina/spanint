<?php

class PelaporanController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
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
    
    public function downloadLaporanKPPN($tipe) {
        
        $d_user = new DataUserSPAN($this->registry); //model
        $filter = array();
        
        if ($tipe == 'LAK') {
        
            $folder = 'SPGLR00258';
            $this->view->page_title = "Laporan Arus Kas per Akun Tingkat KPPN"; 
            
        } else if ($tipe == 'LRA') {
            
            $folder = 'SPGLR00264';
            $this->view->page_title = "Laporan Realisasi Anggaran Tingkat KPPN";
            
        } else {
            
            //Back to Home
            
        }

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if (Session::get('role') == ADMIN) {
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
                            
                            $curl = curl_init('http://spanint.perbendaharaan.go.id/span/report/'.$folder.'/'.$unit.'/'.$folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf');
        
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
                                $data[] = (object) array('kode_unit' => $unit, 'tanggal' => str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))), 'nama_file' => $folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf', 'url' => 'http://spanint.perbendaharaan.go.id/span/report/'.$folder.'/'.$unit.'/'.$folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf');
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

                        $curl = curl_init('http://spanint.perbendaharaan.go.id/span/report/'.$folder.'/'.$unit.'/'.$folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf');

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
                            $data[] = (object) array('kode_unit' => $unit, 'tanggal' => str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))), 'nama_file' => $folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf', 'url' => 'http://spanint.perbendaharaan.go.id/span/report/'.$folder.'/'.$unit.'/'.$folder.'-'.$unit.'-'.str_replace("DEC","DES", str_replace("OCT","OKT", str_replace("AUG", "AGU", str_replace("MAY", "MEI", strtoupper($pointer_date))))).'.pdf');
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
        
    }
    
    public function __destruct() {
        
    }
    
}

?>