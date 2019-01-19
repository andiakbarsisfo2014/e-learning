<?php
	/**
	* 
	*/
	class Resi extends MX_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
			if (!$this->session->userdata('data_id')) {
				redirect(base_url('user/login'));
			}
		}

		public function path()
		{
			$method = $this->ubah->decode($this->uri->segment(3));
			$path = explode('/',$method);
			if (count($path) == 2) {
				$realPath = $path[0];
				$param = $path[1];
				if (method_exists($this,$realPath)) {
					if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
						if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
							// if (!$this->session->userdata('data_id')) {
							// 	redirect(base_url('administrator/login'));
							// }
							// else {
							// 	if ($this->session->userdata('as') != 'Admin') {
							// 		$this->my_error();
							// 	}
							// 	else{
									$this->$realPath($param);
							// 	}
							// }
						}
					}
					else{
						// if (!$this->session->userdata('data_id')) {
						// 	redirect(base_url('administrator/login'));
						// }
						// else{
						// 	if ($this->session->userdata('as') != 'Admin') {
						// 		$this->lanjutan('my_error',null);
						// 	}
						// 	else{
								$this->lanjutan($realPath,$param);
						// 	}
						// }
					}
				}
				else
					echo " Tidak ada 2";
			}
			elseif (count($path) > 1) {
				$pa = array();
				$_path = $path[0];
				for ($i=1; $i < count($path) ; $i++) {
					$pa[] =$path[$i];
				}
				if (method_exists($this,$_path)) {
					if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
						if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
							// if (!$this->session->userdata('data_id')) {
							// 	redirect(base_url('administrator/login'));
							// }
							// else{
							// 	if ($this->session->userdata('as') != 'Admin') {
							// 		$this->my_error();
							// 	}
							// 	else{
									$this->$_path($pa);								
							// 	}
							// }
						}
					}
					else{
						// if (!$this->session->userdata('data_id')) {
						// 	redirect(base_url('administrator/login'));
						// }
						// else{
						// 	if ($this->session->userdata('as') != 'Admin') {
						// 		$this->lanjutan('my_error',null);
						// 	}
							// else{
								$this->lanjutan($_path,$pa);								
						// 	}
						// }
					}
				}
				else{
					echo "tidak ada > 1";
				}
			}
			else{
				if (method_exists($this,$method)) {
					if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
						if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
							// if (!$this->session->userdata('data_id')) {
							// 	redirect(base_url('administrator/login'));
							// }
							// else{
							// 	if ($this->session->userdata('as') != 'Admin') {
							// 		$this->my_error();
							// 	}
							// 	else{
									$this->$method();
							// 	}
							// }
						}
					}
					else{
						// if (!$this->session->userdata('data_id')) {
						// 	redirect(base_url('administrator/login'));
						// }
						// else{
						// 	if ($this->session->userdata('as') != 'Admin') {
						// 		$this->lanjutan('my_error',null);
						// 	}
							// else{
								$this->lanjutan($method,null);								
						// 	}
						// }
					}
				}
				else
					echo " Tidak ada else";
			}

		}

		public function lanjutan($param,$realParam)
		{
			$this->load->view('_head');
			if (is_null($realParam)) {
				$this->$param();
			}
			else{
				$this->$param($realParam);
			}
			$this->load->view('_foot');
		}

		public function index()
		{
			$this->load->view('index');
		}

		public function table()
		{
			$this->load->view('table');
		}

		public function get_layanan()
		{
			$this->load->model('m_resi');
			$data = [];
			$row = [];
			foreach ($this->m_resi->get_layanan($this->input->post('kode')) as $key) {
				$row['id'] = $key->id_pelayanan;
				$row['jenis_pelayanan'] = $key->jenis_pelayanan;
				$data[] = $row;
			}
			echo json_encode($data);
		}

		public function get_ajax()
		{
			$this->load->model('m_datatables');
			$data = [];
			$row = [];
			foreach ($this->m_datatables->get_datatables() as $key) {
				$row['kode_penduduk'] = $key->kode_penduduk;
				$row['no_kk'] = $key->no_kk;
				$row['no_ktp'] = $key->no_ktp;
				$row['nama'] =  $key->nama;
				$row['kepala_keluarga'] = $key->kepala_keluarga;
				$row['url']['url'] = base_url('administrator/resi/'.$this->ubah->encode('proses'));
				$row['url']['key'] = $key->kode_penduduk;
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_datatables->count_all(),
				"recordsFiltered" => $this->m_datatables->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		}

		public function cetak()
		{
			$this->load->model('m_resi');
			$model = $this->m_resi->get_join('tbl_resi a',['tbl_pelayanan b','tbl_penduduk c','tbl_kk d'],['a.id_pelayanan = b.id_pelayanan','a.id_penduduk = c.kode_penduduk','c.no_kk = d.no_kk'],['a.id_penduduk' => $this->uri->segment(3)])->row();
			$this->load->view('_pdf',['model' => $model]);
		}

		public function proses()
		{
			$kode_penduduk = $this->input->post('kode_penduduk');
			$jenis_pelayanan = $this->input->post('jenis_pelayanan');
			if (trim($kode_penduduk) == '' || trim($jenis_pelayanan) == '') {
				$data = ['execute' => false, 'message' => 'Lengkapi data'];
			}
			else{
				$this->load->model('m_resi');
				$value = ['id_pelayanan' => $jenis_pelayanan, 'tgl_stor' => date('Y-m-d'), 'status' => 'false', 'id_penduduk' => $this->input->post('kode_penduduk')];
				if ($this->m_resi->save('tbl_resi',$value)) {
					$data = ['execute' => true, 'key' => $this->ubah->encode('get_berkas/'.$this->input->post('kode_penduduk')) ];
				}
				else{
					$data = ['execute' => false, 'message' => 'terjadi kesalahn'];
				}
			}
			echo json_encode(['respon' => $data]);
		}

		public function get_files($kondisi = NULL)
		{
			$this->load->view('files',['kondisi' => $kondisi]);
		}

		public function get_berkas($kondisi = NULL)
		{
			if (is_null($kondisi) || trim($kondisi) == '') {
				$kondisi = NULL;
			}
			else{
				$kondisi = ['a.id_penduduk' => $kondisi];
			}
			$this->table_all_in($kondisi);
		}

		public function table_all_in($kondisi)
		{
			$this->load->model('m_berkas');
			$model= $this->m_berkas->get_datatables($kondisi);
			$data = [];
			$row = [];
			foreach ($model as $key) {
				$row['no_kk'] = $key->no_kk;
				$row['no_ktp'] = $key->no_ktp;
				$row['nama'] = $key->nama;
				$row['berkas'] = $key->nama_berkas;
				$row['tgl'] = $key->tgl_stor;
				if ($key->status == 'false') {
					$row['status'] = '<span class="label label-warning">Pending</span>';	
				}
				else{
					$row['status'] = '<span class="label label-success">Send</span>';	
				}
				$row['url']['key'] = $key->id_penduduk;
				$row['url']['url'] = base_url('administrator/ambil-berkas/'.$this->ubah->encode('forUpdate/'.$key->id));
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_berkas->count_all(),
				"recordsFiltered" => $this->m_berkas->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		}

		public function forUpdate($id)
		{
			$this->load->model('m_resi');
			if ($this->m_resi->update('tbl_resi',['status' => 'true'],['id'=> $id])) {
				$data = ['execute' => true];
			}
			else{
				$data = ['execute' => false, 'message'=>'terjadi kesalahn'];
			}
			echo json_encode(['respon'=>$data]);
		}



		public function reset()
		{
			$this->load->model('m_resi');
			$this->m_resi->truncate();
		}
		
	}
?>