<?php

function datediff2($interval, $datefrom, $dateto, $using_timestamps = false) {
    /*
      $interval can be:
      yyyy - Number of full years
      q - Number of full quarters
      m - Number of full months
      y - Difference between day numbers
      (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
      d - Number of full days
      w - Number of full weekdays
      ww - Number of full weeks
      h - Number of full hours
      n - Number of full minutes
      s - Number of full seconds (default)
     */
    // contoh : $holidays=array("2014-09-26");
    $holidays = array();

    if ($datefrom > $dateto) {
        $tempdatefrom = $dateto;
        $dateto = $datefrom;
        $datefrom = $tempdatefrom;
    }

    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto = strtotime($dateto, 0);
    }
    $difference = $dateto - $datefrom; // Difference in seconds
    //We subtract the holidays
    foreach ($holidays as $holiday) {
        $time_stamp = strtotime($holiday);
        //If the holiday doesn't fall in weekend
        if ($datefrom <= $time_stamp && $time_stamp <= $dateto && date("N", $time_stamp) != 6 && date("N", $time_stamp) != 7)
            $difference = $difference - (60 * 60 * 24);
    }

    switch ($interval) {

        case 'yyyy': // Number of full years
            $years_difference = floor($difference / 31536000);
            if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom) + $years_difference) > $dateto) {
                $years_difference--;
            }
            if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto) - ($years_difference + 1)) > $datefrom) {
                $years_difference++;
            }
            $datediff = $years_difference;
            break;
        case "q": // Number of full quarters
            $quarters_difference = floor($difference / 8035200);
            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($quarters_difference * 3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }
            $quarters_difference--;
            $datediff = $quarters_difference;
            break;
        case "m": // Number of full months
            $months_difference = floor($difference / 2678400);
            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }
            $months_difference--;
            $datediff = $months_difference;
            break;
        case 'y': // Difference between day numbers
            $datediff = date("z", $dateto) - date("z", $datefrom);
            break;
        case "d": // Number of full days
            $datediff = floor($difference / 86400);
            break;
        case "w": // Number of full weekdays
            $days_difference = floor($difference / 86400);
            $weeks_difference = floor($days_difference / 7); // Complete weeks
            $first_day = date("w", $datefrom);
            $days_remainder = floor($days_difference % 7);
            $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
            if ($odd_days > 7) { // Sunday
                $days_remainder--;
            }
            if ($odd_days > 6) { // Saturday
                $days_remainder--;
            }
            $datediff = ($weeks_difference * 5) + $days_remainder;
            break;
        case "ww": // Number of full weeks
            $datediff = floor($difference / 604800);
            break;
        case "h": // Number of full hours
            $datediff = floor($difference / 3600);
            break;
        case "n": // Number of full minutes
            $datediff = floor($difference / 60);
            break;
        default: // Number of full seconds (default)
            $datediff = $difference;
            break;
    }
    return $datediff;
}

function secondtoString($second) {
    $sebutannya = '';
    if ($second > 59) {
        $detik = fmod($second, 60);
        $menit = fmod(floor(($second - $detik) / 60), 60);
        $jam = fmod(floor(($second - $detik) / 60 / 60), 24);
        $hari = floor(($second - $detik) / 60 / 60 / 24);
        if ($detik < 10)
            $detik = "0" . $detik;
        if ($menit < 10)
            $menit = "0" . $menit;
        if ($jam < 10)
            $jam = "0" . $jam;
        if ($detik == 0)
            $detik = "";
        if ($menit == 0)
            $menit = "";
        if ($jam == 0)
            $jam = "";
        if ($hari == 0) {
            $hari = "";
        } else {
            $hari = $hari . " hari ";
        }
        $sebutannya = $hari . $jam . ":" . $menit . ":" . $detik;
    } else {
        $sebutannya = $second;
        $second = floor($second / 60);
    }
    return $sebutannya;
}

function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a hari %h:%i:%s ');
}

$awal = "2014-09-25 09:27:10";
$akhir = "2014-09-25 14:00:00";
echo datediff2("", $awal, $akhir) . " detik";
echo "<br>";
echo secondtoString(datediff2("", $awal, $akhir));
echo "<br>";
echo secondstoTime(datediff2("", $awal, $akhir));
?>