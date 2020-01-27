<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_model extends CI_Model{

  public function getConfig()
  {
    $this->db->where('id', 1);
    $this->db->limit(1);
    $query =  $this->db->get('config');
    return $query->row();
  }

  public function doUpdate($dados=NULL)
  {
    if (is_array($dados)) {
      $this->db->update('config', $dados, array('id' => 1));
      if ($this->db->affected_rows() > 0) {
        setMsg('msgCadastro', 'Configuracao atualizda com sucesso', 'sucesso');
      } else{
        setMsg('msgCadastro', 'Erro ao atualizar configuracao', 'erro');
      }
    }
  }
}
