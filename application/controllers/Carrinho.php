<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrinho extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->model('loja_model');
    $this->load->library('carrinhocompra');
  }

  public function index()
  {

    $query = $this->loja_model->getDadosLoja();

    $data['titulo'] = 'Carrinho de compra';
    $data['dados_loja'] = $query;
    $data['categorias'] = $this->loja_model->getCategorias();
    $data['view'] = 'loja/carrinho/index';
    $data['carrinho'] = $this->carrinhocompra->listarProdutos();

    $this->load->view('loja/template/index', $data);
  }

  public function add($id)
  {
    $this->carrinhocompra->add($id, 1);
    redirect('/', 'refresh');
  }

  public function addProduto()
  {
    if ($this->input->post('id')) {
      $id = $this->input->post('id');
      $qtd = 1;
      $this->carrinhocompra->add($id, $qtd);

      $json = ['erro' => 0, 'msg' => 'Produto adicionado ao carrinho'];
      echo json_encode($json);
    }
  }

  public function limpar()
  {
    $this->carrinhocompra->limpa();
    redirect('/', 'refresh');
  }

  public function alterar()
  {
    $this->carrinhocompra->altera(42, 5);
  }

  public function apagar_item()
  {
    $this->carrinhocompra->apaga(43);
  }



}
