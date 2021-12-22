<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Lap_penerimaan_klinik extends CI_Controller {
		
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_global');
		$this->load->model('set_role/m_set_role', 'm_role');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_role = $this->m_role->get_data_all(['aktif' => '1'], 'm_role');
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Laporan Penerimaan Klinik',
			'data_user' => $data_user,
			'data_role'	=> $data_role,
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => '',
			'js'	=> 'lap_penerimaan_klinik.js',
			'view'	=> 'view_laporan'
		];

		$this->template_view->load_view($content, $data);
	}

	public function tabel_laporan()
	{
		$model = $this->input->post('model');
		$tahun2 = $this->input->post('tahun2');
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$start = $this->input->post('start');
		$end = $this->input->post('end');

		if ($start) {
			$start = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d');
		}

		if ($end) {
			$end = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
		}

		if ($model == 2) {
			### pertahun
			$where = "DATE_FORMAT(mut.tanggal,'%Y') = '$tahun2'";
			$group = "mut.tanggal, kli.nama_klinik";
		}elseif ($model == 1) {
			### perbulan
			$where = "DATE_FORMAT(mut.tanggal,'%Y-%m') = '".$tahun.'-'.$bulan."' ";
			$group = "mut.tanggal, kli.nama_klinik";
		}elseif ($model == 3) {
			### perhari
			$where = "mut.tanggal between '$start' and '$end'";
			$group = "mut.tanggal, kli.nama_klinik";
		}

		$q = $this->db->query("
			SELECT 
				mut.tanggal,
				kli.nama_klinik,
				sum(mut.total_penerimaan_nett) as total_omset,
				sum(mut.total_pengeluaran) as total_bea_dokter
			FROM t_mutasi mut
			LEFT JOIN t_registrasi reg on mut.id_registrasi = reg.id
			LEFT JOIN m_klinik kli on reg.id_klinik = kli.id
			WHERE $where
			GROUP BY $group
			ORDER BY mut.tanggal, kli.nama_klinik
		")->result();
		
		$html = '';
		$flag_rowspan = null;
		$grandTotal = 0;
		$no = 1;
		if ($q) {
			foreach ($q as $k => $v) {
				$grandTotal += $v->total;
			
				if($flag_rowspan != $v->kode_dokter) {
					$html .= "
						<tr>
							<td rowspan ='$v->num_row'>" . $no . "</td>
							<td rowspan ='$v->num_row'>" . $v->nama_dokter . " [" . $v->kode_dokter . "]</td>
							<td>" . $v->nama_klinik . "</td>
							<td align='right'>" . number_format($v->total, 0, ',', '.') . "</td>
						</tr>
					";

					$no++;
					$flag_rowspan = $v->kode_dokter;
				}else{
					$html .= "
						<tr>
							<td>" . $v->nama_klinik . "</td>
							<td align='right'>" . number_format($v->total, 0, ',', '.') . "</td>
						</tr>
					";
				}
			}

			$html .= "
				<tr>
					<td colspan = '3' align='center'><b>Total Honor Dokter</b></td>
					<td align='right'>" . number_format($grandTotal, 0, ',', '.') . "</td>
				</tr>
			";
		}
        
        echo json_encode([
            'data' => $html
        ]);
	}

	public function datatable()
	{
		$model = $this->input->post('model');
		$tahun2 = $this->input->post('tahun2');

		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$start = $this->input->post('start');
		$end = $this->input->post('end');

		if ($start) {
			$start = date('Y-d-m', strtotime($start));
		}

		if ($end) {
			$exp_date = str_replace('/', '-', $end);
			$end = date('Y-m-d', strtotime($exp_date));
		}

		if ($model == 2) {
			$data_table = $this->m_laporan->get_laporan_penjualan($model, $tahun2);
		}elseif ($model == 1) {
			$data_table = $this->m_laporan->get_laporan_penjualan($model, null, $tahun, $bulan );
		}elseif ($model == 3) {
			$data_table = $this->m_laporan->get_laporan_penjualan($model, null, null, null, $start, $end );
		}

		// echo $this->db->last_query(); die();
		
		// var_dump($data_table); die();
		$data = [];
		if ($data_table) {
			foreach ($data_table as $key => $value) {
			
				$data[$key][] = $key+1;
				$data[$key][] = $value->nama_pelanggan;
				$data[$key][] = $value->nama_barang;
				$data[$key][] = $value->qty.' Pcs';
				$data[$key][] = 'Rp '.number_format($value->sub_total); 
				$data[$key][] = date('d-m-Y H:i:s', strtotime($value->tanggal_order));	
				
			}
		}
        
		
		// $this->output->enable_profiler(TRUE);

        echo json_encode([
            'data' => $data
        ]);
	}

	public function cetak_data()
	{
		$model = $this->input->get('model');
		$tahun2 = $this->input->get('tahun2');
		$tahun = $this->input->get('tahun');
		$bulan = $this->input->get('bulan');
		$start = $this->input->get('start');
		$end = $this->input->get('end');

		if ($start) {
			$start = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d');
		}

		if ($end) {
			$end = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
		}

		if ($model == 2) {
			### pertahun
			$txt_periode = $tahun;
			$where = "DATE_FORMAT(mut.tanggal,'%Y') = '$tahun'";
			$where2 = "DATE_FORMAT(x_mut.tanggal,'%Y') = '$tahun'";
			$group = "m_klinik.nama_klinik, reg.id_pegawai";
		} elseif ($model == 1) {
			### perbulan
			$txt_periode = $bulan.' '.$tahun;
			$where = "DATE_FORMAT(mut.tanggal,'%m') = '$bulan'";
			$where2 = "DATE_FORMAT(x_mut.tanggal,'%m') = '$bulan'";
			$group = "m_klinik.nama_klinik, reg.id_pegawai";
		} elseif ($model == 3) {
			### perhari
			$txt_periode = tanggal_indo($start).' s/d '. tanggal_indo($end);
			$where = "mut.tanggal between '$start' and '$end'";
			$where2 = "x_mut.tanggal between '$start' and '$end'";
			$group = "m_klinik.nama_klinik, reg.id_pegawai";
		}

		$q = $this->db->query("
			SELECT	
				sum(mut.total_pengeluaran) as total,
				mut.tanggal,
				m_klinik.nama_klinik,
				reg.id_klinik,
				m_pegawai.nama as nama_dokter,
				m_pegawai.kode as kode_dokter,
				(SELECT count(sub_tabel.id) 
					FROM (
						select x_mut.id, x_reg.id_pegawai
						from t_mutasi x_mut
						LEFT JOIN t_registrasi AS x_reg ON x_mut.id_registrasi = x_reg.id
						LEFT JOIN m_pegawai AS x_peg ON x_reg.id_pegawai = x_peg.id AND x_peg.deleted_at IS NULL 
						where id_jenis_trans = 6 
						and x_mut.deleted_at is null
						and $where2
						AND x_peg.id_jabatan = 1 
						GROUP BY x_mut.tanggal, x_reg.id_pegawai
					) as sub_tabel where sub_tabel.id_pegawai = reg.id_pegawai
				) as num_row
			FROM
				t_mutasi AS mut
				LEFT JOIN t_registrasi AS reg ON mut.id_registrasi = reg.id
				LEFT JOIN m_klinik ON reg.id_klinik = m_klinik.id AND m_klinik.deleted_at IS NULL 
				LEFT JOIN m_pegawai ON reg.id_pegawai = m_pegawai.id AND m_pegawai.deleted_at IS NULL 
			WHERE
				mut.id_jenis_trans = 6 
				AND mut.deleted_at IS NULL 
				AND m_pegawai.id_jabatan = 1
				AND $where
			GROUP BY $group
			ORDER BY m_pegawai.nama, m_klinik.nama_klinik
		")->result();

		$data_klinik = $this->m_global->single_row('*',['deleted_at' => null, 'id' => 3], 'm_klinik');
		$konten_html = $this->load->view('pdf', ['datanya' => $q], true);

		$retval = [
			'data' => $q,
			'title' => 'Laporan Honor Dokter',
			'periode' => 'Periode ' . $txt_periode,
			'data_klinik' => $data_klinik,
			'content' => $konten_html,
		];

		// $this->load->view('pdf', $retval);
		$html = $this->load->view('pdf', $retval, true);
		$filename = 'laporan_honor_dokter_'.time();
		$this->lib_dompdf->generate($html, $filename, true, 'legal', 'potrait');
	}

	
}
