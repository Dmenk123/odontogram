<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_pegawai extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('master_user/m_user');
		$this->load->model('m_pegawai');
		$this->load->model('m_global');
	}

	public function cok()
	{
		$this->excel->generate_excel();
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_jabatan = $this->m_global->multi_row('*', 'deleted_at is null', 'm_jabatan', null, 'nama');
				
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Data Pegawai',
			'data_user' => $data_user,
			'data_jabatan'	=> $data_jabatan
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'modal_master_pegawai',
			'js'	=> 'master_pegawai.js',
			'view'	=> 'view_master_pegawai'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_pegawai()
	{
		$list = $this->m_pegawai->get_datatable();
		
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $peg) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $peg->kode;
			$row[] = $peg->nama;
			$row[] = $peg->nama_jabatan;
			$row[] = $peg->telp_1;
			$row[] = $peg->telp_2;
			$aktif_txt = ($peg->is_aktif == 1) ? '<span style="color:blue;">Aktif</span>' : '<span style="color:red;">Non Aktif</span>';
			$row[] = $aktif_txt;			
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="edit_pegawai(\''.$peg->id.'\')">
							<i class="la la-pencil"></i> Edit Pegawai
						</button>
						<button class="dropdown-item" onclick="delete_pegawai(\''.$peg->id.'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';

			if ($peg->is_aktif == 1) {
				$str_aksi .=
				'<button class="dropdown-item btn_edit_status" title="aktif" id="'.$peg->id.'" value="aktif"><i class="la la-check">
				</i> Aktif</button>';
			}else{
				$str_aksi .=
				'<button class="dropdown-item btn_edit_status" title="nonaktif" id="'.$peg->id.'" value="nonaktif"><i class="la la-close">
				</i> Non Aktif</button>';
			}	

			$str_aksi .= '</div></div>';
		

			$row[] = $str_aksi;

			// if ($peg->is_aktif == 1) {
			// 	$row[] =
			// 	'<button class="btn btn-sm btn-warning" title="Edit" href="javascript:void(0)" onclick="edit_pegawai(\''.$peg->id.'\')">Edit</button>
			// 	 <button class="btn btn-sm btn-success btn_edit_status" href="javascript:void(0)" title="aktif" id="'.$peg->id.'" value="aktif">Aktif</i></button>';
			// }else{
			// 	$row[] =
			// 	'<button class="btn btn-sm btn-warning" title="Edit" href="javascript:void(0)" onclick="edit_pegawai(\''.$peg->id.'\')">Edit</button>
			// 	 <button class="btn btn-sm btn-danger btn_edit_status" href="javascript:void(0)" title="nonaktif" id="'.$peg->id.'" value="nonaktif">Non Aktif</button>';
			// }

			$data[] = $row;

		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_pegawai->count_all(),
			"recordsFiltered" => $this->m_pegawai->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function edit_pegawai()
	{
		$this->load->library('Enkripsi');
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);
	
		$id = $this->input->post('id');
		$oldData = $this->m_pegawai->get_by_id($id);
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}

		$data = array(
			'data_user' => $data_user,
			'old_data'	=> $oldData
		);
		
		echo json_encode($data);
	}

	public function add_data_pegawai()
	{
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$nama = trim($this->input->post('nama'));
		$alamat = trim($this->input->post('alamat'));
		$telp1 = trim($this->input->post('telp1'));
		$telp2 = trim($this->input->post('telp2'));
		$jabatan = $this->input->post('jabatan');

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}


		$this->db->trans_begin();
		
		$data = [
			'id' => $this->m_pegawai->get_max_id_pegawai(),
			'id_jabatan' => $jabatan,
			'kode' => $this->m_pegawai->get_kode_pegawai(),
			'nama' => $nama,
			'alamat' => $alamat,
			'telp_1' => $telp1,
			'telp_2' => $telp2,
			'is_aktif' => 1,
			'created_at' => $timestamp
		];
		
		$insert = $this->m_pegawai->save($data);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Pegawai';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Pegawai';
		}

		echo json_encode($retval);
	}

	public function update_data_pegawai()
	{
		$id_user = $this->session->userdata('id_user'); 
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi(true);

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$nama = trim($this->input->post('nama'));
		$alamat = trim($this->input->post('alamat'));
		$telp1 = trim($this->input->post('telp1'));
		$telp2 = trim($this->input->post('telp2'));
		$jabatan = $this->input->post('jabatan');

		$this->db->trans_begin();
		
		$data_user = [
			'nama' => $nama,
			'alamat' => $alamat,
			'telp_1' => $telp1,
			'telp_2' => $telp2,
			'id_jabatan'=> $jabatan
		];

		$where = ['id' => $this->input->post('id_pegawai')];
		$update = $this->m_pegawai->update($where, $data_user);
				
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master Pegawai';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master Pegawai';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_pegawai()
	{
		$id = $this->input->post('id');
		$del = $this->m_pegawai->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Pegawai Berhasil dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Pegawai Gagal dihapus';
		}

		echo json_encode($retval);
	}

	public function edit_status_pegawai()
	{
		$input_status = $this->input->post('status');
		// jika aktif maka di set ke nonaktif / "0"
		$status = ($input_status == "aktif") ? $status = 0 : $status = 1;
			
		$input = ['is_aktif' => $status];

		$where = ['id' => $this->input->post('id')];

		$this->m_pegawai->update($where, $input);

		if ($this->db->affected_rows() == '1') {
			$data = array(
				'status' => TRUE,
				'pesan' => "Status Pegawai berhasil di ubah.",
			);
		}else{
			$data = array(
				'status' => FALSE
			);
		}

		echo json_encode($data);
	}

	public function import_excel()
	{
		$select = "m_pegawai.*, m_jabatan.nama as nama_jabatan";
		$where = ['m_pegawai.deleted_at' => null];
		$table = 'm_pegawai';
		$join = [ 
			[
				'table' => 'm_jabatan',
				'on'	=> 'm_pegawai.id_jabatan = m_jabatan.id'
			]
		];

		$data = $this->m_global->multi_row($select, $where, $table, $join, 'm_pegawai.kode');
		
		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();
		
		$spreadsheet
			->getActiveSheet()
			->getStyle('E2:E1000')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_NUMBER);

		$spreadsheet
			->getActiveSheet()
			->getStyle('F2:F1000')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_NUMBER);	
		
		$sheet = $spreadsheet->getActiveSheet();

		$sheet
			->setCellValue('A1', 'Kode')
			->setCellValue('B1', 'Nama')
			->setCellValue('C1', 'Alamat')
			->setCellValue('D1', 'Jabatan')
			->setCellValue('E1', 'Telp. 1')
			->setCellValue('F1', 'Telp. 2')
			->setCellValue('G1', 'Status Aktif');
		
		$startRow = 2;
		$row = $startRow;
		if($data){
			foreach ($data as $key => $val) {
				$sts = ($val->is_aktif = '1') ? 'Aktif' : 'Non Aktif';
				
				$sheet
					->setCellValue("A{$row}", $val->kode)
					->setCellValue("B{$row}", $val->nama)
					->setCellValue("C{$row}", $val->alamat)
					->setCellValue("D{$row}", $val->nama_jabatan)
					->setCellValue("E{$row}", $val->telp_1)
					->setCellValue("F{$row}", $val->telp_2)
					->setCellValue("G{$row}", $sts);
				$row++;
			}
			$endRow = $row - 1;
		}
		
		
		$filename = 'master-pegawai-'.time();
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		
	}
	// ===============================================
	private function rule_validasi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Wajib mengisi Nama';
            $data['status'] = FALSE;
		}

		if ($this->input->post('alamat') == '') {
			$data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Wajib mengisi Alamat';
            $data['status'] = FALSE;
		}

		if ($this->input->post('telp1') == '') {
			$data['inputerror'][] = 'telp1';
            $data['error_string'][] = 'Wajib mengisi No Telp';
            $data['status'] = FALSE;
		}

		// if ($this->input->post('telp2') == '') {
		// 	$data['inputerror'][] = 'telp2';
        //     $data['error_string'][] = 'Wajib mengisi No Telp';
        //     $data['status'] = FALSE;
		// }

		if ($this->input->post('jabatan') == '') {
			$data['inputerror'][] = 'jabatan';
            $data['error_string'][] = 'Wajib Memilih Jabatan';
            $data['status'] = FALSE;
		}


        return $data;
	}
}
