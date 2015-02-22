<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : GR_PFK_GLOBAL_PDF.php
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
	private $bulan;
	
    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn,$bulan) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
        $this->nm_kppn = $nm_kppn;
		$this->bulan1 = $bulan;
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
        $ukuran_kolom_jenis_belanja = 230;
        $ukuran_kolom_satker = 80;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=50;
		$kolom_grandtotal=$kolom1+$kolom2+$ukuran_kolom_jenis_belanja;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($kolom2, $h, 'Akun', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $kolom2);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Uraian Akun', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_satker, $h, 'Potongan SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_satker);
        $this->Cell($ukuran_kolom_satker, $h, 'Setoran MPN', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_satker);
        $this->Cell($ukuran_kolom_satker, $h, 'Total', 1, 1, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_satker);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$kolom2, $ukuran_kolom_jenis_belanja, $ukuran_kolom_satker, $ukuran_kolom_satker, $ukuran_kolom_satker));
        $this->SetAligns(array('C', 'C', 'L', 'R', 'R', 'R'));
		
		 if (count($this->data) == 0) {
			$this->Row(
                    array('',
                        'N I H I L',
                        '',
                        '',
                        '',
                        ''
                    )
            );
		 }else{
		     $no = 1;
			$this->SetFillColor(255);
			foreach ($this->data as $value) {
				$this->Row(
                    array($no++,
                        $value->get_akun(),
                        $value->get_uraian_akun(),
                        number_format($value->get_potongan_spm()),
                        number_format($value->get_setoran_mpn()),
                        number_format($value->get_total())
                    )
            );
			$tot_pot_spm = $tot_pot_spm + $value->get_potongan_spm();
			$tot_set_mpn = $tot_set_mpn + $value->get_setoran_mpn();
			$tot_total = $tot_total + $value->get_total();
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
            $this->Cell($ukuran_kolom_satker, $h, number_format($tot_pot_spm), 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_satker);
            $this->Cell($ukuran_kolom_satker, $h, number_format($tot_set_mpn), 1, 0, 'R', true);
            $py3 = $this->GetY();
            $this->Cell($ukuran_kolom_satker, $h, number_format($tot_total), 1, 1, 'R', true);
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
    'paper_size' => 'A4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'P' //orientation: P=portrait, L=landscape
);
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn, $this->bulan1);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>



