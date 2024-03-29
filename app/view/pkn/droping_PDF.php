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
        $h = 80;
        $this->SetFont('Arial', 'B', 6);
        $ukuran_kolom_pagu_total_sisa = 110;
		$ukuran_kolom_pagu_total_sisa1 = 130;
        $ukuran_kolom_jenis_belanja = 110;
        $ukuran_kolom_file = 40;
        $ukuran_kolom_ket = 60;
        $ukuran_kolom_program = 35;
        $ukuran_kolom_output = 35;
        $ukuran_kolom_dana = 40;
        $ukuran_kolom_bank = 35;
        $ukuran_kolom_kewenangan = 50;
        $ukuran_kolom_kolorari = 50;
        $jumlah_kolom = $ukuran_kolom_jenis_belanja +
                $ukuran_kolom_satker + $ukuran_kolom_akun;
		$kolom_grandtotal=30+60+$ukuran_kolom_dana;
		$ukuran_kolom_jenis_belanja = 75;
		$ukuran_kolom_jenis_belanja1=$ukuran_kolom_jenis_belanja+$ukuran_kolom_file;
		

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell(30, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += 30);
        $this->Cell(60, $h, 'Tanggal', 1, 0, 'C', true);
        $this->SetX($left += 60);
        $this->Cell($ukuran_kolom_dana, $h, 'Bank', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom_dana);
		//----------
		$px1 = $this->GetX();
        $this->Cell($ukuran_kolom_jenis_belanja1, $h*1/4, 'Diterbitkan SPAN', 1, 0, 'C', true);
		$py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_file, $h-20, 'Total File', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_file);
		$py2a = $py1 + 20;
		 $this->SetXY($px2, $py2a);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, 'Total Nilai', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		$px3 = $px2-$ukuran_kolom_jenis_belanja;
		$py2b = $py1 + 40;
		$this->SetXY($px3, $py2b);
		$this->Cell($ukuran_kolom_jenis_belanja, $h/4,'Total SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		$px4 = $px2-($ukuran_kolom_jenis_belanja*2);
		$py2c = $py1 + 60;
		$this->SetXY($px4, $py2c);
		$this->Cell($ukuran_kolom_jenis_belanja, $h/4,'Total Transaksi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 80);		
		//------------
		
		$px5 = $px4+($ukuran_kolom_jenis_belanja);
		$py5 = $py3+20;
		$this->SetXY($px5, $py5);
		$px1 = $this->GetX();
		
        $this->Cell($ukuran_kolom_jenis_belanja1, $h*1/4, 'Sudah Dijalankan Bank', 1, 0, 'C', true);
		$py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_file, $h-20, 'Total File', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_file);
		$py2a = $py1 + 20;
		 $this->SetXY($px2, $py2a);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, 'Total Nilai', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		$px3 = $px2-$ukuran_kolom_jenis_belanja;
		$py2b = $py1 + 40;
		$this->SetXY($px3, $py2b);
		$this->Cell($ukuran_kolom_jenis_belanja, $h/4,'Total SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		$px4 = $px2-($ukuran_kolom_jenis_belanja*2);
		$py2c = $py1 + 60;
		$this->SetXY($px4, $py2c);
		$this->Cell($ukuran_kolom_jenis_belanja, $h/4,'Total Transaksi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 80);		
		
		//----------
		//------------
		
		$px5 = $px4+($ukuran_kolom_jenis_belanja);
		$py5 = $py3+20;
		$this->SetXY($px5, $py5);
		$px1 = $this->GetX();
		
        $this->Cell($ukuran_kolom_jenis_belanja1, $h*1/4, 'Yang Belum Dijalankan Bank', 1, 0, 'C', true);
		$py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_file, $h-20, 'Total File', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_file);
		$py2a = $py1 + 20;
		 $this->SetXY($px2, $py2a);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, 'Total Nilai', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		$px3 = $px2-$ukuran_kolom_jenis_belanja;
		$py2b = $py1 + 40;
		$this->SetXY($px3, $py2b);
		$this->Cell($ukuran_kolom_jenis_belanja, $h/4,'Total SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		$px4 = $px2-($ukuran_kolom_jenis_belanja*2);
		$py2c = $py1 + 60;
		$this->SetXY($px4, $py2c);
		$this->Cell($ukuran_kolom_jenis_belanja, $h/4,'Total Transaksi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 80);		
		
		//----------


		$px6 = $px4+($ukuran_kolom_jenis_belanja);
        $py5 = $py3+20;
        $this->SetXY($px6, $py5);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Total Droping', 1, 0, 'C', true); 

		$px7 = $px6+$ukuran_kolom_pagu_total_sisa;
        $py5 = $py3+20;
        $this->SetXY($px7, $py5);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Total Penihilan', 1, 0, 'C', true); 

		$px8 = $px7+$ukuran_kolom_pagu_total_sisa;
        $py5 = $py3+20;
        $this->SetXY($px8, $py5);
        $this->Cell($ukuran_kolom_pagu_total_sisa1, $h, 'Selisih Rp.(DROPING-(SPAN+PENIHILAN))', 1, 0, 'C', true); 
		
		$px9 = $px8+$ukuran_kolom_pagu_total_sisa1;
        $py5 = $py3+20;
        $this->SetXY($px9, $py5);
        $this->Cell($ukuran_kolom_ket, $h, 'Keterangan', 1, 1, 'C', true); 
         $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array(30, 60,
            $ukuran_kolom_dana,$ukuran_kolom_file,
			$ukuran_kolom_jenis_belanja,$ukuran_kolom_file,
			$ukuran_kolom_jenis_belanja,$ukuran_kolom_file,
			$ukuran_kolom_jenis_belanja,$ukuran_kolom_pagu_total_sisa,
			$ukuran_kolom_pagu_total_sisa,$ukuran_kolom_pagu_total_sisa1,
			$ukuran_kolom_ket));
        $this->SetAligns(array('C', 'C',
            'C', 'C',
            'R', 'C',
            'R', 'C',
			'R', 'R',
            'R', 'R',
			'C'));
        if (count($this->data) == 0) {
            $this->Row(
                    array('','N I H I L',
                        '','',
                        '','',
                        '','',
                        '','',
						'','',
                        '','',
						'','',
						''
						)
            );
        } else {
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data as $value) {
						$selisih_span_bank_file = $value->get_jumlah_ftp_file_name()-$value->get_jml_ftp_file_name_bank();
			            $selisih_span_bank_amount = $value->get_jumlah_check_amount()-$value->get_jml_check_amount_bank();
                        $selisih_span_bank_number = $value->get_jumlah_check_number()-$value->get_jml_check_number_bank();
                        $selisih_span_bank_line_number = $value->get_jumlah_check_number_line_num()-$value->get_jml_check_number_line_num_bank();
						$selisih_droping_span_nihil = $value->get_payment_amount()-($value->get_jumlah_check_amount()+$value->get_penihilan());
						if ($selisih_droping_span_nihil<0){ 
							$ket="Kurang Droping"; 
						}elseif($selisih_droping_span_nihil > 0){
							$ket="Lebih Droping";
						}else { 
							$ket="SAMA";
						}

			
                $this->Row(
                        array($no++,
                            $value->get_creation_date(),
                            $value->get_bank(),
                            number_format($value->get_jumlah_ftp_file_name()),
							number_format($value->get_jumlah_check_amount())."\n".number_format($value->get_jumlah_check_number())."\n".number_format($value->get_jumlah_check_number_line_num()),
                            number_format($value->get_jml_ftp_file_name_bank()),
							number_format($value->get_jml_check_amount_bank())."\n".number_format($value->get_jml_check_number_bank())."\n".number_format($value->get_jml_check_number_line_num_bank()),
							number_format($selisih_span_bank_file),
							number_format($selisih_span_bank_amount)."\n".number_format($selisih_span_bank_number)."\n".number_format($selisih_span_bank_line_number),
							number_format($value->get_payment_amount()),
							number_format($value->get_penihilan()),
							number_format($selisih_droping_span_nihil),
							$ket)
                );
                    $jumlah_ftp_file_name += $value->get_jumlah_ftp_file_name();
                    $jumlah_check_amount += $value->get_jumlah_check_amount();
                    $jumlah_check_number += $value->get_jumlah_check_number();
                    $jumlah_check_number_line_num += $value->get_jumlah_check_number_line_num();
                    $jml_ftp_file_name_bank += $value->get_jml_ftp_file_name_bank();
                    $jml_check_amount_bank += $value->get_jml_check_amount_bank();
                    $jml_check_number_bank += $value->get_jml_check_number_bank();
                    $jml_check_number_line_num_bank += $value->get_jml_check_number_line_num_bank();
					$total_selisih_span_bank_file += $selisih_span_bank_file;
                    $total_selisih_span_bank_amount += $selisih_span_bank_amount;
                    $total_selisih_span_bank_number += $selisih_span_bank_number;
                    $total_selisih_span_bank_line_number += $selisih_span_bank_line_number;
                    $payment_amount += $value->get_payment_amount();
                    $penihilan += $value->get_penihilan();
                    $total_selisih_droping_span_nihil += $selisih_droping_span_nihil;
            }
			$this->SetFont('Arial', 'B', 7);
				$h = 80;
				$this->SetFillColor(200, 200, 200);
				$left = $this->GetX();
				$this->Cell($kolom_grandtotal, $h-20, 'GRAND TOTAL', 1, 0, 'L', true);
				$this->SetX($left += $kolom_grandtotal);
				//--------------------------
				$px1 = $this->GetX();
				$py1 = $this->GetY();
				$px2 = $px1;
				$py2 = $py1;
				$this->SetXY($px2, $py2);
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_file, $h-20, number_format($jumlah_ftp_file_name), 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_file);
				$px1d = $px1+$ukuran_kolom_file;
				$py1d = $py1;
				$this->SetXY($px1d, $py1d);
				$this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($jumlah_check_amount), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
				$px2d = $px1d;
				$py2d = $py2+20;
				$this->SetXY($px2d, $py2d);
				$this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($jumlah_check_number), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
				$px2d = $px1d;
				$py3d = $py2+40;
				$this->SetXY($px2d, $py3d);
				$this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($jumlah_check_number_line_num), 1, 0, 'R', true);
				
				//--------------------------
				
				$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
				$px1e = $px1d+$ukuran_kolom_jenis_belanja;
				$py1e = $py1;
				$this->SetXY($px1e, $py1e);
				$this->Cell($ukuran_kolom_file, $h-20, number_format($jml_ftp_file_name_bank), 1, 0, 'C', true);
				
				$this->SetX($px2 += $ukuran_kolom_file);
				$px2e = $px1e+$ukuran_kolom_file;
				$py2e = $py2;
				$this->SetXY($px2e, $py2e);
				$this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($jml_check_amount_bank), 1, 0, 'R', true);
								
				$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
				$px3e = $px2e;
				$py3e = $py2+20;
				$this->SetXY($px3e, $py3e);
				$this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($jml_check_number_bank), 1, 0, 'R', true);
				
				$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
				$px4e = $px3e;
				$py4e = $py2+40;
				$this->SetXY($px4e, $py4e);
				$this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($jml_check_number_line_num_bank), 1, 0, 'R', true);
				
				//--------------------------

				$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
				$px1f = $px2e+$ukuran_kolom_jenis_belanja;
				$py1f = $py1;
				$this->SetXY($px1f, $py1f);
				$this->Cell($ukuran_kolom_file, $h-20, number_format($total_selisih_span_bank_file), 1, 0, 'C', true);
		
				$this->SetX($px2 += $ukuran_kolom_file);	
				$px2f = $px1f+$ukuran_kolom_file;
				$py2f = $py2;
				$this->SetXY($px2f, $py2f);
				$this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($total_selisih_span_bank_amount), 1, 0, 'R', true);
				
				$this->SetX($px2 += $ukuran_kolom_jenis_belanja);	
				$px3f = $px2f;
				$py3f = $py2+20;
				$this->SetXY($px3f, $py3f);
				$this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($total_selisih_span_bank_number), 1, 0, 'R', true);
				
				 $this->SetX($px2 += $ukuran_kolom_jenis_belanja);	
				$px4f = $px3f;
				$py4f = $py2+40;
				$this->SetXY($px4f, $py4f);
				$this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($total_selisih_span_bank_line_number), 1, 0, 'R', true);
				
 							
				//--------------------------

				$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
				$px4f = $px3f+$ukuran_kolom_jenis_belanja;
				$py4f = $py2;
				$this->SetXY($px4f, $py4f);
				$this->Cell($ukuran_kolom_pagu_total_sisa, $h-20,number_format($payment_amount) , 1, 0, 'R', true);
				
				
				$this->SetX($px2 += $ukuran_kolom_pagu_total_sisa);
				$px5f = $px4f+$ukuran_kolom_pagu_total_sisa;
				$py5f = $py2;
				$this->SetXY($px5f, $py5f);
				$this->Cell($ukuran_kolom_pagu_total_sisa, $h-20, number_format($penihilan), 1, 0, 'R', true);
			
				$this->SetX($px2 += $ukuran_kolom_pagu_total_sisa);
				$px6f = $px5f+$ukuran_kolom_pagu_total_sisa;
				$py6f = $py2;
				$this->SetXY($px6f, $py6f);
				$this->Cell($ukuran_kolom_pagu_total_sisa1, $h-20, number_format($total_selisih_droping_span_nihil), 1, 0, 'R', true);
				
				
				$this->SetX($px2 += $ukuran_kolom_pagu_total_sisa1);
				$px7f = $px6f+$ukuran_kolom_pagu_total_sisa1;
				$py7f = $py2;
				$this->SetXY($px7f, $py7f);
				$this->Cell($ukuran_kolom_ket, $h-20,'', 1, 1, 'R', true);
				/* 		
				*/	
				$this->Ln(3);
				
        }
        $this->Ln(3);
    }

    //footer
    function Footer() {

        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
        $this->Cell(0, 10, 'Hal : ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $hari_ini = date("d-m-Y");
        $this->Cell(0, 10, 'Dicetak : ' . $hari_ini, 0, 0, 'R');
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
$tipefile = '.PDF';
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




