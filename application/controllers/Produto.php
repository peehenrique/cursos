<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produto extends CI_Controller {

	public function __construct(){
    parent::__construct();

    $this->load->model('loja_model');
    $this->load->model('loja/produto_model');
		$this->load->library('carrinhocompra');


  }

	public function index($meta_link=NULL)
	{

    if (!$meta_link) {
      redirect('/', 'refresh');
    }

		$query = $this->loja_model->getDadosLoja();

    $produto = $this->produto_model->getProdutoMetaLink($meta_link);

    if (!$produto) {
      redirect('/', 'refresh');
    }

		$data['titulo'] = $produto->nome_produto;
		$data['dados_loja'] = $query;
		$data['categorias'] = $this->loja_model->getCategorias();
		$data['view'] = 'loja/produto/info';
    $data['produto'] = $produto;
    $data['fotos'] = $this->produto_model->getFotos($produto->id);

		$this->load->view('loja/template/index', $data);
	}

}
