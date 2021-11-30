<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('timeAgo'))
{
	function timeAgo($timestamp){
        $time = time() - $timestamp;
 
        if ($time < 60)
        return ( $time > 1 ) ? $time . ' detik yang lalu' : 'satu detik';
        elseif ($time < 3600) {
        $tmp = floor($time / 60);
        return ($tmp > 1) ? $tmp . ' menit yang lalu' : ' satu menit yang lalu';
        }
        elseif ($time < 86400) {
        $tmp = floor($time / 3600);
        return ($tmp > 1) ? $tmp . ' jam yang lalu' : ' satu jam yang lalu';
        }
        elseif ($time < 2592000) {
        $tmp = floor($time / 86400);
        return ($tmp > 1) ? $tmp . ' hari lalu' : ' satu hari lalu';
        }
        elseif ($time < 946080000) {
        $tmp = floor($time / 2592000);
        return ($tmp > 1) ? $tmp . ' bulan lalu' : ' satu bulan lalu';
        }
        else {
        $tmp = floor($time / 946080000);
        return ($tmp > 1) ? $tmp . ' years' : ' a year';
        }
    }
}

if ( ! function_exists('contul'))
{
	function contul($string){
        if($string == '') {
            return null;
        }else{
            return $string;
        }
    }
}

if (!function_exists('tanggal_indo')) {
    /**
     * fungsi merubah YYYY-MM-DD ke DD String Bulan Indo YYYY
     *
     * @param [type] $string
     * @return void
     */
    function tanggal_indo($date)
    {
        $arr_bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $retval = date('d', strtotime($date)) . ' ' . $arr_bulan[(int) date('m', strtotime($date))] . ' ' . date('Y', strtotime($date));
        return $retval;
    }
}

if (!function_exists('bulan_indo')) {
    /**
     * fungsi merubah YYYY-MM-DD ke DD String Bulan Indo YYYY
     *
     * @param [type] $string
     * @return void
     */
    function bulan_indo($int)
    {
        $arr_bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        return $arr_bulan[$int];
    }
}
if (!function_exists('hitung_umur')) {
    function hitung_umur($tanggal){
        $birthDate = new DateTime($tanggal);
        $today = new DateTime("today");
        if ($birthDate > $today) { 
            exit("0 tahun 0 bulan 0 hari");
        }
        $y = $today->diff($birthDate)->y;
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        return $y." tahun ".$m." bulan ".$d." hari";
    }
}
?>