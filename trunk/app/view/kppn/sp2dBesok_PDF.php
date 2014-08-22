<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : sp2dBesok_PDF.php
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
        'filename' => '',
        'destinationfile' => '',
        'paper_size' => 'F4',
        'orientation' => 'L'
    );

    function __construct($data = array(), $options = array()) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
    }

    public function rptDetailData() {


        $border = 0;
        $h = 40;
        $left = 10;
        //header
        $this->SetFont("", "B", 12);

        $this->SetX($left + 20);
        $this->Image("./././public/img/depkeu.png", 30, 30, 30, 30);
        $px1 = $this->GetX();
        $this->SetX($left + 50);
        $this->MultiCell(0, $h / 2, 'Laporan Monitoring SP2D terbit di atas jam 3 tertanggal hari yang sama  ');
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->SetX($left + 50);
        //$this->MultiCell(0, $h/2, 'Sampai Dengan  '.date('d-m-Y'));
        //$tgl_awal=(".date('Ymd',strtotime($kdtgl_awal)).",'YYYYMMDD');
        //$tgl_akhir=(".date('Ymd',strtotime($kdtgl_akhir)).",'YYYYMMDD');

        $this->MultiCell(0, $h / 2, '');

        $this->Cell(0, 1, " ", "B");
        $this->Ln(10);
        $this->SetFont("", "B", 8);
        $this->Ln(10);

        #tableheader
        $this->SetFont('Arial', 'B', 7);
        $ukuran_kolom_pagu_total_sisa = 70;
        $ukuran_kolom_jenis_belanja = 65;
        $ukuran_kolom_satker = 40;
        $ukuran_kolom_akun = 40;
        $ukuran_kolom_dana = 80;
        $ukuran_kolom_file = 85;
        $ukuran_kolom_bank_pembayar = 60;
        $ukuran_kolom_norek_penerima = 100;
        $ukuran_kolom_tgl_selsp2d = 60;
        $ukuran_kolom_tgl_sp2d = 45;

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
        $no = 1;
        $this->SetFillColor(255);
        foreach ($this->data as $value) {
            $this->Row(
                    array($no++,
                        $value->get_creation_date(),
                        $value->get_payment_date(),
                        $value->get_check_number(),
                        $value->get_invoice_num(),
                        $value->get_check_amount(),
                        $value->get_bank_account_name(),
                        $value->get_bank_name(),
                        $value->get_vendor_name(),
                        $value->get_vendor_ext_bank_account_num(),
                        $value->get_invoice_description(),
                        $value->get_ftp_file_name(),
                        $value->get_return_desc() . '--' . $value->get_payment_method() . '--' . $value->get_sorbor_number() . '--' . $value->get_sorbor_date()
                    )
            );
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
/*
  #koneksi ke database (disederhanakan)
  mysql_connect ("localhost", "root", "");
  mysql_select_db ("demo");

  #ambil data dari DB dan masukkan ke array
  $data = array();
  $query = "SELECT nip, nama, alamat, email, website FROM pegawai ORDER BY nama";
  $sql = mysql_query ($query);
  while ($row = mysql_fetch_assoc($sql)) {
  array_push($data, $row);
  } */
//-----------------------
//mengambil array data dari controller
if (is_array($this->data)) {
    $data = $this->data;
} else {
    //echo 'bukan array';
}


//--------------------------
//Laporan Data Revisi DIPA
//pilihan
$options = array(
    'filename' => 'Laporan Monitoring SP2D terbit di atas jam 3 tertanggal hari yang sama.PDF', //nama file penyimpanan, kosongkan jika output ke browser
    'destinationfile' => 'I', //I=inline browser (default), F=local file, D=download
    'paper_size' => 'F4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'L' //orientation: P=portrait, L=landscape
);

$tabel = new FPDF_AutoWrapTable($data, $options);
$tabel->printPDF();


//-------------------------------------
ob_flush();
?>




