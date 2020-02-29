<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busca_model extends CI_Model{

  public function getBusca($query=NULL)
  {
    if ($query) {
      $this->db->select('produtos.nome_produto, produtos.valor, produtos.meta_link, produtos.cod_produto');
      $this->db->from('produtos');
      $this->db->where(['produtos.ativo' => 1]);
      $this->db->like('produtos.nome_produto', $query, 'both');
      $this->db->or_like('produtos.cod_produto', $query, 'both');
      $this->db->or_like('produtos.valor', $query, 'both');
      return $this->db->get()->result();
    }
  }

}
