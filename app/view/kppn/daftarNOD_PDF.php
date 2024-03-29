<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : posisiSPM_PDF.php
  //Dibuat oleh : Rifan Abdul Rachman
  //Tanggal dibuat : 18-07-2014
  //----------------------------------------------------
 */
ob_start();
//-------------------------------------
require_once("./././public/fpdf17/fpdf.php");require_once("./././public/fpdf17/rotation.php");

class FPDF_AutoWrapTable extends PDF_Rotate {

    private $data = array();
    protected $options = array(
        'judul' => '',
        'filename' => '',
        'destinationfile' => '',
        'paper_size' => 'F4',
        'orientation' => 'L'
    );
    private $kdtgl_awal = array();
    private $kdtgl_akhir = array();
    private $nm_kppn;
	
    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
        $this->nm_kppn = $nm_kppn;
    }

    /*
     * Index
     */

    public function rptDetailData() {
        //-----------------------------------
		//------------------------------
		$judul=$this->options['judul'];
		$nm_kppn = $this->nm_kppn;
		$nm_kppn2 = $this->nm_kppn2;
		$nm_kppn3 = $this->nm_kppn3;
		$kdtgl_awal1 = $this->kdtgl_awal;
		$kdtgl_akhir1 = $this->kdtgl_akhir;
		 
        
		$this->HeaderAtas1($judul,$nm_kppn,$nm_kppn2,$nm_kppn3,$kdtgl_awal1,$kdtgl_akhir1);
        //-----------------------------------
    
        //----------------------------------------------- 

        #pengaturan khusus
		$border = 0;
        $h = 40;
        $this->SetFont('Arial', 'B', 4);
		$ukuran_kolom = 30;
        $ukuran_kolom_pagu_total_sisa = 60;
		$ukuran_kolom1 = 62;
        $ukuran_kolom2 = 75;
        $ukuran_kolom3 = 100;
		$ukuran_kolom4 = 45;
		$ukuran_kolom5 = 90;
		$ukuran_kolom6 = 80;
        $ukuran_kolom_jenis_belanja = 65;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 200;
        $ukuran_kolom_deskripsi = 160;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($ukuran_kolom, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom);
        $this->Cell($ukuran_kolom2, $h, 'WA_NUMBER-REF_NUMBER', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom2);
        $this->Cell($ukuran_kolom4, $h, 'RM_NAME', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom4);
        $this->Cell($ukuran_kolom1, $h, '(PAYMENT-BOOK)_DATE', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom1);
        $this->Cell($ukuran_kolom2, $h, 'NOD_(NUMBER/DATE-TYPE)', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom2);
        $this->Cell($ukuran_kolom4, $h, 'SP4HLN_NUMBER', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom4);
        $this->Cell($ukuran_kolom2, $h, 'CURR_LOAN-AMOUNT-RATE_TYPE', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom2);
        $this->Cell($ukuran_kolom5, $h, 'CURR_EFF-AMOUNT_CURR(EFF-LOCAL)', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom5);
        $this->Cell($ukuran_kolom6, $h, '(APDPL-REGISTER) NUMBER', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom6);
        $this->Cell($ukuran_kolom1, $h, 'CODE(AKUN-OUTPUT-DANA)', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom1);
        $this->Cell($ukuran_kolom4, $h, 'AMOUNT_SERVICE', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom4);
        $this->Cell($ukuran_kolom3, $h, 'MEDIUM_NAME-ONLENDING_DESC-DMFAS_ID', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom3);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom5, $h, 'REKSUS_(TYPE-NUMBER)', 1, 1, 'C', true);
        $this->Ln(3);

        $this->SetFont('Arial', '', 5);
        $this->SetWidths(array($ukuran_kolom, $ukuran_kolom2,
		$ukuran_kolom4,$ukuran_kolom1,
		$ukuran_kolom2,$ukuran_kolom4,
		$ukuran_kolom2,$ukuran_kolom5,
		$ukuran_kolom6,$ukuran_kolom1,
		$ukuran_kolom4,$ukuran_kolom3,
		$ukuran_kolom5));
        $this->SetAligns(array('C', 'C',
		'C', 'C',
		'C', 'C',
		'C', 'C',
		'C', 'C',
		'C', 'C',		
		'C'));
       
	   if (count($this->data) == 0) {
			$this->Row(
                    array('',
                        'N I H I L',
                        '','',
						'','',
						'','',
						'','',
						'','',
                        ''
                    )
            );
	   
	   
	   
	   }else{
	   
		   $no = 1;$this->SetFillColor(255);
			foreach ($this->data as $value) {
				$this->Row(
						array($no++,
							$value->get_wa_number()."\n".$value->get_ref_number(),
							$value->get_rm_name(),
							$value->get_payment_date()."\n".$value->get_book_date(),
							$value->get_nod_number()."\n".$value->get_nod_date()."\n".$value->get_type(),
							$value->get_sp4hln_number(),
							$value->get_curr_loan()."\n".number_format($value->get_amount())."\n".$value->get_rate_type(),
							$value->get_curr_eff()."\n".number_format($value->get_amount_curr_eff())."\n".number_format($value->get_amount_curr_local()) ,
							$value->get_apdpl_number()."\n".$value->get_register_number(),
							$value->get_akun_code()."\n".$value->get_output_code()."\n".$value->get_dana_code(),
							$value->get_amount_service(),
							$value->get_medium_name()."\n".$value->get_onlending_desc()."\n".$value->get_dmfas_id(),
							$value->get_reksus_type()."\n".$value->get_reksus_number()
						)
				);
			}
	   
	   }		
        $this->Ln(3);
    }

    

    

    

    

    

    



    

}

//end of class
//-----------------------
//mengambil array data dari controller
if (is_array($this->data)) {
    $data = $this->data;
} else {
    //echo 'bukan array';
}
//mengambil array tanggal awal dari controller
if (is_array($this->kdtgl_awal)) {
    foreach ($this->kdtgl_awal as $kdtgl_awal) {
        
    }
} else {
    //echo 'bukan array';
}

//mengambil array tanggal akhir dari controller
if (is_array($this->kdtgl_akhir)) {
    foreach ($this->kdtgl_akhir as $kdtgl_akhir) {
        
    }
} else {
    //echo 'bukan array';
}




//--------------------------
//pilihan
//judul laporan
$judul1= $this->judul1;$nm_kppn = $this->nm_kppn;
$judul = 'Laporan '.$judul1; //judul file laporan
$tipefile = '.pdf';
$nmfile = $judul . $tipefile; //nama file penyimpanan, kosongkan jika output ke browser

$options = array(
    'judul' => $judul, //judul file laporan
    'filename' => $nmfile, //nama file penyimpanan, kosongkan jika output ke browser   
    'destinationfile' => 'D', //I=inline browser (default), F=local file, D=download
    'paper_size' => 'F4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'L' //orientation: P=portrait, L=landscape
);
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>





