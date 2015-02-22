<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : fund_fail_PDF.php
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
    
        //----------------------------------------------- 
        #pengaturan khusus
		  $border = 0;
        $h = 40;
        $this->SetFont('Arial', 'B', 6);
		$ukuran_kolom_pagu_total_sisa = 100;
        $ukuran_kolom_jenis_belanja = 90;
		$ukuran_kolom_jenis_belanja1=$ukuran_kolom_jenis_belanja*7;
		$kolom1=20;
        $ukuran_kolom_akun = 90;
        $ukuran_kolom_dana = 30;
		$kolom_grandtotal=$kolom1+$ukuran_kolom_dana+$ukuran_kolom_akun;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($ukuran_kolom_dana, $h, 'Lokasi', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_akun, $h, 'Nama Lokasi', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_akun);
		$px1 = $this->GetX();
		
        $this->Cell($ukuran_kolom_jenis_belanja1, $h / 2, 'JENIS BELANJA', 1, 0, 'C', true);
		$py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'DBH', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'DAU', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'DAK', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'DANA OTONOMI KHUSUS', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'DANA PENYESUAIAN', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'DANA KEISTIMEWAAN DIY', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'SUSPEND', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);
        $this->SetX($left += $ukuran_kolom_jenis_belanja1);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Total Realisasi Belanja Transfer', 1, 1, 'C', true);
        $this->Ln(3);


        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$ukuran_kolom_dana,
		$ukuran_kolom_akun, $ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja,$ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja,$ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja,$ukuran_kolom_jenis_belanja,
		$ukuran_kolom_pagu_total_sisa
		));
        $this->SetAligns(array('C', 'C', 'L', 'R', 'R', 'R', 'R', 'R', 'R', 'R','R'));

        if (count($this->data) == 0) {
            $this->Row(
                    array('',
                        'N I H I L',
                        '',
                        '',
						 '',
						 '',
                        ''
                    )
            );
        } else {
		
            $no = 1;
			$tot_pot = 0;
			$tot_51 = 0;
			$tot_52 = 0;
			$tot_53 = 0;
			$tot_54 = 0;
			$tot_55 = 0;
			$tot_56 = 0;						
			$tot_59 = 0;
			$tot_real = 0;
            $this->SetFillColor(255);
            foreach ($this->data as $value) {
                $this->Row(
                        array($no++,
                            $value->get_lokasi(),
                            $value->get_nmlokasi(),
							number_format($value->get_belanja_51()),
							number_format($value->get_belanja_52()),
							number_format($value->get_belanja_53()),
							number_format($value->get_belanja_54()),
							number_format($value->get_belanja_55()),
							number_format($value->get_belanja_56()),
							number_format($value->get_belanja_59()),
                            number_format($value->get_realisasi())
                        )
                );
						$tot_real+=$value->get_realisasi();
						$tot_51+=$value->get_belanja_51();
						$tot_52+=$value->get_belanja_52();
						$tot_53+=$value->get_belanja_53();
						$tot_54+=$value->get_belanja_54();
						$tot_55+=$value->get_belanja_55();
						$tot_56+=$value->get_belanja_56();
						$tot_57+=$value->get_belanja_59();
            }
			$this->SetFont('Arial', '', 7);
				$h = 20;
				$this->SetFillColor(200, 200, 200);
				$left = $this->GetX();
				$this->Cell($kolom_grandtotal, $h, 'GRAND TOTAL', 1, 0, 'L', true);
				$this->SetX($left += $kolom_grandtotal);
				$px1 = $this->GetX();
				$py1 = $this->GetY();
				$px2 = $px1;
				$py2 = $py1;
				$this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($tot_51), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		 $this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($tot_52), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		 $this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($tot_53), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($tot_54), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($tot_55), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($tot_56), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($tot_59), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, number_format($tot_real), 1, 0, 'R', true);
        $py3 = $this->GetY();
        //$this->SetY($py3 -= 20);
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
    'paper_size' => 'F4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'L' //orientation: P=portrait, L=landscape
);
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>









