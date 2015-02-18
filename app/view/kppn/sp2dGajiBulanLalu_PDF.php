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
require_once("./././public/fpdf17/fpdf.php");require_once("./././public/fpdf17/rotation.php");

class FPDF_AutoWrapTable extends PDF_Rotate {

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
	private $kdtahun;
	
    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn,$kdtahun) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
        $this->nm_kppn = $nm_kppn;
		$this->kdtahun = $kdtahun;
		
		
    }

    /*
     * Index
     */

    public function rptDetailData() {
        //-----------------------------------
        $judul = $this->options['judul'];
        $nm_kppn = $this->nm_kppn;
		$kdtahun = $this->kdtahun;
		$kdtahun=$kdtahun-1;
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
        $ukuran_kolom_pagu_total_sisa = 80;
        $ukuran_kolom_jenis_belanja = 60;
		$kolom1=20;
		
		$totalheader=$ukuran_kolom_jenis_belanja*13;
		$kolom_grandtotal=$kolom1+$ukuran_kolom_pagu_total_sisa;
        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);

        $this->SetX($left += $kolom1);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Bank', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_pagu_total_sisa);
        $this->Cell($totalheader, $h / 2, 'Jumlah SP2D', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Des '.$kdtahun, 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Jan', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Feb', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Mar', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Apr', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Mei', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Jun', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Jul', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Ags', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Sep', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Okt', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		$this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Nov', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Des', 1, 1, 'C', true);
        $py3 = $this->GetY();
        $this->SetX($left += 660);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$ukuran_kolom_pagu_total_sisa,
		$ukuran_kolom_jenis_belanja,$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja, 
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja,$ukuran_kolom_jenis_belanja));
        $this->SetAligns(array('C', 'L', 
		'R', 'R', 
		'R', 'R',
		'R', 'R',
		'R', 'R', 
		'R', 'R', 
		'R', 'R', 
		'R'));
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
			$jan = 0;
			$feb = 0;
			$mar = 0;
			$apr = 0;
			$mei = 0;
			$jun = 0;
			$jul = 0;
			$ags = 0;
			$sep = 0;
			$okt = 0;
			$nop = 0;
			$des = 0;
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data as $value) {
				//filter bank
				if(is_null($value->get_payment_date())){
					$fb='0';
				}else{
					$fb=$value->get_payment_date();
				}
				//filter 1
				if(is_null($value->get_return_desc())){
					$f1='0';
				}else{
					$f1=$value->get_return_desc();
				}
				//filter 2
				if(is_null($value->get_invoice_num())){
					$f2='0';
				}else{
					$f2=$value->get_invoice_num();
				}
				
				//filter 3
				if(is_null($value->get_check_date())){
					$f3='0';
				}else{
					$f3=$value->get_check_date();
				}
				
				//filter 4
				if(is_null($value->get_creation_date())){
					$f4='0';
				}else{
					$f4=$value->get_creation_date();
				}
				//filter 5
				if(is_null($value->get_check_number())){
					$f5='0';
				}else{
					$f5=$value->get_check_number();
				}
				
				//filter 6
				if(is_null($value->get_check_number_line_num())){
					$f6='0';
				}else{
					$f6=$value->get_check_number_line_num();
				}
				
				//filter 7
				if(is_null($value->get_check_amount())){
					$f7='0';
				}else{
					$f7=$value->get_check_amount();
				}
				//filter 8
				if(is_null($value->get_bank_account_name())){
					$f8='0';
				}else{
					$f8=$value->get_bank_account_name();
				}
				
				//filter 9
				if(is_null($value->get_bank_name())){
					$f9='0';
				}else{
					$f9=$value->get_bank_name();
				}
				
				//filter 10
				if(is_null($value->get_vendor_ext_bank_account_num())){
					$f10='0';
				}else{
					$f10=$value->get_vendor_ext_bank_account_num();
				}
				//filter 11
				if(is_null($value->get_vendor_name())){
					$f11='0';
				}else{
					$f11=$value->get_vendor_name();
				}
				
				//filter 12
				if(is_null($value->get_invoice_description())){
					$f12='0';
				}else{
					$f12=$value->get_invoice_description();
				}
				
				//filter 13
				if(is_null($value->get_ftp_file_name())){
					$f13='0';
				}else{
					$f13=$value->get_ftp_file_name();
				}
				
			
                $this->Row(
                        array($no++,
                            $fb,
							$f1,
                            $f2,
                            $f3,
							$f4,
                            $f5,
                            $f6,
							$f7,
                            $f8,
                            $f9,
							$f10,
                            $f11,
                            $f12,
							$f13
                ));
                //jumlah grand total
						$des1+=$value->get_return_desc();
						$jan+=$value->get_invoice_num();
                        $feb+=$value->get_check_date();
                        $mar+=$value->get_creation_date();
                        $apr+=$value->get_check_number();
                        $mei+=$value->get_check_number_line_num();
                        $jun+=$value->get_check_amount();
                        $jul+=$value->get_bank_account_name();
                        $ags+=$value->get_bank_name();
                        $sep+=$value->get_vendor_ext_bank_account_num();
                        $okt+=$value->get_vendor_name();
                        $nop+=$value->get_invoice_description();
                        $des+=$value->get_ftp_file_name();
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
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $des1, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $jan, 1, 0, 'R', true);
			 $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $feb, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $mar, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $apr, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $mei, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $jun, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $jul, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $ags, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $sep, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $okt, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $nop, 1, 0, 'R', true);
			$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $des, 1, 1, 'R', true);
            
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
$kdtahun= $this->kdtahun;
//echo 'kdtahun:'.$kdtahun;

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
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn,$kdtahun);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>




