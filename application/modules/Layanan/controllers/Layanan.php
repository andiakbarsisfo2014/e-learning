<?php
	/**
	* 
	*/
	class Layanan extends MX_Controller
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
			$model = $this->m_datatables->get_datatables();
			$data = array();
			$row = array();
			foreach ($model as $key) {
				$row['id_pelayanan'] = $key->id_pelayanan;
				$row['jenis_pelayanan'] = $key->jenis_pelayanan;
				$row['syarat'] = htmlspecialchars($key->syarat);
				$row['nama_berkas'] = $key->nama_berkas;
				$row['url']['detail'] = base_url('administrator/layanan/').$this->ubah->encode('forDetail/'.$key->id_pelayanan);
				$row['url']['edit'] = base_url('administrator/layanan/').$this->ubah->encode('forUpdate/'.$key->id_pelayanan);
				$row['url']['delete'] = base_url('administrator/layanan/').$this->ubah->encode('forDelete/'.$key->id_pelayanan);
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
			$jenis_pelayanan = $this->input->post('jenis_pelayanan');
			$syarat = $this->input->post('syarat');
			$nama_berkas = $this->input->post('nama_berkas');

			if (trim($jenis_pelayanan) == '' || trim($syarat) == '' || trim($nama_berkas) == '') {
				$data = ['execute' => FALSE,'message' =>' lengkapi data'];
			}
			else{
				$this->load->model('m_pelayanan');
				$value = ['jenis_pelayanan' => $jenis_pelayanan, 'syarat' => $syarat, 'nama_berkas' => $nama_berkas];
				if ($action == 'save') {
					if ($this->m_pelayanan->save('tbl_pelayanan',$value)) {
						$data = ['execute' => true,];
					}
				}
				else{
					if ($this->m_pelayanan->update('tbl_pelayanan',$value,['id_pelayanan' => $this->input->post('kode')])) {
						$data = ['execute' => true];
					}
				}
			}
			echo json_encode(['respon' => $data]);
		}

		public function _form()
		{
			$this->load->view('_form',['model' => NULL]);
		}

		public function forUpdate($id)
		{
			$this->load->model('m_pelayanan');
			$model = $this->m_pelayanan->get_where('tbl_pelayanan',['id_pelayanan'=>$id])->row();
			$this->load->view('_form',['model' =>$model]);
		}

		public function forDelete($id)
		{
			$this->load->model('m_pelayanan');
			if ($this->m_pelayanan->delete('tbl_pelayanan',['id_pelayanan' => $id])) {
				$data = ['execute' => true];
			}
			else{
				$data = ['execute' => false, 'message' => 'Terjadi kesalahan'];
			}

			echo json_encode(['respon' => $data]);
		}

		public function forDetail($id)
		{
			$this->load->model('m_pelayanan');
			$model = $this->m_pelayanan->get_where('tbl_pelayanan',['id_pelayanan'=>$id])->row();
			$this->load->view('detail',['model'=>$model]);
		}

		public function table()
		{
			$this->load->view('table');
		}


	}
?>