<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos_model extends CI_Model{

  public function getPedidos()
  {
    $this->db->select('pedidos.*, status_pedido.*');
    $this->db->from('pedidos');
    $this->db->join('status_pedido', 'status_pedido.id_status = pedidos.id_status');
    return $this->db->get()->result();
  }

  public function getPedidoId($id=NULL)
  {

  $this->db->where('id', $id);
  $this->db->limit(1);
  $this->db->select('pedidos.*, status_pedido.*');
  $this->db->from('pedidos');
  $this->db->join('status_pedido', 'status_pedido.id_status = pedidos.id_status');
  return $this->db->get()->row();
  }

  public function doUpdate($dados=NULL, $id_pedido=NULL)
  {
    if (is_array($dados)) {
      $this->db->update('pedidos', $dados, ['id' => $id_pedido]);
    }
  }

  public function getDadosLoja()
  {
    $this->db->select('config.empresa, config.telefone, config.email');
    $this->db->from('config');
    $this->db->where('id', 1);
    $this->db->limit(1);
    return $this->db->get()->row();
  }

  public function getItens($id=NULL)
  {
    if ($id) {
      $this->db->where('id_pedido', $id);
      return $this->db->get('pedidos_item')->result();
    }
  }

}
