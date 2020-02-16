<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if (!$this->ion_auth->logged_in())
    {
      redirect('admin/login');
    }

  }

  public function index()
  {
    redirect('admin/produtos', 'refresh');
  }


}
