<?php
	/**
	* 
	*/
	class Mapel extends MX_Controller
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

		public function get_ajax()
		{
			$this->load->model('m_datatables');

			$model = $this->m_datatables->get_datatables();
			$data = array();
			$row = array();
			foreach ($model as $key) {
				$row['id_mapel'] = $key->id_mapel;
				$row['nama_mapel'] = $key->nama_mapel;
				!is_null($key->nama_guru) ? $row['nama_guru'] = $key->nama_guru : $row['nama_guru'] = '*Kosong';

				$row['url']['edit'] = base_url('administrator/mata-pelajaran/').$this->ubah->encode('forUpdete/'.$key->id_mapel);
				$row['url']['delete'] = base_url('administrator/mata-pelajaran/').$this->ubah->encode('forDelete/'.$key->id_mapel);
				$row['url']['reg'] = base_url('administrator/mata-pelajaran/').$this->ubah->encode('forRegist/'.$key->id_mapel);

				$data[]  = $row;
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
			$id_mapel = $this->input->post('id_mapel');
			$nama_mapel = $this->input->post('nama_mapel');
			$data = null;
			if (trim($id_mapel) == '' || trim($nama_mapel) == '') {
				$data = ['execute'=>false,'message'=>'Lengkapi data'];
			}
			else{
				$this->load->model('m_mapel');
				if ($action == 'save') {
					if ($this->m_mapel->get_where('tbl_mapel',['id_mapel'=>$id_mapel])->num_rows() > 0) {
						$data = ['execute'=>false,'message'=>'Id Telah digunakan'];
					}
					else{
						$value = ['id_mapel'=>$id_mapel,'nama_mapel'=>$nama_mapel];
						if ($this->m_mapel->save('tbl_mapel',$value)) {
							$data = ['execute'=>true];
						}
						else{
							$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
						}
					}
				}
				else{
					$value = ['nama_mapel'=>$nama_mapel,'id_mapel' => $id_mapel];
					if ($this->m_mapel->update('tbl_mapel',$value,['id_mapel'=>$this->input->post('kode')])) {
						$data = ['execute'=>true];
					}
					else{
						$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
					}
				}
			}
			echo json_encode(array('respon'=>$data));
		}

		public function _form()
		{
			$this->load->view('_form',['model'=>null]);
		}

		public function forUpdete($id)
		{
			$this->load->model('m_mapel');
			$model = $this->m_mapel->get_where('tbl_mapel',['id_mapel'=>$id])->row();
			$this->load->view('_form',['model'=>$model]);
		}

		public function forDelete($id)
		{
			$this->load->model('m_mapel');
			if ($this->m_mapel->delete('tbl_mapel',['id_mapel'=>$id])) {
				$data = ['execute'=>true];
			}
			else{
				$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
			}
			echo json_encode(array('respon'=>$data));
		}

		public function forRegist($id)
		{
			$this->load->model('m_mapel');
			$model = $this->m_mapel->get_where('tbl_mapel',['id_mapel'=>$id])->row();
			$this->load->view('_reg_guru',['model'=>$model]);
		}

		public function reg()
		{
			$this->load->model('m_mapel');
			$value = ['id_guru'=>$this->input->post('nama_guru')];
			if ($this->m_mapel->update('tbl_mapel',$value,['id_mapel'=>$this->input->post('id_mapel')])) {
				$data = ['execute'=>true];
			}
			else{
				$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
			}
			echo json_encode(array('respon'=>$data));
		}

		public function get_guru()
		{
			$this->load->model('m_mapel');
			$model = $this->m_mapel->get_guru($this->input->post('kode'));
			echo json_encode($model);
		}

		public function my_error()
		{
			$this->load->view('error404');
		}
	}

?>