<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : realisasiFA_PDF.php
  //Dibuat oleh : Rifan Abdul Rachman
  //Tanggal dibuat : 18-07-2014
  //----------------------------------------------------
 */
ob_start();
//-------------------------------------
require_once("./././public/fpdf17/fpdf.php");

class FPDF_AutoWrapTable extends FPDF {

    private $data1 = array();
    private $data2 = array();
    private $data3 = array();
    private $data4 = array();
    private $data6 = array();
    private $options = array(
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

    function __construct($data1 = array(),$data2 = array(),$data3 = array(),$data4 = array(),$data6 = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn) {
        parent::__construct();
        $this->data1 = $data1;
		$this->data2 = $data2;
		$this->data3 = $data3;
		$this->data4 = $data4;
		$this->data6 = $data6;
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
        $judul = $this->options['judul'];
        $nm_kppn = $this->nm_kppn;
        $kemenkeu = 'Kementerian Keuangan Republik Indonesia';
        $border = 0;
        $h = 40;
        $left = 10;
        //header
        $h1 = 35;
        $this->SetFont("", "B", 12);
        $this->SetX($left + 20);
        $this->Image("./././public/img/depkeu.png", 30, 30, 30, 30);
        $px1 = $this->GetX();
        $this->SetX($left + 50);
        $this->MultiCell(0, $h1 / 2, $kemenkeu);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->SetX($left + 50);
        if (substr(trim($nm_kppn), 0, 4) == 'KPPN') { //3
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 6) == 'KANWIL') { //5
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 3) == 'DIT') {  //1 & 4
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 3) == 'SET') {  //1
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 5) == 'ADMIN') { //1
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 5) == 'Direktorat') { //6
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } else {
            $this->MultiCell(0, $h1 / 2, 'KPPN ' . $nm_kppn);
        }


        $this->Cell(0, 1, " ", "B");
        $this->Ln(10);
        $this->Cell(0, 20, $judul, 0, 0, 'C', false);
        $this->Ln(15);
        //tanggal
        $kdtgl_awal = 'null';
        $kdtgl_akhir = 'null';
        if ($kdtgl_awal != 'null' OR $kdtgl_akhir != 'null') {
            $kdtgl_awal1 = $this->kdtgl_awal;
            $thn1 = substr($kdtgl_awal1, 6, 4);
            $bln1 = substr($kdtgl_awal1, 3, 2);
            $tgl1 = substr($kdtgl_awal1, 0, 2);
            $kdtgl_awal = $tgl1 . '-' . $bln1 . '-' . $thn1;
            $kdtgl_akhir1 = $this->kdtgl_akhir;
            $thn2 = substr($kdtgl_akhir1, 6, 4);
            $bln2 = substr($kdtgl_akhir1, 3, 2);
            $tgl2 = substr($kdtgl_akhir1, 0, 2);
            $kdtgl_akhir = $tgl2 . '-' . $bln2 . '-' . $thn2;
            $this->Cell(0, 20, 'Dari tanggal:' . $kdtgl_awal . ' s/d ' . $kdtgl_akhir, 0, 0, 'C', false);
        } else {
            $this->Cell(0, 20, 'Sampai Dengan  ' . date('d-m-Y'), 0, 0, 'C', false);
        }
        $this->Ln(20);
        $this->SetFont("", "B", 8);
        $this->Ln(10);
        //----------------------------------------------- 
        #tableheader
        $this->SetFont('Arial', 'B', 7);
       $this->SetFillColor(200, 200, 200);
	   //---------------------BAGIAN 1-----------------------------------

        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 80;
        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=60;
		$kolom3=50;
		$kolom4=50;
		$kolom_grandtotal=$kolom1+$kolom2+$kolom3+$kolom4+$ukuran_kolom_jenis_belanja;

 
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($kolom2, $h, 'Kode Satker', 1, 0, 'C', true);
        $this->SetX($left += $kolom2);
        $this->Cell($kolom3, $h, 'Kode KPPN', 1, 0, 'C', true);
        $this->SetX($left += $kolom3);
        $this->Cell($kolom4, $h, 'No. DIPA', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $kolom4);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Jenis Belanja', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Jumlah', 1, 1, 'C', true);
        $this->Ln(8);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$kolom2,$kolom3,$kolom4,$ukuran_kolom_jenis_belanja,$ukuran_kolom_jenis_belanja));
        $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'R'));

        if (count($this->data1) == 0) {
            $this->Row1(
                    array('',
                        'N I H I L',
                        '',
                        '',
                        '',
                        ''
                    )
            );
        } else {
			$total_dipa = 0;
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data1 as $value) {
                $this->Row1(
                        array($no++,
                            $value->get_satker_code(),
                            $value->get_kppn_code(),
							$value->get_dipa_no(),
							$value->get_jenis_belanja(),
                            number_format($value->get_line_amount()
							)
                        )
                );
				$total_dipa = $total_dipa + $value->get_line_amount();
				
				
            }
			$this->SetFont('Arial', '', 6);
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
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($total_dipa), 1, 1, 'R', true);
				$this->Ln(3);
           
        }
		$this->Ln(15);
	//-------------------BAGIAN 2-------------------------------------
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 80;
		
		$ukuran_kolom_jenis_belanja1 =$kolom4+$ukuran_kolom_jenis_belanja;
        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=60;
		$kolom3=50;
		$kolom4=50;
		$kolom_grandtotal=$kolom1+$kolom2+$kolom3+$kolom4+
		$ukuran_kolom_jenis_belanja;

 
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($kolom2, $h, 'Kode Satker', 1, 0, 'C', true);
        $this->SetX($left += $kolom2);
        $this->Cell($kolom4, $h, 'Kode KPPN', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $kolom4);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja1, $h, 'Kode Akun', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja1);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Jumlah', 1, 1, 'C', true);
        $this->Ln(8);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$kolom2,$kolom4,$ukuran_kolom_jenis_belanja1,$ukuran_kolom_jenis_belanja));
        $this->SetAligns(array('C', 'C', 'C', 'C', 'R'));

        if (count($this->data2) == 0) {
            $this->Row2(
                    array('',
                        'N I H I L',
                        '',
                        '',
                        ''
                    )
            );
        } else {
			$total_penerimaan = 0;
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data2 as $value) {
                $this->Row2(
                        array($no++,
                            $value->get_satker_code(),
                            $value->get_kppn_code(),
							$value->get_account_code(),
                            number_format($value->get_line_amount()
							)
                        )
                );
				$total_penerimaan = $total_penerimaan + $value->get_line_amount();				$this->SetFont('Arial', '', 6);
			
            }
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
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($total_penerimaan), 1, 1, 'R', true);
				$this->Ln(3);
           
        }
	$this->Ln(15);
	//----------------------------------------------------------
	//---------------------BAGIAN 3-----------------------------------
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 80;
				$ukuran_kolom_jenis_belanja1 =$kolom4+$ukuran_kolom_jenis_belanja;

        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=60;
		$kolom3=50;
		$kolom4=50;
		$kolom_grandtotal=$kolom1+$kolom2+$kolom3+$kolom4+
		$ukuran_kolom_jenis_belanja;

 
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($kolom2, $h, 'Kode Satker', 1, 0, 'C', true);
        $this->SetX($left += $kolom2);
        $this->Cell($kolom4, $h, 'Kode KPPN', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $kolom4);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja1, $h, 'Jenis SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja1);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Jumlah', 1, 1, 'C', true);
        $this->Ln(8);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$kolom2,$kolom4,$ukuran_kolom_jenis_belanja1,$ukuran_kolom_jenis_belanja));
        $this->SetAligns(array('C', 'C', 'C', 'C', 'R'));

        if (count($this->data4) == 0) {
            $this->Row4(
                    array('',
                        'N I H I L',
                        '',
                        '',
                        '',
                        ''
                    )
            );
        } else {
			$total_up = 0;
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data4 as $value) {
                $this->Row4(
                        array($no++,
                            $value->get_satker_code(),
                            $value->get_kppn_code(),
							$value->get_jenis_spm(),
                            number_format($value->get_line_amount()
							)
                        )
                );
				$total_up = $total_up + $value->get_line_amount();
				
            }
				$this->SetFont('Arial', '', 6);
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
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($total_up), 1, 1, 'R', true);
				$this->Ln(3);
           
        }
	$this->Ln(15);
	//----------------------------------------------------------
	//---------------------BAGIAN 4-----------------------------------
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 80;
				$ukuran_kolom_jenis_belanja1 =$kolom4+$ukuran_kolom_jenis_belanja;

        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=60;
		$kolom3=50;
		$kolom4=50;
		$kolom_grandtotal=$kolom1+$kolom2+$kolom3+$kolom4+
		$ukuran_kolom_jenis_belanja;

 
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($kolom2, $h, 'Kode Satker', 1, 0, 'C', true);
        $this->SetX($left += $kolom2);
        $this->Cell($kolom4, $h, 'Kode KPPN', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $kolom4);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja1, $h, 'Akun', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja1);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Jumlah', 1, 1, 'C', true);
        $this->Ln(8);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$kolom2,$kolom4,$ukuran_kolom_jenis_belanja1,$ukuran_kolom_jenis_belanja));
        $this->SetAligns(array('C', 'C', 'C', 'C', 'R'));

        if (count($this->data3) == 0) {
            $this->Row3(
                    array('',
                        'N I H I L',
                        '',
                        '',
                        ''
                    )
            );
        } else {
			$total_belanja =0;
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data3 as $value) {
                $this->Row3(
                        array($no++,
                            $value->get_satker_code(),
                            $value->get_kppn_code(),
							 $value->get_account_code(),
                            number_format($value->get_line_amount()
							)
                        )
                );
				$total_belanja = $total_belanja + $value->get_line_amount();
				
            }
				$this->SetFont('Arial', '', 6);
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
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($total_belanja), 1, 1, 'R', true);
				$this->Ln(3);
           
        }
	$this->Ln(15);
	//----------------------------------------------------------
	//---------------------BAGIAN 5-----------------------------------
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 80;
				$ukuran_kolom_jenis_belanja1 =$kolom4+$ukuran_kolom_jenis_belanja;

        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=60;
		$kolom3=50;
		$kolom4=50;
		$kolom_grandtotal=$kolom1+$kolom2+$kolom3+$kolom4+
		$ukuran_kolom_jenis_belanja;

 
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($kolom2, $h, 'Kode Satker', 1, 0, 'C', true);
        $this->SetX($left += $kolom2);
        $this->Cell($kolom4, $h, 'Kode KPPN', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $kolom4);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja1, $h, 'Akun', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja1);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Jumlah', 1, 1, 'C', true);
        $this->Ln(8);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$kolom2,$kolom4,$ukuran_kolom_jenis_belanja1,$ukuran_kolom_jenis_belanja));
        $this->SetAligns(array('C', 'C', 'C', 'C', 'R'));

        if (count($this->data6) == 0) {
            $this->Row6(
                    array('',
                        'N I H I L',
                        '',
                        '',
                        '',
                        ''
                    )
            );
        } else {
			$total_setoran_up =0;
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data6 as $value) {
                $this->Row6(
                        array($no++,
                            $value->get_satker_code(),
                            $value->get_kppn_code(),
							$value->get_account_code(),
                            number_format($value->get_line_amount()
							)
                        )
                );
				$total_setoran_up = $total_setoran_up + $value->get_line_amount();
				
            }
				$this->SetFont('Arial', '', 6);
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
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($total_setoran_up), 1, 1, 'R', true);
				$this->Ln(3);
           
        }
	$this->Ln(15);
	//----------------------------------------------------------
	//---------------------BAGIAN 6-----------------------------------
				$pendapatan_hitung = $this->ppp/100;
				$maksimum_pencairan = ($pendapatan_hitung * $total_penerimaan) - $total_belanja;
				$this->SetFont('Arial', '', 6);
				$h = 20;
				$this->SetFillColor(200, 200, 200);
				$left = $this->GetX();
				$this->Cell($kolom_grandtotal, $h, 'MAKSIMUM PENCAIRAN (MP) SAAT INI', 1, 0, 'L', true);
				$this->SetX($left += $kolom_grandtotal);
				$px1 = $this->GetX();
				$py1 = $this->GetY();
				$px2 = $px1;
				$py2 = $py1;
				$this->SetXY($px2, $py2);
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($maksimum_pencairan), 1, 1, 'R', true);
				$this->Ln(3);
    
	
	//----------------------------------------------------------
    }

    //footer
    function Footer() {

        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
        $this->Cell(0, 10, 'Hal : ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $hari_ini =  Date("Y-m-d H:i:s");
        $this->Cell(0, 10, 'Dicetak : ' . $hari_ini, 0, 0, 'R');
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

    private $widths;
    private $aligns;

    function SetWidths($w) {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a) {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function Row1($data1) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data1); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data1[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data1); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data1[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
		}
		//----------------------------------
		function Row2($data2) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data2); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data2[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data2); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data2[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
		}
		//----------------------------------
		function Row3($data3) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data3); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data3[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data3); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data3[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
		}
		//----------------------------------
		function Row4($data4) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data4); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data4[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data4); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data4[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
		}
		//----------------------------------
		function Row6($data6) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data6); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data6[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data6); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data6[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
		//----------------------------------

		}

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt) {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l+=$cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }

}

