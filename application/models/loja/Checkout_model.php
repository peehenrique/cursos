<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout_model extends CI_Model{

  public function getDadosUsuario($id=null)
  {
    if ($id) {
      $this->db->where('id', $id);
      $this->db->limit(1);
      return $this->db->get('clientes')->row();
    }
  }
}
