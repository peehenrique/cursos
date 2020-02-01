<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if (!$this->ion_auth->logged_in())
    {
      redirect('admin/login');
    }

    $this->load->model('marcas_model');

  }

  public function index()
  {
    $data['titulo'] = "Lista de marcas";
    $data['view'] = 'admin/marcas/listar';
    $data['marcas'] = $this->marcas_model->getMarcas();

    $this->load->view('admin/template/index', $data);
  }

  public function modulo($id_marca=NULL)
  {

  }

  public function core()
  {

  }

  public function del($id_marca=NULL)
  {

  }

}
