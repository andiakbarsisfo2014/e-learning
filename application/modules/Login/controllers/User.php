<?php
	/**
	* 
	*/
	class User extends MX_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
			$this->load->model('m_user');
		}

		public function validate()
		{
			$this->load->model('m_user');
			
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($this->m_user->get_exist_user('tbl_user',['id_user'=>$username])->num_rows() == 0) {
				$param = ['msg' => 'Nama Pengguna tidak ditemukan', 'page'=>'_message'];
			}
			else{
				$model = $this->m_user->get_exist_user('tbl_user',['id_user'=>$username])->row();
				if ($this->ubah->decode($model->password) != $password) {
					$param = ['msg' => 'Kata sandi tidak cocok', 'page' => '_message'];
				}
				else{
					$this->session->set_userdata(['data_id'=>$username,'nama'=>$model->nama, 'level' => $model->level]);
					redirect(base_url('administrator'));
				}
			}
			$this->load->view('template',$param);
		}

		public function index()
		{
			$this->load->view('template',['page' => '_form']);
		}

		public function logout()
		{
			$url = $this->session->userdata('url');
			$array = ['data_id','nama','img','as','url'];
			$this->session->unset_userdata($array);
			header('location: '.base_url());
		}
	}
?>