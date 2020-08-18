<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_rapbs extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_trans_rapbs','m_rapbs');
		$this->load->model('verifikasi_out/mod_verifikasi_out','m_vout');
		$this->load->library('excel');
	}


	public function jaran()
	{
		$a =  $this->excel->number_format();
		// NumberFormat::FORMAT_CURRENCY_USD_SIMPLE
		var_dump($a::FORMAT_CURRENCY_USD_SIMPLE);
	}

	public function index()
	{	
		$arr_bulan = [
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maret',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember'
		];

		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user,
			'arr_bulan' => $arr_bulan
		);

		$content = [
			'css' 	=> 'cssTransRapbs',
			'modal' => null,
			'js'	=> 'jsTransRapbs',
			'view'	=> 'view_list_trans_rapbs'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_rapbs($tahun)
	{
		$list = $this->m_rapbs->get_datatables($tahun);
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $datalist) {
			$no++;
			$row = array();
			$row[] = $datalist->id;
			$row[] = $datalist->tahun;
			$row[] = date('d-m-Y', strtotime($datalist->created_at));
			$row[] = $datalist->nama_lengkap_user;
			
			//cek kuncian
			// $cek_kunci = $this->cek_status_kuncian(date('m', strtotime($datalist->tanggal)), date('Y', strtotime($datalist->tanggal)));
			$link_detail = site_url('trans_rapbs/rapbs_detail/') . $datalist->id;
			//belum di verifikasi
			$row[] = '
				<a class="btn btn-sm btn-success" href="'.$link_detail.'" title="Detail" id="btn_detail">
					<i class="glyphicon glyphicon-info-sign"></i></a>
			';
			
			$data[] = $row;
		}//end loop

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_rapbs->count_all($tahun),
						"recordsFiltered" => $this->m_rapbs->count_filtered($tahun),
						"data" => $data,
					);
		//output to json format
		echo json_encode($output);
	}

	public function rapbs_detail()
	{
		$id_user = $this->session->userdata('id_user'); 
		$query_user = $this->prof->get_detail_pengguna($id_user);
		
		$id = $this->uri->segment(3); 
		$query_header = $this->m_rapbs->get_detail_header($id);
		$query = $this->m_rapbs->get_detail($id);
		
		$data = array(
			'data_user' => $query_user,
			'hasil_header' => $query_header,
			'hasil_data' => $query
		);

		// echo $this->db->last_query();
		
		$content = [
			'css' 	=> 'cssTransRapbs',
			'modal' => null,
			'js'	=> 'jsTransRapbs',
			'view'	=> 'view_detail_trans_rapbs'
		];

		$this->template_view->load_view($content, $data);
	}

	public function add()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);
		$get_field = $this->m_rapbs->get_data_field();

		$data = array(
			'data_user' => $data_user,
			'data_field' => $get_field
		);

		$content = [
			'css' 	=> 'cssTransRapbs',
			'modal' =>  null,
			'js'	=> 'jsTransRapbs',
			'view'	=> 'view_add_trans_rapbs'
		];

		$this->template_view->load_view($content, $data);
	}

	public function saveimport()
	{
		$tahun = date('Y');
		$now = date('Y-m-d H:i:s');

		if (isset($_FILES["file"]["name"])) {
			$arr_data = [];
			$path = $_FILES["file"]["tmp_name"];
			$objPHPExcel = PHPExcel_IOFactory::load($path);

			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			
			//extract to a PHP readable array format
			foreach ($cell_collection as $cell) {
				$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getFormattedValue();

				//The header will/should be in row 1 only. of course, this can be modified to suit your need.
				if ($row == 1) {
					$header[$row][$column] = $data_value;
				}else{
					$arr_data[$row][$column] = $data_value;
				}
			}

			$this->db->trans_begin();
			//cek ada tidaknya laporan
			$cek_exist = $this->m_rapbs->get_data_row('tbl_rapbs', [
				'tahun' => $tahun,
				'deleted_at' => null
			]);

			if ($cek_exist) {
				//update header
				$this->m_rapbs->update_data(['tahun' => $tahun], ['deleted_at' => $now], 'tbl_rapbs');	
				//update detail
				$this->m_rapbs->update_data(['id_header' => $cek_exist->id], ['deleted_at' => $now], 'tbl_rapbs_detail');
			}

			//insert tbl header
			$header_data = [
				'tahun' => $tahun,
				'user_id' => $this->session->userdata('id_user'),
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->db->insert('tbl_rapbs', $header_data);

			$last_insert = $this->m_rapbs->get_data_row('tbl_rapbs', [
				'tahun' => $tahun,
				'deleted_at' => null
			]);

				
			foreach ($arr_data as $key => $kolom) {
				$detil['id_header'] = $last_insert->id;
				$detil['uraian'] = trim($kolom['C']);
				$detil['qty'] = ($kolom['D'] == '' || $kolom['D'] == null) ? null : trim($kolom['D']);
				$detil['nama_satuan'] = ($kolom['E'] == '' || $kolom['E'] == null) ? null : trim(strtoupper($kolom['E']));
				
				if ($kolom['F'] == '' || $kolom['F'] == null) {
					$detil['harga_satuan'] = null;
				}else{
					$pecah_harga_sat = explode('Rp', $kolom['F']);
					$harga_sat_step1 = (count($pecah_harga_sat) > 1) ? trim($pecah_harga_sat[1]) : trim($pecah_harga_sat[0]);

					$pecah_harga_sat_step1 = explode('.', $harga_sat_step1);
					$harga_sat_fix = str_replace(",", "", $pecah_harga_sat_step1[0]);

					$detil['harga_satuan'] = $harga_sat_fix;
				}

				if ($kolom['G'] == '' || $kolom['G'] == null) {
					$detil['harga_total'] = null;
				}else{
					$pecah_harga_tot = explode('Rp', $kolom['G']);
					$harga_tot_step1 = (count($pecah_harga_tot) > 1) ? trim($pecah_harga_tot[1]) : trim($pecah_harga_tot[0]);

					$pecah_harga_tot_step1 = explode('.', $harga_tot_step1);
					$harga_tot_fix = str_replace(",", "", $pecah_harga_tot_step1[0]);

					$detil['harga_total'] = $harga_tot_fix;
				}

				if ($kolom['H'] == '' || $kolom['H'] == null) {
					$detil['gaji_swasta'] = null;
				}else{
					$pecah_gaji_swasta = explode('Rp', $kolom['H']);
					$gaji_swasta_step1 = (count($pecah_gaji_swasta) > 1) ? trim($pecah_gaji_swasta[1]) : trim($pecah_gaji_swasta[0]);

					$pecah_gaji_swasta_step1 = explode('.', $gaji_swasta_step1);
					$gaji_swasta_fix = str_replace(",", "", $pecah_gaji_swasta_step1[0]);

					$detil['gaji_swasta'] = $gaji_swasta_fix;
				}

				if ($kolom['I'] == '' || $kolom['I'] == null) {
					$detil['bosnas'] = null;
				}else{
					$pecah_bosnas = explode('Rp', $kolom['I']);
					$bosnas_step1 = (count($pecah_bosnas) > 1) ? trim($pecah_bosnas[1]) : trim($pecah_bosnas[0]);

					$pecah_bosnas_step1 = explode('.', $bosnas_step1);
					$bosnas_fix = str_replace(",", "", $pecah_bosnas_step1[0]);

					$detil['bosnas'] = $bosnas_fix;
				}

				if ($kolom['L'] == '' || $kolom['L'] == null) {
					$detil['hibah_bopda'] = null;
				}else{
					$pecah_hibah_bopda = explode('Rp', $kolom['L']);
					$hibah_bopda_step1 = (count($pecah_hibah_bopda) > 1) ? trim($pecah_hibah_bopda[1]) : trim($pecah_hibah_bopda[0]);

					$pecah_hibah_bopda_step1 = explode('.', $hibah_bopda_step1);
					$hibah_bopda_fix = str_replace(",", "", $pecah_hibah_bopda_step1[0]);

					$detil['hibah_bopda'] = $hibah_bopda_fix;
				}

				if ($kolom['N'] == '' || $kolom['N'] == null) {
					$detil['jumlah_total'] = null;
				}else{
					$pecah_jumlah_total = explode('Rp', $kolom['N']);
					$jumlah_total_step1 = (count($pecah_jumlah_total) > 1) ? trim($pecah_jumlah_total[1]) : trim($pecah_jumlah_total[0]);

					$pecah_jumlah_total_step1 = explode('.', $jumlah_total_step1);
					$jumlah_total_fix = str_replace(",", "", $pecah_jumlah_total_step1[0]);

					$detil['jumlah_total'] = $jumlah_total_fix;
				}

				$detil['keterangan_belanja'] = trim(strtoupper($kolom['O']));

				$arr_kol_b = explode(',', $kolom['B']);
				$detil['is_sub'] = (count($arr_kol_b) > 1) ? 0 : 1;
				$detil['urut'] = $kolom['A'];
				$detil['kode'] = trim(str_replace(",", ".", $kolom['B']));
				$detil['created_at'] = $now;

				$this->db->insert('tbl_rapbs_detail', $detil);
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('feedback_failed', 'Terjadi Kesalahan');
			redirect(base_url(). 'trans_rapbs/index?tahun=2019');
		} else {
			$this->db->trans_commit();
			$this->session->set_flashdata('feedback_success', 'Suskses Import data Excel');
			redirect(base_url(). 'trans_rapbs/index?tahun=2019');
		}
	}

	public function get_template()
	{
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
			->setLastModifiedBy('My Notes Code')
			->setTitle("template-excel")
			->setSubject("template")
			->setDescription("Template Excel untuk Import Data")
			->setKeywords("template excel");
		
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => TRUE), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO");
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "KODE");
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "URAIAN");
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "VOL");
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "SATUAN");
		$excel->setActiveSheetIndex(0)->setCellValue('F1', "HARGA SATUAN");
		$excel->setActiveSheetIndex(0)->setCellValue('G1', "JUMLAH UANG");
		$excel->setActiveSheetIndex(0)->setCellValue('H1', "GAJI SWASTA");
		$excel->setActiveSheetIndex(0)->setCellValue('I1', "BOSNAS");
		$excel->setActiveSheetIndex(0)->setCellValue('J1', "SSN");
		$excel->setActiveSheetIndex(0)->setCellValue('K1', "BLOK GRAND");
		$excel->setActiveSheetIndex(0)->setCellValue('L1', "HIBAH BOPDA");
		$excel->setActiveSheetIndex(0)->setCellValue('M1', "LAIN-LAIN");
		$excel->setActiveSheetIndex(0)->setCellValue('N1', "JUMLAH TOTAL");
		$excel->setActiveSheetIndex(0)->setCellValue('O1', "KETERANGAN BELANJA");
			
		foreach(range('A','O') as $columnID) {
			// Set width kolom
		    $excel->getActiveSheet()->getColumnDimension($columnID)
		        ->setAutoSize(true);

		    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
			$excel->getActiveSheet()->getStyle($columnID.'1')->applyFromArray($style_col);
		}

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$data_akun = $this->m_rapbs->get_data_field();

		$numberFormat =  $this->excel->number_format();
		$arr_kolom = ['E', 'F', 'G', 'H', 'I', 'L', 'N'];
		$jumlah_baris = count($data_akun);
		foreach($arr_kolom as $kolomFormat) {
			//apply currency format
			$excel->getActiveSheet()
	            ->getStyle($kolomFormat.'2'.':'.$kolomFormat.($jumlah_baris + 1))
	            ->getNumberFormat()
	            ->setFormatCode($numberFormat::FORMAT_CURRENCY_USD_SIMPLE);
		}

		//set cell format di kolom kode menjadi text
		$excel->getActiveSheet()
	            ->getStyle('B2:B'.($jumlah_baris + 1))
	            ->getNumberFormat()
				->setFormatCode($numberFormat::FORMAT_TEXT);

		/* //image processing
		$gdImage = imagecreatefromjpeg(base_url('assets/img/foto_guru/sugiono-1572969124.jpg'));
		// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		$objDrawing->setName('Sample image');
		$objDrawing->setDescription('Sample image');
		$objDrawing->setImageResource($gdImage);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setHeight(150);
		$objDrawing->setWorksheet($excel->getActiveSheet());
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
		//end image processing
		$objDrawing->setCoordinates('P3'); */

		$no = 1; 
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 2
		foreach ($data_akun as $data) { // Lakukan looping pada variabel siswa
			$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, str_replace(".", ",", $data->kode_in_text));
			$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nama);
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
			$no++;
			$numrow++;
		}

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("template-excel");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="template-excel.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function cetak_lap_rapbs()
	{
		$arr_bulan = [
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maret',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember'
		];

		$this->load->library('Pdf_gen');

		$id = $this->uri->segment(3);
		$id_user = $this->session->userdata('id_user');
		$query_user = $this->prof->get_detail_pengguna($id_user);

		$id = $this->uri->segment(3);
		$query_header = $this->m_rapbs->get_detail_header($id);
		$query = $this->m_rapbs->get_detail($id);

		// $data = array(
		// 	'data_user' => $query_user,
		// 	'hasil_header' => $query_header,
		// 	'hasil_data' => $query,
		// 	'arr_bulan' => $arr_bulan,
		// 	'tahun' => $query_header->tahun
		// );

		// // echo $this->db->last_query();

		// $content = [
		// 	'css' 	=> 'cssTransRapbs',
		// 	'modal' => null,
		// 	'js'	=> 'jsTransRapbs',
		// 	'view'	=> 'view_trans_rapbs_cetak'
		// ];

		// $this->template_view->load_view($content, $data);

		
		$data = array(
			'title' => 'Report RAPBS',
			'hasil_header' => $query_header,
			'hasil_data' => $query,
			'arr_bulan' => $arr_bulan,
			'tahun' => $query_header->tahun
		);

		$html = $this->load->view('view_trans_rapbs_cetak', $data, true);

		$filename = 'laporan_RAPBS_' . $id . '_' . time();
		$this->pdf_gen->generate($html, $filename, true, 'A4', 'landscape');
	}

	//------------------------------------------------------------------------
	
	public function cek_status_kuncian($bulan, $tahun)
	{
		$q = $this->db->query("SELECT * FROM tbl_log_kunci WHERE bulan = '" . $bulan . "' and tahun ='" . $tahun . "'");
		if ($q->num_rows() > 0) {
			$query = $q->row();
			if ($query->is_kunci == '1') {
				return TRUE;
			} else {
				return FALSE;
			}
		}else{
			return FALSE;
		}	
	}

	// =====================================================================================================================

}