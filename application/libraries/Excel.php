<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . "/third_party/PHPExcel.php";

class Excel extends PHPExcel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function number_format()
	{
		$number_format = new PHPExcel_Style_NumberFormat();
		return $number_format;
	}
}
