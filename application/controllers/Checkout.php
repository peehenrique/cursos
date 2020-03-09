<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct(){
    parent::__construct();

    $this->load->model('loja_model');
    $this->load->library('carrinhocompra');
    $this->load->model('loja/checkout_model');

  }

	public function index()
	{
		$query = $this->loja_model->getDadosLoja();
		$data['titulo'] = $query->titulo;
		$data['dados_loja'] = $query;
		$data['categorias'] = $this->loja_model->getCategorias();
		$data['view'] = 'loja/checkout/home';

		$this->load->view('loja/template/index', $data);
	}

  public function login()
  {
    $query = $this->loja_model->getDadosLoja();
    $data['titulo'] = "Tela de login";
    $data['dados_loja'] = $query;
    $data['categorias'] = $this->loja_model->getCategorias();
    $data['view'] = 'loja/checkout/login';

    $this->load->view('loja/template/index', $data);
  }

}
