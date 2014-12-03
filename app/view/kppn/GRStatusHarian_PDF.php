<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : GR_IJP_PDF.php
  //Dibuat oleh : Rifan Abdul Rachman
  //Tanggal dibuat : 18-07-2014
  //----------------------------------------------------
 */
ob_start();
//-------------------------------------
require_once("./././public/fpdf17/fpdf.php");

class FPDF_AutoWrapTable extends FPDF {

    private $data = array();
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
        }elseif (substr(trim($nm_kppn), 0, 5) == 'null') { //6
            $this->MultiCell(0, $h1 / 2, '');
        }elseif (substr(trim($nm_kppn), 0, 5) == '') { //6
            $this->MultiCell(0, $h1 / 2, '');
        } else {
            $this->MultiCell(0, $h1 / 2, 'KPPN ' . $nm_kppn);
        }

        $this->Cell(0, 1, " ", "B");
        $this->Ln(10);
        $this->Cell(0, 20, $judul, 0, 0, 'C', false);
        $this->Ln(15);
                //tanggal
		$kdtgl_awal1 = $this->kdtgl_awal;
		$kdtgl_akhir1 = $this->kdtgl_akhir;
	    if (isset($kdtgl_awal1) && isset($kdtgl_akhir1)) {
            $thn1 = substr($kdtgl_awal1, 6, 4);
            $bln1 = substr($kdtgl_awal1, 3, 2);
            $tgl1 = substr($kdtgl_awal1, 0, 2);
            $kdtgl_awal = $tgl1 . '-' . $bln1 . '-' . $thn1;
            $thn2 = substr($kdtgl_akhir1, 6, 4);
            $bln2 = substr($kdtgl_akhir1, 3, 2);
            $tgl2 = substr($kdtgl_akhir1, 0, 2);
            $kdtgl_akhir = $tgl2 . '-' . $bln2 . '-' . $thn2;
            $this->Cell(0, 20, 'Dari tanggal:' . $kdtgl_awal . ' s/d ' . $kdtgl_akhir, 0, 0, 'C', false);		
        } else {
            $this->Cell(0, 20, 'Sampai Dengan  ' . date('d-m-Y'), 0, 0, 'C', false);			 
        } 
		//--------------------

        $this->Ln(20);
        $this->SetFont("", "B", 8);
        $this->Ln(10);
        //----------------------------------------------- 

        #tableheader
        $this->SetFont('Arial', 'B', 9);
        $ukuran_kolom_pagu_total_sisa =0;
        $ukuran_kolom_hari = 24;
		$kolom1=40;
		$kolom2=60;
		$kolom3=100;
		$kolom_tgl_lhp=$ukuran_kolom_hari*31;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($kolom3, $h, 'Bulan', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $kolom3);
        $this->Cell($kolom_tgl_lhp, $h / 2, 'Tanggal LHP', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_hari, $h / 2, '1', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '2', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '3', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '4', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '5', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '6', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '7', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '8', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '9', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '10', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '11', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '12', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '13', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '14', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '15', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '16', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '17', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '18', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '19', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '20', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '21', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '22', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '23', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '24', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '25', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '26', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '27', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '28', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '29', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '30', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '31', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);
        $this->SetX($left += $kolom_tgl_lhp);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h,'', 0, 1, 'C',false);
        
		 $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$kolom3,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari,$ukuran_kolom_pagu_total_sisa));
        $this->SetAligns(array('C', 'L','C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $no = 1;
        $j1 = 0;
        $j2 = 0;
        $j3 = 0;
        $j4 = 0;
        $j5 = 0;
        $j6 = 0;
        $j7 = 0;
        $j8 = 0;
        $j9 = 0;
        $j10 = 0;
        $j11 = 0;
        $j12 = 0;
        $j13 = 0;
        $j14 = 0;
        $j15 = 0;
        $j16 = 0;
        $j17 = 0;
        $j18 = 0;
        $j19 = 0;
        $j20 = 0;
        $j21 = 0;
        $j22 = 0;
        $j23 = 0;
        $j24 = 0;
        $j25 = 0;
        $j26 = 0;
        $j27 = 0;
        $j28 = 0;
        $j29 = 0;
        $j30 = 0;
        $j31 = 0;
        $jtotal = 0;

        $this->SetFillColor(255);
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
						'',
                        ''
                    )
            );
		
		}else{
		
		
        foreach ($this->data as $value) {
			//----------------------------------------
/* 			if ($value->get_n01() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna01 = 'F5F5F5';
			} elseif ($value->get_n01() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna01 = 'A4C639';
			} elseif ($value->get_n01() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna01 = 'FFBF00';
			} elseif ($value->get_n01() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna01 = 'FF2800';
			} elseif ($value->get_n01() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna01 = 'B2BEB5';
			} elseif ($value->get_n01() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna01 = '99666CC';
			} elseif ($value->get_n01() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna01 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna01 = '000000';
			}
			//------------------------------------
			if ($value->get_n02() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna02 = 'F5F5F5';
			} elseif ($value->get_n02() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna02 = 'A4C639';
			} elseif ($value->get_n02() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna02 = 'FFBF00';
			} elseif ($value->get_n02() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna02 = 'FF2800';
			} elseif ($value->get_n02() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna02 = 'B2BEB5';
			} elseif ($value->get_n02() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna02 = '99666CC';
			} elseif ($value->get_n02() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna02 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna02 = '000000';
			}
			//------------------------------------
			
			if ($value->get_n03() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna03 = 'F5F5F5';
			} elseif ($value->get_n03() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna03 = 'A4C639';
			} elseif ($value->get_n03() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna03 = 'FFBF00';
			} elseif ($value->get_n03() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna03 = 'FF2800';
			} elseif ($value->get_n03() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna03 = 'B2BEB5';
			} elseif ($value->get_n03() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna03 = '99666CC';
			} elseif ($value->get_n03() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna03 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna03 = '000000';
			}
			//------------------------------------
			if ($value->get_n04() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna04 = 'F5F5F5';
			} elseif ($value->get_n04() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna04 = 'A4C639';
			} elseif ($value->get_n04() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna04 = 'FFBF00';
			} elseif ($value->get_n04() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna04 = 'FF2800';
			} elseif ($value->get_n04() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna04 = 'B2BEB5';
			} elseif ($value->get_n04() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna04 = '99666CC';
			} elseif ($value->get_n04() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna04 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna04 = '000000';
			}
			//------------------------------------
			if ($value->get_n05() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna05 = 'F5F5F5';
			} elseif ($value->get_n05() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna05 = 'A4C639';
			} elseif ($value->get_n05() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna05 = 'FFBF00';
			} elseif ($value->get_n05() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna05 = 'FF2800';
			} elseif ($value->get_n05() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna05 = 'B2BEB5';
			} elseif ($value->get_n05() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna05 = '99666CC';
			} elseif ($value->get_n05() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna05 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna05 = '000000';
			}
			//------------------------------------
			if ($value->get_n06() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna06 = 'F5F5F5';
			} elseif ($value->get_n06() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna06 = 'A4C639';
			} elseif ($value->get_n06() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna06 = 'FFBF00';
			} elseif ($value->get_n06() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna06 = 'FF2800';
			} elseif ($value->get_n06() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna06 = 'B2BEB5';
			} elseif ($value->get_n06() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna06 = '99666CC';
			} elseif ($value->get_n06() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna06 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna06 = '000000';
			}
			//------------------------------------
			if ($value->get_n07() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna07 = 'F5F5F5';
			} elseif ($value->get_n07() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna07 = 'A4C639';
			} elseif ($value->get_n07() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna07 = 'FFBF00';
			} elseif ($value->get_n07() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna07 = 'FF2800';
			} elseif ($value->get_n07() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna07 = 'B2BEB5';
			} elseif ($value->get_n07() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna07 = '99666CC';
			} elseif ($value->get_n07() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna07 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna07 = '000000';
			}
			//------------------------------------
			if ($value->get_n08() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna08 = 'F5F5F5';
			} elseif ($value->get_n08() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna08 = 'A4C639';
			} elseif ($value->get_n08() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna08 = 'FFBF00';
			} elseif ($value->get_n08() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna08 = 'FF2800';
			} elseif ($value->get_n08() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna08 = 'B2BEB5';
			} elseif ($value->get_n08() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna08 = '99666CC';
			} elseif ($value->get_n08() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna08 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna08 = '000000';
			}
			//------------------------------------
			if ($value->get_n09() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna09 = 'F5F5F5';
			} elseif ($value->get_n09() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna09 = 'A4C639';
			} elseif ($value->get_n09() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna09 = 'FFBF00';
			} elseif ($value->get_n09() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna09 = 'FF2800';
			} elseif ($value->get_n09() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna09 = 'B2BEB5';
			} elseif ($value->get_n09() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna09 = '99666CC';
			} elseif ($value->get_n09() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna09 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna09 = '000000';
			}
			//------------------------------------
			if ($value->get_n10() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna10 = 'F5F5F5';
			} elseif ($value->get_n10() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna10 = 'A4C639';
			} elseif ($value->get_n10() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna10 = 'FFBF00';
			} elseif ($value->get_n10() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna10 = 'FF2800';
			} elseif ($value->get_n10() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna10 = 'B2BEB5';
			} elseif ($value->get_n10() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna10 = '99666CC';
			} elseif ($value->get_n10() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna10 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna10 = '000000';
			}
			//------------------------------------
			if ($value->get_n11() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna11 = 'F5F5F5';
			} elseif ($value->get_n11() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna11 = 'A4C639';
			} elseif ($value->get_n11() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna11 = 'FFBF00';
			} elseif ($value->get_n11() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna11 = 'FF2800';
			} elseif ($value->get_n11() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna11 = 'B2BEB5';
			} elseif ($value->get_n11() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna11 = '99666CC';
			} elseif ($value->get_n11() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna11 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna11 = '000000';
			}
			//------------------------------------
			if ($value->get_n12() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna12 = 'F5F5F5';
			} elseif ($value->get_n12() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna12 = 'A4C639';
			} elseif ($value->get_n12() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna12 = 'FFBF00';
			} elseif ($value->get_n12() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna12 = 'FF2800';
			} elseif ($value->get_n12() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna12 = 'B2BEB5';
			} elseif ($value->get_n12() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna12 = '99666CC';
			} elseif ($value->get_n12() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna12 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna12 = '000000';
			}
			//------------------------------------
			if ($value->get_n13() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna13 = 'F5F5F5';
			} elseif ($value->get_n13() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna13 = 'A4C639';
			} elseif ($value->get_n13() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna13 = 'FFBF00';
			} elseif ($value->get_n13() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna13 = 'FF2800';
			} elseif ($value->get_n13() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna13 = 'B2BEB5';
			} elseif ($value->get_n13() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna13 = '99666CC';
			} elseif ($value->get_n13() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna13 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna13 = '000000';
			}
			//------------------------------------
			if ($value->get_n14() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna14 = 'F5F5F5';
			} elseif ($value->get_n14() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna14 = 'A4C639';
			} elseif ($value->get_n14() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna14 = 'FFBF00';
			} elseif ($value->get_n14() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna14 = 'FF2800';
			} elseif ($value->get_n14() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna14 = 'B2BEB5';
			} elseif ($value->get_n14() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna14 = '99666CC';
			} elseif ($value->get_n14() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna14 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna14 = '000000';
			}
			//------------------------------------
			if ($value->get_n15() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna15 = 'F5F5F5';
			} elseif ($value->get_n15() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna15 = 'A4C639';
			} elseif ($value->get_n15() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna15 = 'FFBF00';
			} elseif ($value->get_n15() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna15 = 'FF2800';
			} elseif ($value->get_n15() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna15 = 'B2BEB5';
			} elseif ($value->get_n15() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna15 = '99666CC';
			} elseif ($value->get_n15() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna15 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna15 = '000000';
			}
			//------------------------------------
			if ($value->get_n16() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna16 = 'F5F5F5';
			} elseif ($value->get_n16() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna16 = 'A4C639';
			} elseif ($value->get_n16() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna16 = 'FFBF00';
			} elseif ($value->get_n16() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna16 = 'FF2800';
			} elseif ($value->get_n16() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna16 = 'B2BEB5';
			} elseif ($value->get_n16() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna16 = '99666CC';
			} elseif ($value->get_n16() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna16 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna16 = '000000';
			}
			//------------------------------------
			if ($value->get_n17() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna17 = 'F5F5F5';
			} elseif ($value->get_n17() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna17 = 'A4C639';
			} elseif ($value->get_n17() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna17 = 'FFBF00';
			} elseif ($value->get_n17() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna17 = 'FF2800';
			} elseif ($value->get_n17() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna17 = 'B2BEB5';
			} elseif ($value->get_n17() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna17 = '99666CC';
			} elseif ($value->get_n17() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna17 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna17 = '000000';
			}
			//------------------------------------
			if ($value->get_n18() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna18 = 'F5F5F5';
			} elseif ($value->get_n18() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna18 = 'A4C639';
			} elseif ($value->get_n18() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna18 = 'FFBF00';
			} elseif ($value->get_n18() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna18 = 'FF2800';
			} elseif ($value->get_n18() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna18 = 'B2BEB5';
			} elseif ($value->get_n18() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna18 = '99666CC';
			} elseif ($value->get_n18() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna18 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna18 = '000000';
			}
			//------------------------------------
			if ($value->get_n19() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna19 = 'F5F5F5';
			} elseif ($value->get_n19() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna19 = 'A4C639';
			} elseif ($value->get_n19() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna19 = 'FFBF00';
			} elseif ($value->get_n19() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna19 = 'FF2800';
			} elseif ($value->get_n19() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna19 = 'B2BEB5';
			} elseif ($value->get_n19() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna19 = '99666CC';
			} elseif ($value->get_n19() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna19 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna19 = '000000';
			}
			//------------------------------------
			if ($value->get_n20() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna20 = 'F5F5F5';
			} elseif ($value->get_n20() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna20 = 'A4C639';
			} elseif ($value->get_n20() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna20 = 'FFBF00';
			} elseif ($value->get_n20() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna20 = 'FF2800';
			} elseif ($value->get_n20() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna20 = 'B2BEB5';
			} elseif ($value->get_n20() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna20 = '99666CC';
			} elseif ($value->get_n20() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna20 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna20 = '000000';
			}
			//------------------------------------
			if ($value->get_n21() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna21 = 'F5F5F5';
			} elseif ($value->get_n21() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna21 = 'A4C639';
			} elseif ($value->get_n21() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna21 = 'FFBF00';
			} elseif ($value->get_n21() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna21 = 'FF2800';
			} elseif ($value->get_n21() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna21 = 'B2BEB5';
			} elseif ($value->get_n21() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna21 = '99666CC';
			} elseif ($value->get_n21() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna21 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna21 = '000000';
			}
			//------------------------------------
			if ($value->get_n22() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna22 = 'F5F5F5';
			} elseif ($value->get_n22() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna22 = 'A4C639';
			} elseif ($value->get_n22() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna22 = 'FFBF00';
			} elseif ($value->get_n22() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna22 = 'FF2800';
			} elseif ($value->get_n22() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna22 = 'B2BEB5';
			} elseif ($value->get_n22() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna22 = '99666CC';
			} elseif ($value->get_n22() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna22 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna22 = '000000';
			}
			//------------------------------------
			if ($value->get_n23() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna23 = 'F5F5F5';
			} elseif ($value->get_n23() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna23 = 'A4C639';
			} elseif ($value->get_n23() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna23 = 'FFBF00';
			} elseif ($value->get_n23() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna23 = 'FF2800';
			} elseif ($value->get_n23() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna23 = 'B2BEB5';
			} elseif ($value->get_n23() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna23 = '99666CC';
			} elseif ($value->get_n23() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna23 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna23 = '000000';
			}
			//------------------------------------
			if ($value->get_n24() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna24 = 'F5F5F5';
			} elseif ($value->get_n24() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna24 = 'A4C639';
			} elseif ($value->get_n24() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna24 = 'FFBF00';
			} elseif ($value->get_n24() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna24 = 'FF2800';
			} elseif ($value->get_n24() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna24 = 'B2BEB5';
			} elseif ($value->get_n24() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna24 = '99666CC';
			} elseif ($value->get_n24() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna24 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna24 = '000000';
			}
			//------------------------------------
			if ($value->get_n25() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna25 = 'F5F5F5';
			} elseif ($value->get_n25() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna25 = 'A4C639';
			} elseif ($value->get_n25() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna25 = 'FFBF00';
			} elseif ($value->get_n25() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna25 = 'FF2800';
			} elseif ($value->get_n25() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna25 = 'B2BEB5';
			} elseif ($value->get_n25() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna25 = '99666CC';
			} elseif ($value->get_n25() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna25 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna25 = '000000';
			}
			//------------------------------------
			if ($value->get_n26() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna26 = 'F5F5F5';
			} elseif ($value->get_n26() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna26 = 'A4C639';
			} elseif ($value->get_n26() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna26 = 'FFBF00';
			} elseif ($value->get_n26() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna26 = 'FF2800';
			} elseif ($value->get_n26() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna26 = 'B2BEB5';
			} elseif ($value->get_n26() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna26 = '99666CC';
			} elseif ($value->get_n26() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna26 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna26 = '000000';
			}
			//------------------------------------
			if ($value->get_n27() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna27 = 'F5F5F5';
			} elseif ($value->get_n27() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna27 = 'A4C639';
			} elseif ($value->get_n27() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna27 = 'FFBF00';
			} elseif ($value->get_n27() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna27 = 'FF2800';
			} elseif ($value->get_n27() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna27 = 'B2BEB5';
			} elseif ($value->get_n27() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna27 = '99666CC';
			} elseif ($value->get_n27() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna27 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna27 = '000000';
			}
			//------------------------------------
			if ($value->get_n28() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna28 = 'F5F5F5';
			} elseif ($value->get_n28() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna28 = 'A4C639';
			} elseif ($value->get_n28() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna28 = 'FFBF00';
			} elseif ($value->get_n28() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna28 = 'FF2800';
			} elseif ($value->get_n28() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna28 = 'B2BEB5';
			} elseif ($value->get_n28() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna28 = '99666CC';
			} elseif ($value->get_n28() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna28 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna28 = '000000';
			}
			//------------------------------------
			if ($value->get_n29() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna29 = 'F5F5F5';
			} elseif ($value->get_n29() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna29 = 'A4C639';
			} elseif ($value->get_n29() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna29 = 'FFBF00';
			} elseif ($value->get_n29() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna29 = 'FF2800';
			} elseif ($value->get_n29() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna29 = 'B2BEB5';
			} elseif ($value->get_n29() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna29 = '99666CC';
			} elseif ($value->get_n29() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna29 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna29 = '000000';
			}
			//------------------------------------
			if ($value->get_n30() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna30 = 'F5F5F5';
			} elseif ($value->get_n30() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna30 = 'A4C639';
			} elseif ($value->get_n30() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna30 = 'FFBF00';
			} elseif ($value->get_n30() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna30 = 'FF2800';
			} elseif ($value->get_n30() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna30 = 'B2BEB5';
			} elseif ($value->get_n30() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna30 = '99666CC';
			} elseif ($value->get_n30() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna30 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna30 = '000000';
			}
			//------------------------------------
			if ($value->get_n31() == 0) {
				$this->SetFillColor(245,245,245);
				//$warna31 = 'F5F5F5';
			} elseif ($value->get_n31() == 1) {
				$this->SetFillColor(164,198,57);
				//$warna31 = 'A4C639';
			} elseif ($value->get_n31() == 2) {
				$this->SetFillColor(255,191,0);
				//$warna31 = 'FFBF00';
			} elseif ($value->get_n31() == 3) {
				$this->SetFillColor(255,40,0);
				//$warna31 = 'FF2800';
			} elseif ($value->get_n31() == 4) {
				$this->SetFillColor(178,190,181);
				//$warna31 = 'B2BEB5';
			} elseif ($value->get_n31() == 5) {
				$this->SetFillColor(153,102,108);
				//$warna31 = '99666CC';
			} elseif ($value->get_n31() == 9) {
				$this->SetFillColor(193,154,107);
				//$warna31 = 'C19A6B';
			} else {
				$this->SetFillColor(0,0,0);
				//$warna31 = '000000';
			}
 */			
 		 //------------------------------------
			$kdbulan=$value->get_bulan();
			if ($kdbulan == '01') {
				$bulan = 'Januari';
			}
			if ($kdbulan == '02') {
				$bulan = 'FebruarI';
			}
			if ($kdbulan == '03') {
				$bulan = 'Maret';
			}
			if ($kdbulan == '04') {
				$bulan = 'April';
			}
			if ($kdbulan == '05') {
				$bulan = 'Mei';
			}
			if ($kdbulan == '06') {
				$bulan = 'Juni';
			}
			if ($kdbulan == '07') {
				$bulan = 'Juli';
			}
			if ($kdbulan == '08') {
				$bulan = 'Agustus';
			}
			if ($kdbulan == '09') {
				$bulan = 'September';
			}
			if ($kdbulan == '10') {
				$bulan = 'Oktober';
			}
			if ($kdbulan == '11') {
				$bulan = 'November';
			}
			if ($kdbulan == '12') {
				$bulan = 'Desember';
			} 
			
			
							//------------------------------------------
		
		
		
            $this->Row(
                    array($no++,
						$bulan,
                        $value->get_r01(),
                        $value->get_r02(),
                        $value->get_r03(),
                        $value->get_r04(),
                        $value->get_r05(),
                        $value->get_r06(),
                        $value->get_r07(),
                        $value->get_r08(),
                        $value->get_r09(),
                        $value->get_r10(),
                        $value->get_r11(),
                        $value->get_r12(),
                        $value->get_r13(),
                        $value->get_r14(),
                        $value->get_r15(),
                        $value->get_r16(),
                        $value->get_r17(),
                        $value->get_r18(),
                        $value->get_r19(),
                        $value->get_r20(),
                        $value->get_r21(),
                        $value->get_r22(),
                        $value->get_r23(),
                        $value->get_r24(),
                        $value->get_r25(),
                        $value->get_r26(),
                        $value->get_r27(),
                        $value->get_r28(),
                        $value->get_r29(),
                        $value->get_r30(),
                        $value->get_r31()
            ));
            //jumlah grand total
            //-------------
            $j1 = $j1 + $value->get_r01();
            $j2 = $j2 + $value->get_r02();
            $j3 = $j3 + $value->get_r03();
            $j4 = $j4 + $value->get_r04();
            $j5 = $j5 + $value->get_r05();
            $j6 = $j6 + $value->get_r06();
            $j7 = $j7 + $value->get_r07();
            $j8 = $j8 + $value->get_r08();
            $j9 = $j9 + $value->get_r09();
            $j10 = $j10 + $value->get_r10();
            $j11 = $j11 + $value->get_r11();
            $j12 = $j12 + $value->get_r12();
            $j13 = $j13 + $value->get_r13();
            $j14 = $j14 + $value->get_r14();
            $j15 = $j15 + $value->get_r15();
            $j16 = $j16 + $value->get_r16();
            $j17 = $j17 + $value->get_r17();
            $j18 = $j18 + $value->get_r18();
            $j19 = $j19 + $value->get_r19();
            $j20 = $j20 + $value->get_r20();
            $j21 = $j21 + $value->get_r21();
            $j22 = $j22 + $value->get_r22();
            $j23 = $j23 + $value->get_r23();
            $j24 = $j24 + $value->get_r24();
            $j25 = $j25 + $value->get_r25();
            $j26 = $j26 + $value->get_r26();
            $j27 = $j27 + $value->get_r27();
            $j28 = $j28 + $value->get_r28();
            $j29 = $j29 + $value->get_r29();
            $j30 = $j30 + $value->get_r30();
            $j31 = $j31 + $value->get_r31();
            $jtotal = $jtotal + $value->get_jumlah();


            //------------------
        }
        $this->SetFont('Arial', 'B', 7);
        $h = 20;
        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        /* $this->Cell(140, $h, 'GRAND TOTAL', 1, 0, 'L', true);
        $this->SetX($left += 140);
        $px1 = $this->GetX();
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j1), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j2), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j3), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j4), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j5), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j6), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j7), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j8), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j9), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j10), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j11), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j12), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j13), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j14), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j15), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j16), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j17), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j18), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j19), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j20), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j21), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j22), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j23), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j24), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j25), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j26), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j27), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j28), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j29), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j30), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h, number_format($j31), 1, 0, 'R', true);
        $py3 = $this->GetY();
        $this->SetX($left += 620);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, number_format($jtotal), 1, 1, 'R', true);
        */ $this->Ln(3);
		}
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

    function Row($data) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data[$i], 0, $a,false);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
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
if (Session::get('role') == KPPN){
	$judul = 'Laporan Monitoring Status LHP per KPPN'; //judul file laporan
}else{
	$judul = 'Laporan Monitoring Status LHP'; //judul file laporan
} 
	//$judul = 'Laporan Monitoring Status LHP'; //judul file laporan

$tipefile = '.pdf';
$nmfile = $judul . $tipefile; //nama file penyimpanan, kosongkan jika output ke browser

$options = array(
    'judul' => $judul, //judul file laporan
    'filename' => $nmfile, //nama file penyimpanan, kosongkan jika output ke browser   
    'destinationfile' => 'D', //I=inline browser (default), F=local file, D=download
    'paper_size' => 'F4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'L' //orientation: P=portrait, L=landscape
);
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn,$kdbulan);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>






