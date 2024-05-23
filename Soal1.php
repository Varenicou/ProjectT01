<?php

function convertToStr($number) {
    $units = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
    $tens = ['', 'sepuluh', 'dua puluh', 'tiga puluh', 'empat puluh', 'lima puluh', 'enam puluh', 'tujuh puluh', 'delapan puluh', 'sembilan puluh'];
    $teens = ['sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'];

    if ($number == 0) {
        return 'nol';
    }

    if ($number < 0 || $number > 999999) {
        return 'Angka di luar jangkauan';
    }

    $result = '';

    if ($number >= 100000) {
        $hundredThousands = intval($number / 100000);
        $result .= $units[$hundredThousands] . ' ratus ';
        $number %= 100000;
    }

    if ($number >= 10000) {
        $tensThousands = intval($number / 10000);
        if ($tensThousands == 1) {
            $result .= $teens[intval($number / 1000 % 10)] . ' ribu ';
            $number %= 1000;
        } else {
            $result .= $tens[$tensThousands] . ' ';
            $number %= 10000;
        }
    }

    if ($number >= 1000) {
        $thousands = intval($number / 1000);
        $result .= ($thousands == 1 ? 'seribu' : $units[$thousands] . ' ribu') . ' ';
        $number %= 1000;
    }

    if ($number >= 100) {
        $hundreds = intval($number / 100);
        $result .= ($hundreds == 1 ? 'seratus' : $units[$hundreds] . ' ratus') . ' ';
        $number %= 100;
    }

    if ($number >= 20) {
        $tensPart = intval($number / 10);
        $result .= $tens[$tensPart] . ' ';
        $number %= 10;
    }

    if ($number >= 10 && $number < 20) {
        $result .= $teens[$number - 10] . ' ';
        $number = 0;
    }

    if ($number > 0 && $number < 10) {
        $result .= $units[$number] . ' ';
    }

    return trim($result);
}

// Test cases   

error_reporting(0);
ini_set('display_errors', 0);
?>

<form action="Soal1.php" method="post">
    Input: <input type="number" name="num_input" id="num_input"> <button type="submit">Submit</button><br>
    <? if(isset($_POST['num_input'])): ?>
    Output: <?=convertToStr($_POST['num_input'])?>
    <? endif; ?>
</form>