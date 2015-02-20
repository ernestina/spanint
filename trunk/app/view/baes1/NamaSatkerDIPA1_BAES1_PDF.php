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
require_once("./././public/fpdf17/fpdf.php");
require_once("./././public/fpdf17/rotation.php");

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
    private $nm_kppn2;
	private $nm_kppn3;
    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn2, $nm_kppn3) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
        $this->nm_kppn2 = $nm_kppn2;
		$this->nm_kppn3 = $nm_kppn3;
    }

    /*
     * Index
     */
	
    public function rptDetailData() {
		//------------------------------
		$judul=$this->options['judul'];
		$nm_kppn = $this->nm_kppn;
		$nm_kppn2 = $this->nm_kppn2;
		$nm_kppn3 = $this->nm_kppn3;
		$kdtgl_awal1 = $this->kdtgl_awal;
		$kdtgl_akhir1 = $this->kdtgl_akhir;
		 $border = 0;
        $h = 40;
        $left = 10;
		$this->HeaderAtas1($judul,$nm_kppn,$nm_kppn2,$nm_kppn3,$kdtgl_awal1,$kdtgl_akhir1);
        //-----------------------------------
       
		//------------------------------------------------------------------
        $this->SetFont('Arial', 'B', 7);

        $ukuran_kolom_pagu_total_sisa = 35;
        $ukuran_kolom_pagu_total = 100;
        $ukuran_kolom_jenis_belanja = 100;
        $ukuran_kolom_satker = 75;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$ukuran_kolom_dana1= 200;
		$ukuran_kolom_dana2= 120;
        $ukuran_kolom_deskripsi = 160;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell(30, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += 30);
        $this->Cell($ukuran_kolom_dana, $h, 'Kode Satker', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_dana1, $h, 'Nama Satker', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana1);
        $this->Cell($ukuran_kolom_dana2, $h, 'No. DIPA', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana2);
        $this->Cell($ukuran_kolom_pagu_total, $h, 'Total Pagu Belanja', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_pagu_total);
        $this->Cell($ukuran_kolom_pagu_total, $h, 'Total Pagu Pendapatan', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_pagu_total);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Tanggal Posting Revisi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_satker, $h, 'No. Revisi Terakhir', 1, 1, 'C', true);
        $this->Ln(2);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array(30,
		$ukuran_kolom_dana,$ukuran_kolom_dana1,
		$ukuran_kolom_dana2, $ukuran_kolom_pagu_total,
		$ukuran_kolom_pagu_total,
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_satker));
        $this->SetAligns(array('C', 'C', 'L', 'C', 'R', 'R', 'C', 'C'));
       
	   if (count($this->data) == 0) {
			$this->Row(
                    array('',
                        'N I H I L',
                        '',
                        '',
                        '',
						 '',
                        '',
                        ''
                    )
            );
	   
	   
	   
	   }else{
	   
		   $no = 1;$this->SetFillColor(255);
			foreach ($this->data as $value) {
				$this->Row(
						array($no++,
							$value->get_kdsatker(),
							'',
							$value->get_dipa_no(),
							number_format($value->get_total_pagu_belanja()),
							number_format($value->get_total_pagu_pendapatan()),
							$value->get_tgl_rev(),
							$value->get_rev()
						)
				);
			}
	   
	   }		
        $this->Ln(3);
    }

	public function printPDF() {

        if ($this->options['paper_size'] == "F4") {
            $a = 8.3 * 72; //1 inch = 72 pt
            $b = 13.0 * 72;
            $this->FPDF($this->options['orientation'], "pt", array($a, $b));
        } else {
            $this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
        }

        $this->SetAutoPageBreak(false, 30);
        $this->AliasNbPages();
        $this->SetFont("helvetica", "B", 10);
        $this->AddPage();

        $this->rptDetailData();
        $this->Footer();
        $this->Output($this->options['filename'], $this->options['destinationfile']);
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

//mengambil array nama satker-kppn dari controller
 $nm_kppn2 = $this->nm_kppn2;
 $nm_kppn3 = $this->nm_kppn3;
 
/* if (is_array($this->nm_kppn2)) {
    foreach ($this->nm_kppn2 as $nm_kppn2) {
        $nm_kppn2 = $nm_kppn2->get_nama_kppn2();
    }
} else {
    //echo 'bukan array';
    $nm_kppn2 = $this->nm_kppn2;
}

if (is_array($this->nm_kppn3)) {
    foreach ($this->nm_kppn3 as $nm_kppn3) {
        $nm_kppn3 = $nm_kppn3->get_nama_kppn3();
    }
} else {
    //echo 'bukan array';
    $nm_kppn3 = $this->nm_kppn3;
} */


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
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn2, $nm_kppn3);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>





