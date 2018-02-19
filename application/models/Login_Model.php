<?php 
	/**
	* 
	*/
	class Login_Model extends CI_Model
	{
		public function view_kat($config, $id_user){
			$this->db->where('id_user', $id_user);
			$this->db->order_by('id_content', 'DESC');
			$hasilquery=$this->db->get('content', $config['per_page'], $this->uri->segment(4));

			if ($hasilquery->num_rows() > 0) {
				foreach($hasilquery->result() as $value){
					$data[]=$value;
				}
				return $data;
			}
		}

		public function kode(){
			$this->db->select_max('id_user');
			return $this->db->get('user_temp')->row();
		}

		public function register($user){
			$this->db->insert('user_temp', $user);
		}

		public function login_user($username, $pass){
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where('username', $username);
			$this->db->where('password', $pass);

			if ($query=$this->db->get()) {
				return $query->row_array();
			}
			else{
				return false;
			}
		}

		public function username_check($username){
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where('username', $username);
			$query=$this->db->get();

			if ($query->num_rows()>0) {
				return false;
			}else{
				return true;
			}
		}

		public function view_by($id_user){
			$this->db->where('id_user', $id_user);
			return $this->db->get('content')->result();
		}

		// bagian dashboar user
		public function save(){
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$config['max_size'] = '2048';
			$config['remove_space'] = TRUE;

			$this->load->library('upload', $config); // Load konfigurasi uploadnyasss

			if($this->upload->do_upload('img_path')){
				$return = array('result' => 'success', 'files' => $this->upload->data(), 'error' => '');
			}
			else{
				$this->session->set_flashdata('error_msg',$this->upload->display_errors());
				redirect('User/add');	
			}
			if ($this->upload->do_upload('file')) {
				$rfile = array('result' => 'success', 'files' => $this->upload->data(), 'error' => '');
			}
			else{
				$this->session->set_flashdata('error_msg',$this->upload->display_errors());
				redirect('User/add');	
			}
			
			
			
			$data = array(
				"id_content" => $this->input->post('id_content'),
				"judul" => $this->input->post('judul'),
				"deskripsi" => $this->input->post('deskripsi'),
				"kategori" => $this->input->post('kategori'),
				"laboratorium" => $this->input->post('laboratorium'),
				"id_user" => $this->input->post('id_user'),
				"time" => $this->input->post('time'),
				"username" => $this->input->post('username'),
				"img_path" => $return['files']['file_name'],
				"file" => $rfile['files']['file_name']
				
			);
			$this->db->insert('content', $data);
		}

		public function view_edit($id_content){
			$this->db->where('id_content', $id_content);
			return $this->db->get('content')->row();
		}

		public function view_user($id_user){
			$this->db->where('id_user', $id_user);
			return $this->db->get('user')->row();
		}

		public function edit($id_content){
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$config['max_size'] = '2048';
			$config['remove_space'] = TRUE;

			$this->load->library('upload', $config); // Load konfigurasi uploadnyasss

			if($this->upload->do_upload('img_path')){
				$return = array('result' => 'success', 'files' => $this->upload->data(), 'error' => '');
			}
			else{
				$this->session->set_flashdata('error_msg',$this->upload->display_errors());
				redirect('User/add');	
			}
			if ($this->upload->do_upload('file')) {
				$rfile = array('result' => 'success', 'files' => $this->upload->data(), 'error' => '');
			}
			else{
				$this->session->set_flashdata('error_msg',$this->upload->display_errors());
				redirect('User/add');	
			}

			$data = array(
				"judul" => $this->input->post('judul'),
				"deskripsi" => $this->input->post('deskripsi'),
				"kategori" => $this->input->post('kategori'),
				"img_path" => $return['files']['file_name'],
				"file" => $rfile['files']['file_name']
			);

			$this->db->where('id_content', $id_content);
			$query = $this->db->get('content');
			$row = $query->row();

			unlink("./uploads/$row->img_path");
			unlink("./uploads/$row->file");
			$this->db->where('id_content', $id_content);
			$this->db->update('content', $data);
		}

		public function edit_user($id_user){
			$config['upload_path'] = './uploads/profiles/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '500';
			$config['remove_space'] = TRUE;

			$this->load->library('upload', $config); // Load konfigurasi uploadnyasss

			if($this->upload->do_upload('img_path')){
				$return = array('result' => 'success', 'files' => $this->upload->data(), 'error' => '');
			}
			else{
				$this->session->set_flashdata('error_msg',$this->upload->display_errors());
				redirect('User/user_profile');	
			}

			$data = array(
				"username" => $this->input->post('username'),
				"email" => $this->input->post('email'),
				"laboratorium" => $this->input->post('laboratorium'),
				"password" =>md5($this->input->post('password')),
				"img_path" => $return['files']['file_name']
			);

			$this->db->where('id_user', $id_user);
			$query = $this->db->get('user');
			$row = $query->row();

			unlink("./uploads/profiles/$row->img_path");
			$this->db->where('id_user', $id_user);
			$this->db->update('user', $data);
		}

		public function hapus($id_content){
			$this->db->where('id_content', $id_content);
			$query = $this->db->get('content');
			$row = $query->row();

			unlink("./uploads/$row->img_path");
			unlink("./uploads/$row->file");
			$this->db->delete('content', array('id_content' => $id_content));
		}
	}
	?>