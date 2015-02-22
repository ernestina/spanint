<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : GR_IJP_PDF.php
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
        'paper_size' => '',
        'orientation' => ''
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
        $this->SetFont('Arial', 'B', 9);
        $ukuran_kolom_pagu_total_sisa = 100;
        $ukuran_kolom_hari = 100;
		$ukuran_kolom=160;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell(20, $h, 'No', 1, 0, 'C', true);

        $this->SetX($left += 20);
        $this->Cell(80, $h, 'Tanggal - Jam', 1, 0, 'C', true);
        $this->SetX($left += 80);
        $this->Cell(80, $h, 'Mata Uang', 1, 0, 'C', true);
        $this->SetX($left += 80);
		$this->Cell(100, $h, 'Nomor Transaksi BAT', 1, 0, 'C', true);
        $this->SetX($left += 100);
        $this->Cell(100, $h, 'Nilai Transaksi', 1, 0, 'C', true);
        $this->SetX($left += 100);
        $this->Cell($ukuran_kolom, $h, 'Nama Rekening', 1, 1, 'C', true);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array(20, 80, 
		80,100,100,$ukuran_kolom));
        $this->SetAligns(array('C', 'C', 'C', 'C', 'R','C'));
		
		if (count($this->data) == 0) {
			$this->Row(
                    array('','N I H I L',
                        '','',
                        '',''
						)
            );
		}else{
			$no = 1;
			$j1 = 0;
			$j2 = 0;
			$j3 = 0;
			$j4 = 0;
			$j5 = 0;
			$jtotal = 0;

			$this->SetFillColor(255);
			foreach ($this->data as $value) {
				$this->Row(
						array($no++,
							$value->get_creation_date(),
							$value->get_payment_currency_code(),
							$value->get_bank_trxn_number(),
							number_format($value->get_payment_amount()),
							$value->get_attribute4()
							));
				//jumlah grand total
				//-------------
				$total+=$value->get_payment_amount();
				//------------------
			}
			$this->SetFont('Arial', 'B', 7);
			$h = 20;
			$this->SetFillColor(200, 200, 200);
			$left = $this->GetX();
			$this->Cell(280, $h, 'GRAND TOTAL', 1, 0, 'L', true);
			$this->SetX($left += 280);
			//$this->Cell($ukuran_kolom_pagu_total_sisa, $h, number_format($total), 1, 0, 'R', true);
			$px1 = $this->GetX();
			$py1 = $this->GetY();
			$px2 = $px1;
			$py2 = $py1;
			$this->SetXY($px2, $py2);
			$this->Cell($ukuran_kolom_hari, $h, number_format($total), 1, 0, 'R', true);
			$py3 = $this->GetY();
			$this->SetX($left += 100);
			$this->Cell($ukuran_kolom, $h,'' , 1, 1, 'R', true);
			$this->Ln(3);
		
		}
		//---------------------------
    }

    //footer
    function Footer() {

        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
        $this->Cell(0, 10, 'Hal : ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $hari_ini = date("d-m-Y");
        $this->Cell(0, 10, 'Dicetak : ' . $hari_ini, 0, 0, 'R');
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
$tipefile = '.PDF';
$nmfile = $judul . $tipefile; //nama file penyimpanan, kosongkan jika output ke browser

$options = array(
    'judul' => $judul, //judul file laporan
    'filename' => $nmfile, //nama file penyimpanan, kosongkan jika output ke browser   
    'destinationfile' => 'D', //I=inline browser (default), F=local file, D=download
    'paper_size' => 'A4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'P' //orientation: P=portrait, L=landscape
);
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>






