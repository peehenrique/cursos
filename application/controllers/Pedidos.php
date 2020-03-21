<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('loja_model');
    $this->load->model('loja/pedidos_model');
    $this->load->library('carrinhocompra');

    if (!$this->ion_auth->logged_in())
    {
      redirect('login');
    }

  }

  public function index()
  {
    $data['user'] = $this->ion_auth->user()->row();

    $data['pedidos'] = $this->pedidos_model->listarPedidos($data['user']->id_cliente);

    $query = $this->loja_model->getDadosLoja();
    $data['titulo'] = "Pedidos";
    $data['dados_loja'] = $query;
    $data['categorias'] = $this->loja_model->getCategorias();
    $data['view'] = 'loja/pedidos/listar';

    $this->load->view('loja/template/index', $data);

  }

}
