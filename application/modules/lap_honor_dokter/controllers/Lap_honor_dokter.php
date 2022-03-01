<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Lap_honor_dokter extends CI_Controller {
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
		$data_dokter = $this->m_global->multi_row('*', [
			'id_jabatan' => 1,
			'deleted_at' => null,
			'is_aktif' => 1,
			'is_owner' => null
		], 'm_pegawai', NULL, 'nama');
		$data_klinik = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_klinik', null, 'nama_klinik');
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Laporan Honor Dokter',
			'data_user' => $data_user,
			'data_role'	=> $data_role,
			'data_dokter' => $data_dokter,
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
			'js'	=> 'lap_honor_dokter.js',
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
		$dokter = $this->input->post('dokter');

		if ($start) {
			$start = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d');
		}

		if ($end) {
			$end = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
		}

		if ($model == 2) {
			### pertahun
			$where = "DATE_FORMAT(reg.tanggal_reg,'%Y') = '$tahun2'";
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		}elseif ($model == 1) {
			### perbulan
			$where = "DATE_FORMAT(reg.tanggal_reg,'%Y-%m') = '".$tahun.'-'.$bulan."' ";
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		}elseif ($model == 3) {
			### perhari
			$where = "reg.tanggal_reg between '$start' and '$end'";
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		}

		$q = $this->db->query("
			SELECT
				reg.id as id_reg,
				reg.no_reg,
				reg.tanggal_reg,
				CONCAT(pas.no_rm, ' - ', pas.nama) as nama_lengkap,
				lay.nama_layanan,
				peg.nama as nama_dokter,
				kli.nama_klinik,
				reg.id_klinik,
				sum( mut.total_penerimaan_nett ) AS total_omset,
				sum( mut.total_pengeluaran ) AS total_honor_dokter
			FROM
				t_mutasi mut
				LEFT JOIN t_registrasi reg ON mut.id_registrasi = reg.id and reg.deleted_at is null
				LEFT JOIN m_klinik kli ON reg.id_klinik = kli.id 
				LEFT JOIN m_layanan lay ON reg.id_layanan = lay.id_layanan 
				LEFT JOIN m_pasien pas ON reg.id_pasien = pas.id
				LEFT JOIN m_pegawai peg ON reg.id_pegawai = peg.id
				JOIN t_pembayaran byr ON reg.id = byr.id_reg
			WHERE
				$where and reg.id_klinik = '$klinik' and reg.is_pulang is not null and reg.id_pegawai = '$dokter'
			GROUP BY
				$group
			ORDER BY
			reg.tanggal_reg, lay.nama_layanan
		")->result();
		
		// echo $this->db->last_query();exit;
					
		// echo "<pre>";
		// print_r ($q);
		// echo "</pre>";
		// exit;

		$html = '';
		$grandTotalHonor = 0;
		$grandTotalOmset = 0;
		$no = 1;
		if ($q) {
			foreach ($q as $k => $v) {
				$q_gathel = $this->db->query("
					SELECT
						a.id as id_mutasi,
						d.harga_bruto,
						e.nama_tindakan
					FROM
						t_mutasi a
						join t_mutasi_det b on a.id = b.id_mutasi and b.deleted_at is null
						join t_tindakan c on a.id_trans_flag = c.id
						join t_tindakan_det d on c.id = d.id_t_tindakan and d.deleted_at is null
						join m_tindakan e on d.id_tindakan = e.id_tindakan and e.deleted_at is null
					WHERE
						a.id_registrasi = '$v->id_reg' 
						AND a.id_jenis_trans IN ( 2 ) 
						AND (a.total_penerimaan_nett > 0 AND a.total_penerimaan_gross > 0)
						GROUP BY d.id
				")->result();

				// var_dump($q_gathel);exit;

				$grandTotalHonor += $v->total_honor_dokter;
				$grandTotalOmset += $v->total_omset;
				$html .= "
					<tr>
						<td>" . $no . "</td>
						<td>".tanggal_indo($v->tanggal_reg)."</td>
						<td>" . $v->no_reg . "</td>
						<td>" . $v->nama_lengkap . "</td>
						<td>" . $v->nama_layanan . "</td>";
						
						if($q_gathel) {
							$html .= "<td><ul style='padding-left: 15px;'>";
							foreach ($q_gathel as $kk => $vv) {
								$html .= "
									<li>".$vv->nama_tindakan."</li>
								";
							}
							$html .= "</ul></td>";
						}else{
							$html .= "<td> - </td>";
						}

				$html .= "<td align='right'>" . number_format($v->total_omset, 0, ',', '.') . "</td>
						<td align='right'>" . number_format($v->total_honor_dokter, 0, ',', '.') . "</td>
				</tr>";

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
			";
		}
        
        echo json_encode([
            'data' => $html
        ]);
	}

	public function tabel_laporan_bak()
	{
		$model = $this->input->post('model');
		$tahun2 = $this->input->post('tahun2');
		$tahun = $this->input->post('tahun');
		$bulan = sprintf("%02d", $this->input->post('bulan'));
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$dokter = $this->input->post('dokter');

		if ($start) {
			$start = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d');
		}

		if ($end) {
			$end = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
		}

		if ($model == 2) {
			### pertahun
			$where = "DATE_FORMAT(reg.tanggal_reg,'%Y') = '$tahun2'";
			$where2 = "DATE_FORMAT(x_reg.tanggal_reg,'%Y') = '$tahun2'";
			$group = "reg.tanggal_reg, m_klinik.nama_klinik, reg.id_pegawai";
		}elseif ($model == 1) {
			### perbulan
			$where = "DATE_FORMAT(reg.tanggal_reg,'%Y-%m') = '".$tahun.'-'.$bulan."' ";
			$where2 = "DATE_FORMAT(x_reg.tanggal_reg,'%Y-%m') = '".$tahun.'-'.$bulan."' ";
			$group = "reg.tanggal_reg, m_klinik.nama_klinik, reg.id_pegawai";
		}elseif ($model == 3) {
			### perhari
			$where = "reg.tanggal_reg between '$start' and '$end'";
			$where2 = "x_reg.tanggal_reg between '$start' and '$end'";
			$group = "reg.tanggal_reg, m_klinik.nama_klinik, reg.id_pegawai";
		}

		$q = $this->db->query("
				SELECT	
				sum(mut.total_pengeluaran) as total,
				mut.tanggal,
				m_klinik.nama_klinik,
				reg.id_klinik,
				m_pegawai.nama as nama_dokter,
				m_pegawai.kode as kode_dokter,
				tbl_sub_join.cnt
			FROM
				t_mutasi AS mut
				LEFT JOIN t_registrasi AS reg ON mut.id_registrasi = reg.id
				LEFT JOIN m_klinik ON reg.id_klinik = m_klinik.id AND m_klinik.deleted_at IS NULL 
				LEFT JOIN m_pegawai ON reg.id_pegawai = m_pegawai.id AND m_pegawai.deleted_at IS NULL 
				JOIN (
					select 
						count(tbl_sub.tanggal) as cnt,
						tbl_sub.tanggal
					FROM (
						SELECT
							x_mut.id,
							x_reg.id_pegawai,
							x_mut.tanggal
						FROM
							t_mutasi x_mut
						LEFT JOIN t_registrasi AS x_reg ON x_mut.id_registrasi = x_reg.id
						LEFT JOIN m_pegawai AS x_peg ON x_reg.id_pegawai = x_peg.id AND x_peg.deleted_at IS NULL 
						WHERE
							id_jenis_trans = 6 
							AND x_mut.deleted_at IS NULL 
							AND $where2
							and x_reg.id_pegawai = $dokter
							AND x_peg.id_jabatan = 1 
						GROUP BY x_mut.tanggal, x_reg.id_pegawai, x_reg.id_klinik
					) as tbl_sub
						
					GROUP BY tbl_sub.tanggal
				) as tbl_sub_join on mut.tanggal = tbl_sub_join.tanggal
			WHERE
				mut.id_jenis_trans = 6 
				AND mut.deleted_at IS NULL 
				AND m_pegawai.id_jabatan = 1
				AND $where  
				AND reg.id_pegawai = $dokter
			GROUP BY $group
			ORDER BY m_pegawai.nama, m_klinik.nama_klinik
		")->result();
		
		// echo $this->db->last_query();exit;
					
		
		// echo "<pre>";
		// print_r ($q);
		// echo "</pre>";
		// exit;

		$html = '';
		$flag_rowspan = null;
		$grandTotal = 0;
		$no = 1;
		if ($q) {
			foreach ($q as $k => $v) {
				$grandTotal += $v->total;
			
				if($flag_rowspan != $v->tanggal) {
					$html .= "
						<tr>
							<td rowspan ='$v->cnt'>" . $no . "</td>
							<td rowspan ='$v->cnt'>" . tanggal_indo($v->tanggal) . "</td>
							<td rowspan ='$v->cnt'>" . $v->nama_dokter . " [" . $v->kode_dokter . "]</td>
							<td>" . $v->nama_klinik . "</td>
							<td align='right'>" . number_format($v->total, 0, ',', '.') . "</td>
						</tr>
					";

					$no++;
					$flag_rowspan = $v->tanggal;
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
					<td colspan = '4' align='center'><b>Total Honor Dokter</b></td>
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
		$klinik = $this->input->get('klinik');
		$model = $this->input->get('model');
		$tahun2 = $this->input->get('tahun2');
		$tahun = $this->input->get('tahun');
		$bulan = sprintf("%02d", $this->input->get('bulan'));
		$start = $this->input->get('start');
		$end = $this->input->get('end');
		$dokter = $this->input->get('dokter');

		if ($start) {
			$start = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d');
		}

		if ($end) {
			$end = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
		}

		if ($model == 2) {
			### pertahun
			$txt_periode = $tahun2;
			$where = "DATE_FORMAT(reg.tanggal_reg,'%Y') = '$tahun2'";
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		} elseif ($model == 1) {
			### perbulan
			$txt_periode = bulan_indo((int)$bulan).' '.$tahun;
			$where = "DATE_FORMAT(reg.tanggal_reg,'%Y-%m') = '" . $tahun . '-' . $bulan . "' ";
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		} elseif ($model == 3) {
			### perhari
			$txt_periode = tanggal_indo($start) . ' s/d ' . tanggal_indo($end);
			$where = "reg.tanggal_reg between '$start' and '$end'";
			$group = "reg.id_layanan, kli.nama_klinik, reg.id";
		}

		$q = $this->db->query("
			SELECT
				reg.id as id_reg,
				reg.no_reg,
				reg.tanggal_reg,
				CONCAT(pas.no_rm, ' - ', pas.nama) as nama_lengkap,
				lay.nama_layanan,
				peg.nama as nama_dokter,
				kli.nama_klinik,
				reg.id_klinik,
				sum( mut.total_penerimaan_nett ) AS total_omset,
				sum( mut.total_pengeluaran ) AS total_honor_dokter
			FROM
				t_mutasi mut
				LEFT JOIN t_registrasi reg ON mut.id_registrasi = reg.id and reg.deleted_at is null
				LEFT JOIN m_klinik kli ON reg.id_klinik = kli.id 
				LEFT JOIN m_layanan lay ON reg.id_layanan = lay.id_layanan 
				LEFT JOIN m_pasien pas ON reg.id_pasien = pas.id
				LEFT JOIN m_pegawai peg ON reg.id_pegawai = peg.id
				JOIN t_pembayaran byr ON reg.id = byr.id_reg
			WHERE
				$where and reg.id_klinik = '$klinik' and reg.is_pulang is not null and reg.id_pegawai = '$dokter'
			GROUP BY
				$group
			ORDER BY
			reg.tanggal_reg, lay.nama_layanan
		")->result();

		$data_klinik = $this->m_global->single_row('*',['deleted_at' => null, 'id' => $klinik], 'm_klinik');
		$data_dokter = $this->m_global->single_row('*',['deleted_at' => null, 'id' => $dokter], 'm_pegawai');
		
		$konten_html = $this->load->view('pdf', ['datanya' => $q,'title' => 'Laporan Honor Dokter','data_klinik' => $data_klinik, 'data_dokter' => $data_dokter, 'data_user' => $this->prop_data_user[0], 'periode' => 'Periode ' . $txt_periode], true);

		$retval = [
			'data' => $q,
			'data_klinik' => $data_klinik,
			'data_dokter' => $data_dokter,
			'content' => $konten_html,
			'footer' => '', // set '' agar tidak ikut default, footer ikut konten,
			'header' => ' ' // set ' ' agar tidak muncul header
		];

		// $this->load->view('pdf', $retval);
		// return;

		$html = $this->load->view('template/pdf', $retval, true);
		$filename = 'laporan_honor_dokter_'.time();
		$this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
	}

	
}
