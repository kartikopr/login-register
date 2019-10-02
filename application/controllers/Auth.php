<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Login';
		$this->load->view('templates/auth_header', $data);
		$this->load->view('auth/login');
		$this->load->view('templates/auth_footer');
	}

	public function registration()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.user_email]', [
			'is_unique' => 'This email has already registered'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'matches' => 'Password do not match!',
			'min_length' => 'Password too short'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = 'User Registration';

			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'user_name' => $this->input->post('name'),
				'user_email' => $this->input->post('email'),
				'user_image' => 'default.jpg',
				'user_password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'user_role_id' => 2,
				'is_active' => 1,
				'create_date' => time(),
			];

			$this->db->insert('users', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Account has been created</div>');
			redirect('auth');
		}
	}
}