//end of class
//-----------------------
//mengambil array data dari controller
if (is_array($this->data1)) {
    $data1 = $this->data1;
} else {
    //echo 'bukan array';
}
if (is_array($this->data2)) {
    $data2 = $this->data2;
} else {
    //echo 'bukan array';
}
if (is_array($this->data3)) {
    $data3 = $this->data3;
} else {
    //echo 'bukan array';
}
if (is_array($this->data4)) {
    $data4 = $this->data4;
} else {
    //echo 'bukan array';
}

if (is_array($this->data6)) {
    $data6 = $this->data6;
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
if (is_array($this->nm_kppn2)) {
    foreach ($this->nm_kppn2 as $nm_kppn1) {
        $nm_kppn = $nm_kppn1->get_nama_kppn();
    }
} else {
    //echo 'bukan array';
    $nm_kppn = $this->nm_kppn2;
}

//--------------------------
//pilihan
$judul = 'Laporan Karwas Maksimum Pencairan (PNBP)'; //judul file laporan
$tipefile = '.pdf';
$nmfile = $judul . $tipefile; //nama file penyimpanan, kosongkan jika output ke browser

$options = array(
    'judul' => $judul, //judul file laporan
    'filename' => $nmfile, //nama file penyimpanan, kosongkan jika output ke browser   
    'destinationfile' => 'D', //I=inline browser (default), F=local file, D=download
    'paper_size' => 'A4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'P' //orientation: P=portrait, L=landscape
);
$tabel = new FPDF_AutoWrapTable($data1,$data2,$data3,$data4,$data6, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>




