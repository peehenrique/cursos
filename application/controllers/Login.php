<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct(){
    parent::__construct();
  }

  public function index()
  {
    $this->form_validation->set_rules('email', 'E-mail', 'required');
    $this->form_validation->set_rules('senha', 'Senha', 'required');

    if ($this->form_validation->run() == TRUE) {

      $identity = $this->input->post('email');
      $password = $this->input->post('senha');
      $remember = ($this->input->post('manter_conectado') != NULL ? TRUE : FALSE);

      if ($this->ion_auth->login($identity, $password, $remember)) {

        echo "usuario logado";

      } else{
        redirect('login','refresh');
      }

    } else{
      $this->load->view('loja/login/index');
    }
  }

  public function sair(){
    $this->ion_auth->logout();
    redirect('admin/login','refresh');
  }

}
