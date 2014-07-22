{

<?php

$total_vol_gaji = 0;
$total_vol_non_gaji = 0;

foreach ($this->data_sp2d_rekap as $sp2d_rekap_harian) {
    $total_vol_gaji += $sp2d_rekap_harian->get_vol_gaji();
    $total_vol_non_gaji += $sp2d_rekap_harian->get_vol_non_gaji();
}

?>

    "title" : "Nominal SP2D",

    "pieData" : [

        {
            "value" : <?php echo $total_vol_gaji; ?>,
            "index" : "<?php echo (number_format(round(($total_vol_gaji / 1000000000), 2), 2)." M<span class='low-res-hidden'>ILYAR</span>"); ?>",
            "label" : "Gaji",
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $total_vol_non_gaji; ?>,
            "index" : "<?php echo (number_format(round(($total_vol_non_gaji / 1000000000), 2), 2)." M<span class='low-res-hidden'>ILYAR</span>"); ?>",
            "label" : "Non Gaji",
            "color" : "#8E5696"
        }

    ]

}