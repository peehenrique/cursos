<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marca extends CI_Controller {

	public function __construct(){
    parent::__construct();

    $this->load->model('loja_model');
    $this->load->model('loja/marca_model');
		$this->load->library('carrinhocompra');
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

	public function grandes_marcas(){
		// DADOS DA LOJA
		$query = $this->loja_model->getDadosLoja();

		// MENU TOPO
		$data['categorias'] = $this->loja_model->getCategorias();

		//INFORMACOES DA PAGINA
		$data['titulo'] = 'listar marcas';
		$data['dados_loja'] = $query;
		$data['view'] = 'loja/marca/listar_marcas';
    $data['marcas'] = $this->marca_model->getMarcasListar();

		// CARREGAR TEMPLATE
		$this->load->view('loja/template/index', $data);
	}


}
