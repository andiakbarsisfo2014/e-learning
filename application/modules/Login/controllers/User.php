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
			if ($this->input->post('as') == 'Guru') {

				$model = $this->m_user->get_exist_user('tbl_guru',['id_guru'=>$this->input->post('username'),'active'=>'true']);
				if ($model->num_rows() == 0) {
					$mss = 'Nama Pengguna tidak ditemukan !! <a href="'.base_url('guru/login').'">kembali</a>';
				}
				else{
					$model = $model->row();
					if ($this->ubah->decode($model->password) != $this->input->post('password')) {
						$mss = 'Kata Sandi tidak cocok !! <a href="'.base_url('guru/login').'">kembali</a>';
					}
					else{
						$img = $model->img;
						if (trim($model->img) == '' || is_null($model->img)) {
							$img = 'user-160x160.jpg';
						}
						$this->session->set_userdata(['data_id'=>$this->input->post('username'),'nama'=>$model->nama_guru, 'img'=>$img,'as' => 'Guru','url'=>'guru/login']);
						redirect(base_url('administrator/profile/Guru/'.$this->ubah->encode('index')));
					}
				}
				$param = ['page'=>'_message','msg'=>$mss,'title'=>'Guru'];
			}
			elseif ($this->input->post('as') == 'Admin') {
				$model = $this->m_user->get_exist_user('tbl_admin',['id_admin'=>$this->input->post('username'),'active'=>'true']);
				if ($model->num_rows() == 0) {
					$mss = 'Nama Pengguna tidak ditemukan !! <a href="'.base_url('administrator/login').'">kembali</a>';
				}
				else{
					$model = $model->row();
					if ($this->ubah->decode($model->password) != $this->input->post('password')) {
						$mss = 'Kata Sandi tidak cocok !! <a href="'.base_url('administrator/login').'">kembali</a>';
					}
					else{
						$img = $model->img;
						if (trim($model->img) == '' || is_null($model->img)) {
							$img = 'user-160x160.jpg';
						}
						$this->session->set_userdata(['data_id'=>$this->input->post('username'),'nama'=>$model->nama_admin, 'img'=>$img,'as' => 'Admin', 'url'=>'administrator/login']);
						redirect(base_url('administrator/profile/Admin/'.$this->ubah->encode('index')));
					}
				}
				$param = ['page'=>'_message','msg'=>$mss,'title'=>'Guru'];
			}


			$this->load->view('template',$param);
		}

		public function guru()
		{
			$this->load->view('template',['page'=>'_form','title'=>'Guru']);
		}

		public function admin($value='')
		{
			$this->load->view('template',['page'=>'_form','title'=>'Admin']);
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