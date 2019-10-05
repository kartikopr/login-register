<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	public function getSubMenu()
	{
		$query = "SELECT usm.*, um.menu from user_sub_menu usm
		join user_menu um
		on um.id_menu = usm.id_menu";

		return $this->db->query($query)->result_array();
	}
}
