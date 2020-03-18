<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagar_model extends CI_Model{

  public function getConfigPagseguro()
  {
    $this->db->where('id', 1);
    $this->db->limit(1);
    return $this->db->get('config_pagseguro')->row();
  }

  public function getAmbiente()
  {
    $this->db->where('id', 1);
    $this->db->limit(1);
    $query = $this->db->get('config_pagseguro')->row();

    if ($query->ambiente == 1) {
      return 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';
    }else{
      return 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';
    }
  }

  public function doInsertCliente($dados=NULL)
  {
    if (is_array($dados)) {
      $this->db->insert('clientes', $dados);
      $last_id = $this->db->insert_id();
      $this->session->set_userdata('last_id', $last_id);
    }
  }

  public function getClienteId($id=NULL)
  {
    if ($id) {
      $this->db->select('clientes.*, users.email');
      $this->db->from('clientes');
      $this->db->join('users', 'users.id_cliente = clientes.id');
      $this->db->where('clientes.id', $id);
      return $this->db->get()->row();
    }
  }

  public function doInsertPedido($dados=NULL)
  {
    if (is_array($dados)) {
      $this->db->insert('pedidos', $dados);
      $last_id_pedido = $this->db->insert_id();
      $this->session->set_userdata('last_id_pedido', $last_id_pedido);
    }
  }

  public function doInsertPedidoProdutos($dados=NULL)
  {
    if (is_array($dados)) {
      $this->db->insert('pedidos_produtos', $dados);
    }
  }

  public function doInsertPedidoTransacao($dados=NULL)
  {
    if (is_array($dados)) {
      $this->db->insert('transacao', $dados);
    }
  }


}
