<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marca extends CI_Controller {

	public function __construct(){
    parent::__construct();

    $this->load->model('loja_model');
    $this->load->model('loja/marca_model');

  }

	public function index($meta_link=NULL)
	{

    if (!$meta_link) {
      redirect('/', 'refresh');
    }

    $marca = $this->marca_model->getMarca($meta_link);

		$query = $this->loja_model->getDadosLoja();

    if (!$marca) {
      redirect('/', 'refresh');
    }

		$data['titulo'] = 'Produtos da marca, '. $marca->nome_marca;
		$data['dados_loja'] = $query;
    $data['categorias'] = $this->loja_model->getCategorias();
		$data['view'] = 'loja/marca/produtos';
    $data['produtos'] = $this->marca_model->getProdutosMarca($marca->id);;

		$this->load->view('loja/template/index', $data);
	}


}
