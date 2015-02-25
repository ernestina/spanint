<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : monitoringSp2d_PDF.php
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
        $this->SetFont('Arial', 'B', 7);
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 140;
        $ukuran_kolom_satker = 80;
		$ukuran_kolom_satker1 = 140;
        $ukuran_kolom_akun = 40;
		$ukuran_kolom1 = 30;
        $ukuran_kolom_dana = 100;
        $ukuran_kolom_bank_pembayar = 60;
        $ukuran_kolom_norek_penerima = 80;
		
		$kolom_grandtotal1=$ukuran_kolom1+$ukuran_kolom_dana+$ukuran_kolom_jenis_belanja+$ukuran_kolom_satker+
		$ukuran_kolom_satker1+$ukuran_kolom_jenis_belanja+
		$ukuran_kolom_bank_pembayar+$ukuran_kolom_norek_penerima;
		
		

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($ukuran_kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom1);
        $this->Cell($ukuran_kolom_dana, $h, 'No. SPM/ Tgl. SPM', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_dana);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'No. SP2D/NTPN /Tgl. SP2D /No. Tagihan', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_satker, $h, 'Satker Penerima', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_satker);
        $this->Cell($ukuran_kolom_satker1, $h, 'Uraian SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_satker1);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Atas Nama', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_bank_pembayar, $h, 'Setoran', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_bank_pembayar);
        $this->Cell($ukuran_kolom_norek_penerima, $h, 'Akun', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_norek_penerima);
        $this->Cell($ukuran_kolom_norek_penerima, $h, 'Jumlah', 1, 1, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_norek_penerima);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array(
            $ukuran_kolom1, $ukuran_kolom_dana,
            $ukuran_kolom_jenis_belanja, $ukuran_kolom_satker,
            $ukuran_kolom_satker1, $ukuran_kolom_jenis_belanja,
            $ukuran_kolom_bank_pembayar, $ukuran_kolom_norek_penerima,
           $ukuran_kolom_norek_penerima
        ));
        $this->SetAligns(array('C', 'C', 'C', 'C', 'L', 'L', 'L', 'C','R'));
        
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
                        ''
                    )
            );
		}else{
			$no = 1;
			$this->SetFillColor(255);
			foreach ($this->data as $value) {
            $this->Row(
                    array($no++,
                        $value->get_no_spm()."\n".$value->get_tgl_spm(),
                        $value->get_no_sp2d()."\n".$value->get_tgl_sp2d(),
                        $value->get_satker(),
                        $value->get_description(),
                        $value->get_nama2(),
                        $value->get_deskripsi_akun(),
                        $value->get_akun(),
                       number_format($value->get_nilai_ori())
                    )
            );
			$tot_pot = $tot_pot + $value->get_nilai_ori();	
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
				$this->Cell($ukuran_kolom_norek_penerima, $h,number_format($tot_pot), 1, 1, 'R', true);
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







