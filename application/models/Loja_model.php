<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loja_model extends CI_Model{

  public function getDadosLoja(){
    $this->db->where('id', 1);
    return $this->db->get('config')->row();
  }

  public function getCategorias()
  {
    $this->db->where(['ativo' => 1, 'id_cat_pai' => NULL]);
    return $this->db->get('categorias')->result();
  }

  public function getSubCategoria($id=NULL)
  {
    if ($id) {
      $this->db->where(['ativo' => 1, 'id_cat_pai' => $id]);
      return $this->db->get('categorias')->result();
    } else{
      return false;
    }
  }

  public function getProdutosDestaque($total_destaque=NULL)
  {
    if ($total_destaque) {
      $this->db->select('produtos.nome_produto, produtos.valor, produtos.meta_link, produtos_fotos.foto');
      $this->db->from('produtos');
      $this->db->join('produtos_fotos', 'produtos_fotos.id_produto = produtos.id', 'left');
      $this->db->where(['produtos.ativo' => 1, 'produtos.destaque' => 1]);
      $this->db->limit($total_destaque);
      $this->db->order_by('produtos.id', 'RANDOM');
      $this->db->group_by('produtos.id');
      return $this->db->get()->result();
    }
  }

}
