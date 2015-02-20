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
	private $nm_kppn4;
	private $kd_bulan;
		

    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn, $nm_kppn4,$kd_bulan) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
		$this->nm_kppn4 = $nm_kppn4;
        $this->nm_kppn = $nm_kppn;
		$this->kd_bulan= $kd_bulan;
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

		 //------------------------------------
			$kdbulan=$this->kd_bulan;
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
		
        $this->Cell(0, 1, " ", "B");
         $this->Ln(10);*/
        $this->Cell(0, 20, $judul.' '.$bulan, 0, 0, 'C', false);
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
            //$this->Cell(0, 20, 'Dari tanggal:' . $kdtgl_awal . ' s/d ' . $kdtgl_akhir, 0, 0, 'C', false);		
        } else {
            //$this->Cell(0, 20, 'Sampai Dengan  ' . date('d-m-Y'), 0, 0, 'C', false);			 
        } 
		//--------------------

        $this->Ln(20);
        $this->SetFont("", "B", 8);
         $this->Ln(10);*/
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
        $this->Cell($kolom3, $h, 'KPPN', 1, 0, 'C', true);
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
				
				if (isset($this->nm_kppn4)) {
					foreach ($this->nm_kppn4 as $kppn1) {
						if ($value->get_kppn() == $kppn1->get_kd_d_kppn()){
							$nama_kppn = $kppn1->get_nama_user();
						}
						if ($value->get_kppn() == "PNR"){
							$nama_kppn = "PENERIMAAN";
						}
					}
                 }
		
            $this->Row(
                    array($no++,
						$nama_kppn.' ('.$value->get_kppn().')',
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
            


            //------------------
        }
        $this->SetFont('Arial', 'B', 7);
        $h = 20;
        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
		$this->Ln(3);
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

 if (is_array($this->kppn_list)) {
	//echo 'ini array';
	$nm_kppn4= $this->kppn_list;
	
} else {
    echo 'bukan array';
    //$nm_kppn4 = $this->nm_kppn2;
}
$kd_bulan = $this->d_bulan;
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
    'paper_size' => 'F4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'L' //orientation: P=portrait, L=landscape
);
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir,$nm_kppn,$nm_kppn4,$kd_bulan);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>






