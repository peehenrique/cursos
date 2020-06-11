<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('loja_model');
    $this->load->library('carrinhocompra');
    $this->load->model('loja/checkout_model');


  }

  public function index()
  {

    if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(2))
    {
      redirect('');
    }

    $this->form_validation->set_rules('email', 'E-mail', 'required');
    $this->form_validation->set_rules('senha', 'Senha', 'required');

    if ($this->form_validation->run() == TRUE) {

      $identity = $this->input->post('email');
      $password = $this->input->post('senha');
      $remember = ($this->input->post('manter_conectado') != NULL ? TRUE : FALSE);

      if ($this->ion_auth->login($identity, $password, $remember)) {

        if ($this->ion_auth->in_group(2)) {

          if ($this->carrinhocompra->totalItem() != 0) {
            redirect('checkout', 'refresh');
          } else{
            redirect('', 'refresh');
          }

        } else{
          $this->ion_auth->logout();
          redirect('/','refresh');
        }


      } else{
        redirect('login','refresh');
      }

    } else{
      $query = $this->loja_model->getDadosLoja();
      $data['titulo'] = "Tela de login";
      $data['dados_loja'] = $query;
      $data['categorias'] = $this->loja_model->getCategorias();
      $data['view'] = 'loja/login/index';

      $this->load->view('loja/template/index', $data);
    }


  }

  public function sair(){
    $this->ion_auth->logout();
    redirect('/','refresh');
  }

  public function esqueceu()
  {
    //Working code for this example is in the example Auth controller in the github repo

    $this->form_validation->set_rules('email', 'Email Address', 'required');
    if ($this->form_validation->run() == false) {
      //setup the input
      $this->data['email'] = array('name'    => 'email',
      'id'      => 'email',
    );
    //set any errors and display the form
    $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
  }
  else {
    //run the forgotten password method to email an activation code to the user
    $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

    if ($forgotten) { //if there were no errors
      $this->session->set_flashdata('message', $this->ion_auth->messages());
      echo "<pre>";
      print_r($forgotten['forgotten_password_code']);
      exit;
      //ENVIAR O CODIGO POR Email
      // fTLlApE2jhTPsjUmn597nOb610c2ddb3e8f7c6a6
      //$forgotten['forgotten_password_code']
    }
    else {
      $this->session->set_flashdata('message', $this->ion_auth->errors());
      redirect("login", 'refresh');
    }
  }

  $query = $this->loja_model->getDadosLoja();
  $data['titulo'] = "Tela de login";
  $data['dados_loja'] = $query;
  $data['categorias'] = $this->loja_model->getCategorias();
  $data['view'] = 'loja/login/esqueceu';

  $this->load->view('loja/template/index', $data);
}

public function codigo()
{
  $data['view'] = 'loja/login/codigo';

  $codigo = $this->input->post('codigo');

  $this->form_validation->set_rules('codigo', 'Codigo', 'required|trim');

  if ($this->form_validation->run()) {
    // code...

    $user = $this->ion_auth->forgotten_password_check($codigo);
    if ($user)
    {
      $data['view'] = 'loja/login/recuperar';
      $data['user'] = $user;

    }
  }

  $query = $this->loja_model->getDadosLoja();
  $data['titulo'] = "Tela de login";
  $data['dados_loja'] = $query;
  $data['categorias'] = $this->loja_model->getCategorias();
  $this->load->view('loja/template/index', $data);
}

public function recuperar()
{
  if ($this->input->post('senha')) {
    $id = $this->input->post('id_usuario');
    $data = array(
          'password' => $this->input->post('senha')
           );

      $this->ion_auth->update($id, $data);
      redirect('login', 'refresh');

  }
}

}
