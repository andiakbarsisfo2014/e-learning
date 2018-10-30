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
			$method = $this->ubah->decode($this->uri->segment(5));
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
		
		public function my_error()
		{
			$this->load->view('error404');
		}

		public function index()
		{
			$this->load->view('siswa/index');
		}
		public function get_ajax()
		{
			$this->load->model('m_datatables');
			$model = $this->m_datatables->get_datatables('tbl_siswa',array('id_siswa','nama_siswa'),array('id_siswa','nama_siswa'),['id_siswa'=>'ASC']);
			$data = array();
			$row = array();
			foreach ($model as $key) {
				$row['id_siswa'] = $key->id_siswa;
				$row['nama_siswa'] = $key->nama_siswa;
				$row['active'] = $key->active;
				$row['url']['reset'] = base_url('administrator/management/user/siswa/').$this->ubah->encode('reset/'.$key->id_siswa);
				$row['url']['switch'] = base_url('administrator/management/user/siswa/').$this->ubah->encode('change/'.$key->id_siswa);
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

		public function change($id)
		{
			$this->load->model('m_manage');
			$model = $this->m_manage->get_where('tbl_siswa',['id_siswa'=>$id])->row();
			if ($model->active == 'true') {
				$data = ['active'=>'false'];
			}
			else{
				$data = ['active'=>'true'];
			}
			if ($this->m_manage->update('tbl_siswa',$data,['id_siswa'=>$id])) {
				$res = ['execute'=>true];
			}
			else{
				$res = ['execute'=>false,'message'=>'terjadi kesalahan'];
			}
			echo json_encode(array('respon'=>$res));
		}

		public function reset($id)
		{
			$this->load->model('m_manage');
			$sandi = base64_encode(rand());
			$data = ['password'=>$this->ubah->encode($sandi)];
			if ($this->m_manage->update('tbl_siswa',$data,['id_siswa'=>$id])) {
				$res = ['execute'=>true,'message'=>'Sandi Baru '.$sandi];
			}
			else{
				$res = ['execute'=>false,'message'=>'terjadi kesalahan'];
			}
			echo json_encode(array('respon'=>$res));
		}
	}
?>