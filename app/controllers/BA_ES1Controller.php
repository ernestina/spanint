<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BA_ES1Controller extends BaseController {
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

    public function DataRealisasiKegiatanBA() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));



        if (isset($_POST['submit_file'])) {

            if ($_POST['kode'] != '') {
                $filter[$no++] = "SUBSTR(OUTPUT,1,4) like '%" . $_POST['kode'] . "%'";
                $this->view->kdkegiatan = $_POST['kode'];
            }
            if ($_POST['nama'] != '') {
                $filter[$no++] = " upper(nmkegiatan) like upper('%" . $_POST['nama'] . "%')";
                $this->view->nmkegiatan = $_POST['nama'];
            }
        }

        if (Session::get('role') == KL) {
            $filter[$no++] = "SUBSTR(PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
        } elseif (Session::get('role') == ES1) {
            $filter[$no++] = "SUBSTR(PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
        } elseif (Session::get('role') == SATKER) {
            $filter[$no++] = "SATKER = '" . Session::get('kd_satker') . "'";
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_ba_kegiatan_filter($filter);

        $d_log->tambah_log("Sukses");
        $this->view->judul = 'Laporan Pagu Dana Per Kegiatan';
        $this->view->judulkolom = 'Kode | Nama Kegiatan';
        $this->view->action = 'DataRealisasiKegiatanBA';
        $this->view->kodes = 'Kode Kegiatan :';
        $this->view->detil = "kegiatan";
        $this->view->render('baes1/DataRealisasiKegiatan');
    }

    public function DataRealisasiPenerimaanBA($eselon1 = null, $satker = null) {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KL) {
            $filter[$no++] = "B.BA = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "B.BAES1 = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "B.KDSATKER = '" . Session::get('kd_satker') . "'";
        }
        if ($eselon1 != null) {
            $filter[$no++] = "B.BAES1 = '" . $eselon1 . "'";
            $this->view->eselon1 = $eselon1;
        }
        if ($satker != null) {
            $filter[$no++] = "B.KDSATKER = '" . $satker . "'";
            $this->view->d_kd_satker = $satker;
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['KEGIATAN'] != '') {
                $filter[$no++] = "SUBSTR(OUTPUT,1,4) = '" . $_POST['KEGIATAN'] . "'";
                $this->view->lokasi = $_POST['KEGIATAN'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_ba_pendapatan_filter($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiPenerimaan');
    }

    public function DataRealisasiPenerimaanPerES1() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KL) {
            $filter[$no++] = "B.BA = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "B.BAES1 = '" . Session::get('kd_baes1') . "'";
        }


        if (isset($_POST['submit_file'])) {

            if ($_POST['KEGIATAN'] != '') {
                $filter[$no++] = "SUBSTR(OUTPUT,1,4) = '" . $_POST['KEGIATAN'] . "'";
                $this->view->lokasi = $_POST['KEGIATAN'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_ba_per_es1_pendapatan_filter($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiPenerimaanES1');
    }

    public function DataRealisasiPenerimaanPerSatkerES1() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KL) {
            $filter[$no++] = "B.BA = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "B.BAES1 = '" . Session::get('kd_baes1') . "'";
        }


        if (isset($_POST['submit_file'])) {

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "B.KDSATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->kdsatker = $_POST['kdsatker'];
            }
            if ($_POST['nmsatker'] != '') {
                $filter[$no++] = " UPPER(B.NMSATKER) LIKE UPPER('%" . $_POST['nmsatker'] . "%')";
                $this->view->d_nm_satker = $_POST['nmsatker'];
            }
            if ($_POST['eselon1'] != '') {
                $filter[$no++] = "B.BAES1 = '" . $_POST['eselon1'] . "'";
                $this->view->kdeselon1 = $_POST['eselon1'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_spm = new DataNamaSatker($this->registry);
        $this->view->data1 = $d_spm->get_es1_dipa_filter();
        $this->view->data = $d_spm1->get_kl_per_es1satker_pendapatan_filter($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiPenerimaanSatkerES1');
    }

    public function DataRealisasiAkunBA() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        $filter[$no++] = "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_realisasi_fa_global_kl_filter($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiBA');
    }

    public function DataRealisasiAkunES1() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if (Session::get('role') == KL) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['satker'] != '') {
                $filter[$no++] = "b.kdsatker = '" . $_POST['satker'] . "'";
                $this->view->satker = $_POST['satker'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_realisasi_fa_baes1_filter($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiES1');
    }

    public function DataRealisasiKewenanganBAES1() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KL) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_realisasi_fa_kewenangan_baes1_filter($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiKewenaganBAES1');
    }

    public function DetailEncumbrances($code_id = null, $detil) {
        $d_spm1 = new encumbrances($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (('' . Session::get('ta')) == date("Y")) {
            $filter[$no++] = "TO_CHAR(NEED_BY_DATE,'YYYY') =" . Session::get('ta');
        } else {
            $filter[$no++] = "TO_CHAR(NEED_BY_DATE,'YYYY') =" . Session::get('ta') - 1;
        }

        $this->view->kd_detil = $detil;
        //detil encumbrance ba
        if (Session::get('role') == KL) {
            $filter[$no++] = " SUBSTR(B.SEGMENT4,1,3) =  '" . Session::get('kd_baes1') . "'";
            if ($detil == 'eselon') {
                $filter[$no++] = " SUBSTR(B.SEGMENT4,1,5) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'satker') {
                $filter[$no++] = " SUBSTR(B.SEGMENT4,1,5)||'-'||B.SEGMENT1 =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'kegiatan') {
                $filter[$no++] = " SUBSTR(B.SEGMENT5,1,4) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'output') {
                $filter[$no++] = " B.SEGMENT5 =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'jenbel') {
                $filter[$no++] = " SUBSTR(B.SEGMENT3,1,2) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'sdana') {
                $filter[$no++] = " SUBSTR(B.SEGMENT6,1,1) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'es1jenbel') {
                $filter[$no++] = " SUBSTR(B.SEGMENT4,1,5)||'-'||SUBSTR(B.SEGMENT3,1,2) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'es1sdana') {
                $filter[$no++] = " SUBSTR(B.SEGMENT4,1,5)||'-'||SUBSTR(B.SEGMENT6,1,1) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
        }

        //detil encumbrance level eselon1
        if (Session::get('role') == ES1) {
            $filter[$no++] = " SUBSTR(B.SEGMENT4,1,5) =  '" . Session::get('kd_baes1') . "'";

            if ($detil == 'satker') {
                $filter[$no++] = " B.SEGMENT1 =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'kegiatan') {
                $filter[$no++] = " SUBSTR(B.SEGMENT5,1,4) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'output') {
                $filter[$no++] = " B.SEGMENT5 =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'jenbel') {
                $filter[$no++] = " SUBSTR(B.SEGMENT3,1,2) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'sdana') {
                $filter[$no++] = " SUBSTR(B.SEGMENT6,1,1) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'satjenbel') {
                $filter[$no++] = " B.SEGMENT1||'-'||SUBSTR(B.SEGMENT3,1,2) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'satsdana') {
                $filter[$no++] = " B.SEGMENT1||'-'||SUBSTR(B.SEGMENT6,1,1) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
        }

        //detil encumbrance level eselon1
        if (Session::get('role') == SATKER) {
            $filter[$no++] = " B.SEGMENT1) =  '" . Session::get('kd_satker') . "'";

            if ($detil == 'kegiatan') {
                $filter[$no++] = " SUBSTR(B.SEGMENT5,1,4) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'output') {
                $filter[$no++] = " B.SEGMENT5 =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'jenbel') {
                $filter[$no++] = " SUBSTR(B.SEGMENT3,1,2) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
            if ($detil == 'sdana') {
                $filter[$no++] = " SUBSTR(B.SEGMENT6,1,1) =  '" . $code_id . "'";
                $this->view->kd_code_id = $code_id;
            }
        }
        //var_dump($d_spm->get_hist_spm_filter());
        $this->view->data = $d_spm1->get_encumbrances_baes1($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/encumbrances');
    }

    public function DataRealisasiKegiatanBAES1() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $filter1 = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KL) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
            $filter1[$no++] = "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
            $filter1[$no++] = "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
        }

        if (isset($_POST['kegiatan'])) {

            if ($_POST['kegiatan'] != '') {
                $filter[$no++] = "substr(a.output,1,4) = '" . $_POST['kegiatan'] . "'";
                $this->view->kegiatan = $_POST['kegiatan'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_realisasi_fa_kegiatan_baes1_filter($filter);
        $this->view->data1 = $d_spm1->get_nama_kegiatan_filter($filter1);
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiKegiatanBAES1');
    }

    public function DataRealisasiSumberDanaBAES1() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KL) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_realisasi_fa_sumber_dana_baes1_filter($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiSumberDanaBAES1');
    }

    public function DataRealisasiWilayahBAES1() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KL) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_realisasi_fa_wilayah_baes1_filter($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiLokasiBAES1');
    }

    public function DataRealisasiKabupatenBAES1($wilayah = null, $nmwilayah = null) {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KL) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "SUBSTR(A.PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
        }

        if ($wilayah != '') {
            $filter[$no++] = "substr(a.lokasi,1,2) = '" . $wilayah . "'";
            $this->view->wilayah = $wilayah;
        }

        if ($nmwilayah != '') {

            $this->view->nmwilayah = $nmwilayah;
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_realisasi_fa_kabupaten_baes1_filter($filter);
        $this->view->data1 = $d_spm1->get_wilayah($wilayah);
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiKabupatenBAES1');
    }

    public function nmsatker() {
        $d_spm1 = new DataNamaSatker($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table4());

        if (Session::get('role') == KL) {
            $filter[$no++] = "B.BA = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "B.BAES1 = '" . Session::get('kd_baes1') . "'";
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "A.KDSATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->kdsatker = $_POST['kdsatker'];
            }
            if ($_POST['nmsatker'] != '') {
                $filter[$no++] = " UPPER(A.NMSATKER) LIKE UPPER('%" . $_POST['nmsatker'] . "%')";
                $this->view->d_nm_satker = $_POST['nmsatker'];
            }
            if ($_POST['eselon1'] != '') {
                $filter[$no++] = "B.BAES1 = '" . $_POST['eselon1'] . "'";
                $this->view->kdeselon1 = $_POST['eselon1'];
            }
            if ($_POST['revisi'] != '') {
                if ($_POST['revisi'] == '0') {
                    $filter[$no++] = "A.REV = 0";
                    $this->view->d_kd_revisi = $_POST['revisi'];
                } elseif ($_POST['revisi'] == '1') {
                    $filter[$no++] = "A.REV > 0";
                    $this->view->d_kd_revisi = $_POST['revisi'];
                }
            }
        }

        $this->view->data = $d_spm1->get_baes1_dipa_filter($filter);
        $this->view->data1 = $d_spm1->get_es1_dipa_filter();

        if (Session::get('role') == ES1) {
            $this->view->render('baes1/NamaSatkerDIPA1');
        }

        if (Session::get('role') == KL) {
            $this->view->render('baes1/NamaSatkerDIPA');
        }


        $d_log->tambah_log("Sukses");
        //var_dump($d_spm1->get_satker_filter($filter));
        //$this->view->render('kppn/NamaSatkerDIPA1');
    }

    public function ProsesRevisi($satker = NULL) {
        $d_spm1 = new proses_revisi($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KL) {
            $filter[$no++] = "B.BA = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "B.BAES1 = '" . Session::get('kd_baes1') . "'";
        }

        if ($satker != '') {
            $filter[$no++] = " A.SATKER_CODE =  '" . $satker . "'";
            $this->view->satker_code = $satker;
        }
        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "A.KPPN_CODE = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            }
            /* else {
              $filter[$no++]="TS.KPPN = '".Session::get('id_user')."'";
              } */

            if ($_POST['satker'] != '') {
                $filter[$no++] = "A.SATKER_CODE = '" . $_POST['satker'] . "'";
                $this->view->d_kd_satker = $_POST['satker'];
            }
            if ($_POST['nmsatker'] != '') {
                $filter[$no++] = " UPPER(B.NMSATKER) LIKE UPPER('%" . $_POST['nmsatker'] . "%')";
                $this->view->d_nm_satker = $_POST['nmsatker'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_revisi_dipa($filter);

        $this->view->render('baes1/proses_revisi');
        $d_log->tambah_log("Sukses");
    }

    public function RekapSp2dBAES1() {
        $d_spm1 = new DataCheck($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (('' . Session::get('ta')) == date("Y")) {
            $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
        } else {
            $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
        }

        if (Session::get('role') == KL) {
            $filter[$no++] = "B.BA = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "B.BAES1 = '" . Session::get('kd_baes1') . "'";
        }

        if (isset($_POST['submit_file'])) {


            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($_POST['tgl_awal'])) . "' AND '" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "'";

                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
        }

        //$this->view->data = $d_spm1->get_sp2d_rekap_filter ($filter);
        //var_dump($d_spm1->get_error_spm_filter ($filter));

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_sp2d_rekap_baes1_filter($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/RekapSP2D');
    }

    public function detailrekapsp2dBAES1($jenis_spm = null, $kppn = null, $tgl_awal = null, $tgl_akhir = null) {
        $d_spm1 = new DataCheck($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (('' . Session::get('ta')) == date("Y")) {
            $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
        } else {
            $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
        }

        if (Session::get('role') == KL) {
            $filter[$no++] = "SEGMENT1 IN (SELECT KDSATKER FROM T_SATKER WHERE BA = '" . Session::get('kd_baes1') . "')";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "SEGMENT1 IN (SELECT KDSATKER FROM T_SATKER WHERE BAES1 = '" . Session::get('kd_baes1') . "')";
        }

        if ($jenis_spm != '') {
            $filter[$no++] = " JENDOK =  '" . $jenis_spm . "'";
            $this->view->jendok1 = $jenis_spm;
        }

        if ($tgl_awal != '' AND $tgl_akhir != '') {

            $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($tgl_awal)) . "' AND '" . date('Ymd', strtotime($tgl_akhir)) . "'";

            $this->view->d_tgl_awal = $tgl_awal;
            $this->view->d_tgl_akhir = $tgl_akhir;
        }

        $this->view->data = $d_spm1->get_sp2d_satker_filter($filter);

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/Rekap');
    }

    public function nmsatkerBAES1() {
        $d_spm1 = new DataNamaSatker($this->registry);

        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (('' . Session::get('ta')) == date("Y")) {
            $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
        } else {
            $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
        }


        if (isset($_POST['submit_file'])) {

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "SEGMENT1 = '" . $_POST['kdsatker'] . "'";
                $this->view->d_kd_satker = $_POST['kdsatker'];
            }
            if ($_POST['nmsatker'] != '') {
                $filter[$no++] = " UPPER(NMSATKER) LIKE UPPER('%" . $_POST['nmsatker'] . "%')";
                $this->view->d_nm_satker = $_POST['nmsatker'];
            }
            if ($_POST['eselon1'] != '') {
                $filter[$no++] = "B.BAES1 = '" . $_POST['eselon1'] . "'";
                $this->view->eselon1 = $_POST['eselon1'];
            }
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {

                $filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($_POST['tgl_awal'])) . "' AND '" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "'";

                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
        }
        if (Session::get('role') == KL) {
            $filter[$no++] = "B.BA = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "B.BAES1 = '" . Session::get('kd_baes1') . "'";
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table2());

        $this->view->data1 = $d_spm1->get_es1_dipa_filter();
        $this->view->data = $d_spm1->get_baes1_satker_filter($filter);

        $this->view->render('baes1/NamaSatker');
        $d_log->tambah_log("Sukses");
    }

    //author by jhon

    public function DataRealisasiOutputBA() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {

            if ($_POST['kode'] != '') {
                $filter[$no++] = "OUTPUT like '%" . $_POST['kode'] . "%'";
                $this->view->kdoutput = $_POST['kode'];
            }

            if ($_POST['nama'] != '') {
                $filter[$no++] = " upper(nmkegiatan) like upper('%" . $_POST['nama'] . "%')";
                $this->view->nmoutput = $_POST['nama'];
            }
        }

        if (Session::get('role') == KL) {
            $filter[$no++] = "SUBSTR(PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
        } elseif (Session::get('role') == ES1) {
            $filter[$no++] = "SUBSTR(PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
        } elseif (Session::get('role') == SATKER) {
            $filter[$no++] = "SATKER = '" . Session::get('kd_satker') . "'";
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_ba_output_filter($filter);

        $d_log->tambah_log("Sukses");
        $this->view->judul = 'Laporan Pagu Dana Per Output';
        $this->view->judulkolom = 'Kode | Nama Kegiatan / Output';
        $this->view->action = 'DataRealisasiOutputBA';
        $this->view->kodes = 'Kode Output :';
        $this->view->detil = 'output :';
        $this->view->render('baes1/DataRealisasiOutput');
    }

    public function DataFaBaPerEs1() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {

            if ($_POST['kode'] != '') {
                $filter[$no++] = "substr(program,1,5) like '%" . $_POST['kode'] . "%'";
                $this->view->kdkegiatan = $_POST['kode'];
            }

            if ($_POST['nama'] != '') {
                $filter[$no++] = " upper(nmes1) like upper('%" . $_POST['nama'] . "%')";
                $this->view->nmkegiatan = $_POST['nama'];
            }
        }

        $filter[$no++] = "SUBSTR(PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        $this->view->data = $d_spm1->get_ba_per_es1_filter($filter);
        $this->view->judul = 'Laporan Pagu Dana Per Eselon 1';
        $this->view->judulkolom = 'Kode | Nama Eselon 1';
        $this->view->action = 'DataFaBaPerEs1';
        $this->view->kodes = 'Kode Eselon 1:';
        $this->view->detil = "eselon";
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiKegiatan');
    }

    public function DataFaBaSatEs1() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {

            if ($_POST['kode'] != '') {
                $filter[$no++] = "satker like '%" . $_POST['kode'] . "%'";
                $this->view->kdkegiatan = $_POST['kode'];
            }
        }
        /* if (isset($_POST['submit_file'])) {

          if ($_POST['nama'] != '') {
          $filter[$no++] = "nmsatker like '%" . $_POST['nama'] . "%'";
          $this->view->nmkegiatan = $_POST['nama'];
          }
          } */

        if (Session::get('role') == KL) {
            $filter[$no++] = "SUBSTR(PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
        } elseif (Session::get('role') == ES1) {
            $filter[$no++] = "SUBSTR(PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
        }
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        $this->view->data = $d_spm1->get_ba_persates1_filter($filter);
        $d_log->tambah_log("Sukses");
        $this->view->judul = 'Laporan Pagu Dana Per Satker';
        $this->view->judulkolom = 'Kode | Nama Eselon 1 / Satker';
        $this->view->action = 'DataFaBaSatEs1';
        $this->view->kodes = 'Kode Satker :';
        $this->view->detil = 'satker :';
        $this->view->render('baes1/DataRealisasiOutput');
    }

    public function DataFaBaPerJenbel() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {

            if ($_POST['kode'] != '') {
                $filter[$no++] = "substr(akun,1,2) like '%" . $_POST['kode'] . "%'";
                $this->view->kdkegiatan = $_POST['kode'];
            }

            if ($_POST['nama'] != '') {
                $filter[$no++] = " upper(nmakun) like upper('%" . $_POST['nama'] . "%')";
                $this->view->nmkegiatan = $_POST['nama'];
            }
        }

        if (Session::get('role') == KL) {
            $filter[$no++] = "SUBSTR(PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
        } elseif (Session::get('role') == ES1) {
            $filter[$no++] = "SUBSTR(PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
        } elseif (Session::get('role') == SATKER) {
            $filter[$no++] = "SATKER = '" . Session::get('kd_satker') . "'";
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        $this->view->data = $d_spm1->get_ba_per_jenbel_filter($filter);
        $this->view->judul = 'Laporan Pagu Dana Per Jenis Belanja';
        $this->view->judulkolom = 'Kode | Nama Jenis Belanja';
        $this->view->action = 'DataFaBaPerJenbel';
        $this->view->kodes = 'Kode Jenis Belanja:';
        $this->view->detil = "jenbel";
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiKegiatan');
    }

    public function DataFaBaPerSdana() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {

            if ($_POST['kode'] != '') {
                $filter[$no++] = "substr(dana,1,1) like '%" . $_POST['kode'] . "%'";
                $this->view->kdkegiatan = $_POST['kode'];
            }

            if ($_POST['nama'] != '') {
                $filter[$no++] = " upper(deskripsi) like upper('%" . $_POST['nama'] . "%')";
                $this->view->nmkegiatan = $_POST['nama'];
            }
        }

        if (Session::get('role') == KL) {
            $filter[$no++] = "SUBSTR(PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";
        } elseif (Session::get('role') == ES1) {
            $filter[$no++] = "SUBSTR(PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";
        } elseif (Session::get('role') == SATKER) {
            $filter[$no++] = "SATKER = '" . Session::get('kd_satker') . "'";
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        $this->view->data = $d_spm1->get_ba_per_sdana_filter($filter);
        $this->view->judul = 'Laporan Pagu Dana Per Sumber Dana';
        $this->view->judulkolom = 'Kode | Nama Sumber Dana';
        $this->view->action = 'DataFaBaPerSdana';
        $this->view->kodes = 'Kode Sumber Dana:';
        $this->view->detil = "sdana";
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiKegiatan');
    }

    public function DataFaBaEs1Jenbel() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {

            if ($_POST['kode'] != '') {
                $filter[$no++] = "SUBSTR(program,1,5) like '%" . $_POST['kode'] . "%'";
                $this->view->kdkegiatan = $_POST['kode'];
            }
        }
        /* if (isset($_POST['submit_file'])) {

          if ($_POST['nama'] != '') {
          $filter[$no++] = "nmsatker like '%" . $_POST['nama'] . "%'";
          $this->view->nmkegiatan = $_POST['nama'];
          }
          } */
        $filter[$no++] = "SUBSTR(PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_ba_peres1jenbel_filter($filter);
        $d_log->tambah_log("Sukses");
        $this->view->judul = 'Laporan Pagu Dana Per Eselon 1 - Jenis Belanja';
        $this->view->judulkolom = 'Kode | Nama Eselon 1 / Jenis Belanja';
        $this->view->action = 'DataFaBaEs1Jenbel';
        $this->view->kodes = 'Kode Eselon 1 :';
        $this->view->detil = 'es1jenbel :';
        $this->view->render('baes1/DataRealisasiOutput');
    }

    public function DataFaBaEs1Sdana() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {

            if ($_POST['kode'] != '') {
                $filter[$no++] = "SUBSTR(program,1,5) like '%" . $_POST['kode'] . "%'";
                $this->view->kdkegiatan = $_POST['kode'];
            }
        }
        /* if (isset($_POST['submit_file'])) {

          if ($_POST['nama'] != '') {
          $filter[$no++] = "nmsatker like '%" . $_POST['nama'] . "%'";
          $this->view->nmkegiatan = $_POST['nama'];
          }
          } */
        $filter[$no++] = "SUBSTR(PROGRAM,1,3) = '" . Session::get('kd_baes1') . "'";

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_ba_peres1sdana_filter($filter);
        $d_log->tambah_log("Sukses");
        $this->view->judul = 'Laporan Pagu Dana Per Eselon 1 - Sumber Dana';
        $this->view->judulkolom = 'Kode | Nama Eselon 1 / Sumber Dana';
        $this->view->action = 'DataFaBaEs1Sdana';
        $this->view->kodes = 'Kode Eselon 1 :';
        $this->view->detil = 'es1sdana :';
        $this->view->render('baes1/DataRealisasiOutput');
    }

    public function DataFaEs1PerSat() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {

            if ($_POST['kode'] != '') {
                $filter[$no++] = "satker like '%" . $_POST['kode'] . "%'";
                $this->view->kdkegiatan = $_POST['kode'];
            }

            if ($_POST['nama'] != '') {
                $filter[$no++] = " nmsatker like upper('%" . $_POST['nama'] . "%')";
                $this->view->nmkegiatan = $_POST['nama'];
            }
        }

        $filter[$no++] = "SUBSTR(PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        $this->view->data = $d_spm1->get_es1_persat_filter($filter);
        $this->view->judul = 'Laporan Pagu Dana Per Satker';
        $this->view->judulkolom = 'Kode | Nama Satker';
        $this->view->action = 'DataFaEs1PerSat';
        $this->view->kodes = 'Kode Satker:';
        $this->view->detil = "satker";
        $d_log->tambah_log("Sukses");

        $this->view->render('baes1/DataRealisasiKegiatan');
    }

    public function DataFaEs1SatJenbel() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {

            if ($_POST['kode'] != '') {
                $filter[$no++] = "satker like '%" . $_POST['kode'] . "%'";
                $this->view->kdkegiatan = $_POST['kode'];
            }
        }
        /* if (isset($_POST['submit_file'])) {

          if ($_POST['nama'] != '') {
          $filter[$no++] = "nmsatker like '%" . $_POST['nama'] . "%'";
          $this->view->nmkegiatan = $_POST['nama'];
          }
          } */
        $filter[$no++] = "SUBSTR(PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_fa_es1_persatjenbel_filter($filter);
        $d_log->tambah_log("Sukses");
        $this->view->judul = 'Laporan Pagu Dana Per Satker - Jenis Belanja';
        $this->view->judulkolom = 'Kode | Nama Satker / Jenis Belanja';
        $this->view->action = 'DataFaEs1SatJenbel';
        $this->view->kodes = 'Kode Satker :';
        $this->view->detil = 'satjenbel :';
        $this->view->render('baes1/DataRealisasiOutput');
    }

    public function DataFaEs1SatSdana() {
        $d_spm1 = new DataRealisasiES1($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {

            if ($_POST['kode'] != '') {
                $filter[$no++] = "satker like '%" . $_POST['kode'] . "%'";
                $this->view->kdkegiatan = $_POST['kode'];
            }
        }
        /* if (isset($_POST['submit_file'])) {

          if ($_POST['nama'] != '') {
          $filter[$no++] = "nmsatker like '%" . $_POST['nama'] . "%'";
          $this->view->nmkegiatan = $_POST['nama'];
          }
          } */
        $filter[$no++] = "SUBSTR(PROGRAM,1,5) = '" . Session::get('kd_baes1') . "'";

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_fa_es1_persatsdana_filter($filter);
        $d_log->tambah_log("Sukses");
        $this->view->judul = 'Laporan Pagu Dana Per Satker - Sumber Dana';
        $this->view->judulkolom = 'Kode | Nama Satker / Sumber Dana';
        $this->view->action = 'DataFaEs1SatSdana';
        $this->view->kodes = 'Kode Satker :';
        $this->view->detil = 'satsdana :';
        $this->view->render('baes1/DataRealisasiOutput');
    }

    public function DataUPBAES1() {
        $d_spm1 = new DataKarwasUP($this->registry);
        $filter = array();
        //$filter2 = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KL) {
            $filter[$no++] = "B.BA = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "B.BAES1 = '" . Session::get('kd_baes1') . "'";
        }

        if (isset($_POST['submit_file'])) {




            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "A.SATKER_CODE = '" . $_POST['kdsatker'] . "'";
                $this->view->d_kd_satker = $_POST['kdsatker'];
            }
            if ($_POST['SUMBERDANA'] != '') {
                $filter[$no++] = "SUMBER_DANA = '" . $_POST['SUMBERDANA'] . "'";
                $this->view->d_sumber_dana = $_POST['SUMBERDANA'];
            }
        }

        $this->view->data1 = $d_spm1->get_karwas_up_baes1($filter);
        $this->view->data2 = $d_spm1->get_total_sisa_up_baes1($filter);

        $d_log->tambah_log("Sukses");
        $this->view->render('baes1/KarwasUPBAES1');
    }

    public function KarwasTUPBaes1() {
        $d_spm1 = new DataKarwasUP($this->registry);
        $filter = array();
        //$filter2 = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (Session::get('role') == KL) {
            $filter[$no++] = "B.BA = '" . Session::get('kd_baes1') . "'";
        }
        if (Session::get('role') == ES1) {
            $filter[$no++] = "B.BAES1 = '" . Session::get('kd_baes1') . "'";
        }

        if (isset($_POST['submit_file'])) {


            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "SATKER_CODE = '" . $_POST['kdsatker'] . "'";
                $this->view->d_kd_satker = $_POST['kdsatker'];
            }
            if ($_POST['SUMBERDANA'] != '') {
                $filter[$no++] = "SUMBER_DANA = '" . $_POST['SUMBERDANA'] . "'";
                $this->view->d_sumber_dana = $_POST['SUMBERDANA'];
            }
        }

        $this->view->data1 = $d_spm1->get_karwas_tup_baes1($filter);
        $this->view->data2 = $d_spm1->get_total_sisa_tup_baes1($filter);

        $d_log->tambah_log("Sukses");
        $this->view->render('baes1/KarwasTUPBAES1');
    }

    public function __destruct() {
        
    }

}
