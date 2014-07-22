{

<?php

$total_gaji = 0;
$total_non_gaji = 0;
$total_lainnya = 0;
$total_void = 0;

foreach ($this->data_sp2d_rekap as $sp2d_rekap_harian) {
    $total_gaji += $sp2d_rekap_harian->get_gaji();
    $total_non_gaji += $sp2d_rekap_harian->get_non_gaji();
    $total_void += $sp2d_rekap_harian->get_void();
    $total_lainnya += $sp2d_rekap_harian->get_lainnya();
}

?>

    "title" : "Jenis SP2D",

    "pieData" : [

        {
            "value" : <?php echo $total_gaji; ?>,
            "index" : "<?php echo number_format($total_gaji); ?>",
            "label" : "Gaji",
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $total_non_gaji; ?>,
            "index" : "<?php echo number_format($total_non_gaji); ?>",
            "label" : "Non Gaji",
            "color" : "#8E5696"
        },
        {
            "value" : <?php echo $total_lainnya; ?>,
            "index" : "<?php echo number_format($total_lainnya); ?>",
            "label" : "Lainnya",
            "color" : "#F6CE40"
        },
        {
            "value" : <?php echo $total_void; ?>,
            "index" : "<?php echo number_format($total_void); ?>",
            "label" : "Void",
            "color" : "#E35C5C"
        }

    ]

}