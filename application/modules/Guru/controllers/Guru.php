<?php
	/**
	* 
	*/
	class Guru extends MX_Controller
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

		public function my_error()
		{
			$this->load->view('error404');
		}

		public function index()
		{
			$this->load->view('index');
		}

		public function get_ajax()
		{
			$this->load->model('m_datatables');
			$mdoel = $this->m_datatables->get_datatables();
			$data = array();
			$row = array();
			foreach ($mdoel as $key) {
				$row['id_guru'] = $key->id_guru;
				$row['nama_guru'] = $key->nama_guru;
				if (is_null($key->nama_mapel) || trim($key->nama_mapel) == '') {
					$row['nama_mapel'] = '*kosong';
				}
				else{
					$row['nama_mapel'] = $key->nama_mapel;					
				}
				$row['url']['edit'] = base_url('administrator/guru/').$this->ubah->encode('forUpdate/'.$key->id_guru);
				$row['url']['delete'] = base_url('administrator/guru/').$this->ubah->encode('forDelete/'.$key->id_guru);
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
			$this->load->model('m_guru');
			$id = $this->input->post('id_guru');
			$nama_guru = $this->input->post('nama_guru');
			$data = null;
			if (trim($id) == '' || trim($nama_guru) == '') {
				$data = ['execute'=>false,'message'=>'lengkapi data'];
			}
			else{
				if ($action == 'save') {
					if ($this->m_guru->get_where('tbl_guru',['id_guru'=>$id])->num_rows() > 0) {
						$data = ['execute'=>false,'message'=>'Id Guru telah digunakan'];
					}
					else{
						$value = ['id_guru'=>$id,'nama_guru'=>$nama_guru];
						if ($this->m_guru->save('tbl_guru',$value)) {
							$data = ['execute'=>true];
						}
						else{
							$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
						}
					}
				}
				else{
					$value = ['nama_guru'=>$nama_guru, 'id_guru' => $id];
					if ($this->m_guru->update('tbl_guru',$value,['id_guru'=>$this->input->post('kode')])) {
						$data = ['execute'=>true,];
					}
					else{
						$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
					}
				}
			}
			echo json_encode(array('respon'=>$data));
		}
		public function forUpdate($id)
		{
			$this->load->model('m_guru');
			$model = $this->m_guru->get_where('tbl_guru',['id_guru'=>$id])->row();
			$this->load->view('_form',['model'=>$model]);
		}
		public function forDelete($id)
		{
			$this->load->model('m_guru');
			if ($this->m_guru->delete('tbl_guru',['id_guru'=>$id])) {
				$data = ['execute'=>true];		
			}	
			else{
				$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
			}
			echo json_encode(array('respon'=>$data));
		}
		public function _form()
		{
			$this->load->view('_form',['model'=>null]);
		}

		public function secure()
		{
			if (!is_null($this->session->userdata('isLogin'))) {
				return true;
			}
			else{
				return false;	
			}
		}

		public function active()
		{
			$model = $this->m_validate->get_where('tbl_user',['username'=>$this->session->userdata('id')])->row();
			if ($model->active == 'false') {
				
	      		return false;	
			}
			else{
				return true;
			}
		}

		public function message()
		{
			echo '<div class="alert alert-danger alert-dismissible">
	            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            		<h4><i class="icon fa fa-info"></i> Error!</h4>
	            		Akun Anda kami non aktifkan
	          			</div>';
		}
	}
?>