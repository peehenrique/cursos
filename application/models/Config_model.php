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
}
