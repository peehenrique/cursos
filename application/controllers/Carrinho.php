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

      $json = ['erro' => 0, 'msg' => 'Produto adicionado ao carrinho', 'itens' => $this->carrinhocompra->totalItem()];
      echo json_encode($json);
    }
  }

  public function limpar()
  {

    if ($this->input->post('limpar') == 'true') {
      $this->carrinhocompra->limpa();
      $json = ['erro' => 0];
      echo json_encode($json);
    }
  }

  public function alterar()
  {
    if ($this->input->post('id') && $this->input->post('qtd')) {
      $id = $this->input->post('id');
      $qtd = $this->input->post('qtd');
      
      $this->carrinhocompra->altera($id, $qtd);
      $json = ['erro' => 0];
      echo json_encode($json);
    }
  }

  public function apagar_item()
  {
    if ($this->input->post('id')) {
      $id = $this->input->post('id');
      $this->carrinhocompra->apaga($id);

      $json = ['erro' => 0];
      echo json_encode($json);
    }

  }

  public function getCarrinhoTopo()
  {
    $json = ['erro' => 0, 'itens' => $this->carrinhocompra->totalItem()];
    echo json_encode($json);
  }

}
