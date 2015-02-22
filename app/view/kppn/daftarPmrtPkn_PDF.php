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
        //-----------------------------------
         
       
       
        #pengaturan khusus
		 $border = 0;
        $h = 60;
        $this->SetFont('Arial', 'B', 6);
        $ukuran_kolom_pagu_total_sisa = 40;
        $ukuran_kolom_pagu_total = 60;
        $ukuran_kolom_jenis_belanja = 60;
        $ukuran_kolom_1a = 29;
        $ukuran_kolom_2a = 53;
        $ukuran_kolom_a = $ukuran_kolom_1a + $ukuran_kolom_2a;
        $ukuran_kolom_1b1 = 29;
        $ukuran_kolom_1b2 = 53;
        $ukuran_kolom_1b = $ukuran_kolom_1b1 + $ukuran_kolom_1b2;
        $ukuran_kolom_2b1 = 29;
        $ukuran_kolom_2b2 = 53;
        $ukuran_kolom_2b = $ukuran_kolom_2b1 + $ukuran_kolom_2b2;
        $ukuran_kolom_3b1 = 29;
        $ukuran_kolom_3b2 = 53;
        $ukuran_kolom_3b = $ukuran_kolom_3b1 + $ukuran_kolom_3b2;
        $ukuran_kolom_b = $ukuran_kolom_1b + $ukuran_kolom_2b + $ukuran_kolom_3b;
		
        $ukuran_kolom_1c1 = 29;
        $ukuran_kolom_1c2 = 53;
        $ukuran_kolom_1c = $ukuran_kolom_1c1 + $ukuran_kolom_1c2;
        $ukuran_kolom_2c1 = 29;
        $ukuran_kolom_2c2 = 53;
        $ukuran_kolom_2c = $ukuran_kolom_2c1 + $ukuran_kolom_2c2;
        $ukuran_kolom_3c1 = 29;
        $ukuran_kolom_3c2 = 53;
        $ukuran_kolom_3c = $ukuran_kolom_3c1 + $ukuran_kolom_3c2;
        $ukuran_kolom_c = $ukuran_kolom_1c + $ukuran_kolom_2c + $ukuran_kolom_3c;
		
        $ukuran_kolom_1d1 = 29;
        $ukuran_kolom_1d2 = 53;
        $ukuran_kolom_1d = $ukuran_kolom_1d1 + $ukuran_kolom_1d2;
        $ukuran_kolom_2d1 = 29;
        $ukuran_kolom_2d2 = 53;
        $ukuran_kolom_2d = $ukuran_kolom_2d1 + $ukuran_kolom_2d2;
        $ukuran_kolom_3d1 = 29;
        $ukuran_kolom_3d2 = 53;
        $ukuran_kolom_3d = $ukuran_kolom_3d1 + $ukuran_kolom_3d2;
        $ukuran_kolom_d = $ukuran_kolom_1d + $ukuran_kolom_2d + $ukuran_kolom_3d;
		
		$kolom_grandtotal1=20+$ukuran_kolom_pagu_total_sisa;
		
		$kolom_grandtotal2=$ukuran_kolom_3a+$ukuran_kolom_4a;
		$kolom_grandtotal3=$ukuran_kolom_1b+$ukuran_kolom_2b;
		$kolom_grandtotal4=$ukuran_kolom_pagu_total;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell(20, $h, 'No', 1, 0, 'C', true);

        $this->SetX($left += 20);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Jenis Belanja', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_pagu_total_sisa);
