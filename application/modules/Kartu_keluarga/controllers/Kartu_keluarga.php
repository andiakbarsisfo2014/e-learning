<?php
	/**
	* 
	*/
	class Kartu_keluarga extends MX_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
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
				$row['no_kk'] = $key->no_kk;
				$row['kepala_keluarga'] = $key->kepala_keluarga;
				$row['rt'] = $key->rt;
				$row['rw'] = $key->rw;
				$row['desa_kelurahan'] = $key->desa_kelurahan;
				$row['kec'] = $key->kec;
				$row['kab'] = $key->kab;
				$row['kode_pos'] = $key->kode_pos;
				$row['prov'] = $key->prov;
				$row['url']['edit'] = base_url('administrator/kartu-keluarga/'.$this->ubah->encode('forUpdate/'.$key->no_kk));
				$row['url']['delete'] = base_url('administrator/kartu-keluarga/'.$this->ubah->encode('forDelete/'.$key->no_kk));
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

		public function _form()
		{
			$this->load->view('_form',['model' => null]);
		}

		public function table()
		{
			$this->load->view('table');
		}

		public function save()
		{
			$this->action('save');
		}

		public function update()
		{
			$this->action('update');
		}

		public function forUpdate($id)
		{
			$this->load->model('m_kk');
			$this->load->view('_form',['model'=>$this->m_kk->get_where('tbl_kk',['no_kk'=>$id])->row()]);
		}

		public function forDelete($id)
		{
			$this->load->model('m_kk');
			if ($this->m_kk->delete('tbl_kk',['no_kk'=>$id])) {
				$data = ['execute'=>true];
			}
			else{
				$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
			}
			echo json_encode(['respon'=>$data]);
		}

		public function action($action)
		{
			$no_kk = $this->input->post('no_kk');
			$kepala_keluarga = $this->input->post('kepala_keluarga');
			$rt = $this->input->post('rt');
			$rw = $this->input->post('rw');
			$desa_kelurahan = $this->input->post('desa_kelurahan');
			$kec = $this->input->post('kec');
			$kab = $this->input->post('kab');
			$kode_pos = $this->input->post('kode_pos');
			$prov = $this->input->post('prov');

			if (trim($no_kk) == '' || trim($kepala_keluarga) == '' || trim($rt) == '' || trim($rw) == '' || trim($desa_kelurahan) == '' || trim($kec) == '' || trim($kab) == '' || trim($kode_pos) == '' || trim($prov) == '') {
				$data = ['execute' => false, 'message' => 'lengkapi data'];
			}
			else{
				$value = ['no_kk' => $no_kk, 'kepala_keluarga' => $kepala_keluarga, 'rt' => $rt, 'rw' => $rw, 'desa_kelurahan' => $desa_kelurahan, 'kec' => $kec, 'kab' => $kab, 'kode_pos' => $kode_pos, 'prov' => $prov];
				$this->load->model('m_kk');
				if ($action == 'save') {
					if ($this->m_kk->save('tbl_kk',$value)) {
						$data = ['execute' => true,];
					}
					else{
						$data = ['execute' => false, 'message' => 'terjadi kesalahan'];
					}
				}
				else{
					if ($this->m_kk->update('tbl_kk',$value,['no_kk' => $this->input->post('kode')])) {
						$data = ['execute' => true];
					}
					else{
						$data = ['execute' => false, 'message' => 'terjadi kesalahan'];
					}
				}
			}
			echo json_encode(['respon'=>$data]);
		}
		
	}
?>