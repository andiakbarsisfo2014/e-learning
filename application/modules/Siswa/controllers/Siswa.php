<?php

	/**
	* 
	*/
	class Siswa extends MX_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
			if (!$this->session->userdata('data_id')) {
				redirect(base_url('administrator/login'));
			}
			else{
				if ($this->session->userdata('as') != 'Admin') {
					$this->load->view('error404');
				}
			}
			$tbl = 'tbl_'.strtolower($this->session->userdata('as'));
			$field = 'id_'.strtolower($this->session->userdata('as'));
			$data = $this->m_umum->get_where($tbl,[$field => $this->session->userdata('data_id')])->row();
			if (!is_null($data->img)) {
				$this->session->set_userdata('img',$data->img);
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
							if (!$this->session->userdata('data_id')) {
								redirect(base_url('administrator/login'));
							}
							else {
								if ($this->session->userdata('as') != 'Admin') {
									$this->my_error();
								}
								else{
									$this->$realPath($param);
								}
							}
						}
					}
					else{
						if (!$this->session->userdata('data_id')) {
							redirect(base_url('administrator/login'));
						}
						else{
							if ($this->session->userdata('as') != 'Admin') {
								$this->lanjutan('my_error',null);
							}
							else{
								$this->lanjutan($realPath,$param);
							}
						}
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
							if (!$this->session->userdata('data_id')) {
								redirect(base_url('administrator/login'));
							}
							else{
								if ($this->session->userdata('as') != 'Admin') {
									$this->my_error();
								}
								else{
									$this->$_path($pa);								
								}
							}
						}
					}
					else{
						if (!$this->session->userdata('data_id')) {
							redirect(base_url('administrator/login'));
						}
						else{
							if ($this->session->userdata('as') != 'Admin') {
								$this->lanjutan('my_error',null);
							}
							else{
								$this->lanjutan($_path,$pa);								
							}
						}
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
							if (!$this->session->userdata('data_id')) {
								redirect(base_url('administrator/login'));
							}
							else{
								if ($this->session->userdata('as') != 'Admin') {
									$this->my_error();
								}
								else{
									$this->$method();
								}
							}
						}
					}
					else{
						if (!$this->session->userdata('data_id')) {
							redirect(base_url('administrator/login'));
						}
						else{
							if ($this->session->userdata('as') != 'Admin') {
								$this->lanjutan('my_error',null);
							}
							else{
								$this->lanjutan($method,null);								
							}
						}
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
		public function _form()
		{
			$this->load->view('_form',['model'=>null]);
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
			$id_siswa = $this->input->post('id_siswa');
			$nama_siswa = $this->input->post('nama_siswa');
			$data = null;
			if (trim($id_siswa) == '' || trim($nama_siswa) == '') {
				$data = ['execute'=>false,'message'=>'lengkapi data'];
			}
			else{
				$this->load->model('m_siswa');
				if ($action == 'save') {
					if ($this->m_siswa->get_where('tbl_siswa',['id_siswa'=>$id_siswa])->num_rows() > 0) {
						$data = ['execute'=>false,'message'=>'Id siswa telah digunakan'];
					}
					else{
						$value = ['id_siswa'=>$id_siswa,'nama_siswa'=>$nama_siswa];
						if ($this->m_siswa->save('tbl_siswa',$value)) {
							$data = ['execute'=>true];
						}
						else{
							$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
						}
					}
				}
				else{
					$value = ['nama_siswa'=>$nama_siswa, 'id_siswa' => $id_siswa];
					if ($this->m_siswa->update('tbl_siswa',$value,['id_siswa'=>$this->input->post('kode')])) {
						$data = ['execute'=>true];
					}
					else{
						$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
					}
				}
			}
			echo json_encode(array('respon'=>$data));
		}

		public function get_ajax()
		{
			$this->load->model('m_datatables');
			$model = $this->m_datatables->get_datatables();
			$data = array();
			$row = array();
			foreach ($model as $key) {
				$row['id_siswa'] = $key->id_siswa;
				$row['nama_siswa'] = $key->nama_siswa;
				$row['url']['edit'] = base_url('administrator/siswa/').$this->ubah->encode('forUpdate/'.$key->id_siswa);
				$row['url']['delete'] = base_url('administrator/siswa/').$this->ubah->encode('forDelete/'.$key->id_siswa);
				$row['url']['detail'] = base_url('administrator/siswa/').$this->ubah->encode('forDetail/'.$key->id_siswa);

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

		public function forUpdate($id)
		{
			$this->load->model('m_siswa');
			$this->load->view('_form',['model'=>$this->m_siswa->get_where('tbl_siswa',['id_siswa'=>$id])->row()]);
		}

		public function forDetail($id)
		{
			echo $id;
		}

		public function forDelete($id)
		{
			$this->load->model('m_siswa');
			if ($this->m_siswa->delete('tbl_siswa',['id_siswa'=>$id])) {
				$data = ['execute'=>true];
			}
			else{
				$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
			}
			echo json_encode(array('respon'=>$data));
		}

		public function my_error()
		{
			$this->load->view('error404');
		}
	}
?>