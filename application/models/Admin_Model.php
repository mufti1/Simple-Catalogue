<?php 
	/**
	* 
	*/
	class Admin_Model extends CI_Model
	{
		//manage user
		public function kode(){
			$this->db->select_max('id_user');
			return $this->db->get('user')->row();
		}
		
		public function view_user($config){
			$hasilquery=$this->db->get('user', $config['per_page'], $this->uri->segment(3));

			if ($hasilquery->num_rows() > 0) {
				foreach($hasilquery->result() as $value){
					$data[]=$value;
				}
				return $data;
			}
		}

		public function view_edit_user($id_user){
			$this->db->where('id_user', $id_user);
			return $this->db->get('user')->row();
		}

		public function edit_user($id_user){
			$data = array(
				"username" => $this->input->post('username'),
				"level" => $this->input->post('level'),
				"laboratorium" => $this->input->post('laboratorium')
			);

			$this->db->where('id_user', $id_user);
			$this->db->update('user', $data);
		}

		public function delete_user($id_user){
			$this->db->where('id_user', $id_user);
			$this->db->delete('user');
		}

		//permintaan user

		public function view_temp(){
			return $this->db->get('user_temp')->result();
		}

		public function delete_temp($id_user){
			$this->db->where('id_user', $id_user);
			$this->db->delete('user_temp');
		}

		public function approve(){
			$data = array(
				'id_user'=>$this->input->post('id_user'),
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password')),
				'level'=>$this->input->post('level'),
				'email'=>$this->input->post('email'),
				'laboratorium'=>$this->input->post('laboratorium')
			);

			$this->db->insert('user', $data);
		}

		//manage katalog

		public function view_katalog($config){
			$hasilquery=$this->db->get('content', $config['per_page'], $this->uri->segment(3));

			if ($hasilquery->num_rows() > 0) {
				foreach($hasilquery->result() as $value){
					$data[]=$value;
				}
				return $data;
			}
		}

		public function delete_katalog($id_content){
			$this->db->where('id_content', $id_content);
			$query = $this->db->get('content');
			$row = $query->row();

			unlink("./uploads/$row->img_path");
			unlink("./uploads/$row->file");
			$this->db->delete('content', array('id_content' => $id_content));
		}

		public function view_edit_katalog($id_content){
			$this->db->where('id_content', $id_content);
			return $this->db->get('content')->row();
		}

		public function edit_katalog($id_content){
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

		public function hapus($id_content){
			$this->db->where('id_content', $id_content);
			$this->db->delete('content');
		}
	}
	?>