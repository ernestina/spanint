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
require_once("./././public/fpdf17/rotation.php");

class FPDF_AutoWrapTable extends PDF_Rotate {

    private $data1 = array();
    private $data2 = array();
    private $data3 = array();
    private $data4 = array();
    private $data6 = array();
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
	private $kd_ppp;
	
    /*
     * Konstruktor
     */

    function __construct($data1 = array(),$data2 = array(),$data3 = array(),$data4 = array(),$data6 = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn,$kd_ppp) {
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
		$this->kd_ppp=$kd_ppp;
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
       $this->SetFillColor(200, 200, 200);
	   //---------------------BAGIAN 1-----------------------------------

        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 100;
        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=60;
		$kolom3=50;
		$kolom4=200;
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
        $this->Ln(3);

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
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($total_dipa), 1, 1, 'R', true);
				$this->Ln(3);
           
        }
		$this->Ln(15);
	//-------------------BAGIAN 2-------------------------------------
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 100;
		$kolom4=125;
		
		$ukuran_kolom_jenis_belanja1 =$kolom4+$ukuran_kolom_jenis_belanja;
        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=60;
		$kolom3=50;
		$kolom_grandtotal=$kolom1+$kolom2+$kolom4+
		$ukuran_kolom_jenis_belanja1;

 
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
        $this->Ln(3);

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
				$this->SetFont('Arial', 'B', 7);
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
        $ukuran_kolom_jenis_belanja = 100;
				$ukuran_kolom_jenis_belanja1 =$kolom4+$ukuran_kolom_jenis_belanja;

        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=60;
		$kolom_grandtotal=$kolom1+$kolom2+$kolom4+
		$ukuran_kolom_jenis_belanja1;

 
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
        $this->Ln(3);

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
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($total_up), 1, 1, 'R', true);
				$this->Ln(3);
           
        }
	$this->Ln(15);
	//----------------------------------------------------------
	//---------------------BAGIAN 4-----------------------------------
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 100;
		$ukuran_kolom_jenis_belanja1 =$kolom4+$ukuran_kolom_jenis_belanja;

        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=60;
		$kolom_grandtotal=$kolom1+$kolom2+$kolom4+
		$ukuran_kolom_jenis_belanja1;

 
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
        $this->Ln(3);

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
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($total_belanja), 1, 1, 'R', true);
				$this->Ln(3);
           
        }
	$this->Ln(15);
	//----------------------------------------------------------
	//---------------------BAGIAN 5-----------------------------------
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 100;
				$ukuran_kolom_jenis_belanja1 =$kolom4+$ukuran_kolom_jenis_belanja;

        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 60;
		$kolom1=20;
		$kolom2=60;
		$kolom_grandtotal=$kolom1+$kolom2+$kolom4+
		$ukuran_kolom_jenis_belanja1;

 
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
        $this->Ln(3);

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
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($total_setoran_up), 1, 1, 'R', true);
				$this->Ln(3);
           
        }
	$this->Ln(15);
	//----------------------------------------------------------
	//---------------------BAGIAN 6-----------------------------------
				//echo 'kd_ppp:'.$kd_ppp;
				$pendapatan_hitung = $kd_ppp/100;
				//echo 'pendapatan_hitung:'.$pendapatan_hitung;
				$maksimum_pencairan = ($pendapatan_hitung * $total_penerimaan) - $total_belanja;

				$this->SetFont('Arial', 'B', 7);
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
$kd_ppp = $this->ppp;
$tabel = new FPDF_AutoWrapTable($data1,$data2,$data3,$data4,$data6, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn,$kd_ppp);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>




