<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller{

  public function __construct(){
    parent::__construct();

    if (!$this->ion_auth->logged_in())
    {
      redirect('admin/login');
    }

    $this->load->model('pedidos_model');
    $this->load->helper('form');
  }

  function index()
  {
    $data['titulo'] = "Lista Pedidos";
    $data['view'] = 'admin/pedidos/listar';
    $data['pedidos'] = $this->pedidos_model->getPedidos();
    $this->load->view('admin/template/index', $data);
  }

  public function getPedido($id=NULL)
  {
    if (!$id) {
      $retorno['erro'] = 58;
      $retorno['msg'] = "Erro, vc deve informar uma ID valida";
      echo json_encode($retorno);
      exit;
    }

    $query = $this->pedidos_model->getPedidoId($id);
    if (!$query) {
      $retorno['erro'] = 59;
      $retorno['msg'] = "Erro, nao foi encontrado nenhum pedido com a ID informada";
      echo json_encode($retorno);
      exit;
    }

    $retorno['erro'] = 0;
    $retorno['id_pedido'] = $query->id;
    $retorno['status'] = $query->status;
    $retorno['email'] = $query->email;
    echo json_encode($retorno);
    exit;
  }
}
