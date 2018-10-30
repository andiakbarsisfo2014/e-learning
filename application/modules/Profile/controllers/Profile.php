<?php
	/**
	* 
	*/
	class Profile extends MX_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
			if (!$this->session->userdata('data_id')) {

				redirect(base_url($this->uri->segment(1).'/login'));
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
			$method = $this->ubah->decode($this->uri->segment(4));
			$path = explode('/',$method);
			if (count($path) == 2) {
				$realPath = $path[0];
				$param = $path[1];
				if (method_exists($this,$realPath)) {
					if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
						if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
							$this->$realPath($param);
						}
					}
					else{
						$this->lanjutan($realPath,$param);
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
							$this->$_path($pa);
						}
					}
					else{
						$this->lanjutan($_path,$pa);
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
							$this->$method();
						}
					}
					else{
						$this->lanjutan($method,null);
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

		public function updateImg()
		{
			$config['upload_path']          = './dist/img/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
           	$config['file_name'] = $this->session->userdata('data_id').'.'.pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
           	if (file_exists('./dist/img/'.$config['file_name'])) {
           		unlink('./dist/img/'.$config['file_name']);
           	}


            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('img'))
            {
            	$data = ['execute'=>false,'message' => $this->upload->display_errors()];
            }
            else
            {
            	$tbl = 'tbl_'.strtolower($this->session->userdata('as'));
            	$this->load->model('m_profile');
            	$field = 'id_'.strtolower($this->session->userdata('as'));
            	if ($this->m_profile->update($tbl,['img'=>$this->upload->data('file_name')],[$field => $this->session->userdata('data_id')])) {
            		$this->session->set_userdata('img',$this->upload->data('file_name'));
            		$data = ['execute' => true];
            	}
            	else{
            		$data = ['execute' => false,'message'=>'terjadi kesalahan'];
            	}
            }
            echo json_encode(array('respon'=>$data));
		}

		public function updateName()
		{
			$this->load->model('m_profile');
			if ($this->session->userdata('as') == 'Guru') {
				$tbl = 'tbl_guru';
				$val = ['nama_guru'=>$this->input->post('nama'),'password' => $this->ubah->encode($this->input->post('password'))];
				$id  = ['id_guru'=>$this->session->userdata('data_id')];
			}
			elseif ($this->session->userdata('as') == 'Admin') {
				$tbl = 'tbl_admin';
				$val = ['nama_admin'=>$this->input->post('nama'),'password' => $this->ubah->encode($this->input->post('password'))];
				$id  = ['id_admin' => $this->session->userdata('data_id')];
			}
			if ($this->m_profile->update($tbl,$val,$id)) {
				$this->session->set_userdata('nama',$this->input->post('nama'));
				$data = ['execute'=>true];
			}
			else{
				$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
			}
			echo json_encode(array('respon'=>$data));
		}

		public function name()
		{
			$this->load->model('m_profile');
			$tbl = 'tbl_'.strtolower($this->session->userdata('as'));
			$field = 'id_'.strtolower($this->session->userdata('as'));
			$model = $this->m_profile->get_where($tbl,[$field => $this->session->userdata('data_id')])->row();
			$this->load->view('_name',['model' => $model]);
		}

		public function img()
		{
			$this->load->view('_img');
		}
	}
?>