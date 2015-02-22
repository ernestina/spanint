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

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(),$nm_kppn,$nm_kppn2,$nm_kppn3) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
        $this->nm_kppn = $nm_kppn;
		$this->nm_kppn2 = $nm_kppn2;
		$this->nm_kppn3 = $nm_kppn3;
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
        $h = 40;
        $left = 10;
        $this->SetFont('Arial', 'B', 9);
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 75;
		$ukuran_kolom_jenis_belanja1=$ukuran_kolom_jenis_belanja*9;
		$kolom1=20;
		$kolom2=53;
		$kolom3=80;
		$kolom_grandtotal=$kolom1+$kolom3;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($kolom3, $h, 'Kota/Kabupaten', 1, 0, 'C', true);
        $this->SetX($left += $kolom3);
        $this->Cell($kolom2, $h, 'Keterangan', 1, 0, 'C', true);
        $this->SetX($left += $kolom2);
        $px1 = $this->GetX();
        $this->Cell($ukuran_kolom_jenis_belanja1, $h / 2, 'Jenis Belanja', 1, 0, 'C', true);
		$py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Pegawai', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Barang', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Modal', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Beban Bunga', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Subsidi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Hibah', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Bansos', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Lain-lain', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Transfer', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);
        $this->SetX($left += $ukuran_kolom_jenis_belanja1);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Total', 1, 1, 'C', true);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1, $kolom3, $kolom2,$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja,$ukuran_kolom_jenis_belanja, $ukuran_kolom_pagu_total_sisa));
        $this->SetAligns(array('C', 'L', 'L', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R'));
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
                        ''
            ));
        } else {
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data as $value) {
				if	($value->get_pagu_51() == 0) { 
					$nil_51='0.00%';
				}else { 
					$nil_51="(".number_format($value->get_belanja_51()/$value->get_pagu_51()*100,2)."%)";
				}
				if	($value->get_pagu_52() == 0) { 
					$nil_52='0.00%';
				}else { 
					$nil_52="(".number_format($value->get_belanja_52()/$value->get_pagu_52()*100,2)."%)";
				}
				if	($value->get_pagu_53() == 0) { 
					$nil_53='0.00%';
				}else { 
					$nil_53="(".number_format($value->get_belanja_53()/$value->get_pagu_53()*100,2)."%)";
				}
				if	($value->get_pagu_54() == 0) { 
					$nil_54='0.00%';
				}else { 
					$nil_54="(".number_format($value->get_belanja_54()/$value->get_pagu_54()*100,2)."%)";
				}
				if	($value->get_pagu_55() == 0) { 
					$nil_55='0.00%';
				}else { 
					$nil_55="(".number_format($value->get_belanja_55()/$value->get_pagu_55()*100,2)."%)";
				}
				if	($value->get_pagu_56() == 0) { 
					$nil_56='0.00%';
				}else { 
					$nil_56="(".number_format($value->get_belanja_56()/$value->get_pagu_56()*100,2)."%)";
				}
				if	($value->get_pagu_58() == 0) { 
					$nil_58='0.00%';
				}else { 
					$nil_58="(".number_format($value->get_belanja_58()/$value->get_pagu_58()*100,2)."%)";
				}
				
				if	($value->get_pagu_61() == 0) { 
					$nil_61='0.00%';
				}else { 
					$nil_61="(".number_format($value->get_belanja_61()/$value->get_pagu_61()*100,2)."%)";
				}
					$nil_pr="(".number_format($value->get_realisasi()/$value->get_pagu()*100,2)."%)";
			
			
                $this->Row(
                        array($no++,
                            $value->get_nmba().' '.$value->get_ba(),
                            'PAGU'."\n".'REALISASI'."\n".'PERSENTASE'."\n".'SISA',
                            number_format($value->get_pagu_51())."\n".number_format($value->get_belanja_51())."\n".$nil_51."\n".number_format($value->get_pagu_51()-$value->get_belanja_51()),
                            number_format($value->get_pagu_52())."\n".number_format($value->get_belanja_52())."\n".$nil_52."\n".number_format($value->get_pagu_52()-$value->get_belanja_52()),
                            number_format($value->get_pagu_53())."\n".number_format($value->get_belanja_53())."\n".$nil_53."\n".number_format($value->get_pagu_53()-$value->get_belanja_53()),
                            number_format($value->get_pagu_54())."\n".number_format($value->get_belanja_54())."\n".$nil_54."\n".number_format($value->get_pagu_54()-$value->get_belanja_54()),
                            number_format($value->get_pagu_55())."\n".number_format($value->get_belanja_55())."\n".$nil_55."\n".number_format($value->get_pagu_55()-$value->get_belanja_55()),
                            number_format($value->get_pagu_56())."\n".number_format($value->get_belanja_56())."\n".$nil_56."\n".number_format($value->get_pagu_56()-$value->get_belanja_56()),
                            number_format($value->get_pagu_57())."\n".number_format($value->get_belanja_57())."\n".$nil_57."\n".number_format($value->get_pagu_57()-$value->get_belanja_57()),
                            number_format($value->get_pagu_58())."\n".number_format($value->get_belanja_58())."\n".$nil_58."\n".number_format($value->get_pagu_58()-$value->get_belanja_58()),
                            number_format($value->get_pagu_61())."\n".number_format($value->get_belanja_61())."\n".$nil_61."\n".number_format($value->get_pagu_61()-$value->get_belanja_61()),
							number_format($value->get_pagu())."\n".number_format($value->get_realisasi())."\n".$nil_pr."\n".number_format($value->get_pagu()-$value->get_realisasi())

                ));
                //jumlah grand total
							$tot_pagu+=$value->get_Pagu();
							$tot_real+=$value->get_realisasi();
                            $tot_51+=$value->get_belanja_51();
                            $tot_52+=$value->get_belanja_52();
                            $tot_53+=$value->get_belanja_53();
                            $tot_54+=$value->get_belanja_54();
                            $tot_55+=$value->get_belanja_55();
                            $tot_56+=$value->get_belanja_56();
                            $tot_57+=$value->get_belanja_57();
                            $tot_58+=$value->get_belanja_58();
							$tot_61+=$value->get_belanja_61();
							$tot_pagu_51+=$value->get_pagu_51();
                            $tot_pagu_52+=$value->get_pagu_52();
                            $tot_pagu_53+=$value->get_pagu_53();
                            $tot_pagu_54+=$value->get_pagu_54();
                            $tot_pagu_55+=$value->get_pagu_55();
                            $tot_pagu_56+=$value->get_pagu_56();
                            $tot_pagu_57+=$value->get_pagu_57();
                            $tot_pagu_58+=$value->get_pagu_58();
                            $tot_pagu_61+=$value->get_pagu_61();

            }
            $this->SetFont('Arial', 'B',6);
            $h = 80;
            $this->SetFillColor(200, 200, 200);
            $left = $this->GetX();
            $this->Cell($kolom_grandtotal, $h, 'GRAND TOTAL', 1, 0, 'C', true);
            $this->SetX($left += $kolom_grandtotal);
