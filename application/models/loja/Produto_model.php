<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produto_model extends CI_Model{


  public function getProdutoMetaLink($meta_link)
  {
    $this->db->select('produtos.*, marca.nome_marca, marca.meta_link as marca_meta_link, categorias.nome as nome_categoria, categorias.meta_link as categoria_meta_link');
    $this->db->from('produtos');
    $this->db->join('categorias', 'categorias.id = produtos.id_categoria', 'left');
    $this->db->join('marca', 'marca.id = produtos.id_marca', 'left');
    $this->db->where(['produtos.ativo' => 1, 'produtos.meta_link' => $meta_link]);
    $this->db->limit(1);
    return $this->db->get()->row();
  }

  public function getFotos($id_produto)
  {
    $this->db->where('id_produto', $id_produto);
    return $this->db->get('produtos_fotos')->result();
  }

}
