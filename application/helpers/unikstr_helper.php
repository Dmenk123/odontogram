<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function unik_str($minVal, $maxVal) {
    $range = $maxVal - $minVal;
    if ($range < 0) return $minVal; // not so random...

    $log = log($range, 2);
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1

    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd >= $range);
    return $minVal + $rnd;
}
?>