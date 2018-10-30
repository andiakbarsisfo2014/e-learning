<?php
/**
* 
*/
	class Login extends MX_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
		}
		public function path()
		{
			$method = $this->uri->segment(2);
			if (method_exists($this,$method)) {
				if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
					if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

						if (!is_null($this->uri->segment(2)) && is_null($this->uri->segment(3))) {
							$this->$method($this->uri->segment(2));
						}
						elseif (!is_null($this->uri->segment(2)) && !is_null($this->uri->segment(3))){
							$this->$method($this->uri->segment(2),$this->uri->segment(3));
						}
						else{
							$this->$method();
						}
					}
				}
				else{
					if (!is_null($this->uri->segment(2)) && is_null($this->uri->segment(3))) {
						// $this->$method($this->uri->segment(2));
						$this->lanjutan($method,$this->uri->segment(2));
					}
					elseif (!is_null($this->uri->segment(2)) && !is_null($this->uri->segment(3))){
						// $this->$method($this->uri->segment(2),$this->uri->segment(3));
						$this->lanjutan($method,$this->uri->segment(2),$this->uri->segment(3));
					}
					else{
						$this->lanjutan($method);
						// $this->$method();
					}
					// if (is_null($this->uri->segment(2))) {
					// 	$this->lanjutan($method,null);
					// }
					// else{
					// 	$this->lanjutan($method,$this->uri->segment(2));
					// }
				}
			}
			else
				echo "Not Found";
		}
		public function lanjutan($param,$realParam,$par3 = null)
		{
			$this->load->view('siswa_template/_head');
			if (is_null($realParam)) {
				$this->$param();
			}
			else{
				$this->$param($realParam,$par3);
			}
			$this->load->view('siswa_template/_foot');
		}
		public function login()
		{
			$this->load->view('login');
		}

		public function validate()
		{
			$this->load->model('m_belajar');
			$model = $this->m_belajar->get_where('tbl_siswa',['id_siswa' => $this->input->post('username')]);
			if ($model->num_rows() == 0) {
				$data = [ 'execute' => false ,'message' => 'Nama pengguna tidak ditemukan'];
			}
			else{
				$user = $model->row();
				if ($this->ubah->decode($user->password) != $this->input->post('password')) {
					$data = ['message' => 'kata sandi tidak cocok', 'execute' => false];
				}
				else{
					$this->session->set_userdata(['siswa_id' => $this->input->post('username'),'siswa_nama' => $user->nama_siswa]);
					$data = ['execute' => true,];
				}
			}
			echo json_encode(['respon' =>$data]);
		}

		public function logout()
		{
			$this->session->unset_userdata(['data_id','nama']);
			redirect(base_url());
		}
	}
?>