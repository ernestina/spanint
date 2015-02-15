<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : sp2dSudahVoid_PDF.php
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
        $this->SetFont('Arial', 'B', 7);
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 65;
        $ukuran_kolom_satker = 80;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 80;
        $ukuran_kolom_file = 85;
        $ukuran_kolom_bank_pembayar = 60;
        $ukuran_kolom_norek_penerima = 80;
        $ukuran_kolom_tgl_selsp2d = 60;
        $ukuran_kolom_tgl_sp2d = 45;
				$kolom_grandtotal1=30+$ukuran_kolom_tgl_selsp2d+
		$ukuran_kolom_tgl_sp2d+$ukuran_kolom_satker+$ukuran_kolom_dana;
		$kolom_grandtotal2=$ukuran_kolom_bank_pembayar+$ukuran_kolom_dana+
		$ukuran_kolom_jenis_belanja+$ukuran_kolom_norek_penerima+
		$ukuran_kolom_dana+$ukuran_kolom_file+$ukuran_kolom_jenis_belanja;


        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell(30, $h, 'No', 1, 0, 'L', true);
        $this->SetX($left += 30);
        $this->Cell($ukuran_kolom_tgl_selsp2d, $h, 'Tgl Selesai SP2D', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_tgl_selsp2d);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_tgl_sp2d, $h, 'Tgl SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_tgl_sp2d);
        $this->Cell($ukuran_kolom_satker, $h, 'No. SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_satker);
        $this->Cell($ukuran_kolom_dana, $h, 'No. Invoice', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Jumlah Rp', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_bank_pembayar, $h, 'Bank Pembayar', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_bank_pembayar);
        $this->Cell($ukuran_kolom_dana, $h, 'Bank Penerima', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Nama', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_norek_penerima, $h, 'No. Rekening Penerima', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_norek_penerima);
        $this->Cell($ukuran_kolom_dana, $h, 'Deskripsi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_dana);
        $this->Cell($ukuran_kolom_file, $h, 'File Transaksi', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_file);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Status', 1, 1, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Ln(8);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array(
            30, $ukuran_kolom_tgl_selsp2d,
            $ukuran_kolom_tgl_sp2d, $ukuran_kolom_satker,
            $ukuran_kolom_dana, $ukuran_kolom_jenis_belanja,
            $ukuran_kolom_bank_pembayar, $ukuran_kolom_dana,
            $ukuran_kolom_jenis_belanja, $ukuran_kolom_norek_penerima,
            $ukuran_kolom_dana, $ukuran_kolom_file,
            $ukuran_kolom_jenis_belanja
        ));
        $this->SetAligns(array('C', 'C', 'C', 'R', 'R', 'R', 'L', 'L', 'L', 'L', 'L', 'L', 'R'));
        
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
                        ''
                    )
            );
		}else{
			$no = 1;
        $this->SetFillColor(255);
        foreach ($this->data as $value) {
            $this->Row(
                    array($no++,
                        $value->get_creation_date(),
                        $value->get_payment_date(),
                        $value->get_check_number(),
                        $value->get_invoice_num(),
                        number_format($value->get_check_amount()),
                        $value->get_bank_account_name(),
                        $value->get_bank_name(),
                        $value->get_vendor_name(),
                        $value->get_vendor_ext_bank_account_num(),
                        $value->get_invoice_description(),
                        $value->get_ftp_file_name(),
                        $value->get_return_desc() . ' ' . $value->get_payment_method() . ' ' . $value->get_sorbor_number() . ' ' . $value->get_sorbor_date()
                    )
            );
			$tot_pot = $tot_pot + $value->get_check_amount();	

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
				$this->Cell($ukuran_kolom_jenis_belanja, $h, number_format($tot_pot), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
				$this->Cell($kolom_grandtotal2, $h,'', 1, 1, 'R', true);
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
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>






