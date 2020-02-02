<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas_model extends CI_Model{

  public function getMarcas()
  {
    return $this->db->get('marca')->result();
  }

  public function doInsert($dados=NULL)
  {
    if (is_array($dados)) {
      $this->db->insert('marca', $dados);
      if ($this->db->affected_rows() > 0) {
        setMsg('msgCadastro', 'Marca cadastrado com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Nao foi possivel realizar o marca', 'erro');
      }
    }
  }

  public function getMarcaId($id_marca=NULL)
  {
    if ($id_marca) {
      $this->db->where('id', $id_marca);
      $query = $this->db->get('marca');
      return $query->row();
    }
  }

  public function doUpdate($dados=NULL, $id_marca=NULL)
  {
    if (is_array($dados)) {
      $this->db->update('marca', $dados, array('id' => $id_marca));
    }

    if ($this->db->affected_rows() > 0) {
      setMsg('msgCadastro', 'Marca atualizada com sucesso', 'sucesso');
    } else{
      setMsg('msgCadastro', 'Nao foi possivel atualizar a marca', 'erro');
    }
  }

  public function doDelete($id_marca=NULL)
  {
    if ($id_marca) {
      $this->db->delete('marca', array('id' => $id_marca));

      if ($this->db->affected_rows() > 0) {
        setMsg('msgCadastro', 'Marca deletada com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Nao foi possivel deletar a marca', 'erro');
      }
    }
  }
}
