<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Kumpulan Fungsi dari Stackoverview.com dan github.com
* Rumus Untuk Menghitung ROP dan SS
* Surabaya, 26-10-2017
* Rizky Yuanda - 04212096
*/
class Lib_rop 
{
	public function NormSInv($probability) 
	{
	  $a1 = -39.6968302866538; 
	  $a2 = 220.946098424521;
	  $a3 = -275.928510446969;
	  $a4 = 138.357751867269;
	  $a5 = -30.6647980661472;
	  $a6 = 2.50662827745924;
	  $b1 = -54.4760987982241;
	  $b2 = 161.585836858041;
	  $b3 = -155.698979859887;
	  $b4 = 66.8013118877197;
	  $b5 = -13.2806815528857;
	  
	  $c1 = -7.78489400243029E-03;
	  $c2 = -0.322396458041136;
	  $c3 = -2.40075827716184;
	  $c4 = -2.54973253934373;
	  $c5 = 4.37466414146497;
	  $c6 = 2.93816398269878;
	  $d1 = 7.78469570904146E-03;
	  $d2 = 0.32246712907004;
	  $d3 = 2.445134137143;
	  $d4 =  3.75440866190742;
	  $p_low = 0.02425;
	  $p_high = 1 - $p_low;
	  $q = 0;
	  $r = 0;
	  $normSInv = 0;
	  if ($probability < 0 ||
	    $probability > 1)
	  {
	    throw new \Exception("normSInv: Argument out of range.");
	  } else if ($probability < $p_low) {
	    $q = sqrt(-2 * log($probability));
	    $normSInv = ((((($c1 * $q + $c2) * $q + $c3) * $q + $c4) * $q + $c5) * $q + $c6) / (((($d1 * $q + $d2) * $q + $d3) * $q + $d4) * $q + 1);
	  } else if ($probability <= $p_high) {
	    $q = $probability - 0.5;
	    $r = $q * $q;
	    $normSInv = ((((($a1 * $r + $a2) * $r + $a3) * $r + $a4) * $r + $a5) * $r + $a6) * $q / ((((($b1 * $r + $b2) * $r + $b3) * $r + $b4) * $r + $b5) * $r + 1);
	  } else {
	    $q = sqrt(-2 * log(1 - $probability));
	    $normSInv = -((((($c1 * $q + $c2) * $q + $c3) * $q + $c4) * $q + $c5) * $q + $c6) /(((($d1 * $q + $d2) * $q + $d3) * $q + $d4) * $q + 1);
	  
	  }
	  return $normSInv;
	}

	public function standardDeviation($array){
		$count = count($array);
		$actual = array_sum($array);//nilai aktual
	    $mean = array_sum($array)/$count; //rata2
	    $rowValue = 0;
	    
	    foreach($array as $value){
	        $rowValue += pow($value - $mean,2);
	    }
	    return sqrt($rowValue/($count - 1));
	}

	public function mean ($array)
	{
		$total = array_sum($array);
		$hitung = count($array);
		$mean = $total/$hitung;
		return $mean;
	}

	public function leadTime ($days)
	{
		$leadTime = $days/25;
		return $leadTime;
	}

	public function safetyStock ($z, $stdev, $lt)
	{
	  $ss = round(($z * $stdev) * sqrt($lt));
	  return $ss;
	}

	public function rop ($rata2, $lt, $ss)
	{
	  $rop = round(($rata2 * $lt) + $ss);
	  return $rop;
	}

}