//-------------------------------------------
        $py1 = $this->GetY();
		$px1 = $this->GetX();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($kolom2, $h/4, 'PAGU', 1, 0, 'L', true);
        $this->SetX($px2 += $kolom2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_51), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		 $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_52), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		 $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_53), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_54), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_55), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_56), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_57), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_58), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_61), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h/4, number_format($tot_pagu), 1, 0, 'R', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);

//---------------------------------------------------
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py2 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($kolom2, $h/4, 'REALISASI', 1, 0, 'L', true);
        $this->SetX($px2 += $kolom2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_51), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		 $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_52), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		 $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_53), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_54), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_55), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_56), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_57), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_58), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_61), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h/4, number_format($tot_real), 1, 0, 'R', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);
//---------------------------------------------------
//---------------------------------------------------

	if ($tot_pagu_51==0){
		$per_51='0.00%';
	}else{
		$per_51="(".number_format($tot_51/$tot_pagu_51*100)."%)";
	}
	if ($tot_pagu_52==0){
		$per_52='0.00%';
	}else{
		$per_52="(".number_format($tot_52/$tot_pagu_52*100)."%)";
	}
	if ($tot_pagu_53==0){
		$per_53='0.00%';
	}else{
		$per_53="(".number_format($tot_53/$tot_pagu_53*100)."%)";
	}
	if ($tot_pagu_54==0){
		$per_54='0.00%';
	}else{
		$per_54="(".number_format($tot_54/$tot_pagu_54*100)."%)";
	}
	if ($tot_pagu_55==0){
		$per_55='0.00%';
	}else{
		$per_55="(".number_format($tot_55/$tot_pagu_55*100)."%)";
	}
	if ($tot_pagu_56==0){
		$per_56='0.00%';
	}else{
		$per_56="(".number_format($tot_56/$tot_pagu_56*100)."%)";
	}
	if ($tot_pagu_58==0){
		$per_58='0.00%';
	}else{
		$per_58="(".number_format($tot_58/$tot_pagu_58*100)."%)";
	}
	if ($tot_pagu_61==0){
		$per_61='0.00%';
	}else{
		$per_61="(".number_format($tot_61/$tot_pagu_61*100)."%)";
	}
		$per_pr="(".number_format($tot_real/$tot_pagu*100)."%)";

        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py2 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($kolom2, $h/4, 'PERSENTASE', 1, 0, 'L', true);
        $this->SetX($px2 += $kolom2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, $per_51, 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		 $this->Cell($ukuran_kolom_jenis_belanja, $h/4,$per_52, 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		 $this->Cell($ukuran_kolom_jenis_belanja, $h/4, $per_53, 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, $per_54, 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, $per_55, 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, $per_56, 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, $per_57, 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, $per_58, 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, $per_61, 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h/4, $per_pr, 1, 0, 'R', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);
//---------------------------------------------------

//---------------------------------------------------
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py2 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($kolom2, $h/4, 'SISA', 1, 0, 'L', true);
        $this->SetX($px2 += $kolom2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_51-$tot_51), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		 $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_52-$tot_52), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		 $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_53-$tot_53), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_54-$tot_54), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_55-$tot_55), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_56-$tot_56), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_57-$tot_57), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_58-$tot_58), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h/4, number_format($tot_pagu_61-$tot_61), 1, 0, 'R', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h/4, number_format($tot_pagu-$tot_real), 1, 0, 'R', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);

        }
    }

        //----------------------------------------------- 

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


$nm_kppn = $this->nm_kppn;
$nm_kppn2 = $this->nm_kppn2;
$nm_kppn3 = $this->nm_kppn3;
//--------------------------
//pilihan
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
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir,$nm_kppn,$nm_kppn2,$nm_kppn3);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>




