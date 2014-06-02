<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataGantiUserSpan {

    private $db;
	private $_nama_unit;
	private $_no_surat;
	private $_tgl_surat;
    private $_nama_user1;
    private $_nip_user1;
    private $_posisi_user1;
	private $_email_user1;
	private $_nama_user2;
    private $_nip_user2;
    private $_posisi_user2;
	private $_email_user2;
	private $_tgl_mulai;
	private $_tgl_akhir;
	private $_nama_pelapor;
    private $_nip_pelapor;
    private $_posisi_pelapor;
	private $_email_pelapor;
	private $_tlp_pelapor;
	private $_status_persetujuan;
	private $_alasan;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'ganti_user';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    /*
     * mendapatkan data dari tabel
     */

    public function get_d_user($limit = null, $batas = null) {
        $sql = "SELECT * FROM " . $this->_table ;
		
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_user = new $this($this->registry);
			$d_user->set_kode_kppn($val['nama_unit']);
			$d_user->set_no_surat($val['no_surat']);
			$d_user->set_tgl_surat($val['tgl_surat']);
            $d_user->set_nama_user1($val['nama_user1']);
            $d_user->set_nip_user1($val['nip_user1']);
            $d_user->set_posisi_user1($val['posisi_user1']);
			$d_user->set_email_user1($val['email_user1']);
            $d_user->set_nama_user2($val['nama_user2']);
            $d_user->set_nip_user2($val['nip_user2']);
			$d_user->set_posisi_user2($val['posisi_user2']);
			$d_user->set_email_user2($val['email_user2']);
            $d_user->set_tgl_mulai($val['tgl_mulai']);
			$d_user->set_tgl_akhir($val['tgl_akhir']);
			$d_user->set_nama_pelapor($val['nama_pelapor']);
            $d_user->set_nip_pelapor($val['nip_pelapor']);
			$d_user->set_posisi_pelapor($val['posisi_pelapor']);
			$d_user->set_email_pelaporan($val['email_pelapor']);
			$d_user->set_tlp_pelapor($val['tlp_pelapor']);
			$d_user->set_status_persetujuan($val['status_persetujuan']);
			$d_user->set_alasan($val['alasan']);
            $data[] = $d_user;
        }
        return $data;
    }

    /*
     * Add data
     */

  

    public function add_d_user() {
        $data = array(
			'kode_kppn' => $this->get_nama_unit(),
            'no_surat' => $this->get_no_surat(),
            'tgl_surat' => $this->get_tgl_surat(),
			'nama_user1' => $this->get_nama_user1(),
			'nip_user1' => $this->get_nip_user1(),
			'posisi_user1' => $this->get_posisi_user1(),
			'email_user1' => $this->get_email_user1(),
			'nama_user2' => $this->get_nama_user2(),
			'nip_user2' => $this->get_nip_user2(),
			'posisi_user2' => $this->get_posisi_user2(),
			'email_user2' => $this->get_email_user2(),
			'tgl_mulai' => $this->get_tgl_mulai(),
			'tgl_akhir' => $this->get_tgl_akhir(),
			'nama_pelapor' => $this->get_nama_pelapor(),
			'nip_pelapor' => $this->get_nip_pelapor(),
			'posisi_pelapor' => $this->get_posisi_pelapor(),
			'email_pelapor' => $this->get_email_pelapor(),
			'status_persetujuan' => $this->get_status_persetujuan(),
            'alasan' => $this->get_alasan()
        );
        $this->validate();
        if (!$this->get_valid()) {
            return false;
        }
        if (!is_array($data)) {
            return false;
        }
        return $this->db->insert($this->_table, $data);
    }

    /*
     * update Data Tetap, id harus di set terlebih dahulu
     * param data array
     */

    public function update_d_user() {
        $data = array(
			'kode_kppn' => $this->get_nama_unit(),
            'no_surat' => $this->get_no_surat(),
            'tgl_surat' => $this->get_tgl_surat(),
			'nama_user1' => $this->get_nama_user1(),
			'nip_user1' => $this->get_nip_user1(),
			'posisi_user1' => $this->get_posisi_user1(),
			'email_user1' => $this->get_email_user1(),
			'nama_user2' => $this->get_nama_user2(),
			'nip_user2' => $this->get_nip_user2(),
			'posisi_user2' => $this->get_posisi_user2(),
			'email_user2' => $this->get_email_user2(),
			'tgl_mulai' => $this->get_tgl_mulai(),
			'tgl_akhir' => $this->get_tgl_akhir(),
			'nama_pelapor' => $this->get_nama_pelapor(),
			'nip_pelapor' => $this->get_nip_pelapor(),
			'posisi_pelapor' => $this->get_posisi_pelapor(),
			'email_pelapor' => $this->get_email_pelapor(),
			'status_persetujuan' => $this->get_status_persetujuan(),
            'alasan' => $this->get_alasan()
        );
        $this->validate();
        if (!$this->get_valid()) {
            return false;
        }
        if (!is_array($data)) {
            return false;
        }
        $where = ' no_surat=' . $this->get_no_surat();
        return $this->db->update($this->_table, $data, $where);
    }


    public function validate() {
	    if ($this->get_nama_unit() == "") {
            $this->_error .= "Nama Unit belum diinput!<?br>";
            $this->_valid = FALSE;
        }
        if ($this->get_no_surat() == "") {
            $this->_error .= "No surat belum diinput!<?br>";
            $this->_valid = FALSE;
        }
        if ($this->get_tgl_surat() == "") {
            $this->_error .= "tanggal surat belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_nama_user1() == "") {
            $this->_error .= "Nama user lama belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_nip_user1() == "") {
            $this->_error .= "NIP user lama belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_posisi_user1() == "") {
            $this->_error .= "Posisi user lama belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_email_user1() == "") {
            $this->_error .= "Email user lama belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_nama_user2() == "") {
            $this->_error .= "Nama user baru belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_nip_user2() == "") {
            $this->_error .= "NIP user baru belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_posisi_user2() == "") {
            $this->_error .= "Posisi user baru belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_email_user2() == "") {
            $this->_error .= "Email user baru belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_tgl_mulai() == "") {
            $this->_error .= "Tanggal mulai belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_tgl_akhir() == "") {
            $this->_error .= "Tanggal akhir belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_nama_pelapor() == "") {
            $this->_error .= "Nama pelapor baru belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_nip_pelapor() == "") {
            $this->_error .= "NIP pelapor baru belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_posisi_pelapor() == "") {
            $this->_error .= "Posisi pelapor baru belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_email_pelapor() == "") {
            $this->_error .= "Email pelapor baru belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_tlp_pelapor() == "") {
            $this->_error .= "Telpon pelapor baru belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_status_persetujuan() == "") {
            $this->_error .= "Status persetujuan belum diinput!</br>";
            $this->_valid = FALSE;
        }
		if ($this->get_alasan() == "") {
            $this->_error .= "Alasan belum diinput!</br>";
            $this->_valid = FALSE;
        }
    }

    /*
     * setter
     */
    public function set_nama_unit($nama_unit) {
        $this->_nama_unit = $nama_unit;
    }
	
    public function set_no_surat($no_surat) {
        $this->_no_surat = $no_surat;
    }

    public function set_tgl_surat($tgl_surat) {
        $this->_tgl_surat = $tgl_surat;
    }

    public function set_nama_user1($nama_user1) {
        $this->_nama_user1 = $nama_user1;
    }

    public function set_nip_user1($nip_user1) {
        $this->_nip_user1 = $nip_user1;
    }

    public function set_posisi_user1($posisi_user1) {
        $this->_posisi_user1 = $posisi_user1;
    }
	
	public function set_email_user1($email_user1) {
        $this->_email_user1 = $email_user1;
    }
    public function set_nama_user2($nama_user2) {
        $this->_nama_user2 = $nama_user2;
    }
    public function set_nip_user2($nip_user2) {
        $this->_nip_user2 = $nip_user2;
    }
    public function set_posisi_user2($posisi_user2) {
        $this->_posisi_user2 = $posisi_user2;
    }
	public function set_email_user2($email_user2) {
        $this->_email_user2 = $email_user2;
    }
	public function set_tgl_mulai($tgl_mulai) {
        $this->_tgl_mulai = $tgl_mulai;
    }
	public function set_tgl_akhir($tgl_akhir) {
        $this->_tgl_akhir = $tgl_akhir;
    }
	public function set_nama_pelapor($nama_pelapor) {
        $this->_nama_pelapor = $nama_pelapor;
    }
    public function set_nip_pelapor($nip_pelapor) {
        $this->_nip_pelapor = $nip_pelapor;
    }
    public function set_posisi_pelapor($posisi_pelapor) {
        $this->_posisi_pelapor = $posisi_pelapor;
	}
	public function set_email_pelapor($email_pelapor) {
        $this->_email_pelapor = $email_pelapor;
    }
	public function set_tlp_pelapor($tlp_pelapor) {
        $this->_tlp_pelapor = $tlp_pelapor;
    }
	public function set_status_persetujuan($status_persetujuan) {
        $this->_status_persetujuan = $status_persetujuan;
    }
    public function set_alasan($alasan) {
        $this->_alasan = $alasan;
	}		

    /*
     * getter
     */
	public function get_nama_unit() {
        return $this->_nama_unit;
    }
    public function get_no_surat() {
        return $this->_no_surat;
    }
    public function get_tgl_surat() {
        return $this->_tgl_surat;
    }
    public function get_nama_user1() {
        return $this->_nama_user1;
    }
    public function get_nip_user1() {
        return $this->_nip_user1;
    }
    public function get_posisi_user1() {
        return $this->_posisi_user1;
    }
	public function get_email_user1() {
        return $this->_email_user1;
    }
    public function get_nama_user2() {
        return $this->_nama_user2;
    }
    public function get_nip_user2() {
        return $this->_nip_user2;
    }
    public function get_posisi_user2() {
        return $this->_posisi_user2;
    }
	public function get_email_user2() {
        return $this->_email_user2;
    }
	public function get_tgl_mulai() {
        return $this->_tgl_mulai;
    }
	public function get_tgl_akhir() {
        return $this->_tgl_akhir;
    }
	public function get_nama_pelapor() {
        return $this->_nama_pelapor;
    }
    public function get_nip_pelapor() {
        return $this->_nip_pelapor;
    }
    public function get_posisi_pelapor() {
        return $this->_posisi_pelapor;
	}
	public function get_email_pelapor() {
        return $this->_email_pelapor;
    }
	public function get_tlp_pelapor() {
        return $this->_tlp_pelapor;
    }
	public function get_status_persetujuan() {
        return $this->_status_persetujuan;
    }
    public function get_alasan($alasan) {
        return $this->_alasan;
	}

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}