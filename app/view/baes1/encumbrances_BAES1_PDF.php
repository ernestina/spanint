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
	 private $nm_kppn2;
	  private $nm_kppn3;
	
    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(),$nm_kppn,$nm_kppn2,$nm_kppn3) {
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
        //-----------------------------------
         
        //----------------------------------------------- 
        #pengaturan khusus
		$border = 0;
        $h = 40;
        $this->SetFont('Arial', 'B', 7);
        $ukuran_kolom_dana = 97;
		$ukuran_kolom1 = 30;
		$ukuran_kolom2 = 70;
		$ukuran_kolom3 = 60;
		$ukuran_kolom4 = $ukuran_kolom1+$ukuran_kolom2+
		$ukuran_kolom3+$ukuran_kolom2+
		$ukuran_kolom3+$ukuran_kolom_dana+
		$ukuran_kolom_dana+$ukuran_kolom_dana+
		$ukuran_kolom_dana
		;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($ukuran_kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom1);
        $this->Cell($ukuran_kolom2, $h, 'Satker', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom2);
        $this->Cell($ukuran_kolom3, $h, 'Nomor PO', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom3);
        $this->Cell($ukuran_kolom2, $h, 'CAN', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom2);
        $this->Cell($ukuran_kolom3, $h, 'Tanggal Approve', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom3);
        $this->Cell($ukuran_kolom_dana, $h, 'Nomor Kontrak', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_dana, $h, 'Uraian Kontrak', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_dana, $h, 'Nilai Kontrak', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_dana, $h, 'Nilai Realisasi', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_dana);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_dana, $h, 'Nilai Sisa Encumbrance', 1, 1, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_dana);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($ukuran_kolom1,$ukuran_kolom2,$ukuran_kolom3,$ukuran_kolom2,$ukuran_kolom3, $ukuran_kolom_dana,$ukuran_kolom_dana,
		$ukuran_kolom_dana, $ukuran_kolom_dana, $ukuran_kolom_dana));
        $this->SetAligns(array('C', 'C','C', 'R', 'C', 'L','L', 'R','R', 'R', 'R', 'R'));

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
                        ''
                    )
            );
        } else {
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data as $value) {
                $this->Row(
                        array($no++,
							$value->get_status(),
                            $value->get_segment1(),
                            $value->get_attribute11(),
                            $value->get_app_date(),
                            $value->get_attribute1(),
                            $value->get_comments(),
                            number_format($value->get_encumbered_amount()),
                            number_format($value->get_billed_amount()),
                            number_format($value->get_sisa_encumbrence()),
                        )
                );
				$tot1+=$value->get_sisa_encumbrence();
            }
				$this->SetFont('Arial', 'B', 7);
				$h = 20;
				$this->SetFillColor(200, 200, 200);
				$left = $this->GetX();
				$px1 = $this->GetX();
				$py1 = $this->GetY();
				$px2 = $px1;
				$py2 = $py1;
				$this->SetXY($px2, $py2);
				$this->Cell($ukuran_kolom4, $h, 'TOTAL', 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom4);
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_dana, $h, number_format($tot1), 1, 1, 'R', true);
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

$nm_kppn = $this->nm_kppn;
$nm_kppn2 = $this->nm_kppn2;
$nm_kppn3 = $this->nm_kppn3;



//--------------------------
//pilihan
//judul laporan
$judul1= $this->judul1;
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
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir,$nm_kppn,$nm_kppn2,$nm_kppn3);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>









