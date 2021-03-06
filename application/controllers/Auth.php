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
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('users', ['user_email' => $email])->row_array();

		if ($user) {

			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['user_password'])) {
					$data = [
						'user_email' => $user['user_email'],
						'user_role_id' => $user['user_role_id']
					];

					$this->session->set_userdata($data);
					if ($data['user_role_id'] == 1) {
						redirect('admin');
					} else {

						redirect('user');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Wrong password!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				This email has not been activated!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Email is not registered!</div>');
			redirect('auth');
		}
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
				'user_name' => htmlspecialchars($this->input->post('name', true)),
				'user_email' => htmlspecialchars($this->input->post('email', true)),
				'user_image' => 'default.jpg',
				'user_password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
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

	public function logout()
	{
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('user_role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			You have been logged out</div>');
		redirect('auth');
	}
}
