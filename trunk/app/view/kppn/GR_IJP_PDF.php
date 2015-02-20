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
		 $border = 0;
        $h = 40;
        $left = 10;
		$this->HeaderAtas1($judul,$nm_kppn,$nm_kppn2,$nm_kppn3,$kdtgl_awal1,$kdtgl_akhir1);
        //-----------------------------------
         /*$judul = $this->options['judul'];
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
         $this->Ln(10);*/
         /*$this->Cell(0, 20, $judul, 0, 0, 'C', false);
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
         $this->Ln(10);*/
        //----------------------------------------------- 

        #tableheader
        $this->SetFont('Arial', 'B', 9);
        $ukuran_kolom_pagu_total_sisa = 60;
        $ukuran_kolom_hari = 20;
		$kolom1=40;
		$kolom2=60;
		$kolom3=100;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($kolom2, $h, 'Bank Cabang', 1, 0, 'C', true);
        $this->SetX($left += $kolom2);
        $this->Cell($kolom3, $h, 'No.Rekening', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $kolom3);
        $this->Cell(620, $h / 2, 'Tanggal Penerimaan', 1, 0, 'C', true);
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
        $this->SetX($left += 620);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Total', 1, 1, 'C', true);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1, $kolom2, $kolom3,
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
            $ukuran_kolom_hari, $ukuran_kolom_pagu_total_sisa));
        $this->SetAligns(array('C', 'C', 'L', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R'));
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
		
		}
        foreach ($this->data as $value) {
            $this->Row(
                    array($no++,
                        $value->get_bank_code(),
                        $value->get_bank_branch_code(),
                        number_format($value->get_n01()),
                        number_format($value->get_n02()),
                        number_format($value->get_n03()),
                        number_format($value->get_n04()),
                        number_format($value->get_n05()),
                        number_format($value->get_n06()),
                        number_format($value->get_n07()),
                        number_format($value->get_n08()),
                        number_format($value->get_n09()),
                        number_format($value->get_n10()),
                        number_format($value->get_n11()),
                        number_format($value->get_n12()),
                        number_format($value->get_n13()),
                        number_format($value->get_n14()),
                        number_format($value->get_n15()),
                        number_format($value->get_n16()),
                        number_format($value->get_n17()),
                        number_format($value->get_n18()),
                        number_format($value->get_n19()),
                        number_format($value->get_n20()),
                        number_format($value->get_n21()),
                        number_format($value->get_n22()),
                        number_format($value->get_n23()),
                        number_format($value->get_n24()),
                        number_format($value->get_n25()),
                        number_format($value->get_n26()),
                        number_format($value->get_n27()),
                        number_format($value->get_n28()),
                        number_format($value->get_n29()),
                        number_format($value->get_n30()),
                        number_format($value->get_n31()),
                        number_format($value->get_jumlah()),
            ));
            //jumlah grand total
            //-------------
            $j1 = $j1 + $value->get_n01();
            $j2 = $j2 + $value->get_n02();
            $j3 = $j3 + $value->get_n03();
            $j4 = $j4 + $value->get_n04();
            $j5 = $j5 + $value->get_n05();
            $j6 = $j6 + $value->get_n06();
            $j7 = $j7 + $value->get_n07();
            $j8 = $j8 + $value->get_n08();
            $j9 = $j9 + $value->get_n09();
            $j10 = $j10 + $value->get_n10();
            $j11 = $j11 + $value->get_n11();
            $j12 = $j12 + $value->get_n12();
            $j13 = $j13 + $value->get_n13();
            $j14 = $j14 + $value->get_n14();
            $j15 = $j15 + $value->get_n15();
            $j16 = $j16 + $value->get_n16();
            $j17 = $j17 + $value->get_n17();
            $j18 = $j18 + $value->get_n18();
            $j19 = $j19 + $value->get_n19();
            $j20 = $j20 + $value->get_n20();
            $j21 = $j21 + $value->get_n21();
            $j22 = $j22 + $value->get_n22();
            $j23 = $j23 + $value->get_n23();
            $j24 = $j24 + $value->get_n24();
            $j25 = $j25 + $value->get_n25();
            $j26 = $j26 + $value->get_n26();
            $j27 = $j27 + $value->get_n27();
            $j28 = $j28 + $value->get_n28();
            $j29 = $j29 + $value->get_n29();
            $j30 = $j30 + $value->get_n30();
            $j31 = $j31 + $value->get_n31();
            $jtotal = $jtotal + $value->get_jumlah();


            //------------------
        }
        $this->SetFont('Arial', 'B', 7);
        $h = 20;
        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell(200, $h, 'GRAND TOTAL', 1, 0, 'L', true);
        $this->SetX($left += 200);
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
            $this->MultiCell($w, 10, $data[$i], 0, $a);
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
$kdbulan = $this->kd_bulan;

//--------------------------
//pilihan
//judul laporan
$judul1= $this->judul1;
$judul = 'Laporan '.$judul1.' '.$kdbulan; //judul file laporan

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






