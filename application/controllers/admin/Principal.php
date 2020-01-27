<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if (!$this->ion_auth->logged_in())
		{
			redirect('admin/login');
		}
	}

	public function index()
	{
		$data['titulo'] = "Principal";
		$this->load->view('admin/template/index', $data);
	}

}
