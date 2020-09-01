<?php defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Excel
{
	public function spreadsheet_obj()
	{
		$spreadsheet = new Spreadsheet();
		return $spreadsheet;
	}

	public function xlsx_obj($obj)
	{
		if($obj) {
			$xlsx = new Xlsx($obj);
		}else{
			$xlsx = new Xlsx();
		}
		
		return $xlsx;
	}

	public function number_format_obj()
	{
		$format = new NumberFormat;
		return $format;
	}
}
