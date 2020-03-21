<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos_model extends CI_Model{

public function listarPedidos($id=null)
{
  if ($id) {
    $this->db->select('pedidos.*, transacao.*, pedidos_produtos.*');
    $this->db->from('pedidos');
    $this->db->where('pedidos.id_cliente', $id);
    $this->db->join('transacao', 'transacao.id_pedido = pedidos.id', 'left');
    $this->db->join('pedidos_produtos', 'pedidos_produtos.id_pedido = pedidos.id', 'left');
    return $this->db->get()->result();
  }
}

}