//--------------------------------------------------------		
        $this->Cell($ukuran_kolom_a, $h / 2, 'S.D tgl 16 Desember 2014', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + $h / 2;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_1a, $h / 2, 'Jml SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1a);
        $this->Cell($ukuran_kolom_2a, $h / 2, 'Jml Netto (Rp.)', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 30);
        $this->SetX($left += $ukuran_kolom_a);
//--------------------------------------------------------
	
		$this->Cell($ukuran_kolom_b, $h / 3, 'Tgl 17 Desember 2014', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1 + $ukuran_kolom_a;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
		//++++++
        $this->Cell($ukuran_kolom_1b, $h / 3, 'Diterima', 1, 0, 'C', true);
		$this->SetX($px2 += $ukuran_kolom_1b);
		//++++++
        $py1 = $this->GetY();
        $px2 = $px1+$ukuran_kolom_a;
        $py2 = $py1 + $h /3;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_1b1, $h/3, 'Jml SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1b1);
        $this->Cell($ukuran_kolom_1b2, $h/3, 'Jml Netto (Rp.)', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 30);
		//---------------------------------------------
		$px2 = $px1 + $ukuran_kolom_a+$ukuran_kolom_1b;
        $py2 = $py1;
		$this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_2b, $h / 3, 'SP2D Terbit', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2b);
		//-----------------------------------
		$py1 = $this->GetY();
        $px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_1b;
        $py2 = $py1 + $h /3;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_2b1, $h/3, 'Jml SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2b1);
        $this->Cell($ukuran_kolom_2b2, $h/3, 'Jml Netto (Rp.)', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 30);
		//-----------------------------------
		$px2 = $px1 + $ukuran_kolom_a+$ukuran_kolom_1b+$ukuran_kolom_2b;
        $py2 = $py1;
		$this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_3b, $h / 3, 'Dalam Proses', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_3b);
		//-----------------------------------
		$py1 = $this->GetY();
        $px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_1b+$ukuran_kolom_2b;
        $py2 = $py1 + $h /3;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_3b1, $h/3, 'Jml SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_3b1);
        $this->Cell($ukuran_kolom_3b2, $h/3, 'Jml Netto (Rp.)', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 40);
		//-----------------------------------
        $this->SetX($left += $ukuran_kolom_b);
		$this->Cell($ukuran_kolom_c, $h / 3, 'Tgl 18 Desember 2014', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_1b+$ukuran_kolom_2b+$ukuran_kolom_3b;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
		
        $this->Cell($ukuran_kolom_1c, $h / 3, 'Diterima', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1c);
		//++++++
        $py1 = $this->GetY();
        $px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_b;
        $py2 = $py1 + $h /3;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_1c1, $h/3, 'Jml SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1c1);
        $this->Cell($ukuran_kolom_1c2, $h/3, 'Jml Netto (Rp.)', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 30);

		//---------------------------------------------
        $px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_1b+$ukuran_kolom_2b+$ukuran_kolom_3b+$ukuran_kolom_1c;
        $py2 = $py1;
		$this->SetXY($px2, $py2);

        $this->Cell($ukuran_kolom_2c, $h / 3, 'SP2D Terbit', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2c);
		//++++++
        $py1 = $this->GetY();
        $px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_b+$ukuran_kolom_1c;
        $py2 = $py1 + $h /3;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_2c1, $h/3, 'Jml SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2c1);
        $this->Cell($ukuran_kolom_2c2, $h/3, 'Jml Netto (Rp.)', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 30);
		//---------------------------------------------
        $px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_1b+$ukuran_kolom_2b+$ukuran_kolom_3b+$ukuran_kolom_1c+$ukuran_kolom_2c;
        $py2 = $py1;
		$this->SetXY($px2, $py2);
		
        $this->Cell($ukuran_kolom_3c, $h / 3, 'Dalam Proses', 1, 0, 'C', true);
        
        $this->SetX($left += $ukuran_kolom_3c);
		//++++++
        $py1 = $this->GetY();
		$px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_1b+$ukuran_kolom_2b+$ukuran_kolom_1c+$ukuran_kolom_2c+$ukuran_kolom_3c;
        $py2 = $py1 + $h /3;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_3c1, $h/3, 'Jml SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_3c1);
        $this->Cell($ukuran_kolom_3c2, $h/3, 'Jml Netto (Rp.)', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 40);
		//---------------------------------------------
		
        $this->SetX($left += $ukuran_kolom_3c+$ukuran_kolom_3c1+$ukuran_kolom_3c2);
        $this->Cell($ukuran_kolom_d, $h / 3, 'Dan seterusnya s.d 30 Desember 2014', 1, 0, 'C', true);
     
	   $py1 = $this->GetY();
	   $px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_1b+$ukuran_kolom_2b+$ukuran_kolom_3b+$ukuran_kolom_3c+$ukuran_kolom_1d+$ukuran_kolom_2d;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);

        $this->Cell($ukuran_kolom_1d, $h / 3, 'Diterima', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1d);
		//++++++
        $py1 = $this->GetY();
		$px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_b+$ukuran_kolom_c;
        $py2 = $py1 + $h /3;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_1d1, $h/3, 'Jml SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1d1);
        $this->Cell($ukuran_kolom_1d2, $h/3, 'Jml Netto (Rp.)', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 30);
   
	//---------------------------------------------
		$px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_1b+$ukuran_kolom_2b+$ukuran_kolom_3b+$ukuran_kolom_3c+$ukuran_kolom_1d+$ukuran_kolom_2d+$ukuran_kolom_3d;

        $py2 = $py1;
		$this->SetXY($px2, $py2);

        $this->Cell($ukuran_kolom_2d, $h / 3, 'SP2D Terbit', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2d);
