<?php
	/**
	* 
	*/
	class Penduduk extends MX_Controller
	{
		function __construct()
		{
			$this->load->library('ubah');
			parent::__construct();
			if (!$this->session->userdata('data_id')) {
				redirect(base_url('user/login'));
			}
			else{
				if ($this->session->userdata('level') != 'admin') {
					$this->load->view('error404');
				}
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

		public function get_ajax()
		{
			$this->load->model('m_datatables');
			$data = [];
			$row = [];
			foreach ($this->m_datatables->get_datatables() as $key) {
				$row['kode_penduduk'] = $key->kode_penduduk;
				$row['no_ktp'] = $key->no_ktp;
				$row['no_kk'] = $key->no_kk;
				$row['nama'] = $key->nama;
				$row['kepala_keluarga'] = $key->kepala_keluarga;
				$row['url']['edit'] = base_url('administrator/data-penduduk/'.$this->ubah->encode('forUpdate/'.$key->kode_penduduk));
				$row['url']['delete'] = base_url('administrator/data-penduduk/'.$this->ubah->encode('forDelete/'.$key->kode_penduduk));
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

		public function get_penduduk()
		{
			$this->load->model('m_master');
			$model = $this->m_master->get_penduduk($this->input->post('kode'));
			echo json_encode($model);
		}

		public function _form()
		{
			$this->load->view('_form',['model' => NULL]);
		}

		public function save()
		{
			$this->action('save');
		}

		public function update()
		{
			$this->action('update');
		}

		public function action($action)
		{
			$kode_penduduk = base64_encode(rand(random_int(0,1000),random_int(0,1000)));
			$no_kk = $this->input->post('no_kk');
			$no_ktp = $this->input->post('no_ktp');
			$nama = $this->input->post('nama');
			$jk = $this->input->post('jk');
			if (trim($no_kk) == '' || trim($no_ktp) == '' || trim($nama) == '' || trim($jk) == '') {
				$data = ['execute' => false, 'message' => 'Lengkapi data'];
			}
			else{
				$this->load->model('m_master');
				if ($action == 'save') {
					$value = ['kode_penduduk' => $kode_penduduk, 'no_ktp' => $no_ktp, 'no_kk' => $no_kk, 'nama' => $nama, 'jk' => $jk];
					if ($this->m_master->save('tbl_penduduk',$value)) {
						$data = ['execute' => true];
					}
					else{
						$data = ['execute' => false, 'message' => 'terjadi kesalahan'];
					}
				}
				else{
					$value = ['no_kk' => $no_kk, 'no_ktp' => $no_ktp, 'nama' => $nama, 'jk' => $jk];
					if ($this->m_master->update('tbl_penduduk',$value,['kode_penduduk' => $this->input->post('kode')])) {
						$data = ['execute' => true];
					}
					else{
						$data = ['execute' => false, 'message' => 'terjadi kesalahan'];
					}
				}
			}
			echo json_encode(['respon' => $data]);
		}

		public function forUpdate($id)
		{
			$this->load->model('m_master');
			$this->load->view('_form',['model' => $this->m_master->get_join('tbl_penduduk a','tbl_kk b','a.no_kk = b.no_kk',['a.kode_penduduk' => $id])->row()]);
		}

		public function forDelete($id)
		{
			$this->load->model('m_master');
			if ($this->m_master->delete('tbl_penduduk',['kode_penduduk'=>$id])) {
					$data = ['execute' => true];
			}
			else{
				$data = ['execute' => false, 'message' => 'terjadi kesalahan'];
			}
			echo json_encode(['respon' => $data]);
		}

		public function table()
		{
			$this->load->view('table');
		}
	}
?>