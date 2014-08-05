<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataSupplierController extends BaseController {
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
	
	public function cekSupplier() {
		$d_supp = new DataSupplier($this->registry);
		$filter = array ();
		$no=0;
		if (isset($_POST['submit_file'])) {
		
			if ($_POST['tipesup']!=''){
				$filter[$no++]="substr(TIPE_SUPP,1,1) = '".$_POST['tipesup']."'";
				$this->view->d_tipesup = $_POST['tipesup'];
			}
		
			if ($_POST['nrs']!=''){
				$filter[$no++]=" v_supplier_number like '%".$_POST['nrs']."%'";
				$this->view->d_nrs = $_POST['nrs'];
			}
		
			if ($_POST['namasupplier']!=''){
				$filter[$no++]=" nama_supplier like '%".$_POST['namasupplier']."%'";
				$this->view->d_namasupplier = $_POST['namasupplier'];
			}
		
			if ($_POST['npwpsupplier']!=''){
				$filter[$no++]=" npwp_supplier like '%".$_POST['npwpsupplier']."%'";
				$this->view->d_npwpsupplier = $_POST['npwpsupplier'];
			}
		
			if ($_POST['nip']!=''){
				$filter[$no++]=" nip_penerima like '%".$_POST['nip']."%'";
				$this->view->d_nip = $_POST['nip'];
			}
		
			if ($_POST['namapenerima']!=''){
				$filter[$no++]=" nm_penerima like '%".$_POST['namapenerima']."%'";
				$this->view->d_namapenerima = $_POST['namapenerima'];
			}
		
			if ($_POST['norek']!=''){
				$filter[$no++]=" norek_bank like '%".$_POST['norek']."%'";
				$this->view->d_norek = $_POST['norek'];
			}
		
			if ($_POST['namarek']!=''){
				$filter[$no++]=" nm_pemilik_rek like '%".$_POST['namarek']."%'";
				$this->view->d_namarek = $_POST['namarek'];
			}
		
			if ($_POST['npwppenerima']!=''){
				$filter[$no++]=" npwp_penerima like '%".$_POST['npwppenerima']."%'";
				$this->view->d_npwppenerima = $_POST['npwppenerima'];
			}
			$this->view->data = $d_supp->get_supp_filter($filter);
		}
		
		// untuk mengambil data last update 
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_supp->get_table());
		
		$this->view->render('satker/isianSupplier');
		
    }
	
    public function __destruct() {
        
    }

}
