<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : sp2dBackdate_PDF.php
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
        $ukuran_kolom_satker = 80;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 80;
        $ukuran_kolom_file = 85;
        $ukuran_kolom_bank_pembayar = 60;
        $ukuran_kolom_norek_penerima = 80;
        $ukuran_kolom_tgl_selsp2d = 60;
        $ukuran_kolom_tgl_sp2d = 45;
		$kolom_grandtotal1=30+$ukuran_kolom_tgl_selsp2d+
		$ukuran_kolom_tgl_sp2d+$ukuran_kolom_satker+$ukuran_kolom_dana;
		$kolom_grandtotal2=$ukuran_kolom_bank_pembayar+$ukuran_kolom_dana+
		$ukuran_kolom_jenis_belanja+$ukuran_kolom_norek_penerima+
		$ukuran_kolom_dana+$ukuran_kolom_file+$ukuran_kolom_jenis_belanja;


        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell(30, $h, 'No', 1, 0, 'L', true);
        $this->SetX($left += 30);
        $this->Cell($ukuran_kolom_tgl_selsp2d, $h, 'Tgl Selesai SP2D', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_tgl_selsp2d);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_tgl_sp2d, $h, 'Tgl SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_tgl_sp2d);
        $this->Cell($ukuran_kolom_satker, $h, 'No. SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_satker);
        $this->Cell($ukuran_kolom_dana, $h, 'No. Invoice', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Jumlah Rp', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_bank_pembayar, $h, 'Bank Pembayar', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_bank_pembayar);
        $this->Cell($ukuran_kolom_dana, $h, 'Bank Penerima', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Nama', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_norek_penerima, $h, 'No. Rekening Penerima', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_norek_penerima);
        $this->Cell($ukuran_kolom_dana, $h, 'Deskripsi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_file, $h, 'File Transaksi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_file);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Status', 1, 1, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array(
            30, $ukuran_kolom_tgl_selsp2d,
            $ukuran_kolom_tgl_sp2d, $ukuran_kolom_satker,
            $ukuran_kolom_dana, $ukuran_kolom_jenis_belanja,
            $ukuran_kolom_bank_pembayar, $ukuran_kolom_dana,
            $ukuran_kolom_jenis_belanja, $ukuran_kolom_norek_penerima,
            $ukuran_kolom_dana, $ukuran_kolom_file,
            $ukuran_kolom_jenis_belanja
        ));
        $this->SetAligns(array('C', 'C', 'C', 'R', 'R', 'R', 'L', 'L', 'L', 'L', 'L', 'L', 'R'));
        
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
                        ''
                    )
            );
		}else{
			$no = 1;
        $this->SetFillColor(255);
        foreach ($this->data as $value) {
            $this->Row(
                    array($no++,
                        $value->get_creation_date(),
                        $value->get_payment_date(),
                        $value->get_check_number(),
                        $value->get_invoice_num(),
                        number_format($value->get_check_amount()),
                        $value->get_bank_account_name(),
                        $value->get_bank_name(),
                        $value->get_vendor_name(),
                        $value->get_vendor_ext_bank_account_num(),
                        $value->get_invoice_description(),
                        $value->get_ftp_file_name(),
                        $value->get_return_desc() . '--' . $value->get_payment_method() . '--' . $value->get_sorbor_number() . '--' . $value->get_sorbor_date()
                    )
            );
			$tot_pot = $tot_pot + $value->get_check_amount();	
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




