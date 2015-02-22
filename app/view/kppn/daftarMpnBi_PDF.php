<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : daftarPelimpahan_PDF.php
  //Dibuat oleh : Rifan Abdul Rachman
  //Tanggal dibuat : 18-07-2014
  //----------------------------------------------------
 */
ob_start();
//-------------------------------------
require_once("./././public/fpdf17/fpdf.php");
require_once("./././public/fpdf17/rotation.php");

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
         
       
        
       

        
           
		//--------------------

			
        
        //----------------------------------------------- 

        #pengaturan khusus
		 $border = 0;
        $h = 40;
        $this->SetFont('Arial', 'B', 7);
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_pagu_total = 90;
        $ukuran_kolom_jenis_belanja = 60;
		$kolom1=20;
		$kolom2=80;
        $ukuran_kolom_1a = 100;
        $ukuran_kolom_2a = 120;
        $ukuran_kolom_3a = 75;
        $ukuran_kolom_4a = 60;
		$ukuran_kolom_5a = 50;
        $ukuran_kolom_6a = 50;
		$ukuran_kolom_a = $ukuran_kolom_1a + $ukuran_kolom_2a;
        $ukuran_kolom_1b = 100;
        $ukuran_kolom_2b = 120;
        $ukuran_kolom_3b = 75;
		$ukuran_kolom_4b = 60;
        $ukuran_kolom_5b = 50;
		$ukuran_kolom_6b = 50;
        $ukuran_kolom_b = $ukuran_kolom_1b + $ukuran_kolom_2b;
		$kolom_grandtotal1=$kolom1+$kolom2+$ukuran_kolom_1a;
		
		$kolom_grandtotal2=$ukuran_kolom_5a+$ukuran_kolom_6a+$ukuran_kolom_1b+$ukuran_kolom_2b+
		$ukuran_kolom_3b+$ukuran_kolom_4b;
		$kolom_grandtotal3a=$ukuran_kolom_5a+$ukuran_kolom_6a;
		$kolom_grandtotal3b=$ukuran_kolom_5b+$ukuran_kolom_6b+$ukuran_kolom_pagu_total ;
		
		
        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
		$this->Cell($kolom2, $h, 'Tanggal', 1, 0, 'C', true);
		$this->SetX($left += $kolom2);
		  $px1 = $this->GetX();
        $this->Cell($ukuran_kolom_a, $h / 2, 'KPPN Induk', 1, 0, 'C', true);
       
		$py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + $kolom1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_1a, $h / 2, 'Transaksi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1a);
        $this->Cell($ukuran_kolom_2a, $h / 2, 'Nilai', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2a);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);
        $this->SetX($left += $ukuran_kolom_a);
        $this->Cell($ukuran_kolom_b, $h / 2, 'KPPN Anak', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1 + $ukuran_kolom_a;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);

        $this->Cell($ukuran_kolom_1b, $h / 2, 'Transaksi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1b);
        $this->Cell($ukuran_kolom_2b, $h / 2, 'Nilai', 1, 1, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2b);
        $this->Ln(3);

        $this->SetFont('Arial', '', 6);
        $this->SetWidths(array($kolom1,$kolom2,$ukuran_kolom_1a,
			$ukuran_kolom_2a,$ukuran_kolom_1b,
			$ukuran_kolom_2b
        ));
        $this->SetAligns(array('C', 'C',
		'C', 'R','C','R'));
        
		if (count($this->data) == 0) {
		 $this->Row(
             array('',
                        'N I H I L',
                        '',
                        '',
                        '',
                        ''
            ));
		
		}else{
			$no = 1;
			$this->SetFillColor(255);
			foreach ($this->data as $value) {
				$this->Row(
						array($no++,
							$value->get_tanggal_gl(),
							number_format($value->get_trn_kbi()),
							number_format($value->get_rph_kbi()),
							number_format($value->get_trn_non_kbi()),
							number_format($value->get_rph_non_kbi()),
							
				));
				$terima += $value->get_rph_kbi();
				$limpah += $value->get_rph_non_kbi();
			}
				$this->SetFont('Arial', 'B', 7);
				$h = 20;
				$this->SetFillColor(200, 200, 200);
				$left = $this->GetX();
				$this->Cell($kolom_grandtotal1, $h, 'GRAND TOTAL', 1, 0, 'L', true);
				$this->SetX($left += $kolom_grandtotal1);
				$px1 = $this->GetX();
				$py1 = $this->GetY();
				$px2 = $px1;
				$py2 = $py1;
				$this->SetXY($px2, $py2);
				$this->Cell($ukuran_kolom_2a, $h, number_format($terima), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_2a);
				$px1 = $this->GetX();
				$py1 = $this->GetY();
				$px2 = $px1;
				$py2 = $py1;
				$this->SetXY($px2, $py2);
				$this->Cell($ukuran_kolom_1b, $h, '', 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_1b);
				$this->Cell($ukuran_kolom_2b, $h, number_format($limpah), 1, 1, 'R', true);
				$this->Ln(3);
		
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
    'paper_size' => 'A4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'P' //orientation: P=portrait, L=landscape
);
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>






