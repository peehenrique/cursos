<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if (!$this->ion_auth->logged_in())
		{
			redirect('admin/login');
		}
	}

	public function index()
	{
		$data['titulo'] = "Configuracoes";
    $data['view'] = 'admin/config/index';

    $this->load->view('admin/template/index', $data);
	}

}
