<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : holdSPM_PDF.php
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
    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn,$nm_kppn2,$nm_kppn3) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
        $this->nm_kppn = $nm_kppn;
		$this->nm_kppn2 = $nm_kppn2;
		$this->nm_kppn3 = $nm_kppn3;
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
        //----------------------------------------------- 

        #pengaturan khusus
		$border = 0;
        $h = 40;
        $this->SetFont('Arial', 'B', 7);
        $ukuran_kolom_pagu_total_sisa = 80;
        $ukuran_kolom_pagu_total = 100;
        $ukuran_kolom_jenis_belanja = 65;
        $ukuran_kolom_satker = 75;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
        $ukuran_kolom_deskripsi = 244;
		$kolom_grandtotal1=30+$ukuran_kolom_pagu_total_sisa+
		$ukuran_kolom_pagu_total+$ukuran_kolom_pagu_total;
		$kolom_grandtotal2=$ukuran_kolom_satker+$ukuran_kolom_dana+
		$ukuran_kolom_jenis_belanja+$ukuran_kolom_jenis_belanja+$ukuran_kolom_deskripsi;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell(30, $h, 'No', 1, 0, 'L', true);
        $this->SetX($left += 30);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Nomor SP2D', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_pagu_total_sisa);
        $this->Cell($ukuran_kolom_pagu_total, $h, 'Tanggal Selesai SP2D', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_pagu_total);
        $this->Cell($ukuran_kolom_pagu_total, $h, 'Tanggal SP2D', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_pagu_total);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Nilai SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_satker, $h, 'Nomor Invoice', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_satker);
        $this->Cell($ukuran_kolom_dana, $h, 'Tanggal Invoice', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Jenis SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Jenis SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_deskripsi, $h, 'Deskripsi', 1, 1, 'C', true);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array(30, $ukuran_kolom_pagu_total_sisa, $ukuran_kolom_pagu_total, $ukuran_kolom_pagu_total, $ukuran_kolom_jenis_belanja, $ukuran_kolom_satker, $ukuran_kolom_dana, $ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja, $ukuran_kolom_deskripsi));
        $this->SetAligns(array('C', 'C', 'C', 'C', 'R', 'C', 'C', 'C', 'C', 'L'));
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
                    )
            );
		}else{
		
		$no = 1;
        $this->SetFillColor(255);
        foreach ($this->data as $value) {
            $this->Row(
                    array($no++,
                        $value->get_check_number(),
                        $value->get_creation_date(),
                        $value->get_check_date(),
                        number_format($value->get_amount()),
                        $value->get_invoice_num(),
                        $value->get_invoice_date(),
                        $value->get_attribute6(),
                        $value->get_jenis_sp2d(),
                        $value->get_description()
                    )
            );
			$tot_pot = $tot_pot + $value->get_amount();				
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
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($tot_pot), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
				$this->Cell($kolom_grandtotal2, $h,'', 1, 1, 'R', true);
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


$nm_kppn2 = $this->nm_kppn2;
$nm_kppn3 = $this->nm_kppn3;

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
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir,$nm_kppn,$nm_kppn2,$nm_kppn3);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>




