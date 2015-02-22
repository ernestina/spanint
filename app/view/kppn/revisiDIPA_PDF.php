<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : revisiDIPA_PDF.php
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
    protected $nm_kppn;
	 private $nm_kppn2;
	  private $nm_kppn3;
	
    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn, $nm_kppn2, $nm_kppn3) {
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
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 100;
        $ukuran_kolom_satker = 60;
        $ukuran_kolom_akun = 45;
        $ukuran_kolom_program = 45;
        $ukuran_kolom_output = 42;
        $ukuran_kolom_dana = 50;
        $ukuran_kolom_bank = 40;
        $ukuran_kolom_kewenangan = 50;
        $ukuran_kolom_kolorari = 50;
		$kolom_grandtotal=30+120+40+$ukuran_kolom_pagu_total_sisa;
		$kolom_grandtotal1 = $ukuran_kolom_pagu_total_sisa+ $ukuran_kolom_program +
                $ukuran_kolom_output + $ukuran_kolom_dana +
                $ukuran_kolom_satker + $ukuran_kolom_akun +
                $ukuran_kolom_bank + $ukuran_kolom_kewenangan +
                $ukuran_kolom_kolorari+$ukuran_kolom_pagu_total_sisa;
		

        $jumlah_kolom = $ukuran_kolom_jenis_belanja+ $ukuran_kolom_program +
                $ukuran_kolom_output + $ukuran_kolom_dana +
                $ukuran_kolom_satker + $ukuran_kolom_akun +
                $ukuran_kolom_bank + $ukuran_kolom_kewenangan +
                $ukuran_kolom_kolorari+$ukuran_kolom_pagu_total_sisa;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell(30, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += 30);
        $this->Cell(120, $h, 'Nomor DIPA', 1, 0, 'C', true);
        $this->SetX($left += 120);
        $this->Cell(40, $h, 'Revisi Ke', 1, 0, 'C', true);
        $this->SetX($left += 40);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Tgl Post Revisi', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_pagu_total_sisa);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Pagu', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_satker, $h, 'Satker', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_satker);
        $this->Cell($ukuran_kolom_akun, $h, 'Akun', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_akun);
        $this->Cell($ukuran_kolom_program, $h, 'Program', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_program);
        $this->Cell($ukuran_kolom_output, $h, 'Output', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_output);
        $this->Cell($ukuran_kolom_dana, $h, 'Dana', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_bank, $h, 'Bank', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_bank);
        $this->Cell($ukuran_kolom_kewenangan, $h, 'Kewenangan', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_kewenangan);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Tipe Anggaran', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_pagu_total_sisa);
        $this->Cell($ukuran_kolom_kolorari, $h, 'Kolorari', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetX($left += $jumlah_kolom);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Kode Cadangan', 1, 1, 'C', true);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array(30, 120,
            40, $ukuran_kolom_pagu_total_sisa,
            $ukuran_kolom_jenis_belanja, $ukuran_kolom_satker,
            $ukuran_kolom_akun, $ukuran_kolom_program,
            $ukuran_kolom_output, $ukuran_kolom_dana,
            $ukuran_kolom_bank, $ukuran_kolom_kewenangan,
            $ukuran_kolom_pagu_total_sisa, $ukuran_kolom_kolorari,
            $ukuran_kolom_pagu_total_sisa));
        $this->SetAligns(array('C', 'C',
            'C', 'C',
            'R', 'C',
            'C', 'C',
            'C', 'C',
            'C', 'C',
            'C', 'C',
            'C', 'C'));
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
                        ' ',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '')
            );
        } else {
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data as $value) {
                $this->Row(
                        array($no++,
                            $value->get_dipa_no(),
                            $value->get_revision_no(),
                            $value->get_tanggal_posting_revisi(),
                            number_format($value->get_line_amount()),
                            $value->get_satker_code(),
                            $value->get_account_code(),
                            $value->get_program_code(),
                            $value->get_output_code(),
                            $value->get_dana_code(),
                            $value->get_bank_code(),
                            $value->get_kewenangan_code(),
                            $value->get_budget_type(),
                            $value->get_intraco_code(),
                            $value->get_cadangan_code())
                );
				$total = $total + $value->get_line_amount();
            }
				/*$this->SetFont('Arial', 'B', 7);
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
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($total), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
				$this->Cell($kolom_grandtotal1, $h, '', 1, 1, 'R', true);
				$this->Ln(3);*/

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
//var_dump($this->nm_kppn);
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
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn, $nm_kppn2, $nm_kppn3);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>




