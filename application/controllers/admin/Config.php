<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if (!$this->ion_auth->logged_in())
    {
      redirect('admin/login');
    }

    $this->load->library('form_validation');
    $this->load->helper('form');
    $this->load->model('config_model');
  }

  public function index()
  {
    $this->form_validation->set_rules('titulo', 'Titulo', 'required|trim');

    if ($this->form_validation->run() == TRUE) {


    } else{
      $data['titulo'] = "Configuracoes";
      $data['view'] = 'admin/config/index';
      $data['query'] = $this->config_model->getConfig();

      $this->load->view('admin/template/index', $data);
    }
  }


}