//++++++
        $py1 = $this->GetY();
        $px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_b+$ukuran_kolom_c+$ukuran_kolom_2d;
        $py2 = $py1 + $h /3;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_2d1, $h/3, 'Jml SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1d1);
        $this->Cell($ukuran_kolom_2d2, $h/3, 'Jml Netto (Rp.)', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 30);
		//---------------------------------------------
		$px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_b+$ukuran_kolom_c+$ukuran_kolom_1d+$ukuran_kolom_2d;

        $py2 = $py1;
		$this->SetXY($px2, $py2);

        $this->Cell($ukuran_kolom_3d, $h / 3, 'Dalam Proses', 1, 0, 'C', true);
         $this->SetX($left += $ukuran_kolom_d);
		 //++++++
        $py1 = $this->GetY();
        $px2 = $px1+$ukuran_kolom_a+$ukuran_kolom_b+$ukuran_kolom_c+$ukuran_kolom_1d+$ukuran_kolom_2d;
        $py2 = $py1 + $h /3;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_3d1, $h/3, 'Jml SPM', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_3d1);
        $this->Cell($ukuran_kolom_3d2, $h/3, 'Jml Netto (Rp.)', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 40);
 	//---------------------------------------------
		$this->SetX($px2 += $ukuran_kolom_3d);
        $this->SetX($left += $ukuran_kolom_d);
 
		//--------------
        $this->Cell($ukuran_kolom_pagu_total, $h, '', 1, 1, 'C', true);
        $this->Ln(3);

        $this->SetFont('Arial', '', 6);
        $this->SetWidths(array(20,$ukuran_kolom_pagu_total_sisa,
		$ukuran_kolom_1a,$ukuran_kolom_2a,
		$ukuran_kolom_1b1,$ukuran_kolom_1b2,
		$ukuran_kolom_2b1,$ukuran_kolom_2b2,
		$ukuran_kolom_3b1,$ukuran_kolom_3b2,
		$ukuran_kolom_1c1,$ukuran_kolom_1c2,
		$ukuran_kolom_2c1,$ukuran_kolom_2c2,
		$ukuran_kolom_3c1,$ukuran_kolom_3c2,
		$ukuran_kolom_1d1,$ukuran_kolom_1d2,
		$ukuran_kolom_2d1,$ukuran_kolom_2d2,
		$ukuran_kolom_3d1,$ukuran_kolom_3d2,
			$ukuran_kolom_pagu_total
        ));
        $this->SetAligns(array('C', 'C',
		'C', 'R', 
		'C', 'R', 
		'C', 'R', 
		'C', 'R', 
		'C', 'R', 
		'C', 'R', 
		'C', 'R', 
		'C', 'R', 
		'C', 'R', 
		'C', 'R', 
		'C', 'R'
		
		
		));
        
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
                    '','',
					'','',
                    '','',
                    ''
            ));
		
		}else{
			$no = 1;
			$this->SetFillColor(255);
			foreach ($this->data as $value) {
				$this->Row(
						array($no++,
							$value->get_akun(),
							$value->get_jml_spm_dlm_proses_16(),
							number_format($value->get_nilai_spm_dlm_proses_16()),
							$value->get_jml_spm_diterima_17(),
							number_format($value->get_nilai_spm_diterima_17()),
							$value->get_jml_spm_diterbitkan_17(),
							number_format($value->get_nilai_spm_diterbitkan_17()),
							$value->get_jml_spm_dlm_proses_17(),
							number_format($value->get_nilai_spm_dlm_proses_17()),
							$value->get_jml_spm_diterima_18(),
							number_format($value->get_nilai_spm_diterima_18()),
							$value->get_jml_spm_diterbitkan_18(),
							number_format($value->get_nilai_spm_diterbitkan_18()),
							$value->get_jml_spm_dlm_proses_18(),
							number_format($value->get_nilai_spm_dlm_proses_18()),
							$value->get_jml_spm_diterima_19(),
							number_format($value->get_nilai_spm_diterima_19()),
							$value->get_jml_spm_diterbitkan_19(),
							number_format($value->get_nilai_spm_diterbitkan_19()),
							$value->get_jml_spm_dlm_proses_19(),
							number_format($value->get_nilai_spm_dlm_proses_19())
							
				));
				
			$jml_spm_dlm_proses_16 += $value->get_jml_spm_dlm_proses_16();
			$nilai_spm_dlm_proses_16 += $value->get_nilai_spm_dlm_proses_16();
            $jml_spm_diterima_17 += $value->get_jml_spm_diterima_17();
			$nilai_spm_diterima_17 += $value->get_nilai_spm_diterima_17();
            $jml_spm_diterbitkan_17 += $value->get_jml_spm_diterbitkan_17();
			$nilai_spm_diterbitkan_17 += $value->get_nilai_spm_diterbitkan_17();
            $jml_spm_dlm_proses_17 += $value->get_jml_spm_dlm_proses_17();
			$nilai_spm_dlm_proses_17 += $value->get_nilai_spm_dlm_proses_17();   
            $jml_spm_diterima_18 += $value->get_jml_spm_diterima_18();
			$nilai_spm_diterima_18 += $value->get_nilai_spm_diterima_18();
            $jml_spm_diterbitkan_18 += $value->get_jml_spm_diterbitkan_18();
			$nilai_spm_diterbitkan_18 += $value->get_nilai_spm_diterbitkan_18();
            $jml_spm_dlm_proses_18 += $value->get_jml_spm_dlm_proses_18();
			$nilai_spm_dlm_proses_18 += $value->get_nilai_spm_dlm_proses_18();   
            $jml_spm_diterima_19 += $value->get_jml_spm_diterima_19();
			$nilai_spm_diterima_19 += $value->get_nilai_spm_diterima_19();
            $jml_spm_diterbitkan_19 += $value->get_jml_spm_diterbitkan_19();
			$nilai_spm_diterbitkan_19 += $value->get_nilai_spm_diterbitkan_19();
            $jml_spm_dlm_proses_19 += $value->get_jml_spm_dlm_proses_19();
			$nilai_spm_dlm_proses_19 += $value->get_nilai_spm_dlm_proses_19();
				
			}
			$this->SetFont('Arial', 'B', 6);
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
				$this->Cell($ukuran_kolom_1a, $h, $jml_spm_dlm_proses_16, 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_1a);
				$this->Cell($ukuran_kolom_2a, $h, number_format($nilai_spm_dlm_proses_16), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_2a);
				$this->Cell($ukuran_kolom_1b1, $h, $jml_spm_diterima_17, 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_1b1);
				$this->Cell($ukuran_kolom_1b2, $h, number_format($nilai_spm_diterima_17), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_1b2);
				$this->Cell($ukuran_kolom_2b1, $h, $jml_spm_diterbitkan_17, 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_2b1);
				$this->Cell($ukuran_kolom_2b2, $h, number_format($nilai_spm_diterbitkan_17), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_2b2);
				$this->Cell($ukuran_kolom_3b1, $h, $jml_spm_dlm_proses_17, 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_3b1);
				$this->Cell($ukuran_kolom_3b2, $h, number_format($nilai_spm_dlm_proses_17), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_3b2);
				$this->Cell($ukuran_kolom_1c1, $h, $jml_spm_diterima_18, 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_1c1);
				$this->Cell($ukuran_kolom_1c2, $h, number_format($nilai_spm_diterima_18), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_1c2);
				$this->Cell($ukuran_kolom_2c1, $h, $jml_spm_diterbitkan_18, 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_2c1);
				$this->Cell($ukuran_kolom_2c2, $h, number_format($nilai_spm_diterbitkan_18), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_2c2);
				$this->Cell($ukuran_kolom_3c1, $h, $jml_spm_dlm_proses_18, 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_3c1);
				$this->Cell($ukuran_kolom_3c2, $h, number_format($nilai_spm_dlm_proses_18), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_3c2);
				$this->Cell($ukuran_kolom_1d1, $h, $jml_spm_diterima_19, 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_1d1);
				$this->Cell($ukuran_kolom_1d2, $h, number_format($nilai_spm_diterima_19), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_1d2);
				$this->Cell($ukuran_kolom_2d1, $h, $jml_spm_diterbitkan_19, 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_2d1);
				$this->Cell($ukuran_kolom_2d2, $h, number_format($nilai_spm_diterbitkan_19), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_2d2);
				$this->Cell($ukuran_kolom_3d1, $h, $jml_spm_dlm_proses_19, 1, 0, 'C', true);
				$this->SetX($px2 += $ukuran_kolom_3d1);
				$this->Cell($ukuran_kolom_3d2, $h, number_format($nilai_spm_dlm_proses_19), 1, 1, 'R', true);
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
if(isset($this->judul)){
	$judul =$this->judul;
}else{

}


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






