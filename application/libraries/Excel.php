<?php defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

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

	public function reader_obj()
	{
		$reader = new Reader();
		$reader->setReadDataOnly(true);
		return $reader;
	}

	public function csv_reader_obj()
	{
		$csv = new Csv();
		return $csv;
	}
}
