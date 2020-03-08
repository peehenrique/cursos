<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model{

  public function getParametrosEnvio()
  {
    $this->db->where('id', 1);
    $this->db->limit(1);
    $query =  $this->db->get('config_correio');
    return $query->row();
  }

  public function getProduto($id=NULL)
  {
    if ($id) {
      $this->db->select('produtos.id,produtos.peso,produtos.altura,produtos.largura,produtos.comprimento');
      $this->db->from('produtos');
      $this->db->where(['id' => $id, 'ativo' => 1]);
      $this->db->limit(1);
      return $this->db->get()->row();
    } else{
      return false;
    }

  }

}
