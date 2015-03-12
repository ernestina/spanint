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
		$kolom1=160;
		$kolom2=80;
        $ukuran_kolom_1a = 80;
        $ukuran_kolom_2a = 60;
        $ukuran_kolom_3a = 75;
        $ukuran_kolom_4a = 60;
		$ukuran_kolom_5a = 50;
        $ukuran_kolom_6a = 50;
		$ukuran_kolom_a = $ukuran_kolom_1a +$ukuran_kolom_1a +$ukuran_kolom_1a + $ukuran_kolom_2a;
        $ukuran_kolom_1b = 100;
        $ukuran_kolom_2b = 60;
        $ukuran_kolom_3b = 75;
		$ukuran_kolom_4b = 60;
        $ukuran_kolom_5b = 50;
		$ukuran_kolom_6b = 50;
        $ukuran_kolom_b = $ukuran_kolom_1b +$ukuran_kolom_1b+$ukuran_kolom_1b+ $ukuran_kolom_2b;
		$kolom_grandtotal1=$kolom1+$kolom2;
		
		$kolom_grandtotal2=$ukuran_kolom_5a+$ukuran_kolom_6a+$ukuran_kolom_1b+$ukuran_kolom_2b+
		$ukuran_kolom_3b+$ukuran_kolom_4b;
		$kolom_grandtotal3a=$ukuran_kolom_5a+$ukuran_kolom_6a;
		$kolom_grandtotal3b=$ukuran_kolom_5b+$ukuran_kolom_6b+$ukuran_kolom_pagu_total ;
		
		
        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
       
		$this->Cell($kolom1, $h, 'URAIAN', 1, 0, 'C', true);
		$this->SetX($left += $kolom1);
		$this->Cell($kolom2, $h, 'APBN', 1, 0, 'C', true);
		$this->SetX($left += $kolom2);
		  $px1 = $this->GetX();
        $this->Cell($ukuran_kolom_a, $h / 2, 'REALISASI', 1, 0, 'C', true);
       
		$py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1+20;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_1a, $h / 2, 'BUN', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1a);
        $this->Cell($ukuran_kolom_1a, $h / 2, 'KPPN', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1a);
        $this->Cell($ukuran_kolom_1a, $h / 2, 'JUMLAH', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1a);
        $this->Cell($ukuran_kolom_2a, $h / 2, 'PERSENTASE', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2a);
	
   $this->Ln(20);

        $this->SetFont('Arial', '', 6);
        $this->SetWidths(array($kolom1,$kolom2,$ukuran_kolom_1a,
			$ukuran_kolom_1a,$ukuran_kolom_1a,
			$ukuran_kolom_2a
        ));
        $this->SetAligns(array('L', 'R',
		'R', 'R','R','C'));
        
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
			
			$this->SetFillColor(255);
			$trn_kbi = 0;
			$rph_kbi = 0;
			$trn_non_kbi = 0;
			$rph_non_kbi = 0;
			foreach ($this->data as $value) {
				if	($value->get_apbn() < 0) { 
					$nil1="(".number_format($value->get_apbn()).")";
				} else { 
					$nil1=number_format($value->get_apbn());
					
				}
				if	($value->get_realisasi_bun() < 0) { 
					$nil2="(".number_format($value->get_realisasi_bun()).")";
				} else { 
					$nil2=number_format($value->get_realisasi_bun());
					
				}
				
				if	($value->get_realisasi_kppn() < 0) { 
					$nil3="(".number_format($value->get_realisasi_kppn()).")";
				} else { 
					$nil3=number_format($value->get_realisasi_kppn());
					
				}
				if	($value->get_jumlah() < 0) { 
					$nil4="(".number_format($value->get_jumlah()).")";
				} else { 
					$nil4=number_format($value->get_jumlah());
					
				}
				
				if	($value->get_apbn() == 0) { 
					$nil='0.00%';
				} else { 
					$nil="(".number_format($value->get_jumlah()/$value->get_apbn()*100,2)."%)";
					
				}  
				$this->Row(
						array(
							$value->get_deskripsi(),
							$nil1,
							$nil2,
							$nil3,
							$nil4,
							$nil));
				/* $rph_apbn += $value->get_apbn();
				$rph_non_kbi += $value->get_realisasi_bun();
				$trn_kbi += $value->get_trn_kbi();
				$trn_non_kbi += $value->get_trn_non_kbi(); */

				
			}
				/* $this->SetFont('Arial', 'B', 7);
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
				$this->Cell($ukuran_kolom_1a, $h, number_format($trn_kbi), 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_1a);
				$this->Cell($ukuran_kolom_2a, $h, number_format($rph_kbi), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_2a);
				$px1 = $this->GetX();
				$py1 = $this->GetY();
				$px2 = $px1;
				$py2 = $py1;
				$this->SetXY($px2, $py2);
				$this->Cell($ukuran_kolom_1b, $h, number_format($trn_non_kbi), 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_1b);
				$this->Cell($ukuran_kolom_2b, $h, number_format($rph_non_kbi), 1, 1, 'R', true);
				$this->Ln(3); */
		
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






