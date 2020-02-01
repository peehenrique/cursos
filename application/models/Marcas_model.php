<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas_model extends CI_Model{

  public function getMarcas()
  {
    return $this->db->get('marca')->result();
  }
  
}
