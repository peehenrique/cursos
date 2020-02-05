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

        // PEGAR ID PARA DOWNLOAD DE FOTO
        $last_id = $this->db->insert_id();
        $this->session->set_userdata('last_id', $last_id);

        setMsg('msgCadastro', 'Produto cadastrado com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Nao foi possivel realizar o cadastro', 'erro');
      }
    }
  }

  // ADICIONAR FOTOS
  public function doInsertFoto($dados)
  {
    if (is_array($dados)) {
      $this->db->insert('produtos_fotos', $dados);
    }
  }

  public function getProdutosId($id=NULL)
  {
    if ($id) {
      $this->db->where('id', $id);
      $this->db->limit(1);
      $query = $this->db->get('produtos');
      return $query->row();
    }
  }

  // PEGAR FOTOS DO PRODUTO
  public function getFotosProduto($id=NULL)
  {
    if ($id) {
      $this->db->where('id_produto', $id);
      // $this->db->where('principal', 1);
      return $this->db->get('produtos_fotos')->result();
    }
  }

  public function doUpdate($dados=NULL, $id=NULL)
  {

    if (is_array($dados)) {
      $this->db->update('produtos', $dados, ['id' => $id]);

      if ($this->db->affected_rows() > 0) {
        setMsg('msgCadastro', 'Produto atualizado com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Nao foi possivel atualizar o produto', 'erro');
      }
    }

  }

  public function doDeleteFotoProduto($id=NULL)
  {
    if ($id) {
      $this->db->delete('produtos_fotos', ['id_produto' => $id]);
    }
  }

  public function doDelete($id=NULL)
  {
    if ($id) {
      $this->db->delete('produtos', ['id' => $id]);
      if ($this->db->affected_rows() > 0) {
        setMsg('msgCadastro', 'Produto deletado com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Nao foi possivel deletar o produto', 'erro');
      }
    }
  }

}
