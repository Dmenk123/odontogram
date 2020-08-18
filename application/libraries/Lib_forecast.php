<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Rumus Untuk Menghitung peramalan DES-brown
* Surabaya, 3-11-2017
* Rizky Yuanda - 04212096
*/
class Lib_forecast 
{
	public function smooth1($arr_pakai, $alpha)
	{
		//deklarasi tipe varabel
		$pemulusan1 = array();
		//set array
		$pemulusan1[] = $arr_pakai[0];
		//hitung row array dikurangi 1 row
		$hitung = count($arr_pakai) - 1;
		for ($i=1; $i <= $hitung ; $i++) { 
			$pemulusan1[] = $alpha * $arr_pakai[$i] + (1 - $alpha) * $pemulusan1[$i - 1];
		}

		return $pemulusan1;
	}

	public function smooth2($arr_pemulusan1, $alpha)
	{
		//deklarasi tipe varabel
		$pemulusan2 = array();
		//set array
		$pemulusan2[] = $arr_pemulusan1[0];
		//hitung row array dikurangi 1 row
		$hitung = count($arr_pemulusan1) - 1;
		for ($i=1; $i <= $hitung ; $i++) { 
			$pemulusan2[] = $alpha * $arr_pemulusan1[$i] + (1 - $alpha) * $pemulusan2[$i - 1];
		}

		return $pemulusan2;
	} 

	public function slope_at($arr_pemulusan1, $arr_pemulusan2)
	{
		//deklarasi tipe varabel
		$slopeAt = array();
		//hitung row array 
		$hitung = count($arr_pemulusan1);
		for ($i=0; $i < $hitung ; $i++) { 
			$slopeAt[] = 2 * $arr_pemulusan1[$i] - $arr_pemulusan2[$i];
		}

		return $slopeAt;
	} 


	public function slope_bt($arr_pemulusan1, $arr_pemulusan2, $alpha)
	{
		//deklarasi tipe varabel
		$slopeBt = array();
		//hitung row array
		$hitung = count($arr_pemulusan1);
		for ($i=0; $i < $hitung ; $i++) { 
			$slopeBt[] = $alpha / (1 - $alpha) * ($arr_pemulusan1[$i] - $arr_pemulusan2[$i]);
		}

		return $slopeBt;
	}

	public function forecast($arr_at, $arr_bt)
	{
		//deklarasi tipe varabel
		$ramal = array();
		//set array
		$ramal[0] = 0;
		//hitung row array
		$hitung = count($arr_at);
		for ($i=0; $i < $hitung ; $i++) { 
			$ramal[] = $arr_at[$i] + $arr_bt[$i];
		}

		return $ramal;
	} 

	public function absolute_error($arr_pakai, $arr_forecast)
	{
		//deklarasi tipe varabel
		$absErr = array();
		//set array
		$absErr[0] = 0;
		//hitung row array
		$hitung = count($arr_pakai);
		for ($i=1; $i < $hitung ; $i++) { 
			$absErr[] = abs($arr_pakai[$i] - $arr_forecast[$i]);
		}

		return $absErr;
	} 

	public function square_error($arr_absError)
	{
		//deklarasi tipe varabel
		$sqErr = array();
		//set array
		$sqErr[0] = 0;
		//hitung row array
		$hitung = count($arr_absError);
		for ($i=1; $i < $hitung ; $i++) { 
			$sqErr[] = pow($arr_absError[$i], 2);
		}

		return $sqErr;
	} 

	public function absolute_precentage_error($arr_pakai, $arr_forecast)
	{
		//deklarasi tipe varabel
		$absPtgErr = array();
		//set array
		$absPtgErr[0] = 0;
		//hitung row array
		$hitung = count($arr_pakai);
		for ($i=1; $i < $hitung ; $i++) { 
			$absPtgErr[] = round(abs(($arr_pakai[$i] - $arr_forecast[$i]) / $arr_pakai[$i]), 2) * 100;
		}

		return $absPtgErr;
	} 


	public function peramalan_des($keluar, $alpha)
	{
		//pemulusan pertama
		$s1t = $this->smooth1($keluar, $alpha);
		//pemulusan kedua
		$s2t = $this->smooth2($s1t, $alpha);
		//slope at
		$at = $this->slope_at($s1t, $s2t);
		//slope bt
		$bt = $this->slope_bt($s1t, $s2t, $alpha);
		//peramalan
		$ft = $this->forecast($at, $bt);
		//nilai peramalan untuk grafik
		$ft_grafik = $this->forecast($at, $bt);
		//absolute error
		$ae = $this->absolute_error($keluar, $ft);
		//mean absolute error
		$mad = round((array_sum($keluar) - array_sum($ae)) / (count($ae) - 1), 2);
		//square error
		$sqe = $this->square_error($ae);
		//mean square error
		//fungsi @ untk mengecek kesalahan aritmatik(ex: disini kesalahan apabila pembagian dengan nilai 0)
		//$tes = count($ae);
		$mse = @(round(array_sum($sqe) / (count($ae) - 1), 2));
		if(false === $mse) {
		  $mse = null;
		}
		//absolute precentage error
		$ape = @($this->absolute_precentage_error($keluar, $ft));
		if(false === $ape) {
		  $ape = null;
		}
		//mean absolute precentage error
		$mape = @(round(array_sum($ape) / (count($ae) - 1), 2));
		if(false === $mape) {
		  $mape = null;
		}
		//forecast ft+1
		$peramalan = round(end($ft) * 1);

		$hasil = array(
			's1t' => $s1t,
			's2t' => $s2t,
			'at' => $at,
			'bt' => $bt,
			'ft' => $ft,
			'ft_grafik' => $ft_grafik,
			'ae' => $ae,
			'mad' => $mad,
			'sqe' => $sqe,
			'mse' => $mse,
			'ape' => $ape,
			'mape' => $mape,
			'peramalan' => $peramalan
		);

		return $hasil;
	}

}









