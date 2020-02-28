<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct(){
    parent::__construct();

    $this->load->model('loja_model');
    $this->load->model('loja/categoria_model');

  }

	public function index($meta_link=NULL)
	{

    if (!$meta_link) {
      redirect('/', 'refresh');
    }

    $cat = $this->categoria_model->getCategoria($meta_link);

		$query = $this->loja_model->getDadosLoja();

    if (!$cat) {
      redirect('/', 'refresh');
    }

		$data['titulo'] = 'Produtos da categoria, '. $cat->nome;
		$data['dados_loja'] = $query;
    $data['categorias'] = $this->loja_model->getCategorias();
		$data['view'] = 'loja/categoria/produtos';
    $data['produtos'] = $this->categoria_model->getProdutosCategorias($cat->id);;

		$this->load->view('loja/template/index', $data);
	}


}
