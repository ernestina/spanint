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
	private $nm_kppn2;
	private $nm_kppn3;
	private $kdjk;
	
    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(),$nm_kppn,$nm_kppn2,$nm_kppn3,$kdjk) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
        $this->nm_kppn = $nm_kppn;
		$this->nm_kppn2 = $nm_kppn2;
		$this->nm_kppn3 = $nm_kppn3;
		$this->kdjk=$kdjk;
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
		$kdjk=$this->kdjk;
		$this->HeaderAtas1($judul,$nm_kppn,$nm_kppn2,$nm_kppn3,$kdtgl_awal1,$kdtgl_akhir1);
        //----------------------------------------------- 
        #pengaturan khusus
        $h = 40;
		 $border = 0;
		 

        $this->SetFont('Arial', 'B', 7);
        $ukuran_kolom_jenis_belanja = 200;
        $ukuran_kolom_akun = 200;
        $ukuran_kolom_dana = 120;
		$ukuran_kolom_dana1 = 90;
		$kolom1=20;
		$kolom_grandtotal=$kolom1+$ukuran_kolom_akun;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($ukuran_kolom_akun, $h,$kdjk, 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_akun);
        $this->Cell($ukuran_kolom_dana1, $h, 'Pagu', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana1);
        $this->Cell($ukuran_kolom_dana1, $h, 'Realisasi', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana1);
        $this->Cell($ukuran_kolom_dana, $h, 'Persentase Realisasi', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_dana1, $h, 'Outstanding Kontrak', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana1);
        $this->Cell($ukuran_kolom_dana1, $h, 'Block Amount', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_dana1);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_dana1, $h, 'Total Fund Available', 1, 1, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_dana1);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1, $ukuran_kolom_akun,
		$ukuran_kolom_dana1,$ukuran_kolom_dana1,
		$ukuran_kolom_dana,$ukuran_kolom_dana1,
		$ukuran_kolom_dana1,$ukuran_kolom_dana1
		));
        $this->SetAligns(array('C', 'L','R','R','C','R','R','R'));

        if (count($this->data) == 0) {
            $this->Row(
                    array('',
                        'N I H I L',
                        '',
                        '', 
                        '',
                        '', ''
                    )
            );
        } else {
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data as $value) {
				if($value->get_budget_amt() == 0) { 
					$nil1="0.00%" ;
				} else {
                    $nil1=number_format(($value->get_actual_amt()/$value->get_budget_amt())*100, 2) ."%" ;
				}
				
                $this->Row(
                        array($no++,
                            $value->get_kdkegiatan().'|'.$value->get_nmkegiatan(),
                            number_format($value->get_budget_amt()),
                            number_format($value->get_actual_amt()),
							$nil1,
							number_format($value->get_obligation()),
							number_format($value->get_block_amount()),
							number_format($value->get_balancing_amt())
							)
                        );
							$tot_pagu+=$value->get_budget_amt();
							$tot_real+=$value->get_actual_amt();
							$tot_kontrak += $value->get_obligation();
							$tot_block += $value->get_block_amount();
							$tot_balance += $value->get_balancing_amt();
					}
						
        }
		$this->SetFont('Arial', 'B', 7);
            $h = 20;
            $this->SetFillColor(200, 200, 200);
            $left = $this->GetX();
            $this->Cell($kolom_grandtotal, $h, 'GRAND TOTAL', 1, 0, 'L', true);
            $this->SetX($left += $kolom_grandtotal);
            $this->Cell($ukuran_kolom_dana1, $h, number_format($tot_pagu), 1, 0, 'R', true);
            $this->SetX($left += $ukuran_kolom_dana1);
            $this->Cell($ukuran_kolom_dana1, $h, number_format($tot_real), 1, 0, 'R', true);
            $this->SetX($left += $ukuran_kolom_dana1);
			$this->Cell($ukuran_kolom_dana, $h, '', 1, 0, 'R', true);
            $this->SetX($left += $ukuran_kolom_dana);
            $this->Cell($ukuran_kolom_dana1, $h, number_format($tot_kontrak), 1, 0, 'R', true);
            $this->SetX($left += $ukuran_kolom_dana1);
            $this->Cell($ukuran_kolom_dana1, $h, number_format($tot_block), 1, 0, 'R', true);
            $this->SetX($left += $ukuran_kolom_dana1);
            $px1 = $this->GetX();
            $py1 = $this->GetY();
            $px2 = $px1;
            $py2 = $py1;
            $this->SetXY($px2, $py2);
            $py3 = $this->GetY();
            $this->Cell($ukuran_kolom_dana1, $h, number_format($tot_balance), 1, 1, 'R', true);

        $this->Ln(3);
    }

 //-----------------------------------

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


   $nm_kppn2 = $this->nm_kppn2;$nm_kppn = $this->nm_kppn;
	$nm_kppn3 = $this->nm_kppn3;

//--------------------------
//pilihan
//judul laporan
$judul1= $this->judul1;
$nm_kppn = $this->nm_kppn;
$kdjk = $this->kdjk;

$judul = 'Laporan '.$judul1; //judul file laporan
$tipefile = '.pdf';
$nmfile = $judul . $tipefile; //nama file penyimpanan, kosongkan jika output ke browser

$options = array(
    'judul' => $judul, //judul file laporan
    'filename' => $nmfile, //nama file penyimpanan, kosongkan jika output ke browser   
    'destinationfile' => 'D', //I=inline browser (default), F=local file, D=download
    'paper_size' => 'A4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'L' //orientation: P=portrait, L=landscape
);
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir,$nm_kppn,$nm_kppn2,$nm_kppn3,$kdjk);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>









