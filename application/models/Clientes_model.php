<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model{

  public function getClientes()
  {
    return $this->db->get('clientes')->result();
  }

  public function doInsert($dados=NULL)
  {
    if (is_array($dados)) {
      $this->db->insert('clientes', $dados);
      if ($this->db->affected_rows() > 0) {
        setMsg('msgCadastro', 'Cliente cadastrado com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Nao foi possivel realizar o cadastro do cliente', 'erro');
      }
    }
  }

  public function getClientesId($id=NULL)
  {
    if ($id) {
      $this->db->where('id', $id);
      $this->db->limit(1);
      $query = $this->db->get('clientes');
      return $query->row();
    }
  }

  public function doUpdate($dados=NULL, $id_cliente=NULL)
  {
    if (is_array($dados) && $id_cliente) {

      $this->db->update('clientes', $dados, array('id' => $id_cliente));

      if ($this->db->affected_rows() > 0) {
        setMsg('msgCadastro', 'Cliente atualizado com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Nao foi possivel atualizar o cliente', 'erro');
      }
    }
  }

  public function doDelete($id_cliente=NULL)
  {
    if ($id_cliente) {
      $this->db->delete('clientes', array('id' => $id_cliente));
      if ($this->db->affected_rows() > 0) {
        setMsg('msgCadastro', 'Cliente deletado com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Nao foi possivel deletar o cliente', 'erro');
      }
    }
  }

  

}
