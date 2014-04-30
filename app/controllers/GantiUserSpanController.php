<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class GantiUserSpanController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

	
/*
     * tambah data user
     */

    public function addDataUserSpan($id = null) {
        $d_data = new DataGantiUserSpan($this->registry);
        if (isset($_POST['add_d_data'])) {
		    $nama_unit = $_POST['nama_unit'];
            $no_surat = $_POST['no_surat'];
            $tgl_surat = $_POST['tgl_surat'];
            $nama_user1 = $_POST['nama_user1'];
            $nip_user1 = $_POST['nip_user1'];
			$posisi_user1 = $_POST['posisi_user1'];
			$email_user1 = $_POST['email_user1'];
			$nama_user2 = $_POST['nama_user2'];
            $nip_user2 = $_POST['nip_user2'];
			$posisi_user2 = $_POST['posisi_user2'];
			$email_user2 = $_POST['email_user2'];
			$tgl_mulai = $_POST['tgl_mulai'];
			$tgl_akhir = $_POST['tgl_akhir'];
			$nama_pelapor = $_POST['nama_pelapor'];
            $nip_pelapor = $_POST['nip_pelapor'];
			$posisi_pelapor = $_POST['posisi_pelapor'];
			$email_pelapor = $_POST['email_pelapor'];
			$tlp_pelapor = $_POST['tlp_pelapor'];
			$status_persetujuan = $_POST['status_persetujuan'];
			$alasan = $_POST['alasan'];
			$d_data->set_nama_unit($val['nama_unitt']);
			$d_data->set_no_surat($val['no_surat']);
			$d_data->set_tgl_surat($val['tgl_surat']);
            $d_data->set_nama_user1($val['nama_user1']);
            $d_data->set_nip_user1($val['nip_user1']);
            $d_data->set_posisi_user1($val['posisi_user1']);
			$d_data->set_email_user1($val['email_user1']);
            $d_data->set_nama_user2($val['nama_user2']);
            $d_data->set_nip_user2($val['nip_user2']);
			$d_data->set_posisi_user2($val['posisi_user2']);
			$d_data->set_email_user2($val['email_user2']);
            $d_data->set_tgl_mulai($val['tgl_mulai']);
			$d_data->set_tgl_akhir($val['tgl_akhir']);
			$d_data->set_nama_pelapor($val['nama_pelapor']);
            $d_data->set_nip_pelapor($val['nip_pelapor']);
			$d_data->set_posisi_pelapor($val['posisi_pelapor']);
			$d_data->set_email_pelapor($val['email_pelapor']);
			$d_data->set_tlp_pelapor($val['tlp_pelapor']);
			$d_data->set_status_persetujuan($val['status_persetujuan']);
			$d_data->set_alasan($val['alasan']);
			if (!$d_user->add_d_data()) {
                $this->view->d_rekam = $d_data;
                $this->view->error = $d_data->get_error();
            }
        }
        $this->view->data = $d_data->get_d_user();
        $this->view->render('kppn/gantiUserSpan'); //view di folder admin
    }
	
	/*
     * ubah data user
     */

    public function updDataUserSpan() {
        $d_data = new DataGantiUserSpan($this->registry);
        if (isset($_POST['upd_d_user'])) {
		 	$nama_unit = $_POST['nama_unit'];
            $no_surat = $_POST['no_surat'];
            $tgl_surat = $_POST['tgl_surat'];
            $nama_user1 = $_POST['nama_user1'];
            $nip_user1 = $_POST['nip_user1'];
			$posisi_user1 = $_POST['posisi_user1'];
			$email_user1 = $_POST['email_user1'];
			$nama_user2 = $_POST['nama_user2'];
            $nip_user2 = $_POST['nip_user2'];
			$posisi_user2 = $_POST['posisi_user2'];
			$email_user2 = $_POST['email_user2'];
			$tgl_mulai = $_POST['tgl_mulai'];
			$tgl_akhir = $_POST['tgl_akhir'];
			$nama_pelapor = $_POST['nama_pelapor'];
            $nip_pelapor = $_POST['nip_pelapor'];
			$posisi_pelapor = $_POST['posisi_pelapor'];
			$email_pelapor = $_POST['email_pelapor'];
			$tlp_pelapor = $_POST['tlp_pelapor'];
			$status_persetujuan = $_POST['status_persetujuan'];
			$alasan = $_POST['alasan'];
			$d_data->set_nama_unit($val['nama_unitt']);
			$d_data->set_no_surat($val['no_surat']);
			$d_data->set_tgl_surat($val['tgl_surat']);
            $d_data->set_nama_user1($val['nama_user1']);
            $d_data->set_nip_user1($val['nip_user1']);
            $d_data->set_posisi_user1($val['posisi_user1']);
			$d_data->set_email_user1($val['email_user1']);
            $d_data->set_nama_user2($val['nama_user2']);
            $d_data->set_nip_user2($val['nip_user2']);
			$d_data->set_posisi_user2($val['posisi_user2']);
			$d_data->set_email_user2($val['email_user2']);
            $d_data->set_tgl_mulai($val['tgl_mulai']);
			$d_data->set_tgl_akhir($val['tgl_akhir']);
			$d_data->set_nama_pelapor($val['nama_pelapor']);
            $d_data->set_nip_pelapor($val['nip_pelapor']);
			$d_data->set_posisi_pelapor($val['posisi_pelapor']);
			$d_data->set_email_pelapor($val['email_pelapor']);
			$d_data->set_tlp_pelapor($val['tlp_pelapor']);
			$d_data->set_status_persetujuan($val['status_persetujuan']);
			$d_data->set_alasan($val['alasan']);		
            if (!$d_user->update_d_user()) {
                $this->view->d_ubah = $d_user;
                $this->view->error = $d_user->get_error();
                $this->view->data = $d_user->get_d_user();
                $this->view->render('kppn/gantiUserSpan');
            } 
        }
    }
	
	
    public function __destruct() {
        
    }

}

