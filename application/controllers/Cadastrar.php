<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastrar extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('loja_model');
    $this->load->library('carrinhocompra');
    $this->load->model('loja/checkout_model');
  }

  public function index()
  {
    $this->form_validation->set_rules('email', 'E-mail', 'required');
    $this->form_validation->set_rules('nome', 'Nome', 'required');
    $this->form_validation->set_rules('senha', 'Senha', 'required');

    if ($this->form_validation->run() == TRUE) {

      $username = $this->input->post('nome');;
      $password = $this->input->post('senha');;
      $email = $this->input->post('email');;
      $additional_data = array();
      $group = array('2'); // Sets user to admin.

      $this->ion_auth->register($username, $password, $email, $additional_data, $group);

      $this->ion_auth->login($email, $password);

      redirect('/','refresh');


    } else{
      $query = $this->loja_model->getDadosLoja();
      $data['titulo'] = "Tela de login";
      $data['dados_loja'] = $query;
      $data['categorias'] = $this->loja_model->getCategorias();
      $data['view'] = 'loja/cadastro/index';

      $this->load->view('loja/template/index', $data);
    }


  }

}
