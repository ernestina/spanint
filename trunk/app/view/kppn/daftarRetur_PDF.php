<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : DataRealisasiBA_PDF.php
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
 
        #pengaturan khusus
		 $border = 0;
        $h = 40;
        $this->SetFont('Arial', 'B', 7);
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_pagu_total = 60;
        $ukuran_kolom_jenis_belanja = 60;
        $ukuran_kolom_1a = 100;
        $ukuran_kolom_2a = 140;
        $ukuran_kolom_3a = 70;
        $ukuran_kolom_4a = 55;
		$ukuran_kolom_5a = 60;
        $ukuran_kolom_a = $ukuran_kolom_1a + $ukuran_kolom_2a + $ukuran_kolom_3a + $ukuran_kolom_4a+$ukuran_kolom_5a;
        $ukuran_kolom_1b = 100;
        $ukuran_kolom_2b = 60;
        $ukuran_kolom_3b = 160;
        $ukuran_kolom_b = $ukuran_kolom_1b + $ukuran_kolom_2b + $ukuran_kolom_3b;
		
		$kolom_grandtotal1=20+$ukuran_kolom_pagu_total_sisa+$ukuran_kolom_1a+$ukuran_kolom_5a;
		
		$kolom_grandtotal2=$ukuran_kolom_3a+$ukuran_kolom_4a;
		$kolom_grandtotal3=$ukuran_kolom_1b+$ukuran_kolom_2b;
		$kolom_grandtotal4=$ukuran_kolom_pagu_total;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell(20, $h, 'No', 1, 0, 'C', true);

        $this->SetX($left += 20);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Kode/Nama Satker', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_pagu_total_sisa);
        $this->Cell($ukuran_kolom_a, $h / 2, 'SP2D Retur', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_1a, $h / 2, 'Tgl/No.SP2D-No.Transaksi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1a);
		$this->Cell($ukuran_kolom_5a, $h / 2, 'Bank Pembayar', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_5a);
        $this->Cell($ukuran_kolom_2a, $h / 2, 'Bank/Nama/No.Rek. Penerima-Jumlah', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2a);
        $this->Cell($ukuran_kolom_3a, $h / 2, 'Uraian SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_3a);
        $this->Cell($ukuran_kolom_4a, $h / 2, 'Alasan Retur', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);
        $this->SetX($left += $ukuran_kolom_a);
        $this->Cell($ukuran_kolom_b, $h / 2, 'SP2D Pengganti', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1 + $ukuran_kolom_a;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);

        $this->Cell($ukuran_kolom_1b, $h / 2, 'Tgl Proses'.'-'.'SP2D Pengganti', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1b);

        $this->Cell($ukuran_kolom_2b, $h / 2, 'Tgl/No. SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2b);

        $this->Cell($ukuran_kolom_3b, $h / 2, 'Bank/Nama/No.Rek Penerima'.'-'.'Jumlah Penerima', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_3b);

        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);
        $this->SetX($left += $ukuran_kolom_b);
        $this->Cell($ukuran_kolom_pagu_total, $h, 'Status Retur', 1, 1, 'C', true);
        $this->Ln(3);

        $this->SetFont('Arial', '', 6);
        $this->SetWidths(array(20,$ukuran_kolom_pagu_total_sisa,$ukuran_kolom_1a,$ukuran_kolom_5a, 
			$ukuran_kolom_2a,$ukuran_kolom_3a,
			$ukuran_kolom_4a,$ukuran_kolom_1b,
            $ukuran_kolom_2b, $ukuran_kolom_3b, 
			$ukuran_kolom_pagu_total
        ));
        $this->SetAligns(array('C', 'L', 'L', 'L', 'L', 'L', 'L', 'L', 'L', 'L', 'L', 'L'));
        
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
            ));
		
		}else{
			$no = 1;
			$this->SetFillColor(255);
			foreach ($this->data as $value) {
				$this->Row(
						array($no++,
							$value->get_kdsatker()."\n".$value->get_nmsatker(),
							$value->get_statement_date()."\n".$value->get_sp2d_number()."\n".$value->get_receipt_number(),
							$value->get_bank_account_name(),
							$value->get_bank_name()."\n".'Penerima:'. $value->get_vendor_name()."\n".'No.Rek:'. $value->get_vendor_ext_bank_account_num()."\n".'Rp:' . number_format($value->get_amount()),
							$value->get_invoice_description(),
							$value->get_keterangan_retur(),
							$value->get_tgl_proses_sp2d_pengganti(),
							$value->get_tgsp2d_pengganti()."\n".$value->get_nosp2d_pengganti(),
							$value->get_bank_name_pengganti()."\n".'Penerima:'. $value->get_vendor_name_pengganti()."\n".'No.Rek:'. $value->get_vendor_account_num_pengganti()."\n".'Rp:'. number_format($value->get_nilai_sp2d_pengganti()),
							'KPPN  '.$value->get_status_retur()
				));
				$tot1 = $tot1 + $value->get_amount();	
				$tot2 = $tot2 + $value->get_nilai_sp2d_pengganti();	
				
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
				$this->Cell($ukuran_kolom_2a, $h, number_format($tot1), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_2a);
				$this->Cell($kolom_grandtotal2, $h,'', 1, 0, 'R', true);
				$this->SetX($px2 += $kolom_grandtotal2);
				$this->Cell($kolom_grandtotal3, $h,'GRAND TOTAL', 1, 0, 'L', true);
				$this->SetX($px2 += $kolom_grandtotal3);
				$this->Cell($ukuran_kolom_3b, $h, number_format($tot2), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_3b);
				$this->Cell($kolom_grandtotal4, $h,'', 1, 1, 'R', true);
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






