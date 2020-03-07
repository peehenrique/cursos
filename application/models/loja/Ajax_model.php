<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model{

  public function getParametrosEnvio()
  {
    $this->db->where('id', 1);
    $this->db->limit(1);
    $query =  $this->db->get('config_correio');
    return $query->row();
  }

}
