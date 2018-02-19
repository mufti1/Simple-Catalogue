<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->database();
		$this->load->model('Admin_Model');
	}
	public function index(){

		$this->load->view('template/header.php');
		$this->load->view('template/sidebar-admin.php');
		$this->load->view('admin/dashboard');
		$this->load->view('template/footer.php');		
	}

	//controller untuk ngemanage user

	public function userlist(){
		$config['base_url'] = base_url()."admin/userlist/";
		$config['total_rows'] = $this->db->query("SELECT * FROM user;")->num_rows();
		$config['per_page']=3;
		$config['num_links'] = 2;
		$config['uri_segment']=3;
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
		
		$data['user']=$this->Admin_Model->view_user($config);

		$this->load->view('template/header.php');
		$this->load->view('template/sidebar-admin.php');
		$this->load->view('admin/user-list', $data);
		$this->load->view('template/footer.php');	
	}

	public function delete_user($id_user){
		$this->Admin_Model->delete_user($id_user);
		redirect('admin/userlist','refresh');
	}

	public function edit_user($id_user){
		if ($this->input->post('submit')) {
			$this->Admin_Model->edit_user($id_user);
			$this->session->set_flashdata('success_msg','Berhasil diedit');
			redirect('/admin/userlist');
		}
		$data['user'] = $this->Admin_Model->view_edit_user($id_user);
		$this->load->view('template/header.php');
		$this->load->view('admin/view-user', $data);
		$this->load->view('template/footer.php');
	}
	//permintaan user

	public function approval(){
		$data['user_temp'] = $this->Admin_Model->view_temp();
		$data['user'] = $this->Admin_Model->kode();
		$this->load->view('template/header.php');
		$this->load->view('template/sidebar-admin.php');
		$this->load->view('admin/user-approval', $data);
		$this->load->view('template/footer.php');	
	}
	public function approve(){
		$id_user = $this->input->post('usr');
		$this->Admin_Model->approve();
		$this->Admin_Model->delete_temp($id_user);
		redirect('/admin/userlist','refresh');
	}
	public function delete_temp($id_user){
		$this->Admin_Model->delete_temp($id_user);
		redirect('/admin/approval','refresh');
	}

	//bagian untuk manage katalog

	public function kataloglist(){
		$config['base_url'] = base_url()."admin/kataloglist/";
		$config['total_rows'] = $this->db->query("SELECT * FROM content;")->num_rows();
		$config['per_page']=3;
		$config['num_links'] = 2;
		$config['uri_segment']=3;
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
		
		$data['content']=$this->Admin_Model->view_katalog($config);

		$this->load->view('template/header.php');
		$this->load->view('template/sidebar-admin.php');
		$this->load->view('admin/katalog-list', $data);
		$this->load->view('template/footer.php');
	}

	public function delete_katalog($id_content){
		$this->Admin_Model->delete_katalog($id_content);
		redirect('admin/kataloglist','refresh');
	}

	public function edit_katalog($id_content){
		if ($this->input->post('submit')) {
			$this->Admin_Model->edit_katalog($id_content);
			$this->session->set_flashdata('success_msg','Berhasil diedit');
			redirect('/admin/kataloglist');
		}
		$data['content'] = $this->Admin_Model->view_edit_katalog($id_content);
		$this->load->view('template/header.php');
		$this->load->view('admin/update_form', $data);
		$this->load->view('template/footer.php');
	}
}
?>