<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	* semua controller user logikanya disini
	*/
	class User extends CI_Controller
	{

		public function __construct(){
			parent::__construct();

			$this->load->helper('url');
			$this->load->model('Login_Model');
			$this->load->library('pagination');
			$this->load->database();
			$this->load->library('session');
		}

		public function index(){
			$data['user'] = $this->Login_Model->kode();
			$this->load->view('template/header.php');
			$this->load->view('user/register.php', $data);
			$this->load->view('template/footer.php');
		}

		//input register
		public function register(){
			$user=array(
				'id_user'=>$this->input->post('id_user'),
				'username'=>$this->input->post('username'),
				'password'=>$this->input->post('password'),
				'level'=>$this->input->post('level'),
				'email'=>$this->input->post('email'),
				'laboratorium'=>$this->input->post('laboratorium')
			);
			print_r($user);

			$username_check=$this->Login_Model->username_check($user['username']);

			if ($username_check) {
				$this->Login_Model->register($user);
				$this->session->set_flashdata('success_msg','Berhasil Register');
				redirect('User/login_view');
			}
			else{
				$this->session->set_flashdata('error_msg','gagal username sudah ada');
				redirect('User/login_view');
			}
		}

		public function login_view(){
			$this->load->view('template/header.php');
			$this->load->view('user/login.php');
			$this->load->view('template/footer.php');
		}

		public function login_user(){
			$user_login=array(
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password'))
			);

			$data=$this->Login_Model->login_user($user_login['username'],$user_login['password']);

			if ($data) {
				$this->session->set_userdata('id_user',$data['id_user']);
				$this->session->set_userdata('username',$data['username']);
				$this->session->set_userdata('level',$data['level']);
				$this->session->set_userdata('img_path',$data['img_path']);
				redirect('User/edit_user');
			}else{
				$this->session->set_flashdata('error_msg','error');
				redirect('User/login_view','refresh');
			}
		}

		public function user_profile(){

			$this->load->view('template/header.php');
			$this->load->view('template/sidebar.php');
			$this->load->view('user/user_profile.php');
			$this->load->view('template/footer.php');
		}

		public function user_logout(){
			$this->session->sess_destroy();
			redirect('/','refresh');
		}

// bagian dashboard
		
		public function dashboard($id_user){
			//konfig pagination

			$config['base_url'] = base_url()."User/dashboard/$id_user/";
			$config['total_rows'] = $this->db->query("SELECT * FROM content where id_user = '$id_user'")->num_rows();
			$config['per_page']=3;
			$config['num_links'] = 2;
			$config['uri_segment']=4;
		//Tambahan untuk styling
			$config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";

			$config['first_link']='< Pertama ';
			$config['last_link']='Terakhir > ';
			$config['next_link']='> ';
			$config['prev_link']='< ';

			$this->pagination->initialize($config);

			$data['content']=$this->Login_Model->view_kat($config, $id_user);

			$this->load->view('template/header.php');
			$this->load->view('template/sidebar.php');			
			$this->load->view('user/dashboard.php', $data);
			$this->load->view('template/footer.php');
		}
		public function add(){
			$data=array();
			if ($this->input->post('submit')) {
				$this->Login_Model->save();
				$this->session->set_flashdata('success_msg','Berhasil dikirim');
				redirect('User/add');				
			}


			$this->load->view('template/header.php');
			$this->load->view('template/sidebar.php');			
			$this->load->view('user/form_add', $data);
			$this->load->view('template/footer.php');
		}

		public function edit($id_content){
			$data=array();
			if ($this->input->post('submit')) {
				
				$this->Login_Model->edit($id_content);
				$this->session->set_flashdata('success_msg','Berhasil diedit');
				redirect('/User/dashboard');
			}
			$data['content'] = $this->Login_Model->view_edit($id_content);
			$this->load->view('template/header.php');
			$this->load->view('user/update_form', $data);
			$this->load->view('template/footer.php');
		}

		public function edit_user($id_user){
			$data=array();
			if ($this->input->post('submit')) {
				
				$this->Login_Model->edit_user($id_user);
				$this->session->set_flashdata('success_msg','Berhasil diedit');
				redirect('/User/edit_user');
			}
			$data['user'] = $this->Login_Model->view_user($id_user);
			$this->load->view('template/header.php');
			$this->load->view('template/sidebar.php');
			$this->load->view('user/user_profile.php', $data);
			$this->load->view('template/footer.php');
		}

		public function hapus($id_content){
			$this->Login_Model->hapus($id_content);

			redirect('/User/dashboard');
		}
	}
	?>