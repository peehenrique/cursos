<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marca_model extends CI_Model{

  public function getProdutosMarca($id_marca=NULL)
  {
    if ($id_marca) {
      $this->db->select('produtos.nome_produto, produtos.valor, produtos.meta_link, produtos_fotos.foto');
      $this->db->from('produtos');
      $this->db->join('produtos_fotos', 'produtos_fotos.id_produto = produtos.id', 'left');
      $this->db->where(['produtos.ativo' => 1, 'produtos.id_marca' => $id_marca, 'produtos_fotos.principal' => 1]);
      $this->db->order_by('produtos.id', 'RANDOM');
      // $this->db->group_by('produtos.id');
      $this->db->distinct();
      return $this->db->get()->result();
    }
  }

  public function getMarca($meta_link)
  {
    $this->db->where(['meta_link' => $meta_link, 'ativo' => 1]);
    $this->db->limit(1);
    return $this->db->get('marca')->row();
  }

  public function getFotos($id_produto)
  {
    $this->db->where('id_produto', $id_produto);
    return $this->db->get('produtos_fotos')->result();
  }

  public function getMarcasListar()
  {
    $this->db->where('ativo', 1);
    return $this->db->get('marca')->result();
  }

}
