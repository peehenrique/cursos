<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos_model extends CI_Model{

  public function getProdutos()
  {

    $this->db->select('produtos.*, marca.nome_marca, categorias.nome');
    $this->db->from('produtos');
    $this->db->join('marca', 'marca.id = produtos.id_marca', 'left');
    $this->db->join('categorias', 'categorias.id = produtos.id_categoria', 'left');
    $query = $this->db->get();
    return $query->result();

  }

  public function getMarcas()
  {
    $this->db->where('ativo', 1);
    return $this->db->get('marca')->result();

  }

  public function getCategorias()
  {
    $this->db->where('ativo', 1);
    return $this->db->get('categorias')->result();
  }

  public function doInsert($dados=NULL)
  {
    if (is_array($dados)) {
      $this->db->insert('produtos', $dados);
      if ($this->db->affected_rows() > 0) {
        setMsg('msgCadastro', 'Produto cadastrado com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Nao foi possivel realizar o cadastro', 'erro');
      }
    }
  }

}
