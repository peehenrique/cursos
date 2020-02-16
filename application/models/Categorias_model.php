<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model{

  public function getCategorias()
  {
    return $this->db->get('categorias')->result();
  }

  public function doInsert($dados=NULL)
  {
    if (is_array($dados)) {
      $this->db->insert('categorias', $dados);
      if ($this->db->affected_rows() > 0) {
        setMsg('msgCadastro', 'Categoria cadastrado com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Nao foi possivel realizar o cadastro', 'erro');
      }
    }
  }

  public function getCatPai()
  {
    $this->db->where('id_cat_pai', NULL);
    return $this->db->get('categorias')->result();
  }

  public function getCatPaiNome($id_categoria_pai=NULL)
  {
    if ($id_categoria_pai) {
      $this->db->where('id', $id_categoria_pai);
      $this->db->limit(1);
      $query = $this->db->get('categorias')->row();

      return $query->nome;
    }
  }

  public function getCategoriaId($id_categoria=NULL)
  {
    if ($id_categoria) {
      $this->db->where('id', $id_categoria);
      $query = $this->db->get('categorias');
      return $query->row();
    }
  }

  public function doUpdate($dados=NULL, $id_categoria=NULL)
  {
    if (is_array($dados)) {
      $this->db->update('categorias', $dados, array('id' => $id_categoria));
    }

    if ($this->db->affected_rows() > 0) {
      setMsg('msgCadastro', 'Categoria atualizada com sucesso', 'sucesso');
    } else{
      setMsg('msgCadastro', 'Nao foi possivel atualizar a categoria', 'erro');
    }
  }

  public function doDelete($id_categoria=NULL)
  {
    if ($id_categoria) {
      $this->db->delete('categorias', array('id' => $id_categoria));

      if ($this->db->affected_rows() > 0) {
        setMsg('msgCadastro', 'Categoria deletada com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Nao foi possivel deletar a categoria', 'erro');
      }
    }
  }

  public function getSubCategoria($id=NULL)
  {
    if ($id) {
      $this->db->where('id_cat_pai', $id);
      $query = $this->db->get('categorias');
      if ($query->num_rows() >= 1) {
        return TRUE;
      } else{
        return FALSE;
      }
    }
  }

}
