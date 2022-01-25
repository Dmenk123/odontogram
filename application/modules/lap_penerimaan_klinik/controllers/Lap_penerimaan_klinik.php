<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Lap_penerimaan_klinik extends CI_Controller {
	protected $prop_data_user = null;

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_global');
		$this->load->model('set_role/m_set_role', 'm_role');

		$this->prop_data_user = $this->m_user->get_detail_user($this->session->userdata('id_user'));
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_role = $this->m_role->get_data_all(['aktif' => '1'], 'm_role');
		$data_klinik = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_klinik', null, 'nama_klinik');
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Laporan Penerimaan Klinik',
			'data_user' => $data_user,
			'data_role'	=> $data_role,
			'data_klinik' => $data_klinik
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
		$klinik = $this->input->post('klinik');
		$model = $this->input->post('model');
		$tahun2 = $this->input->post('tahun2');
		$tahun = $this->input->post('tahun');
		$bulan = sprintf("%02d", $this->input->post('bulan'));
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
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		}elseif ($model == 1) {
			### perbulan
			$where = "DATE_FORMAT(mut.tanggal,'%Y-%m') = '".$tahun.'-'.$bulan."' ";
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		}elseif ($model == 3) {
			### perhari
			$where = "mut.tanggal between '$start' and '$end'";
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		}

		$q = $this->db->query("
			SELECT
				reg.tanggal_reg,
				CONCAT(pas.no_rm, ' - ', pas.nama) as nama_lengkap,
				lay.nama_layanan,
				peg.nama as nama_dokter,
				kli.nama_klinik,
				reg.id_klinik,
				sum( mut.total_penerimaan_nett ) AS total_omset,
				sum( mut.total_pengeluaran ) AS total_bea_dokter
			FROM
				t_mutasi mut
				LEFT JOIN t_registrasi reg ON mut.id_registrasi = reg.id and reg.deleted_at is null
				LEFT JOIN m_klinik kli ON reg.id_klinik = kli.id 
				LEFT JOIN m_layanan lay ON reg.id_layanan = lay.id_layanan 
				LEFT JOIN m_pasien pas ON reg.id_pasien = pas.id
				LEFT JOIN m_pegawai peg ON reg.id_pegawai = peg.id
			WHERE
				$where and reg.id_klinik = '$klinik' and reg.is_pulang is not null
			GROUP BY
				$group
			ORDER BY
				reg.tanggal_reg, lay.nama_layanan
		")->result();

		// echo $this->db->last_query();exit;
		
		$html = '';
		$grandTotalOmset = 0;
		$grandTotalHonor = 0;
		$no = 1;
		if ($q) {
			foreach ($q as $k => $v) {
				$grandTotalOmset += $v->total_omset;
				$grandTotalHonor += $v->total_bea_dokter;

				$html .= "
					<tr>
						<td>" . $no . "</td>
						<td>".tanggal_indo($v->tanggal_reg)."</td>
						<td>" . $v->nama_lengkap . "</td>
						<td>" . $v->nama_layanan . "</td>
						<td>" . $v->nama_dokter . "</td>
						<td align='right'>" . number_format($v->total_omset, 0, ',', '.') . "</td>
						<td align='right'>" . number_format($v->total_bea_dokter, 0, ',', '.') . "</td>
						<td align='right'>" . number_format($v->total_omset - $v->total_bea_dokter, 0, ',', '.') . "</td>
					</tr>
				";

				$no++;				
			}

			$html .= "
				<tr>
					<td colspan = '7' align='center'><b>Grand Total Omset</b></td>
					<td align='right'>" . number_format($grandTotalOmset, 0, ',', '.') . "</td>
				</tr>
				<tr>
					<td colspan = '7' align='center'><b>Grand Total Honor</b></td>
					<td align='right'>" . number_format($grandTotalHonor, 0, ',', '.') . "</td>
				</tr>
				<tr>
					<td colspan = '7' align='center'><b>Penerimaan Klink (Nett)</b></td>
					<td align='right'>" . number_format($grandTotalOmset - $grandTotalHonor, 0, ',', '.') . "</td>
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
		$klinik = $this->input->get('klinik');
		$model = $this->input->get('model');
		$tahun2 = $this->input->get('tahun2');
		$tahun = $this->input->get('tahun');
		$bulan = sprintf("%02d", $this->input->get('bulan'));
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
			$txt_periode = $tahun2;
			$where = "DATE_FORMAT(mut.tanggal,'%Y') = '$tahun2'";
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		} elseif ($model == 1) {
			### perbulan
			$txt_periode = bulan_indo((int)$bulan).' '.$tahun;
			$where = "DATE_FORMAT(mut.tanggal,'%Y-%m') = '" . $tahun . '-' . $bulan . "' ";
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		} elseif ($model == 3) {
			### perhari
			$txt_periode = tanggal_indo($start) . ' s/d ' . tanggal_indo($end);
			$where = "mut.tanggal between '$start' and '$end'";
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		}

		$q = $this->db->query("
			SELECT
				reg.tanggal_reg,
				CONCAT(pas.no_rm, ' - ', pas.nama) as nama_lengkap,
				lay.nama_layanan,
				peg.nama as nama_dokter,
				kli.nama_klinik,
				reg.id_klinik,
				sum( mut.total_penerimaan_nett ) AS total_omset,
				sum( mut.total_pengeluaran ) AS total_bea_dokter
			FROM
				t_mutasi mut
				LEFT JOIN t_registrasi reg ON mut.id_registrasi = reg.id and reg.deleted_at is null
				LEFT JOIN m_klinik kli ON reg.id_klinik = kli.id 
				LEFT JOIN m_layanan lay ON reg.id_layanan = lay.id_layanan 
				LEFT JOIN m_pasien pas ON reg.id_pasien = pas.id
				LEFT JOIN m_pegawai peg ON reg.id_pegawai = peg.id
			WHERE
				$where and reg.id_klinik = '$klinik' and reg.is_pulang is not null
			GROUP BY
				$group
			ORDER BY
				reg.tanggal_reg, lay.nama_layanan
		")->result();

		// echo $this->db->last_query();exit;
		

		$data_klinik = $this->m_global->single_row('*',['deleted_at' => null, 'id' => 3], 'm_klinik');
		$konten_html = $this->load->view('pdf', ['datanya' => $q,'title' => 'Laporan Penerimaan Klinik', 'data_klinik' => $data_klinik, 'data_user' => $this->prop_data_user[0], 'periode' => 'Periode ' . $txt_periode], true);

		$retval = [
			'data' => $q,
			'data_klinik' => $data_klinik,
			'content' => $konten_html,
			'footer' => '', // set '' agar tidak ikut default, footer ikut konten
		];


		// $this->load->view('pdf', $retval);
		$html = $this->load->view('template/pdf', $retval, true);
		// echo $html;exit;
		$filename = 'laporan_penerimaan_klinik_'.time();
		$this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
	}

	
}
