<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_gaji extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('verifikasi_out/mod_verifikasi_out','m_vout');
		$this->load->model('mod_proses_gaji','m_pro');
	}

	public function index()
	{	
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user
		);

		$content = [
			'css' 	=> 'cssProsesGaji',
			'modal' => 'modalProsesGaji',
			'js'	=> 'jsProsesGaji',
			'view'	=> 'view_list_proses_gaji'
		];

		$this->template_view->load_view($content, $data);
	}

	public function suggest_guru()
	{
		if (isset($_GET['term'])) {
			$q = strtolower($_GET['term']);
		}else{
			$q = '';
		}
		
		$query = $this->m_pro->lookup_kode_guru($q);
		
		foreach ($query as $row) {
			$akun[] = array(
				'id' => $row->id,
				'text' => $row->nip.' - '.$row->nama
			);
		}
		echo json_encode($akun);
	}

	public function get_data_guru($id)
	{
		$q = $this->db->query("
			SELECT tg.*, tj.nama as nama_jabatan, tsg.gaji_pokok, tsg.gaji_perjam, tsg.gaji_tunjangan_jabatan 
			FROM tbl_guru as tg
			LEFT JOIN tbl_jabatan tj on tg.kode_jabatan = tj.id and tj.is_aktif = 1
			LEFT JOIN tbl_set_gaji tsg on tg.kode_jabatan = tsg.id_jabatan and tsg.is_aktif = 1
			WHERE tg.id = '".$id."' and tg.is_aktif = 1
		 ")->row();

		// echo $this->db->last_query();

		if ($q->is_guru == 1) {
			$q->statuspeg = 'Guru';
		}else{
			$q->statuspeg = 'Staff/Karyawan';
		}
		
		echo json_encode($q);
	}

	public function list_data()
	{
		$list = $this->m_pro->get_datatables();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row = array();
			//loop value tabel db
			// $row[] = $no;
			$row[] = $val->nama_guru;
			$row[] = $val->nama_jabatan;
			$row[] = $this->bulanIndo($val->bulan);
			$row[] = $val->tahun;
			$row[] = '
				<div>
	                <span class="pull-left">Rp. </span>
	                  <span class="pull-right">'.number_format($val->total_take_home_pay,2,",",".").'</span>
	             </div>
			';

			//add html for action
			$row[] = '
					<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Detail" onclick="detail_data('."'".$val->id."'".')"><i class="glyphicon glyphicon-info-sign"></i> Detail</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$val->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
			';

			$data[] = $row;
		}//end loop

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_pro->count_all(),
			"recordsFiltered" => $this->m_pro->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function add_data()
	{
		//validasi
		$arr_valid = $this->_validate();
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}  

		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$namapeg = $this->input->post('namapeg');
		$statuspeg = $this->input->post('statuspeg_raw');
		$jabatanpeg = $this->input->post('jabatanpeg_raw');
		$gapok = $this->input->post('gapok_raw');
		$gaperjam = $this->input->post('gaperjam_raw');
		$tunjangan = $this->input->post('tunjangan_raw');
		$tunjangan_lain = $this->input->post('tunjanganlain_raw');
		$potongan = $this->input->post('potongan_raw');
		$jumlahjam = $this->input->post('jumlahjam');
		$totalgaji = $this->input->post('totalgaji_raw');	
		
		$this->db->trans_begin();

		//cek sudah ada gaji/belum
		$cek_ada = $this->m_pro->cek_exist_gaji([
			'id_guru' => $namapeg, 
			'bulan' => (int)$bulan, 
			'tahun' => $tahun, 
			'is_aktif' => '1'
		]);

		if ($cek_ada) {
			echo json_encode(array(
				"status" => FALSE,
				"pesan" => "Maaf Gaji Guru/Staff pada bulan ".$bulan." dan ".$tahun." Sudah ada"
			));
			return;
		}

		$arr_ins_gaji = [
			'id_guru' => $namapeg,
			'id_jabatan' => $jabatanpeg,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'is_guru' => $statuspeg,
			'gaji_pokok' => $gapok,
			'gaji_perjam' => $gaperjam,
			'gaji_tunjangan_jabatan' => $tunjangan,
			'gaji_tunjangan_lain' => $tunjangan_lain,
			'potongan_lain' => $potongan,
			'jumlah_jam_kerja' => $jumlahjam,
			'total_take_home_pay' => $totalgaji,
			'created_at' => date('Y-m-d H:i:s')
		];
		
		$insert = $this->m_pro->save('tbl_penggajian', $arr_ins_gaji);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status = FALSE;
			$pesan = 'Gagal Proses Gaji';
		}
		else {
			$this->db->trans_commit();
			$status = TRUE;
			$pesan = 'Berhsil Proses Gaji';
		}
				
		echo json_encode(array(
			"status" => $status,
			"pesan" => $pesan,
		));
	}

	public function edit($id)
	{
		$data = $this->m_pro->get_by_id($id);
		echo json_encode($data);
	}

	public function update_data()
	{
		$arr_valid = $this->_validate();
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		} 

		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$namapeg = $this->input->post('namapeg');
		$statuspeg = $this->input->post('statuspeg_raw');
		$jabatanpeg = $this->input->post('jabatanpeg_raw');
		$gapok = $this->input->post('gapok_raw');
		$gaperjam = $this->input->post('gaperjam_raw');
		$tunjangan = $this->input->post('tunjangan_raw');
		$tunjangan_lain = $this->input->post('tunjanganlain_raw');
		$potongan = $this->input->post('potongan_raw');
		$jumlahjam = $this->input->post('jumlahjam');
		$totalgaji = $this->input->post('totalgaji_raw');

		$this->db->trans_begin();

		$cek_ada = $this->m_pro->cek_exist_gaji(['id_guru' => $namapeg, 'bulan' => (int)$bulan, 'tahun' => $tahun]);

		if ($cek_ada) {
			echo json_encode(array(
				"status" => FALSE,
				"pesan" => "Maaf Gaji Guru/Staff pada bulan ".$bulan." dan ".$tahun." Sudah ada"
			));
			return;
		}

		$data = [
			'id_guru' => $namapeg,
			'id_jabatan' => $jabatanpeg,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'is_guru' => $statuspeg,
			'gaji_pokok' => $gapok,
			'gaji_perjam' => $gaperjam,
			'gaji_tunjangan_jabatan' => $tunjangan,
			'gaji_tunjangan_lain' => $tunjangan_lain,
			'potongan_lain' => $potongan,
			'jumlah_jam_kerja' => $jumlahjam,
			'total_take_home_pay' => $totalgaji
		];

		$this->m_pro->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Setting Gaji Berhasil diupdate',
		));
	}

	public function delete_data($id)
	{
		//$this->m_pro->delete_by_id($id);
		$this->m_pro->update(['id' => $id], ['is_aktif '=> 0]);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Setting Gaji Berhasil dihapus',
		));
	}

	public function bulanIndo($key)
	{
		$arr_bulan = [ 
		    '1' => 'Januari',
		    '2' => 'Februari',
		    '3' => 'Maret',
		    '4' => 'April',
		    '5' => 'Mei',
		    '6' => 'Juni',
		    '7' => 'Juli',
		    '8' => 'Agustus',
		    '9' => 'September',
		    '10' => 'Oktober',
		    '11' => 'November',
		    '12' => 'Desember'
		];

		return $arr_bulan[$key];
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('tahun') == '') {
			$data['inputerror'][] = 'tahun';
            $data['error_string'][] = 'Wajib mengisi tahun';
            $data['status'] = FALSE;
		}

		if ($this->input->post('bulan') == '') {
			$data['inputerror'][] = 'bulan';
            $data['error_string'][] = 'Wajib mengisi Bulan';
            $data['status'] = FALSE;
		}

		/*if ($this->input->post('gaperjam') == '') {
			$data['inputerror'][] = 'gaperjam';
            $data['error_string'][] = 'Wajib mengisi Gaji per jam';
            $data['status'] = FALSE;
		}*/

		/*if ($this->input->post('tunjangan') == '') {
			$data['inputerror'][] = 'tunjangan';
            $data['error_string'][] = 'Wajib mengisi Gaji Tunjangan';
            $data['status'] = FALSE;
		}*/

		/*if ($this->input->post('tipepeg') == '') {
			$data['inputerror'][] = 'tipepeg';
            $data['error_string'][] = 'Wajib mengisi Tipe Pegawai';
            $data['status'] = FALSE;
		}*/
			
        return $data;
	}
}
