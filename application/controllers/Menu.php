<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('users', ['user_email' => $this->session->userdata('user_email')])
			->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required|trim');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert(
				'user_menu',
				['menu' => $this->input->post('menu')]
			);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			New Menu added</div>');
			redirect('menu');
		}
	}

	public function submenu()
	{
		$data['title'] = 'Sub Menu Management';
		$data['user'] = $this->db->get_where('users', ['user_email' => $this->session->userdata('user_email')])
			->row_array();
		$this->load->model('Menu_model', 'menu');
		$data['submenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('id_menu', 'Menu', 'required|trim');
		$this->form_validation->set_rules('url', 'URL', 'required|trim');
		$this->form_validation->set_rules('icon', 'Icon', 'required|trim');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'id_menu' => $this->input->post('id_menu'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];
			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			New Sub Menu added</div>');
			redirect('menu/submenu');
		}
	}
}
