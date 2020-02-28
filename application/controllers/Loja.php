<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loja extends CI_Controller {

	public function __construct(){
    parent::__construct();

    $this->load->model('loja_model');

  }

	public function index()
	{
		$query = $this->loja_model->getDadosLoja();
		$data['titulo'] = $query->titulo;
		$data['dados_loja'] = $query;
		$data['categorias'] = $this->loja_model->getCategorias();
		$data['view'] = 'loja/vitrine/home';
		$data['destaques'] = $this->loja_model->getProdutosDestaque($query->p_destaque);

		$this->load->view('loja/template/index', $data);
	}



}
