<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrinho_model extends CI_Model{

  public function getProduto($id_produto=NULL)
  {
    if ($id_produto) {
      $this->db->select('produtos.id, produtos.nome_produto, produtos.valor, produtos.meta_link, produtos.peso, produtos.altura, produtos.largura, produtos.comprimento, produtos_fotos.foto');
      $this->db->from('produtos');
      $this->db->join('produtos_fotos', 'produtos_fotos.id_produto = produtos.id', 'left');
      $this->db->where(['produtos.ativo' => 1, 'produtos.id' => $id_produto, 'produtos_fotos.principal' => 1]);
      $this->db->limit(1);

      return $this->db->get()->row();
    }
  }
}
