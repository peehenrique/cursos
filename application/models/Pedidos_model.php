<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos_model extends CI_Model{

  public function getPedidos()
  {
    return $this->db->get('pedidos')->result();
  }

  public function getPedidoId($id=NULL)
  {
  $this->db->where('id', $id);
  $this->db->limit(1);
  return $this->db->get('pedidos')->row();
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
