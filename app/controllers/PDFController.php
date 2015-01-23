<?php

//----------------------------------------------------
//Development history
//Revisi : 0
//Kegiatan :1.mencetak hasil filter ke dalam pdf
//File yang dibuat : PDFController.php
//Dibuat oleh : Rifan Abdul Rachman
//Tanggal dibuat : 18-07-2014
//----------------------------------------------------

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PDFController extends BaseController {
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

//------------------------------------------------------
//Function PDF untuk DataDIPAController(DataDIPAController.php)
//------------------------------------------------------
    public function RevisiDipa_PDF($kdsatker = null, $kdakun = null, $kdoutput = null, $kdprogram = null, $kdtgl_awal = null, $kdtgl_akhir = null) {

        $d_spm1 = new DataDIPA($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdsatker != 'null') {
            $filter[$no++] = " A.SATKER_CODE =  '" . $kdsatker . "'";
        }
        if ($kdakun != 'null') {
            $filter[$no++] = " A.ACCOUNT_CODE =  '" . $kdakun . "'";
        }
        if ($kdoutput != 'null') {
            $filter[$no++] = " A.OUTPUT_CODE = '" . $kdoutput . "'";
        }
        if ($kdprogram != 'null') {
            $filter[$no++] = " A.PROGRAM_CODE =  '" . $kdprogram . "'";
        }
        if ($kdtgl_awal != 'null' OR $kdtgl_akhir != 'null') {

            list($bln, $tgl, $tahun) = explode("-", $kdtgl_awal);
            $kdtgl_awal = $bln . '/' . $tgl . '/' . $tahun;

            list($bln, $tgl, $tahun) = explode("-", $kdtgl_akhir);
            $kdtgl_akhir = $bln . '/' . $tgl . '/' . $tahun;


            $filter[$no++] = " A.TANGGAL_POSTING_REVISI BETWEEN '" . $kdtgl_awal . "' AND '" . $kdtgl_akhir . "'";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        } else {
            $this->view->kdtgl_awal = 'null';
            $this->view->kdtgl_akhir = 'null';
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------




        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        $this->view->data = $d_spm1->get_dipa_filter($filter);
        $this->view->load('kppn/revisiDIPA_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function Fund_fail_PDF($kdsatker = null, $kdkppn = null) {
        $d_spm1 = new DataFundFail($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if ($kdkppn != 'null') {
            $filter[$no++] = "KPPN_CODE = '" . $kdkppn . "'";
        }

        if ($kdsatker != 'null') {
            $filter[$no++] = "KDSATKER = '" . $kdsatker . "'";
        }

        $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $filter[$no++] = "KPPN_CODE IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";


            $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "KDSATKER = '" . Session::get('kd_satker') . "'";
            $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());


        $this->view->load('kppn/fund_fail_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function Detail_Fund_fail_kd_PDF($kf, $kdsatker = null, $kdoutput = null, $kdkppn = null, $kdakun1 = null) {
        $d_spm1 = new DataFundFail($this->registry);
        $filter = array();
        $no = 0;
        //var_dump($kdakun1);
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if ($kdsatker != 'null') {
            $filter[$no++] = " SATKER =  '" . $kdsatker . "'";
        }
        if ($kdoutput != 'null') {
            $filter[$no++] = " OUTPUT =  '" . $kdoutput . "'";
        }

        if ($kdakun1 != 'null' AND $kf == '2') {
            $filter[$no++] = " AKUN BETWEEN  (SELECT MIN(CHILD_FROM)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $kdakun1 . "') AND (SELECT MAX(CHILD_TO)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $kdakun1 . "') 
			AND AKUN NOT IN(SELECT CHILD_FROM FROM T_AKUN_CONTROL WHERE VALUE != '" . $kdakun1 . "')";
        } elseif ($kdakun1 != 'null' AND $kf == '1') {
            $filter[$no++] = " A.AKUN BETWEEN  (SELECT MIN(CHILD_FROM)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $kdakun1 . "') AND (SELECT MAX(CHILD_TO)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $kdakun1 . "') 
			AND A.AKUN NOT IN(SELECT CHILD_FROM FROM T_AKUN_CONTROL WHERE VALUE != '" . $kdakun1 . "')";
        }

        /* if ($kdsatker != 'null') {
          $filter[$no++] = "KDSATKER = '" . $kdsatker . "'";
          } */

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = " SATKER = '" . Session::get('kd_satker') . "'";
            $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table3());
        if ($kf == '2') {
            $this->view->data = $d_spm1->get_detail_fun_fail_kd_filter($filter);
            $this->view->load('kppn/detail_fund_fail_kd_PDF');
        } elseif ($kf == '1') {
            $d_spm1 = new DataFA($this->registry);
            $this->view->data = $d_spm1->get_fa_filter($filter);
            $this->view->load('kppn/detail_fund_fail_ff_PDF');
        }

        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function RealisasiFA_PDF($kdsatker = null, $kdprogram = null, $kdoutput = null, $kdakun = null, $dana = null) {
        $d_spm1 = new DataFA($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if (Session::get('role') == KPPN) {
            $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "A.SATKER = '" . Session::get('kd_satker') . "'";
        }  
        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "A.KPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }

        if ($kdtgl_awal != 'null' OR $kdtgl_akhir != 'null') {
            //$filter[$no++] = " A.TANGGAL_POSTING_REVISI BETWEEN '".$kdtgl_awal."' AND '".$kdtgl_akhir."'";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }

        if ($kdsatker != 'null') {
            $filter[$no++] = " A.SATKER =  '" . $kdsatker . "'";
        }

        if ($kdprogram != 'null') {
            $filter[$no++] = " A.PROGRAM = '" . $kdprogram . "'";
        }
        if ($kdoutput != 'null') {
            $filter[$no++] = " A.OUTPUT = '" . $kdoutput . "'";
        }
        if ($dana != 'null') {
            $filter[$no++] = " A.DANA =  '" . $dana . "'";
        }
        if ($kdakun != 'null') {
            $filter[$no++] = " A.AKUN BETWEEN  (SELECT MIN(CHILD_FROM)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $kdakun . "') AND (SELECT MAX(CHILD_TO)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $kdakun . "') 
			AND A.AKUN NOT IN(SELECT CHILD_FROM FROM T_AKUN_CONTROL WHERE VALUE != '" . $kdakun . "')";
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_fa_filter($filter);
        $this->view->load('kppn/realisasiFA_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function RealisasiFA_1_PDF($kdsatker = null, $kdkppn = null, $kdakun = null, $kdprogram = null, $kdoutput = null, $kdakun1 = null) {
        $d_spm1 = new DataFA($this->registry);
        $filter = array();
        $no = 0;
        $this->view->kdakun1 = $kdakun1;
        if ($kdsatker != 'null' and Session::get('role') != SATKER) {
            $filter[$no++] = " A.SATKER =  '" . $kdsatker . "'";
        } else {
            $filter[$no++] = " A.SATKER =  '" . Session::get('kd_satker') . "'";
        }
        if ($kdkppn != 'null' and Session::get('role') != SATKER) {
            $filter[$no++] = " A.KPPN =  '" . $kdkppn . "'";
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "A.KPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }

        IF ($kdakun != 'null' || $kdprogram != 'null' || $kdoutput != 'null') {
            if ($kdsatker != 'null') {
                $filter[$no++] = "A.SATKER = '" . $kdsatker . "'";
            }
            if ($kdakun != 'null') {
                $filter[$no++] = "A.AKUN = '" . $kdakun . "'";
            }

            if ($kdoutput != 'null') {
                $filter[$no++] = "A.OUTPUT = '" . $kdoutput . "'";
            }
            if ($kdprogram != 'null') {
                $filter[$no++] = "A.PROGRAM = '" . $kdprogram . "'";
            }
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------



        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_fa_summary_filter($filter);

        $this->view->load('kppn/realisasiFA_1_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    //------------------------------------
    public function DataRealisasi_PDF($kdkppn = null, $kdsatker = null) {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        if ($kdkppn != 'null') {
            $filter[$no++] = "A.KPPN = '" . $kdkppn . "'";
        }
        if ($kdsatker != 'null') {
            $filter[$no++] = "A.SATKER = '" . $kdsatker . "'";
        }
        //header
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = $kppn->get_nama_user();
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }



        $this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);
        }


        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        //untuk mencatat log user
        $this->view->load('kppn/DataRealisasi_PDF');
        $d_log->tambah_log("Sukses");
    }

    public function DataRealisasiBA_PDF($kdkppn = null) {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;

        if ($kdkppn != 'null') {

            $filter[$no++] = "KPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        } elseif (Session::get('role') == KANWIL) {
            $filter[$no++] = "KANWIL = '" . Session::get('id_user') . "'";
        }

        /* if ($kdlokasi != 'null') {
          $filter[$no++] = "a.lokasi = '" . $kdlokasi . "'";
          } */
        $this->view->data = $d_spm1->get_realisasi_fa_global_ba_filter($filter);

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
            //$this->view->data2 = $d_spm1->get_realisasi_lokasi(Session::get('id_user'));
            $this->view->data = $d_spm1->get_realisasi_fa_global_ba_filter($filter);
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->load('kppn/DataRealisasiBA_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function DataRealisasiTransfer_PDF($kdsatker = null, $kdlokasi = null, $kdtgl_awal = null, $kdtgl_akhir = null) {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if ($kdlokasi != 'null') {
            $filter[$no++] = "a.lokasi = '" . $kdlokasi . "'";
        }
        if ($kdsatker != 'null') {
            $filter[$no++] = "A.SATKER = '" . $kdsatker . "'";
        }
		$filter[$no++]="A.KPPN = '019'";
            $this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
			

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            //$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $this->view->data4 = $d_spm1->get_realisasi_lokasi_kanwil(Session::get('id_user'));
            $this->view->data2 = $d_spm1->get_realisasi_satker_transfer();
            //$this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            //$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            $this->view->data4 = $d_spm1->get_realisasi_lokasi_kanwil(Session::get('id_user'));
            //$this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
            $this->view->data2 = $d_spm1->get_realisasi_satker_transfer();
            //$this->view->data2 = $d_spm1->get_realisasi_satker_transfer($_POST['kdkppn']);
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++]="A.KPPN = '".Session::get('id_user')."'";
            $this->view->data4 = $d_spm1->get_realisasi_lokasi(Session::get('id_user'));
            $this->view->data2 = $d_spm1->get_realisasi_satker_transfer(Session::get('id_user'));
            //$this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
        }
        //var_dump($d_spm->get_hist_spm_filter());
        //$this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->load('kppn/DataRealisasiTransfer_PDF');
        $d_log->tambah_log("Sukses");
    }

    public function DetailRevisi_PDF($kdsatker = null) {
        $d_spm1 = new proses_revisi($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdsatker != 'null') {
            $filter[$no++] = " KDSATKER =  '" . $kdsatker . "'";
        }
        if ($kdtgl_awal != 'null' OR $kdtgl_akhir != 'null') {
            //$filter[$no++] = " A.TANGGAL_POSTING_REVISI BETWEEN '".$kdtgl_awal."' AND '".$kdtgl_akhir."'";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }
        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "KDSATKER = '" . Session::get('kd_satker') . "'";
        }


        $this->view->d_kdsatker = $satker;


        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table3());


        $this->view->data = $d_spm1->detail_revisi($filter);
        //untuk mencatat log user

        $this->view->load('kppn/detail_revisi_PDF');
        $d_log->tambah_log("Sukses");
    }

    public function nmsatker_PDF($kdkppn = null, $kdsatker = null, $nmsatker = null, $kdrevisi = null) {
        $d_spm1 = new DataNamaSatker($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));



        if ($kdkppn != 'null') {
            $filter[$no++] = "KPPN_CODE = '" . $kdkppn . "'";
        }

        if ($kdsatker != 'null') {
            $filter[$no++] = "KDSATKER = '" . $kdsatker . "'";
        }
        if ($nmsatker != 'null') {
            $filter[$no++] = " UPPER(NMSATKER) LIKE UPPER('%" . $nmsatker . "%')";
        }
        if ($kdrevisi != 'null') {
            $filter[$no++] = "(SELECT MAX(REVISION_NO) FROM SPSA_BT_DIPA_V) " . $kdrevisi;
        }
        $this->view->data = $d_spm1->get_satker_dipa_filter($filter);


        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            //$this->view->data = $d_spm1->get_satker_dipa_filter($filter);	
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_satker_dipa_filter($filter);
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        if (Session::get('role') == ADMIN) {
            $this->view->load('kppn/NamaSatkerDIPA1_PDF');
        } else {
            $this->view->load('kppn/NamaSatkerDIPAkppn_PDF');
        }
        $d_log->tambah_log("Sukses");
    }

    public function nmsatker1_PDF($kdkppn = null, $kdsatker = null, $nmsatker = null) {
        $d_spm1 = new DataNamaSatker($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $filter[$no++] = "KPPN_CODE = '" . $kdkppn . "'";
        } else {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
        }

        if ($kdsatker != 'null') {
            $filter[$no++] = "KDSATKER = '" . $kdsatker . "'";
        }
        if ($nmsatker != 'null') {
            $filter[$no++] = " UPPER(NMSATKER) LIKE UPPER('%" . $nmsatker . "%')";
        }

        $this->view->data = $d_spm1->get_satker_dipa_filter($filter);

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_satker_dipa_filter($filter);
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->load('kppn/NamaSatkerDIPA2_PDF');
        $d_log->tambah_log("Sukses");
    }

    public function ProsesRevisi_PDF($kdkppn = null, $kdsatker = null, $nmsatker = null) {
        $d_spm1 = new proses_revisi($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $filter[$no++] = "A.KPPN_CODE = '" . $kdkppn . "'";
        }

        if ($kdsatker != 'null') {
            $filter[$no++] = "A.SATKER_CODE = '" . $kdsatker . "'";
        }
        if ($nmsatker != 'null') {
            $filter[$no++] = " UPPER(B.NMSATKER) LIKE UPPER('%" . $nmsatker . "%')";
        }

        if (Session::get('role') == SATKER) {
            $filter[$no++] = "A.SATKER_CODE = '" . Session::get('kd_satker') . "'";
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "A.KPPN_CODE = '" . Session::get('id_user') . "'";
        }

        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "KPPN_CODE IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_revisi_dipa($filter);

        $this->view->load('kppn/proses_revisi_PDF');
        $d_log->tambah_log("Sukses");
    }

//baru
    public function DetailEncumbrances_PDF($code_id = null) {
        $d_spm1 = new encumbrances($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if ($code_id != 'null') {
            $filter[$no++] = " CODE_COMBINATION_ID =  '" . $code_id . "'";
            //$this->view->invoice_num = $invoice_num;	
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
        //var_dump($d_spm->get_hist_spm_filter());
        $this->view->data = $d_spm1->get_encumbrances($filter);
        $d_log->tambah_log("Sukses");
        $this->view->load('kppn/encumbrances_PDF');
    }

    public function DetailRealisasiFA_PDF($code_id = null) {
        $d_spm1 = new DataRealisasiFA($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if ($code_id != 'null') {
            $filter[$no++] = " DIST_CODE_COMBINATION_ID =  '" . $code_id . "'";
            //$this->view->invoice_num = $invoice_num;	
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
        //var_dump($d_spm->get_hist_spm_filter());
        $this->view->data = $d_spm1->get_realisasi_fa_filter($filter);


        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/DetailRealisasiFA_PDF');
    }

    public function Detail_Fund_fail_PDF($kdsatker = null) {
        $d_spm1 = new DataFundFail($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdsatker != 'null') {
            $filter[$no++] = " KDSATKER =  '" . $kdsatker . "'";
            //$this->view->invoice_num = $invoice_num;	
        }
        //var_dump($d_spm->get_hist_spm_filter());
        //$this->view->data = $d_spm1->get_detail_fun_fail_filter($filter);
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $this->view->data = $d_spm1->get_detail_fun_fail_kd_filter($filter);
        $this->view->load('kppn/detail_fund_fail_kd_PDF');
        $d_log->tambah_log("Sukses");
    }

	//20-11-2014
		public function RealisasiFA_1_Minus_PDF($kdsatker = null, $kdkppn = null, $kdakun = null, $kdprogram = null, $kdoutput = null) {
        $d_spm1 = new DataFA($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if ($kdsatker != 'null' and Session::get('role') != SATKER) {
            $filter[$no++] = " A.SATKER =  '" . $kdsatker . "'";
            $this->view->satker_code = $kdsatker;
        }
		/* else {
            $filter[$no++] = " A.SATKER =  '" . Session::get('kd_satker') . "'";
        } */
		if($kdkppn !='null' and Session::get('role') != SATKER) {
			$filter[$no++] = " A.KPPN =  '" . $kdkppn . "'";
		}
		
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
			/* if (Session::get('id_user') != '019'){
			$filter[$no++] = "SUBSTR(AKUN,1,2) <> 'B3'";
			}	 */
        }
       
		if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			$filter[$no++] = "A.KPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            //$this->view->data = $d_spm1->get_satker_dipa_filter($filter);	
        }
		
			
			if ($kdkppn != 'null') {
                $filter[$no++] = "A.KPPN = '" . $kdkppn . "'";
				$this->view->kppn_code = $kdkppn;
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
            }

            if ($kdsatker != 'null') {
                $filter[$no++] = "A.SATKER = '" . $kdsatker . "'";
                $this->view->satker_code = $kdsatker;
            }
            if ($kdakun != 'null') {
                $filter[$no++] = "A.AKUN = '" . $kdakun . "'";
                $this->view->account_code = $kdakun;
            }
            if ($kdoutput != 'null') {
                $filter[$no++] = "A.OUTPUT = '" . $kdoutput . "'";
                $this->view->output_code = $kdoutput;
            }
            if ($kdprogram != 'null') {
                $filter[$no++] = "A.PROGRAM = '" . $kdprogram . "'";
                $this->view->program_code = $kdprogram;
            }

		$filter[$no++] = "SUBSTR(A.AKUN,1,2) <> 'B1'";
		
		        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_fa_summary_minus_filter($filter);
        //var_dump($d_spm->get_hist_spm_filter());

        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/realisasiFA_1_minus_PDF');
    }
	
	public function RealisasiFA_1_Minus_51_PDF($kdsatker = null, $kdkppn = null, $kdakun = null, $kdprogram = null, $kdoutput = null) {
        $d_spm1 = new DataFA($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if ($kdsatker != 'null' and Session::get('role') != SATKER) {
            $filter[$no++] = " A.SATKER =  '" . $kdsatker . "'";
            $this->view->satker_code = $kdsatker;
        }
		/* else {
            $filter[$no++] = " A.SATKER =  '" . Session::get('kd_satker') . "'";
        } */
		if($kdkppn !='null' and Session::get('role') != SATKER) {
			$filter[$no++] = " A.KPPN =  '" . $kdkppn . "'";
		}
		
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
			/* if (Session::get('id_user') != '019'){
			$filter[$no++] = "SUBSTR(AKUN,1,2) <> 'B3'";
			}	 */
        }
       
		if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			$filter[$no++] = "A.KPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            //$this->view->data = $d_spm1->get_satker_dipa_filter($filter);	
        }
		
            if ($kdkppn != 'null') {
                $filter[$no++] = "A.KPPN = '" . $kdkppn . "'";
				$this->view->kppn_code = $kdkppn;
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
            }

            if ($kdsatker != 'null') {
                $filter[$no++] = "A.SATKER = '" . $kdsatker . "'";
                $this->view->satker_code = $kdsatker;
            }
            if ($kdakun != 'null') {
                $filter[$no++] = "A.AKUN = '" . $kdakun . "'";
                $this->view->account_code = $kdakun;
            }
            if ($kdoutput != 'null') {
                $filter[$no++] = "A.OUTPUT = '" . $kdoutput . "'";
                $this->view->output_code = $kdoutput;
            }
            if ($kdprogram != 'null') {
                $filter[$no++] = "A.PROGRAM = '" . $kdprogram . "'";
                $this->view->program_code = $kdprogram;
            }
        
		$filter[$no++] = "SUBSTR(A.AKUN,1,2) = 'B1'";
		 //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_fa_summary_minus_filter($filter);
        //var_dump($d_spm->get_hist_spm_filter());

        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/realisasiFA_1_minus_51_PDF');
    }

//------------------------------------------------------
    //Function PDF untuk DataDropingController(DataDropingController.php)
//------------------------------------------------------
    public function detailDroping_PDF($kdid = null, $kdbank = null, $kdtanggal = null) {
        $d_sppm = new DataDroping($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (!is_null($kdid)) {
            $filter[$no++] = "ID_DETAIL = '" . $kdid . "'";
            $this->view->d_id = $kdid;
        }
        if (!is_null($kdbank)) {
            if ($kdbank != "SEMUA") {
                $filter[$no++] = "BANK = '" . $kdbank . "'";
            }
            $this->view->d_bank = $kdbank;
        }
        if (!is_null($kdtanggal)) {
            $filter[$no++] = "TO_CHAR(CREATION_DATE,'DD-MM-YYYY') = '" . $kdtanggal . "'";
            $this->view->d_tanggal = $kdtanggal;
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->data = $d_sppm->get_droping_detail_filter($filter);

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table1());

        $this->view->load('pkn/dropingDetail_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function monitoringDroping_PDF($kdbank = null, $kdtgl_awal = null, $kdtgl_akhir = null) {
        $d_sppm = new DataDroping($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if ($kdbank != 'null') {
            if ($kdbank != 'SEMUA') {
                $filter[$no++] = "BANK = '" . $kdbank . "'";
            }
        }
        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {
            $filter[$no++] = "CREATION_DATE BETWEEN TO_DATE (" . date('Ymd', strtotime($kdtgl_awal)) . ",'YYYYMMDD') 
									AND TO_DATE (" . date('Ymd', strtotime($kdtgl_akhir)) . ",'YYYYMMDD')  ";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->data = $d_sppm->get_droping_filter($filter);

        if (Session::get('role') == ADMIN OR Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        $this->view->load('pkn/droping_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }
	
	    public function detailSPAN_PDF($kdbank = null, $kdtanggal = null) {
        $d_sppm = new DataDroping($this->registry);
        $filter = array();
        $no = 0;
        
        
        if (Session::get('role') == BANK) {
            $filter[$no++] = "BANK = '" . Session::get('kd_satker') . "' ";
            $this->view->d_bank = Session::get('kd_satker');
            //var_dump(Session::get('role'));
        }
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if (!is_null($kdbank)) {
            if ($kdbank != "SEMUA") {
                $filter[$no++] = "BANK = '" . $kdbank . "'";
            }
            $this->view->d_bank = $kdbank;
        }
        if (!is_null($kdtanggal)) {
            $filter[$no++] = "PAYMENT_DATE = TO_DATE('" . $kdtanggal . "','DD-MM-YYYY')";
            $this->view->d_tanggal = $kdtanggal;
        }
        $this->view->data = $d_sppm->get_droping_detail_span_filter($filter,$kdtanggal);

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table2());

        $this->view->load('pkn/dropingDetailSPAN_PDF');
		
		$d_log->tambah_log("Sukses");
    }


//------------------------------------------------------
//Function PDF untuk DataGRController(DataGRController.php)
//------------------------------------------------------
    public function GR_PFK_PDF($kdbulan = null, $kdkppn = null) {
        $d_spm1 = new DataPFK($this->registry);
        $filter = array();
        $bulan = 'null';
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
        }
        if ($kdbulan != 'null') {
			if (Session::get('role') == ADMIN) {
				if ($kdbulan == '01') {
                    $kdbulan = 'januari';
                }
                elseif ($kdbulan == '02') {
                    $kdbulan = 'februari';
                }
                elseif ($kdbulan == '03') {
                    $kdbulan = 'maret';
                }
                elseif ($kdbulan == '04') {
                    $kdbulan = 'april';
                }
                elseif ($kdbulan == '05') {
                    $kdbulan = 'mei';
                }
                elseif ($kdbulan == '06') {
                    $kdbulan = 'juni';
                }
                elseif ($kdbulan == '07') {
                    $kdbulan = 'juli';
                }
                elseif ($kdbulan == '08') {
                    $kdbulan = 'agustus';
                }
                elseif ($kdbulan == '09') {
                    $kdbulan = 'september';
                }
                elseif ($kdbulan == '10') {
                    $kdbulan = 'oktober';
                }
                elseif ($kdbulan == '11') {
                    $kdbulan = 'nopember';
                }
                elseif ($kdbulan == '12') {
                    $kdbulan = 'desember';
                }
                else {
                    $kdbulan = date("F"); 
                }
				
			}
            
        }
        if ($kdkppn != 'null') {
            if ($kdkppn != 'SEMUAKPPN') {
                $filter[$no++] = "KPPN = '" . $kdkppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
            }
        } else {
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $this->view->data = $d_spm1->get_gr_pfk_filter($filter, $kdbulan);
        $this->view->load('kppn/GR_PFK_GLOBAL_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function GR_PFK_DETAIL1_PDF($kdakun = null, $kdbulan = null, $kdkppn = null) {
        $d_spm1 = new DataPFK_DETAIL($this->registry);
        $filter = array();
        $no = 0;
        if (!is_null($kdakun)) {
            $filter[$no++] = "akun =  '" . $kdakun . "'";
            $this->view->kd_akun = $kdakun;
        }
        if (!is_null($kdbulan)) {
            
            $this->view->nm_bulan = $kdbulan;
            $filter[$no++] = "to_char(tanggal_buku,'mm')  =  '" . $kdbulan . "'";
        }
        if (!is_null($kdkppn)) {
            if ($kdkppn != 'SEMUA') {
                $filter[$no++] = "KPPN =  '" . $kdkppn . "'";
            }
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->data = $d_spm1->get_gr_pfk_detail_filter($filter);

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/GR_PFK_DETAIL1_PDF');
    }

    public function GR_IJP_PDF($kdbulan = null, $kdkppn = null) {
        $d_spm1 = new DataGR_IJP($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
        }
        if ($kdbulan != 'null') {
            $filter[$no++] = "BULAN = '" . $kdbulan . "'";
			if ($kdbulan == '01') {
                $bulan = 'Januari';
            }
            if ($kdbulan == '02') {
                $bulan = 'FebruarI';
            }
            if ($kdbulan == '03') {
                $bulan = 'Maret';
            }
            if ($kdbulan == '04') {
                $bulan = 'April';
            }
            if ($kdbulan == '05') {
                $bulan = 'Mei';
            }
            if ($kdbulan == '06') {
                $bulan = 'Juni';
            }
            if ($kdbulan == '07') {
                $bulan = 'Juli';
            }
            if ($kdbulan == '08') {
                $bulan = 'Agustus';
            }
            if ($kdbulan == '09') {
                $bulan = 'September';
            }
            if ($kdbulan == '10') {
                $bulan = 'Oktober';
            }
            if ($kdbulan == '11') {
                $bulan = 'November';
            }
            if ($kdbulan == '12') {
                $bulan = 'Desember';
            }

			$this->view->kd_bulan = $bulan;
        }
        if ($kdkppn != 'null') {
            $filter[$no++] = "KPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------



        $this->view->data = $d_spm1->get_gr_ijp_filter($filter);
        $this->view->load('kppn/GR_IJP_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function detailLhpRekap_PDF($kdtgl = null, $kdkppn = null) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        if (!is_null($kdtgl)) {
			$kdtgl = substr($kdtgl, 6, 4) . substr($kdtgl,3, 2) . substr($kdtgl, 0, 2);
            $filter[$no++] = "CONT_GL_DATE =  '" . $kdtgl . "'";
        }
        if (!is_null($kdkppn)) {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        $this->view->data = $d_spm1->get_detail_lhp_rekap($filter);
        $this->view->load('kppn/detailLhpRekap_PDF');
		
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function detailPenerimaan_PDF($file_name = null, $kdkppn = null) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (!is_null($file_name)) {
            $filter[$no++] = "FILE_NAME =  '" . $file_name . "' AND ";
        }
        if (!is_null($kdkppn)) {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            $this->view->kppn = Session::get('id_user');
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $this->view->data = $d_spm1->get_detail_penerimaan($filter);

        $this->view->load('kppn/detailPenerimaan_PDF');
        $d_log->tambah_log("Sukses");
    }

    public function detailCoAPenerimaan_PDF($kdntpn = null) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (!is_null($kdntpn)) {
            $filter[$no++] = "RECEIPT_NUMBER =  '" . $kdntpn . "'";
            $this->view->d_tgl = $ntpn;
        }

        $this->view->data = $d_spm1->get_detail_coa_penerimaan($filter);

        //var_dump($d_spm->get_gr_status_filter($filter));
        $this->view->load('kppn/detailCoAPenerimaan_PDF');
        $d_log->tambah_log("Sukses");
    }

    public function SuspendSatkerPenerimaan_PDF($kdtgl_awal = null,$kdtgl_akhir = null,$kdntpn = null,$kdkppn = null,$kdkoreksi = null) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

		if ($kdkppn != 'null') {
			$filter[$no++] = "KPPN = '" . $kdkppn . "'";
			$filter[$no++] = "SEGMENT1 = 'ZZZ" . $kdkppn . "'";
				
        } else {
			$filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
        }

        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {
			$filter[$no++] = "TANGGAL BETWEEN TO_DATE ('" . date('Ymd', strtotime($kdtgl_awal)) . "','YYYYMMDD') 
							AND TO_DATE ('" . date('Ymd', strtotime($kdtgl_akhir)) . "','YYYYMMDD')  ";
            
			$tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
		}
        if ($kdntpn != 'null') {
            $filter[$no++] = "RECEIPT_NUMBER = '" . $kdntpn . "'";
        }
		if ($kdkoreksi != 'null') {
			if ($kdkoreksi == 'BELUM'){
				$filter[$no++] = "RECEIPT_NUMBER = RECEIPT_NUMBER2";    
			} else if ($kdkoreksi == 'SUDAH'){
				$filter[$no++] = "RECEIPT_NUMBER <> RECEIPT_NUMBER2";    
			}

		}
		
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
        }


        $this->view->data = $d_spm1->get_konfirmasi_penerimaan($filter);

        $this->view->load('kppn/suspend_satker_penerimaan_PDF');
		//$this->view->render('kppn/suspend_satker_penerimaan');
        $d_log->tambah_log("Sukses");
    }

    public function KonfirmasiPenerimaan_PDF($kdntpn = null) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if ($kdntpn != 'null') {
            $filter[$no++] = "RECEIPT_NUMBER = '" . $kdntpn . "'";
        }
        $this->view->data = $d_spm1->get_konfirmasi_penerimaan($filter);



        $this->view->load('kppn/konfirmasi_penerimaan_PDF');
        $d_log->tambah_log("Sukses");
    }

    public function SuspendAkunPenerimaan_PDF($kdtgl_awal = null,$kdtgl_akhir = null,$kdkppn = null,$kdkoreksi = null) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
            $filter[$no++] = "SEGMENT3 = '498111'";
        }

		if ($kdkoreksi != 'null') {
			if ($kdkoreksi == 'BELUM'){
				$filter[$no++] = "RECEIPT_NUMBER = RECEIPT_NUMBER2";    
			} else if ($kdkoreksi == 'SUDAH'){
				$filter[$no++] = "RECEIPT_NUMBER <> RECEIPT_NUMBER2";    
			}
			
		}

		if ($kdkppn != 'null') {
			$filter[$no++] = "KPPN = '" . $kdkppn . "'";
			$filter[$no++] = "SEGMENT3 = '498111'";
		} else {
			$filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
			$filter[$no++] = "SEGMENT3 = '498111'";
		}
			
        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {
            $filter[$no++] = "TANGGAL BETWEEN TO_DATE ('" . date('Ymd', strtotime($kdtgl_awal)) . "','YYYYMMDD') 
								AND TO_DATE ('" . date('Ymd', strtotime($kdtgl_akhir)) . "','YYYYMMDD')  ";
			$tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
                
		}


        $this->view->data = $d_spm1->get_konfirmasi_penerimaan($filter);
        //var_dump($d_spm->get_gr_status_filter($filter));

        $this->view->load('kppn/suspend_akun_penerimaan_PDF');
        $d_log->tambah_log("Sukses");
    }

    public function NTPNGanda_PDF($kdbulan = null,$kdkppn = null) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
        }

        if ($kdbulan != 'null') {
            $filter[$no++] = "SUBSTR(BULAN,1,2) = '" . $kdbulan . "'";
        }


        $this->view->data = $d_spm1->get_ntpn_ganda($filter);

        $this->view->load('kppn/ntpn_ganda_PDF');
        $d_log->tambah_log("Sukses");
    }

    public function DetailNTPNGanda_PDF($kdntpn = null) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if (Session::get('role') == KPPN) {
            $filter[$no++] = "SUBSTR(RESP_NAME,1,3) = '" . Session::get('id_user') . "'";
        }

        if ($kdntpn != 'null') {
            $filter[$no++] = "NTPN = '" . $kdntpn . "'";
        }

        $this->view->data = $d_spm1->get_detail_ntpn_ganda($filter);

        $this->view->load('kppn/detail_ntpn_ganda_PDF');
        $d_log->tambah_log("Sukses");
    }
	
//baru	
    public function grStatusHarian_PDF($kdkppn = null) {
        $d_spm1 = new DataGR_IJP($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		$d_kppn = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn->get_kppn_kanwil();

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "a.KPPN = '" . Session::get('id_user') . "'";
            $this->view->jml_rek = $d_spm1->get_jml_rek_dep(Session::get('id_user'));
            $this->view->data = $d_spm1->get_gr_status_harian($filter);
        }
		
		//-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

            if ($kdkppn != 'null') {
                $filter[$no++] = "a.KPPN = '" . $kdkppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
            } else {
                $filter[$no++] = "a.KPPN = '" . Session::get('id_user') . "'";
            }
            $this->view->jml_rek = $d_spm1->get_jml_rek_dep($kdkppn);
            $this->view->data = $d_spm1->get_gr_status_harian($filter);
        
        
		
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table());

        $this->view->load('kppn/GRStatusHarian_PDF');
        $d_log->tambah_log("Sukses");
    }
    
    public function grStatusHarianBulan_PDF($kdbulan = null) {
        $d_spm1 = new DataGR_IJP($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		$d_kppn = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn->get_kppn_kanwil();
		
		
        
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $kppnya='';
            foreach ($kppn_list as $value1) {
                $kppnya .= "'".$value1->get_kd_d_kppn()."',";
            }
            $filter[$no++] = " a.kppn in (".$kppnya."'0') ";
        }
        
		//-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
       
            if ($kdbulan != 'null') {
                if ($kdbulan != 'SEMUA_BULAN') {
                    $filter[$no++] = "a.BULAN = '" . $kdbulan . "'";
                }
                $this->view->d_bulan = $kdbulan;
            }else {
            $filter[$no++] = "a.BULAN = '" . date('m', time()) . "'";
            $this->view->d_bulan = date('m', time());
			}
        
        
        //$this->view->jml_rek = $d_spm1->get_jml_rek_dep($_POST['kdkppn']);
        $this->view->data = $d_spm1->get_gr_status_harian($filter);
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table());

        $this->view->load('kppn/GRStatusHarianBulan_PDF');
        $d_log->tambah_log("Sukses");
    }


//------------------------------------------------------
//Function PDF untuk DataKppnController(DataKppnController.php)
//------------------------------------------------------
    public function monitoringSp2d_PDF($kdkppn = null, $kdsatker = null, $kdtgl_awal = null, $kdtgl_akhir = null, $kdnosp2d = null, $kdnoinvoice = null, $kdbarsp2d = null, $kdstatus = null, $kdbayar = null, $kdbank = null,$kd_vendor_name=null,$kd_fxml=null ) {
        $d_sppm = new DataSppm($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if (Session::get('role') == ADMIN OR Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }

        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if ($kdnosp2d != 'null') {
            $filter[$no++] = "CHECK_NUMBER = '" . $kdnosp2d . "'";
        }
        if ($kdbarsp2d != 'null') {
            $filter[$no++] = "CHECK_NUMBER_LINE_NUM = '" . $kdbarsp2d . "'";
        }
        if ($kdsatker != 'null') {
            $filter[$no++] = "SUBSTR(INVOICE_NUM,8,6) = '" . $kdsatker . "'";
        }

        if ($kdnoinvoice != 'null') {
            $filter[$no++] = "INVOICE_NUM = UPPER('" . $kdnoinvoice . "')";
        }
        if ($kdbank != 'null') {
            if ($kdbank != '5') {
                $filter[$no++] = "BANK_ACCOUNT_NAME LIKE '%" . $kdbank . "%'";
            }
        }
        if ($kdstatus != 'null') {
            if ($kdstatus == 'SUKSES') {
                $filter[$no++] = "RETURN_DESC = 'SUKSES'";
            } elseif ($kdstatus == 'TIDAK') {
                $filter[$no++] = "RETURN_DESC != 'SUKSES'";
            }
        }
        if ($kdbayar != 'null') {
            if ($kdbayar != 'SEMUA') {
                $filter[$no++] = "PAYMENT_METHOD = '" . $kdbayar . "'";
            }
        }

        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {
            $filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (" . date('Ymd', strtotime($kdtgl_awal)) . ",'YYYYMMDD') 
									AND TO_DATE (" . date('Ymd', strtotime($kdtgl_akhir)) . ",'YYYYMMDD')  ";

            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }
		
		if ($kd_fxml != 'null') {
                $fxml = $kd_fxml;
                $filter[$no++] = "UPPER(FTP_FILE_NAME) = '" . strtoupper($fxml) . "'";
                $this->view->d_fxml = $kd_fxml;
            }
			
		if ($kd_vendor_name != 'null') {
                $filter[$no++] = "UPPER(VENDOR_NAME) = '" . strtoupper($kd_vendor_name) . "'";
                $this->view->d_vendor_name = $kd_vendor_name;
            }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        if (Session::get('role') == SATKER) {
            $filter[$no++] = " SUBSTR(INVOICE_NUM,8,6) = '" . Session::get('kd_satker') . "'";
            $this->view->d_satker = Session::get('kd_satker');
        }
        $this->view->data = $d_sppm->get_sppm_filter($filter);

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        $this->view->load('kppn/isianKppn_PDF');
		
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function harianBO_PDF($kdkppn = null, $kdtgl_awal = null, $kdtgl_akhir = null, $kdbank = null) {
        $d_sppm = new DataSppm($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if ($kdbank != 'null') {
            if ($kdbank != 5) {
                $filter[$no++] = "BANK_ACCOUNT_NAME LIKE '%" . $kdbank . "%'";
            }
        }
        if ($kdtgl_awal != 'null' OR $kdtgl_akhir != 'null') {
            $filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (" . date('Ymd', strtotime($kdtgl_awal)) . ",'YYYYMMDD') 
									AND TO_DATE (" . date('Ymd', strtotime($kdtgl_akhir)) . ",'YYYYMMDD')  ";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $this->view->data = $d_sppm->get_harian_bo_i($filter);

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }


        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        $this->view->load('kppn/harianBo_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function sp2dHariIni_PDF($kdkppn = null, $kdtgl_awal = null, $kdtgl_akhir = null, $kdbank = null) {
        $d_sppm = new DataSppm($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if ($kdbank != 'null') {
            if ($kdbank != 5) {
                $filter[$no++] = "BANK_ACCOUNT_NAME LIKE '%" . $kdbank . "%'";
            }
        }
        if ($kdtgl_awal != 'null' OR $kdtgl_akhir != 'null') {
            $filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (" . date('Ymd', strtotime($kdtgl_awal)) . ",'YYYYMMDD') 
									AND TO_DATE (" . date('Ymd', strtotime($kdtgl_akhir)) . ",'YYYYMMDD')  ";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $filter[$no++] = " TO_CHAR(PAYMENT_DATE,'YYYYMMDD') = TO_CHAR(CREATION_DATE,'YYYYMMDD') ";
        $this->view->data = $d_sppm->get_sp2d_hari_ini($filter);

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        $this->view->load('kppn/sp2dHariIni_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function sp2dBesok_PDF($kdkppn = null, $kdtgl_awal = null, $kdtgl_akhir = null, $kdbank = null) {
        $d_sppm = new DataSppm($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if ($kdbank != 'null') {
            if ($kdbank != 5) {
                $filter[$no++] = "BANK_ACCOUNT_NAME LIKE '%" . $kdbank . "%'";
            }
        }
        if ($kdtgl_awal != 'null' OR $kdtgl_akhir != 'null') {
            $filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (" . date('Ymd', strtotime($kdtgl_awal)) . ",'YYYYMMDD') 
									AND TO_DATE (" . date('Ymd', strtotime($kdtgl_akhir)) . ",'YYYYMMDD')  ";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $filter[$no++] = "( TO_CHAR(PAYMENT_DATE,'YYYYMMDD') = TO_CHAR(CREATION_DATE,'YYYYMMDD') 
								AND TO_CHAR(CREATION_DATE,'HH24MISS') > '150000' )";

        $this->view->data = $d_sppm->get_sp2d_besok($filter);

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        $this->view->load('kppn/sp2dBesok_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function sp2dBackdate_PDF($kdkppn = null, $kdtgl_awal = null, $kdtgl_akhir = null, $kdbank = null) {
        $d_sppm = new DataSppm($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if ($kdbank != 'null') {
            if ($kdbank != 5) {
                $filter[$no++] = "BANK_ACCOUNT_NAME LIKE '%" . $kdbank . "%'";
            }
        }
        if ($kdtgl_awal != 'null' OR $kdtgl_akhir != 'null') {
            $filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (" . date('Ymd', strtotime($kdtgl_awal)) . ",'YYYYMMDD') 
									AND TO_DATE (" . date('Ymd', strtotime($kdtgl_akhir)) . ",'YYYYMMDD')  ";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYYMMDD')  > TO_CHAR(CHECK_DATE,'YYYYMMDD')";
        $this->view->data = $d_sppm->get_sp2d_backdate($filter);

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        $this->view->load('kppn/sp2dBackdate_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function sp2dNilaiMinus_PDF($kdkppn = null, $kdtgl_awal = null, $kdtgl_akhir = null, $kdbank = null) {
        $d_sppm = new DataSppm($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if ($kdbank != 'null') {
            if ($kdbank != 5) {
                $filter[$no++] = "BANK_ACCOUNT_NAME LIKE '%" . $kdbank . "%'";
            }
        }
        if ($kdtgl_awal != 'null' OR $kdtgl_akhir != 'null') {
            $filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (" . date('Ymd', strtotime($kdtgl_awal)) . ",'YYYYMMDD') 
									AND TO_DATE (" . date('Ymd', strtotime($kdtgl_akhir)) . ",'YYYYMMDD')  ";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $filter[$no++] = "CHECK_AMOUNT < 1";
        $this->view->data = $d_sppm->get_sp2d_minus($filter);

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        $this->view->load('kppn/sp2dNilaiMinus_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function sp2dSudahVoid_PDF($kdkppn = null, $kdtgl_awal = null, $kdtgl_akhir = null, $kdbank = null) {
        $d_sppm = new DataSppm($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if ($kdbank != 'null') {
            if ($kdbank != 5) {
                $filter[$no++] = "BANK_ACCOUNT_NAME LIKE '%" . $kdbank . "%'";
            }
        }

        if ($kdtgl_awal != 'null' OR $kdtgl_akhir != 'null') {
            $filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (" . date('Ymd', strtotime($kdtgl_awal)) . ",'YYYYMMDD') 
									AND TO_DATE (" . date('Ymd', strtotime($kdtgl_akhir)) . ",'YYYYMMDD')  ";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->data = $d_sppm->get_sp2d_sudah_void($filter);

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        $this->view->load('kppn/sp2dSudahVoid_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function sp2dGajiDobel_PDF($kdkppn = null) {

        $d_sppm = new DataSppm($this->registry);
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $kppn = "KDKPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        } else {
            $kppn = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if ($kdbulan != 13) {
            $bulan = $kdbulan;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->data = $d_sppm->get_sp2d_gaji_dobel($bulan, $kppn);
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        //var_dump($d_sppm->get_sppm_filter($filter));
        $this->view->load('kppn/sp2dGajiDobel_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function sp2dSalahTanggal_PDF($kdkppn = null) {
        $d_sppm = new DataSppm($this->registry);

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $kppn = " AND KDKPPN = '" . $kdkppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
            }
            $this->view->data = $d_sppm->get_sp2d_gaji_tanggal($kppn);

            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            if ($kdkppn != 'null') {
                $kppn = " AND KDKPPN = '" . $kdkppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
            }
            $this->view->data = $d_sppm->get_sp2d_gaji_tanggal($kppn);

            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (session::get('role') == KPPN) {
            $kppn = " AND KDKPPN = '" . Session::get('id_user') . "'";
            $this->view->data = $d_sppm->get_sp2d_gaji_tanggal($kppn);
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        //var_dump($d_sppm->get_sppm_filter($filter));
        $this->view->load('kppn/sp2dGajiTanggal_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function sp2dSalahBank_PDF($kdkppn = null) {
        $d_sppm = new DataSppm($this->registry);
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $kppn = " AND KDKPPN = '" . $kdkppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
            }
            $this->view->data = $d_sppm->get_sp2d_gaji_bank($kppn);

            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            if ($kdkppn != 'null') {
                $kppn = " AND KDKPPN = '" . $kdkppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
            }
            $this->view->data = $d_sppm->get_sp2d_gaji_bank($kppn);

            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (session::get('role') == KPPN) {
            $kppn = " AND KDKPPN = '" . Session::get('id_user') . "'";
            $this->view->data = $d_sppm->get_sp2d_gaji_bank($kppn);
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        $this->view->load('kppn/sp2dGajiBank_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function sp2dSalahRekening_PDF($kdkppn = null) {
        $d_sppm = new DataSppm($this->registry);
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $kppn = " AND KDKPPN = '" . $kdkppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
            }
            $this->view->data = $d_sppm->get_sp2d_gaji_rekening($kppn);

            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            if ($kdkppn != 'null') {
                $kppn = " AND KDKPPN = '" . $kdkppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
            }
            $this->view->data = $d_sppm->get_sp2d_gaji_rekening($kppn);

            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (session::get('role') == KPPN) {
            $kppn = " AND KDKPPN = '" . Session::get('id_user') . "'";
            $this->view->data = $d_sppm->get_sp2d_gaji_rekening($kppn);
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        //var_dump($d_sppm->get_sppm_filter($filter));
        $this->view->load('kppn/sp2dGajiRekening_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function detailSp2dGaji_PDF($kdbank = null, $kdbulan = null,$kdtahun = null, $kdkppn = null) {
        $d_sppm = new DataSppm($this->registry);
        $filter = array();
        $no = 0;
        $d_kppn_list = new DataUser($this->registry);

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        //handle filter dari UI
        if ($kdbank == 'BNI') {
            $bank1 = 'gaji-BNI';
        } else if ($kdbank == 'BRI') {
            $bank1 = 'GAJI BRI';
        } else if ($kdbank == 'BTN') {
            $bank1 = 'GAJI-BTN';
        } else if ($kdbank == 'MANDIRI') {
            $bank1 = 'GAJI-MDRI';
        }
        if (!is_null($kdbank)) {
            $filter[$no++] = "BANK_ACCOUNT_NAME LIKE '%" . $bank1 . "%'";
        }
        if (!is_null($kdbulan)) {
            if ($kdbulan != 'all') {
                $filter[$no++] = "to_char(PAYMENT_DATE,'mm') = '" . $kdbulan . "'";
            }
        }
		if (!is_null($kdtahun)) {
                $filter[$no++] = "to_char(PAYMENT_DATE,'yyyy') = '" . $kdtahun . "'";
                $this->view->d_tahun = $kdtahun;
        } 
        if (!is_null($kdkppn)) {
            $filter[$no++] = " KDKPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        } else {
            $kdkppn = Session::get('kd_satker');
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        /* pembatasan akses dari session, inputan adalah nama kolom dan isi kolom yang ingin dibatasi.
          contoh : disini yang dibatasi adalah kolom KPPN dalam tabel t_satker dengan isian sesuai dengan variabel input $kdkppn */
        if ($d_kppn_list->get_akses_kppn_satker("KPPN", $kdkppn)) {
            $this->view->data = $d_sppm->get_detail_sp2d_gaji($filter);
        } else {
            $this->view->data = '';
        }
        $this->view->load('kppn/detailSp2dGaji_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function detailRekapSP2D2_PDF($kdbank = null, $kdjendok = null, $kdtgl_awal = null, $kdtgl_akhir = null, $kdkppn = null) {
        $d_sppm = new DataSppm($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        /* pembatasan akses dari session, karena yang dibatasi hanya variabel $kdkppn, 
          maka pembatasan data dibawah hanya membatasi kolom KDKPPN di database */
        if (Session::get('role') == ADMIN) {
            //do nothing karena untuk menu ini, ADMIN tidak dibatasi untuk mengambil data
        }
        if (Session::get('role') == SATKER) {
            //do nothing karena untuk menu ini, SATKER tidak bisa mengakses menu ini, if untuk satker bisa dihilangkan
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = " KDKPPN = " . Session::get('id_user');
        }
        if (Session::get('role') == PKN) {
            //do nothing karena untuk menu ini, PKN tidak bisa mengakses menu ini, if untuk pkn bisa dihilangkan
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $kppn_list2 = '0';
            foreach ($kppn_list as $value1) {
                $kppn_list2 .= "," . $value1->get_kd_d_kppn();
            }
            $filter[$no++] = " KDKPPN in ( " . $kppn_list2 . ") ";
            $this->view->kppn_list = $kppn_list;
        }
        if (Session::get('role') == DJA) {
            //do nothing karena untuk menu ini, DJA tidak bisa mengakses menu ini, if untuk dja bisa dihilangkan
        }

        //handle filter dari UI
        if ($kdbank == 'BNI') {
            $bank1 = 'BNI';
        } else if ($kdbank == 'BRI') {
            $bank1 = 'BRI';
        } else if ($kdbank == 'BTN') {
            $bank1 = 'BTN';
        } else if ($kdbank == 'MANDIRI') {
            $bank1 = 'MDRI';
        }
        if (!is_null($kdbank)) {
            $filter[$no++] = "BANK_ACCOUNT_NAME LIKE '" . $bank1 . "'";
        }
        if (!is_null($kdjendok)) {
            $filter[$no++] = "JENDOK = '" . $kdjendok . "'";
        }
        if ((!is_null($kdtgl_awal)) AND ( !is_null($kdtgl_akhir))) {
            $filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE ('" . date('Ymd', strtotime($kdtgl_awal)) . "','YYYYMMDD') 
									AND TO_DATE ('" . date('Ymd', strtotime($kdtgl_akhir)) . "','YYYYMMDD')  ";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }
        if (!is_null($kdkppn)) {
            $filter[$no++] = " KDKPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $this->view->data = $d_sppm->get_detail_sp2d_rekap($filter);

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        //var_dump($d_sppm->get_sppm_filter($filter));

        $this->view->load('kppn/detailSp2dRekap_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    //baru
    public function sp2dRekap_PDF($kdkppn = null, $kdtgl_awal = null, $kdtgl_akhir = null) {
        $d_sppm = new DataSppm($this->registry);

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $filter[$no++] = " KDKPPN = '" . $kdkppn . "'";
        } else {
            $filter[$no++] = " KDKPPN = '" . Session::get('id_user') . "'";
        }
        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {
            $filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE ('" . date('Ymd', strtotime($kdtgl_awal)) . "','YYYYMMDD') 
									AND TO_DATE ('" . date('Ymd', strtotime($kdtgl_akhir)) . "','YYYYMMDD')  ";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }
        $this->view->data = $d_sppm->get_sp2d_rekap($filter);

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }


        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        //var_dump($d_sppm->get_sp2d_rekap($filter));
        $this->view->load('kppn/sp2dRekap_PDF');
        $d_log->tambah_log("Sukses");
    }

    public function sp2dCompareGaji_PDF($kdkppn = null,$kdtahun = null) {
        $d_sppm = new DataSppm($this->registry);

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if ($kdtahun != 'null') {
            
			$this->view->kdtahun = $kdtahun;
		}


        if (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $kppn = " AND KDKPPN = '" . $kdkppn . "'";
            }
			if ($kdtahun != 'null') {
                $tahun = $kdtahun;
            }
            $this->view->data = $d_sppm->get_sp2d_gaji_bulan_lalu($kppn,$tahun);

            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            if ($kdkppn != 'null') {
                $kppn = " AND KDKPPN = '" . $kdkppn . "'";
            }			
			if ($kdtahun != 'null') {
                $tahun = $kdtahun;
            }
            $this->view->data = $d_sppm->get_sp2d_gaji_bulan_lalu($kppn,$tahun);


            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (session::get('role') == KPPN) {
            $kppn = " AND KDKPPN = '" . Session::get('id_user') . "'";
			if ($kdtahun != 'null') {
                $tahun = $kdtahun;
            }
            $this->view->data = $d_sppm->get_sp2d_gaji_bulan_lalu($kppn,$tahun);

        
		}

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        //var_dump($d_sppm->get_sppm_filter($filter));
			$this->view->load('kppn/sp2dGajiBulanLalu_PDF');
        $d_log->tambah_log("Sukses");
    }

//------------------------------------------------------
//Function PDF untuk DataReturController(DataReturController.php)
//------------------------------------------------------
    public function monitoringRetur_PDF($kdkppn = null, $kdnosp2d = null, $kdbarsp2d = null, $kdsatker = null, $kdbank = null, $kdstatus = null, $kdtgl_awal = null, $kdtgl_akhir = null) {
        $d_retur = new DataRetur($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        } else {
            $filter[$no++] = "KDKPPN = " . Session::get('id_user');
        }
        if ($kdnosp2d != 'null') {
            $filter[$no++] = "SP2D_NUMBER = '" . $kdnosp2d . "'";
        }
        if ($kdbarsp2d != 'null') {
            $filter[$no++] = "RECEIPT_NUMBER = '" . $kdbarsp2d . "'";
        }
        if ($kdsatker != 'null') {
            $filter[$no++] = "KDSATKER = '" . $kdsatker . "'";
        }
        if ($kdbank != 'null') {
            if ($kdbank != 'SEMUA') {
                $filter[$no++] = "BANK_ACCOUNT_NAME LIKE '%" . $kdbank . "%'";
            }
        }
        if ($kdstatus != 'null') {
            if ($kdstatus != 'SEMUA') {
                $filter[$no++] = "STATUS_RETUR = '" . $kdstatus . "'";
            }
        }
        if ($kdtgl_awal != 'null' OR $kdtgl_akhir != 'null') {
            $filter[$no++] = "STATEMENT_DATE BETWEEN TO_DATE (" . date('Ymd', strtotime($kdtgl_awal)) . ",'YYYYMMDD') 
									AND TO_DATE (" . date('Ymd', strtotime($kdtgl_akhir)) . ",'YYYYMMDD')  ";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        if (Session::get('role') == SATKER) {
            $filter[$no++] = " KDSATKER = '" . Session::get('kd_satker') . "'";
            $this->view->d_satker = Session::get('kd_satker');
        }
        $this->view->data = $d_retur->get_retur_filter($filter);

        if (Session::get('role') == ADMIN OR Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_retur->get_table());

        //var_dump($d_sppm->get_sppm_filter($filter));

        $this->view->load('kppn/daftarRetur_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function monitoringReturPkn_PDF($kdkppn = null, $kdbank = null, $kdtgl_awal = null, $kdtgl_akhir = null) {
        $d_retur = new DataRetur($this->registry);
        $d_kppn_list = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = " . $kdkppn;
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        }
        if ($kdbank != 'null') {
            if ($kdbank != 'SEMUA') {
                $filter[$no++] = "BANK_ACCOUNT_NAME LIKE '%" . $kdbank . "%'";
            }
        }
        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {
            $filter[$no++] = "STATEMENT_DATE BETWEEN TO_DATE (" . date('Ymd', strtotime($kdtgl_awal)) . ",'YYYYMMDD') 
									AND TO_DATE (" . date('Ymd', strtotime($kdtgl_akhir)) . ",'YYYYMMDD')  ";

            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $this->view->data = $d_retur->get_retur_pkn_filter($filter);



        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_retur->get_table());

        //var_dump($d_sppm->get_sppm_filter($filter));

        $this->view->load('kppn/daftarReturPKN_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

//------------------------------------------------------
//Function PDF untuk DataSPMController(DataSPMController.php)
//------------------------------------------------------
    public function posisiSpm_PDF($kdkppn = null) {
        $d_spm1 = new DataHistSPM($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
        } else {
            $filter[$no++] = " SUBSTR(INVOICE_NUM,8,6) = '" . Session::get('kd_satker') . "'";
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = " SUBSTR(INVOICE_NUM,8,6) = '" . Session::get('kd_satker') . "'";
            $this->view->d_satker = Session::get('kd_satker');
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_hist_spm_filter($filter);

        $this->view->load('kppn/posisiSPM_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function detailposisiSpm_PDF($invoice_num1 = null, $invoice_num2 = null, $invoice_num3 = null) {
        $d_spm1 = new DataHistSPM($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (!is_null($invoice_num1)) {
            $filter[$no++] = "INVOICE_NUM =  '" . $invoice_num1 . "/" . $invoice_num2 . "/" . $invoice_num3 . "'";
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $this->view->data = $d_spm1->get_hist_spm_filter($filter);

        $this->view->load('kppn/detailposisiSPM_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function HoldSpm_PDF($kdkppn = null, $status = null,$invoice_num1 = null, $invoice_num2 = null, $invoice_num3 = null) {
        $d_spm1 = new DataHoldSPM($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		$invoice = "'" . $invoice_num1 . "/" . $invoice_num2 . "/" . $invoice_num3 . "'";
		$invoice = substr($invoice,1,18);

        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
        }
        if ($invoice_num1 != 'null') {
            $filter[$no++] = "invoice_num = '" . $invoice . "'";
        }
        if ($status != 'null') {
			if ($status == 1) {
                    $filter[$no++] = "A.CANCELLED_DATE IS NULL ";
                } elseif ($status == 2) {
                    $filter[$no++] = "A.CANCELLED_DATE IS NOT NULL";
				}
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = " . Session::get('id_user');
			$this->view->d_kppn = Session::get('id_user');
            $this->view->data = $d_spm1->get_hold_spm_filter($filter);
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			$filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = " SUBSTR(INVOICE_NUM,8,6) = '" . Session::get('kd_satker') . "'";
            $this->view->d_satker = Session::get('kd_satker');
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->data = $d_spm1->get_hold_spm_filter($filter);

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table2());

        $this->view->load('kppn/holdSPM_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function HistorySpm_PDF($invoice_num1 = null, $invoice_num2 = null, $invoice_num3 = null, $sp2d = null, $kdkppn = null) {
        $d_spm1 = new DataHistorySPM($this->registry);
        $filter = array();
        $invoice = '';
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = Session::get('id_user')
            ;
        }
        if (!is_null($invoice_num1) and Session::get('role') == KPPN) {
            $invoice = "'" . $invoice_num1 . "/" . $invoice_num2 . "/" . $invoice_num3 . "'";
            $kdkppn = Session::get('id_user');
            $filter[$no++] = $kdkppn;
            $this->view->invoice_num = $invoice_num;
            $this->view->data = $d_spm1->get_history_spm_filter($filter, $invoice);
        } elseif (!is_null($invoice_num1) and Session::get('role') == SATKER) {
            $satker = Session::get('kd_satker');
            $invoice = "'" . $invoice_num1 . "/" . $satker . "/" . $invoice_num3 . "'";
            $kdkppn = Session::get('id_user');
            $filter[$no++] = $kdkppn;
            $this->view->invoice_num = $invoice_num;
            $this->view->data = $d_spm1->get_history_spm_filter($filter, $invoice);
        } elseif (!is_null($invoice_num1) and ( Session::get('role') == KANWIL OR Session::get('role') == ADMIN)) {
            $invoice = "'" . $invoice_num1 . "/" . $invoice_num2 . "/" . $invoice_num3 . "'";
			//var_dump($invoice);
            $kppn = substr($sp2d, 2, 3);
			//$kppn = substr($invoice_num1, 2, 3);
            $filter[$no++] = $kdkppn;
            //$filter_kanwil = "SUBSTR(NO_SP2D,3,3) IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '". Session::get('id_user') . "')";
            $this->view->invoice_num = $invoice_num;
            $this->view->data = $d_spm1->get_history_spm_filter($filter, $invoice);
        }

        if ($kdkppn != 'null') {
            $filter[$no++] = $kdkppn;
        } else {
            $filter[$no++] = Session::get('id_user');
        }
        if ($invoice != 'null') {
            $invoice = $invoice;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $this->view->data = $d_spm1->get_history_spm_filter($filter, $invoice);
        $this->view->load('kppn/historySPM_PDF');
		//$this->view->render('kppn/historySPM');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function daftarsp2d_PDF($kdsatker = null, $check_number = null, $invoice = null, $JenisSP2D = null, $JenisSPM = null, $kdtgl_awal = null, $kdtgl_akhir = null) {
        $d_spm1 = new DataCheck($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
		 }
		 else {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
		 }

        if ($kdsatker != 'null') {
            if (Session::get('role') == SATKER) {
                if (Session::get('kd_satker') != $kdsatker) {
                    header('location:' . URL . 'auth/logout');
                    exit();
                } else {
                    $filter[$no++] = " SEGMENT1 =  '" . Session::get('kd_satker') . "'";
                }
            } else {
                $filter[$no++] = " SEGMENT1 =  '" . $kdsatker . "'";
            }
        }
        if ($check_number != 'null') {
            $filter[$no++] = "check_number = '" . $check_number . "'";
        }
        if ($invoice != 'null') {
            $filter[$no++] = "invoice_num = '" . $invoice . "'";
        }
        if ($JenisSP2D != 'null') {
            $filter[$no++] = "JENIS_SP2D = '" . $JenisSP2D . "'";
        }
        if ($JenisSPM != 'null') {
            $filter[$no++] = "JENIS_SPM = '" . $JenisSPM . "'";
        }
        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {
            $filter[$no++] = "CHECK_DATE BETWEEN TO_DATE('" . $kdtgl_awal . "','DD/MM/YYYY hh:mi:ss') AND TO_DATE('" . $kdtgl_akhir . "','DD/MM/YYYY hh:mi:ss')";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");
            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "SEGMENT1 = '" . Session::get('kd_satker') . "'";
        }
        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
            ;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        if ($kdsatker != 'null') {
            $this->view->data = $d_spm1->get_sp2d_satker_filter($filter);
        }

        $this->view->data2 = $d_spm1->get_jenis_spm_filter($kdsatker);

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        //var_dump($d_spm1->get_satker_filter($filter));
        if (Session::get('id_user') == 140) {
            $this->view->load('kppn/SP2DSatker140_PDF');
            //untuk mencatat log user
            $d_log->tambah_log("Sukses");
        } else {
            $this->view->load('kppn/SP2DSatker_PDF');
            //untuk mencatat log user
            $d_log->tambah_log("Sukses");
        }
    }

    public function detailrekapsp2d1_PDF($jenis_spm = null, $kdkppn = null, $kdtgl_awal = null, $kdtgl_akhir = null) {
        $d_spm1 = new DataCheck($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYY') = '2015'";
		 }else {
			$filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYY') = '2014'";
		 }

        if ($jenis_spm != 'null') {
            $filter[$no++] = " JENDOK =  '" . $jenis_spm . "'";
        }
        if ($kdkppn != 'null' AND Session::get('role') == KANWIL AND $kdkppn != 'null') {
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        } elseif ($kdkppn != 'null') {
            $filter[$no++] = " SUBSTR(CHECK_NUMBER,3,3) =  '" . $kdkppn . "'";
        }
        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {

            $filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($kdtgl_awal)) . "' AND '" . date('Ymd', strtotime($kdtgl_akhir)) . "'";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        if (Session::get('role') == KPPN) {
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "SUBSTR(INVOICE_NUM,8,6) = '" . Session::get('kd_satker') . "'";
        }
        $this->view->data = $d_spm1->get_sp2d_satker_filter($filter);

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->load('kppn/Rekap_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    public function ValidasiSpm_PDF($kdkppn = null, $filename = null, $kdsatker = null, $kdtgl_awal = null, $kdtgl_akhir = null) {
        $d_spm1 = new DataValidasiUploadSPM($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if ($kdkppn != 'null') {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }

        if ($kdsatker != 'null') {
            $filter[$no++] = "substr(invoice_num,8,6) = '" . $kdsatker . "'";
        }
        if ($filename != 'null') {
            $filter[$no++] = " upper(file_name) = upper('" . $filename . "')";
        }
        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {
            $filter[$no++] = "CREATION_DATE BETWEEN TO_DATE('" . $kdtgl_awal . " 00:00:01','DD/MM/YYYY hh24:mi:ss') AND TO_DATE('" . $kdtgl_akhir . " 23:59:59','DD/MM/YYYY hh24:mi:ss')";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------



        $this->view->data = $d_spm1->get_validasi_spm_filter($filter);


        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";



            if ($kdsatker == 'null' || $filename == 'null' || $kdtgl_awal == 'null' || $kdtgl_akhir == 'null') {
                $filter[$no++] = " creation_date in 
							(select max(creation_date) from SPPM_AP_INV_INT_ALL where KDKPPN = '" . Session::get('id_user') . "'
							and STATUS_CODE = 'Validasi gagal') ";
            }
            $this->view->data = $d_spm1->get_validasi_spm_filter($filter);
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = " SUBSTR(INVOICE_NUM,8,6) = '" . Session::get('kd_satker') . "'";
            $this->view->d_satker = Session::get('kd_satker');
            $this->view->data = $d_spm1->get_validasi_spm_filter($filter);
        }
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/validasiuploadSPM_PDF');
    }

    public function DurasiSpm_PDF($kdkppn = null, $invoice = null, $jenisspm = null, $durasi = null, $kdtgl_awal = null, $kdtgl_akhir = null, $kdsatker = null) {
        $d_spm1 = new DataDurasiSPM($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdkppn != 'null' AND ( $invoice != 'null' or $jenisspm != 'null' or $kdsatker != 'null' or $jenisspm != 'null' or $durasi != 'null' or $kdtgl_awal != 'null')) {
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
        } elseif ($kdkppn != 'null') {
            $filter[$no++] = " to_date(tanggal_upload,'dd-MM-yyyy') in (select max(to_date(tanggal_upload,'dd-MON-yyyy'))
								from DURATION_INV_ALL_V where KDKPPN = '" . $kdkppn . "')";
            $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
			
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }

        if ($invoice != 'null') {
            $filter[$no++] = "invoice_num = '" . $invoice . "'";
        }
        if ($kdsatker != 'null') {
            $filter[$no++] = "substr(invoice_num,8,6) = '" . $kdsatker . "'";
        }
        if ($jenisspm != 'null') {
            $filter[$no++] = "jendok = '" . $jenisspm . "'";
        }
        if ($durasi != 'null') {
            if ($durasi == '1') {
                $filter[$no++] = "durasi2 < 1";
            }
            if ($durasi == '2') {
                $filter[$no++] == "durasi2 > 1 and durasi2 < 24";
            }
            if ($durasi == '3') {
                $filter[$no++] = "durasi2 > 24";
            }
        }
        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {
            $filter[$no++] = "TANGGAL_UPLOAD BETWEEN to_date('" . $kdtgl_awal . "','dd-mm-yyyy') AND to_date('" . $kdtgl_akhir . "' ,'dd-mm-yyyy')";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;

            /* $this->view->kdtgl_awal = $kdtgl_awal;
              $this->view->kdtgl_akhir = $kdtgl_akhir; */
        }

        $this->view->data = $d_spm1->get_durasi_spm_filter($filter);

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            //$filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '". Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            if ($invoice == 'null' && $jenisspm == 'null' && $kdsatker == 'null' && $jenisspm == 'null' && $durasi == 'null' && $kdtgl_awal == 'null' && $kdtgl_akhir == 'null') {
                $filter[$no++] = " to_date(tanggal_upload,'dd-MM-yyyy') = (select max(to_date(tanggal_upload,'dd-MON-yyyy'))
								from DURATION_INV_ALL_V where KDKPPN = '" . Session::get('id_user') . "')";
                $this->view->data = $d_spm1->get_durasi_spm_filter($filter);
            }
        }
        $this->view->data2 = $d_spm1->get_jendok_spm_filter();
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->load('kppn/DurasiSPM_PDF');

        $d_log->tambah_log("Sukses");
    }

    public function nmsatkerSP2D_PDF($kdkppn = null, $kdsatker = null, $nmsatker = null, $kdtgl_awal = null, $kdtgl_akhir = null) {
        $d_spm1 = new DataNamaSatker($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
		 }
		 else {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
		 }

        if ($kdkppn != 'null') {
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) = '" . $kdkppn . "'";
        } else {
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) = '" . Session::get('id_user') . "'";
        }

        if ($kdsatker != 'null') {
            $filter[$no++] = "SEGMENT1 = '" . $kdsatker . "'";
        }
        if ($nmsatker != 'null') {
            $filter[$no++] = " UPPER(NMSATKER) LIKE UPPER('%" . $nmsatker . "%')";
        }
        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {

            $filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($kdtgl_awal)) . "' AND '" . date('Ymd', strtotime($kdtgl_akhir)) . "'";

            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }

        $this->view->data = $d_spm1->get_satker_filter($filter);

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_satker_filter($filter);
        }

        $this->view->load('kppn/NamaSatker_PDF');
        $d_log->tambah_log("Sukses");
    }

    public function RekapSp2d_PDF($kdkppn = null, $kdtgl_awal = null, $kdtgl_akhir = null) {
        $d_spm1 = new DataCheck($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYY') = '2015'";
		 }
		 else {
			$filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYY') = '2014'";
		 }
        if ($kdkppn != 'null') {
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) IN ( '" . $kdkppn . "')";
        } elseif (Session::get('role') == KANWIL) {
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        } elseif (Session::get('role') == ADMIN) {
            
        }

        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {
            $filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($kdtgl_awal)) . "' AND '" . date('Ymd', strtotime($kdtgl_akhir)) . "'";

            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }

        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $this->view->data = $d_spm1->get_sp2d_rekap_kanwil_filter($filter);
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            $this->view->data = $d_spm1->get_sp2d_rekap_admin_filter($filter);
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_sp2d_rekap_filter($filter);
        }

        if (Session::get('role') == SATKER) {
            $filter[$no++] = "SUBSTR(CHECK_NUMBER,3,3) = '" . Session::get('id_user') . "'";
            $filter[$no++] = "SUBSTR(INVOICE_NUM,8,6) = '" . Session::get('kd_satker') . "'";
            $this->view->data = $d_spm1->get_sp2d_rekap_filter($filter);
        }

        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/RekapSP2D_PDF');
    }

    //BARU
    public function errorSpm_PDF($file_name = null) {
        $d_spm1 = new DataUploadSPM($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (!is_null($file_name)) {
            $filter[$no++] = "FILE_NAME =  '" . $file_name . "'";
            //$this->view->invoice_num = $invoice_num;
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "SUBSTR(FILE_NAME,8,6) = '" . Session::get('kd_satker') . "'";
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $this->view->data = $d_spm1->get_error_spm_filter($filter);
        //var_dump($d_spm1->get_error_spm_filter ($filter));

        $this->view->load('kppn/uploadSPM_PDF');

        $d_log->tambah_log("Sukses");
    }
	
		public function KonversiSPM_PDF($kdkppn = null) {
        $d_spm1 = new DataADKKonversi($this->registry);
        $filter = array();
		//$filter2 = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
            if ($kdkppn != 'null') {
                $filter[$no++] = "KDKPPN = '" . $kdkppn."'";
                $d_kppn = new DataUser($this->registry);
                //$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
				
            } 
			if (Session::get('role') == KANWIL){
			$filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
			}
			$this->view->data = $d_spm1->get_adk_konversi($filter);
			$this->view->data1 = $d_spm1->get_jml_adk_konversi($filter);
		
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KDKPPN = '" . Session::get('id_user')."'";
			$this->view->data = $d_spm1->get_adk_konversi($filter);
			$this->view->data1 = $d_spm1->get_jml_adk_konversi($filter);
        }
		
		if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
		        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

		
		
		$d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table());
		
        //var_dump($d_spm1->get_adk_konversi(filter));
		
		$d_log->tambah_log("Sukses");
        $this->view->load('kppn/KonversiSPM_PDF');
    }

    //------------------------------------------------------
    //Function PDF untuk DataPelimpahanController(daftarPelimpahan.php)
    //------------------------------------------------------
    public function monitoringPelimpahan_PDF($kdkppn_anak = null, $kdkppn_induk = null, $kdstatus = null,$kdnorek= null, $kdtgl_awal = null, $kdtgl_akhir = null) {
        $d_limpah = new DataPelimpahan($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

		if (Session::get('role') == ADMIN || Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_anak = $d_kppn_list->get_kppn_kanwil();
            $this->view->kppn_induk = $d_kppn_list->get_induk_limpah();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_anak = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $this->view->kppn_induk = $d_kppn_list->get_induk_limpah(Session::get('id_user'));
        }
        if (Session::get('role') == KPPN) {
            $d_kppn_list = new DataUser($this->registry);
            $kppn_list = $d_kppn_list->get_induk_limpah_kppn(Session::get('id_user'));
            if (count($kppn_list) > 1) {
                $filter[$no++] = "KPPN_INDUK= '" . Session::get('id_user') . "'";
            }
            
        }
        if ($kdkppn_anak != 'null') {
            if ($kdkppn_anak != 'SEMUA') {
                $filter[$no++] = "KPPN_ANAK = '" . $kdkppn_anak . "'";
            }
        } else {
            $filter[$no++] = "KPPN_ANAK= '" . Session::get('id_user') . "'";
        }

        if ($kdkppn_induk != 'null') {
            if ($kdkppn_induk != 'SEMUA') {
                $filter[$no++] = "KPPN_INDUK = '" . $kdkppn_induk . "'";
            }
        }
		if ($kdnorek != 'null') {
				$filter[$no++] = "NOREK_PERSEPSI = '" . $kdnorek . "'";
				$this->view->d_no_rek_persepsi = $kdnorek;
            }

        if ($kdstatus != 'null') {
            if ($kdstatus != 'SEMUA') {
                $filter[$no++] = "STATUS = '" . $kdstatus . "'";
            }
        }
        if ($kdtgl_awal != 'null' AND $kdtgl_akhir != 'null') {
            $filter[$no++] = "TGL_LIMPAH BETWEEN TO_DATE ('" . date('Ymd', strtotime($kdtgl_awal)) . "','YYYYMMDD') 
								AND TO_DATE ('" . date('Ymd', strtotime($kdtgl_akhir)) . "','YYYYMMDD')  ";
            $tglawal = array("$kdtgl_awal");
            $tglakhir = array("$kdtgl_akhir");

            $this->view->kdtgl_awal = $tglawal;
            $this->view->kdtgl_akhir = $tglakhir;
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        
        $this->view->data = $d_limpah->get_limpah_filter($filter);
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_limpah->get_table());

        $this->view->load('kppn/daftarPelimpahan_PDF');
		//$this->view->render('kppn/daftarPelimpahan');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    //------------------------------------------------------
    //Function PDF untuk DataSupplierController(DataSupplierController.php)
    //------------------------------------------------------
//cekSupplier
    public function cekSupplier_PDF($kdkppn = null, $kdtipesup = null, $kdnrs = null, $kdnamasupplier = null, $kdnpwpsupplier = null, $kdnip = null, $kdnamapenerima = null, $kdnorek = null, $kdnamarek = null, $kdnpwppenerima = null) {
        $d_supp = new DataSupplier($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            //$filter[$no++] = "KPPN_CODE = '" . Session::get('kd_satker') . "'";
        }
        if (Session::get('role') == SATKER) {
            //$filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
        }


        if ($kdkppn != 'null') {
            //$filter[$no++] = "KPPN_CODE = '" . $kdkppn . "'";
        }

        if ($kdtipesup != 'null') {
            $filter[$no++] = "substr(TIPE_SUPP,1,1) = '" . $kdtipesup . "'";
        }

        if ($kdnrs != 'null') {
            $filter[$no++] = " upper(v_supplier_number) like 'upper(%" . $kdnrs . "%')";
        }

        if ($kdnamasupplier != 'null') {
            $filter[$no++] = " upper(nama_supplier) like upper('%" . $kdnamasupplier . "%')";
        }

        if ($kdnpwpsupplier != 'null') {
            $filter[$no++] = " upper(npwp_supplier) like upper('%" . $kdnpwpsupplier . "%')";
        }

        if ($kdnip != 'null') {
            $filter[$no++] = " upper(nip_penerima) like upper('%" . $kdnip . "%')";
        }

        if ($kdnamapenerima != 'null') {
            $filter[$no++] = " upper(nm_penerima) like upper('%" . $kdnamapenerima . "%')";
        }

        if ($kdnorek != 'null') {
            $filter[$no++] = " upper(norek_bank) like upper('%" . $kdnorek . "%')";
        }

        if ($kdnamarek != 'null') {
            $filter[$no++] = " upper(nm_pemilik_rek) like upper('%" . $kdnamarek . "%')";
        }

        if ($kdnpwppenerima != 'null') {
            $filter[$no++] = " upper(npwp_penerima) like upper('%" . $kdnpwppenerima . "%')";
        }
        $this->view->data = $d_supp->get_supp_filter($filter);


        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_supp->get_table());

        $this->view->load('satker/isianSupplier_PDF');
        $d_log->tambah_log("Sukses");
    }

    //------------------------------------------------------
    //Function PDF untuk DataUserController(DataUserController.php)
    //------------------------------------------------------
    //------------------------------------------------------
    //Function PDF untuk UserSpanController(UserSpanController.php)
    //------------------------------------------------------
    public function monitoringUserSpan_PDF($kdkppn = null, $kdnip = null) {   //nama function
        $d_user = new DataUserSPAN($this->registry); //model
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        $filter = array();
        if ($kdkppn != 'null') {
            $filter[$no++] = " KDKPPN = '" . $kdkppn . "'";
        }
        if ($kdnip != 'null') {
            $filter[] = " USER_NAME = '" . $kdnip . "'";
        }
        $this->view->data = $d_user->get_user_filter($filter);

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = " KDKPPN = " . Session::get('id_user');
            $this->view->data = $d_user->get_user_filter($filter);
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------


        $this->view->load('kppn/monitoringUser_PDF');
        //untuk mencatat log user
        $d_log->tambah_log("Sukses");
    }

    //------------------------------------------------------
    //Function PDF untuk DataPNBPController(DataPNBPController.php)
    //------------------------------------------------------
    public function KarwasPNBP_PDF($kdkppn = null, $kdppp = null, $kdsatker = null) {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if (Session::get('role') == KPPN) {
            $this->view->data5 = $d_spm1->get_satker_pnbp(Session::get('id_user'));
        }


        if ($kdkppn != 'null') {
            $filter[$no++] = "KPPN_CODE = '" . $kdkppn . "'";
        } else {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
        }

        if ($kdppp != 'null') {
            $this->view->ppp = $kdppp;
        }

        if ($kdsatker != 'null') {
            $filter[$no++] = "SATKER_CODE = '" . $kdsatker . "'";
        }
        $this->view->data5 = $d_spm1->get_satker_pnbp(Session::get('id_user'));

        if ($kdsatker != 'null') {

            $this->view->data1 = $d_spm1->get_dipa_pnbp($filter);
            $this->view->data2 = $d_spm1->get_gr_pnbp($filter);
            $this->view->data3 = $d_spm1->get_sa_pnbp($filter);
            $this->view->data4 = $d_spm1->get_up_pnbp($filter);
            $this->view->data6 = $d_spm1->get_set_up_pnbp($filter);
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
        //var_dump($d_spm->get_hist_spm_filter());

        $d_log->tambah_log("Sukses");


        $this->view->load('kppn/karwasPNBP_PDF');
    }

    public function DetailDipaPNBP_PDF($kdakun = null, $kdsatker = null) {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
            $this->view->d_kppn = Session::get('id_user');
        }

        if ($kdakun != 'null') {
            $filter[$no++] = "SUBSTR(ACCOUNT_CODE,1,2) = '" . $kdakun . "'";
        }
        if ($kdsatker != 'null') {
            $filter[$no++] = "SATKER_CODE = '" . $kdsatker . "'";
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->data = $d_spm1->get_pnbp_dipa_line($filter);

        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/detail_dipa_pnbp_PDF');
    }

    public function DetailGRPNBP_PDF($kdakun = null, $kdsatker = null) {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
            $this->view->d_kppn = Session::get('id_user');
        }
        if ($kdakun != 'null') {
            $filter[$no++] = "ACCOUNT_CODE = '" . $kdakun . "'";
        }
        if ($kdsatker != 'null') {
            $filter[$no++] = "SATKER_CODE = '" . $kdsatker . "'";
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->data = $d_spm1->get_pnbp_gr_line($filter);



        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/detail_gr_pnbp_PDF');
    }

    public function DetailUPPNBP_PDF($kdakun = null, $kdsatker = null) {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "SEGMENT2 = '" . Session::get('id_user') . "'";
            $this->view->d_kppn = Session::get('id_user');
        }
        if ($kdakun != 'null') {
            $filter[$no++] = "JENIS_SPM = '" . $kdakun . "'";
        }
        if ($kdsatker != 'null') {
            $filter[$no++] = "SATKER_CODE = '" . $kdsatker . "'";
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->data = $d_spm1->get_pnbp_up_line($filter);



        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/detail_up_pnbp_PDF');
    }

    public function DetailBelanjaPNBP_PDF($kdakun = null, $kdsatker = null) {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "SEGMENT2 = '" . Session::get('id_user') . "'";
            $this->view->d_kppn = Session::get('id_user');
        }
        if ($kdakun != 'null') {
            $filter[$no++] = "SUBSTR(SEGMENT3,1,2) = '" . $kdakun . "'";
        }
        if ($kdsatker != 'null') {
            $filter[$no++] = "SATKER_CODE = '" . $kdsatker . "'";
            $this->view->nmsatker = $d_spm1->get_nama_satker_pnbp($kdsatker);
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->data = $d_spm1->get_pnbp_bel_line($filter);



        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/detail_belanja_pnbp_PDF');
    }

    public function DetailSetoranUPPNBP_PDF($kdakun = null, $kdsatker = null) {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
            $this->view->d_kppn = Session::get('id_user');
        }
        if ($kdakun != 'null') {
            $filter[$no++] = "ACCOUNT_CODE = '" . $kdakun . "'";
        }
        if ($kdsatker != 'null') {
            $filter[$no++] = "SATKER_CODE = '" . $kdsatker . "'";
        }
        //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

        $this->view->data = $d_spm1->get_pnbp_set_up_line($filter);



        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/detail_setoran_up_pnbp_PDF');
    }
	
	//------------------------------------------------------
    //Function PDF untuk DataBLUController(DataBLUController.php)
	//------------------------------------------------------
	
	    public function KarwasBLU_PDF($kdkppn = null, $kdsatker = null,$kdppp = null ) {
        $d_spm1 = new DataBLU($this->registry);
        $filter = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        		
		if ($kdkppn != 'null') {
			$filter[$no++] = "KPPN_CODE = '" . $kdkppn."'";
			$d_kppn = new DataUser($this->registry);
			$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
			
		} 
		
		if ($kdppp != 'null') {
			//$filter[$no++] = "SATKER_CODE = '" . $_POST['kdsatker'] . "'";
			$this->view->ppp = $kdppp;
		}
		
		if ($kdsatker != 'null') {
			$filter[$no++] = "SATKER_CODE = '" . $kdsatker . "'";
		}
       
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KDKPPN = '" . Session::get('id_user')."'";			
        }
				 //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

		$this->view->data = $d_spm1->get_rekap_sp3b($filter);
		
		$d_log->tambah_log("Sukses");
		
		$this->view->load('blu/karwasBLU_PDF');
    }
	
	public function DaftarSP3_PDF($bulan=null, $satker=null, $kdkppn=null, $kdsatker=null) {
        $d_spm1 = new DataBLU($this->registry);
        $filter = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		
		if ($bulan != 'null') {           
                $filter[$no++] = " TO_CHAR(CHECK_DATE,'MM') =  '" .$bulan. "'";
				$this->view->bulan = $bulan;				
        }
		
		if ($satker != 'null') {           
                $filter[$no++] = " SUBSTR(INVOICE_NUM,8,6) =  '" .$satker. "'";
				$this->view->satker = $satker;
				
        }
		
		
            if ($kdkppn != 'null') {
                $filter[$no++] = "KPPN_CODE = '" . $kdkppn."'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
				
            }
									
            if ($kdsatker != 'null') {
                $filter[$no++] = "SATKER_CODE = '" . $kdsatker . "'";
				$this->view->nmsatker = $d_spm1->get_nama_satker_pnbp($kdsatker);
            }
       
		
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KDKPPN = '" . Session::get('id_user')."'";			
        }
				 //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------

		$this->view->data = $d_spm1->get_daftar_sp3b($filter);
		$this->view->data1 = $d_spm1->get_kdsatker_blu($satker);
		
		$d_log->tambah_log("Sukses");
		$this->view->load('blu/daftarSP3_PDF');
    }

	
	public function CariSP3B_PDF($kdsatker=null, $kd_tgl_awal=null, $kd_tgl_akhir=null, $kdinvoice4=null) {
        $d_spm1 = new DataBLU($this->registry);
        $filter = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		
			if ($kdinvoice4 != 'null') {
				$kdinvoice1=substr($kdinvoice4,0,6);
				$kdinvoice2=substr($kdinvoice4,7,6);
				$kdinvoice3=substr($kdinvoice4,14,6);
				$kdinvoice4=$kdinvoice1.'/'.$kdinvoice2.'/'.$kdinvoice3;

                $filter[$no++] = "INVOICE_NUM = '" . $kdinvoice4 . "'";
				$this->view->invoice = $kdinvoice4;
            }
            if ($kdsatker != 'null') {
                $filter[$no++] = "SEGMENT1 = '" . $kdsatker . "'";
				$this->view->kdsatkerr = $kdsatker;
            }
			
			
			if ($kd_tgl_awal != 'null' AND $kd_tgl_akhir != 'null') {
                $filter[$no++] = "TO_CHAR(INVOICE_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($kd_tgl_awal)) . "' AND '" . date('Ymd', strtotime($kd_tgl_akhir)) . "'";

				$tglawal = array("$kd_tgl_awal");
				$tglakhir = array("$kd_tgl_akhir");
				//var_dump($tglawal);
				//var_dump($tglakhir);
				$this->view->kdtgl_awal = $tglawal;
				$this->view->kdtgl_akhir = $tglakhir;
            }
			 //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
		$this->view->data = $d_spm1->get_cari_sp3b($filter);
		
		
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KDKPPN = '" . Session::get('id_user')."'";			
        }
		
		
		$d_log->tambah_log("Sukses");
		$this->view->load('blu/cariSP3_PDF');
    }
	
	public function DataRealisasiBLU_PDF($kdsatker=null, $kdsumberdana=null) {
        $d_spm1 = new DataBLU($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
		
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        

            if ($kdsatker != 'null') {
                $filter[$no++] = "A.SATKER = '" . $kdsatker . "'";
                $this->view->satker_code = $kdsatker;
            }
			if ($kdsumberdana != 'null') {
                $filter[$no++] = "SUBSTR(A.DANA,1,1) = '" . $kdsumberdana . "'";
                $this->view->SumberDana = $kdsumberdana;
            }
            			
					 //-------------------------
        if (Session::get('role') == SATKER) {
            $d_nm_kppn1 = new DataUser($this->registry);
            $this->view->nm_kppn2 = $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
        } elseif (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } elseif (Session::get('role') == KANWIL) {
            $d_kppn = new DataUser($this->registry);
            $d_kppn->get_d_user_kppn($kdkppn);
            foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                $this->view->nm_kppn2 = Session::get('user') . ' - ' . $kppn->get_nama_user();
            }
        } else {
            $this->view->nm_kppn2 = Session::get('user');
        }
        //-------------------------
	
        

        //----------------------------------------------------
		
        $this->view->data = $d_spm1->get_realisasi_blu($filter);

        //$d_last_update = new DataLastUpdate($this->registry);
        //$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");
		$this->view->load('blu/RealisasiBLU_PDF');
    }
	//-------------------------------------------------------
		//------------------------------------------------------
    //Function PDF untuk DataPMRTPKNController(DataPMRTPKNController.php)
	//------------------------------------------------------
    public function DataSPMAkhirTahun_PDF($kdkppn = null,$kdjudul = null) {
        $d_pmrtpkn = new DataPMRTPKN($this->registry);
        $filter = array();
        $no = 0;
		
        $this->view->judul =$kdjudul;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        //narik list kppn
        $d_kppn_list = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();

            if ($kdkppn != 'null') {
                $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
                $this->view->d_kd_kppn = $kdkppn;
            } else {
                $this->view->d_kd_kppn = 'SEMUA';
            }
            $this->view->data = $d_pmrtpkn->get_pmrt_pkn_filter($filter);
        
        
        //-------------------------
		if (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        }elseif (Session::get('role') == PKN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } else {
            $this->view->nm_kppn2 = 'null';
        }
        //-------------------------

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_pmrtpkn->get_table1());

		$this->view->load('kppn/daftarPmrtPkn_PDF');
        $d_log->tambah_log("Sukses");
    }

    
    public function DataSPMAkhirTahunNihil_PDF($kdkppn = null,$kdjudul = null) {
        $d_pmrtpkn = new DataPMRTPKN($this->registry);
        $filter = array();
        $no = 0;
        $this->view->judul =$kdjudul;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        //narik list kppn
        $d_kppn_list = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();

            if ($kdkppn != 'null') {
                $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
                $this->view->d_kd_kppn = $kdkppn;
            } else {
                $this->view->d_kd_kppn = 'SEMUA';
            }
            $this->view->data = $d_pmrtpkn->get_pmrt_pkn_nihil_filter($filter);
        
        
        //-------------------------
		if (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        }elseif (Session::get('role') == PKN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } else {
            $this->view->nm_kppn2 = 'null';
        }
        //-------------------------

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_pmrtpkn->get_table1());

		$this->view->load('kppn/daftarPmrtPkn_PDF');
        $d_log->tambah_log("Sukses");
    }
    
    
    public function DataSPMAkhirTahunBUN_PDF($kdkppn = null,$kdjudul = null) {
        $d_pmrtpkn = new DataPMRTPKN($this->registry);
        $filter = array();
        $no = 0;
        $this->view->judul =$kdjudul;
		

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        //narik list kppn
        $d_kppn_list = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();

            if ($kdkppn != 'SEMUA') {
                $filter[$no++] = "KDKPPN = '" . $kdkppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
                $this->view->d_kd_kppn = $kdkppn;
            } else {
                $this->view->d_kd_kppn = 'SEMUA';
            }
            $this->view->data = $d_pmrtpkn->get_pmrt_pkn_bun_filter($filter);
        
        //-------------------------
		if (Session::get('role') == ADMIN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        }elseif (Session::get('role') == PKN) {
            if ($kdkppn != 'null') {
                $d_kppn = new DataUser($this->registry);
                $d_kppn->get_d_user_kppn($kdkppn);
                foreach ($d_kppn->get_d_user_kppn($kdkppn) as $kppn) {
                    $this->view->nm_kppn2 = $kppn->get_nama_user();
                }
            } else {
                $this->view->nm_kppn2 = 'null';
            }
        } else {
            $this->view->nm_kppn2 = 'null';
        }
        //-------------------------


        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_pmrtpkn->get_table1());

        $this->view->load('kppn/daftarPmrtPkn_PDF');
        $d_log->tambah_log("Sukses");
    }
    

	
	
	
	//------------------------------------------------------
	
	


    public function __destruct() {
        
    }

}
