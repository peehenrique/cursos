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

}
