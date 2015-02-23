<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : realisasiFA_PDF.php
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
         
       
     
		//--------------------

        
        //----------------------------------------------- 
        #pengaturan khusus
		 $border = 0;
        $h = 40;
        $this->SetFont('Arial', 'B', 7);
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 65;
		$ukuran_kolom_jenis_belanja1 = 90;
        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=40;
		$kolom3=50;
		$kolom4=50;
		$kolom_grandtotal=$kolom1+$kolom2+$kolom3+$kolom4+
		$ukuran_kolom_jenis_belanja+$ukuran_kolom_satker+
		$ukuran_kolom_dana+$ukuran_kolom_jenis_belanja+
		$ukuran_kolom_jenis_belanja+$ukuran_kolom_jenis_belanja;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($kolom2, $h, 'Satker', 1, 0, 'C', true);
        $this->SetX($left += $kolom2);
        $this->Cell($kolom3, $h, 'KPPN', 1, 0, 'C', true);
        $this->SetX($left += $kolom3);
        $this->Cell($kolom4, $h, 'Akun', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $kolom4);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Program', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_satker, $h, 'Output', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_satker);
        $this->Cell($ukuran_kolom_dana, $h, 'Dana', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Kewenangan', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Lokasi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Tipe Anggaran', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja1, $h, 'Pagu', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja1);
        $this->Cell($ukuran_kolom_jenis_belanja1, $h, 'Pencadangan', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja1);
        $this->Cell($ukuran_kolom_jenis_belanja1, $h, 'Realisasi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja1);
        $this->Cell($ukuran_kolom_jenis_belanja1, $h, 'Sisa Pagu', 1, 1, 'C', true);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$kolom2,$kolom3,$kolom4, 
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_satker, 
		$ukuran_kolom_dana, $ukuran_kolom_jenis_belanja, 
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja, 
		$ukuran_kolom_jenis_belanja1, $ukuran_kolom_jenis_belanja1, 
		$ukuran_kolom_jenis_belanja1, $ukuran_kolom_jenis_belanja1));
        $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'R', 'R', 'R', 'R'));

        if (count($this->data) == 0) {
            $this->Row(
                    array('',
                        'N I H I L',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        ''
                    )
            );
        } else {
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data as $value) {
                $this->Row(
                        array($no++,
                            $value->get_satker(),
                            $value->get_kppn(),
                            $value->get_akun(),
                            $value->get_program(),
                            $value->get_output(),
                            $value->get_dana(),
                            $value->get_kewenangan(),
                            $value->get_lokasi(),
                            $value->get_budget_type(),
                            number_format($value->get_budget_amt()),
                            number_format($value->get_encumbrance_amt()),
                            number_format($value->get_actual_amt()),
                            number_format($value->get_balancing_amt())
                        )
                );
				$tot_budget+=$value->get_budget_amt();
				$tot_encumbrance+=$value->get_encumbrance_amt();
				$tot_actual+=$value->get_actual_amt();
				$tot_balancing+=$value->get_balancing_amt();
				
				
            }
				$this->SetFont('Arial', 'B', 7);
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
				$this->Cell($ukuran_kolom_jenis_belanja1, $h, number_format($tot_budget), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_jenis_belanja1);
				$this->Cell($ukuran_kolom_jenis_belanja1, $h, number_format($tot_encumbrance), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_jenis_belanja1);
				$this->Cell($ukuran_kolom_jenis_belanja1, $h, number_format($tot_actual), 1, 0, 'R', true);
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja1, $h, number_format($tot_balancing), 1, 1, 'R', true);
				$this->Ln(3);
           
        }
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




