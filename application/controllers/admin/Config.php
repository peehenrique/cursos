<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if (!$this->ion_auth->logged_in())
    {
      redirect('admin/login');
    }

    $this->load->helper('form');
    $this->load->model('config_model');
  }

  public function index()
  {
    $this->form_validation->set_rules('titulo', 'Titulo', 'required|trim');

    if ($this->form_validation->run() == TRUE) {

      $dados['titulo'] = $this->input->post('titulo');
      $dados['empresa'] = $this->input->post('empresa');
      $dados['cep'] = $this->input->post('cep');
      $dados['endereco'] = $this->input->post('endereco');
      $dados['bairro'] = $this->input->post('bairro');
      $dados['cidade'] = $this->input->post('cidade');
      $dados['complemento'] = $this->input->post('complemento');
      $dados['estado'] = $this->input->post('estado');
      $dados['email'] = $this->input->post('email');
      $dados['telefone'] = $this->input->post('telefone');
      $dados['p_destaque'] = $this->input->post('p_destaque');
      $dados['data_atualizacao'] = dataDiaDb();

      $this->config_model->doUpdate($dados);
      redirect('admin/config', 'refresh');

    } else{
      $data['titulo'] = "Configuracoes";
      $data['view'] = 'admin/config/index';
      $data['query'] = $this->config_model->getConfig();

      $this->load->view('admin/template/index', $data);
    }
  }

  public function pagseguro()
  {
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('token', 'Token', 'required|trim');

    if ($this->form_validation->run() == TRUE) {

      $dados['email'] = $this->input->post('email');
      $dados['token'] = $this->input->post('token');
      $dados['cartao'] = $this->input->post('cartao');
      $dados['boleto'] = $this->input->post('boleto');
      $dados['transferencia'] = $this->input->post('transferencia');
      $dados['data_atualizacao'] = dataDiaDb();

      $this->config_model->doUpdatePagSeguro($dados);
      redirect('admin/config/pagseguro', 'refresh');

    } else{
      $data['titulo'] = "Configuração do Pag Seguro";
      $data['view'] = 'admin/config/pagseguro';
      $data['query'] = $this->config_model->getConfigPagSeguro();

      $this->load->view('admin/template/index', $data);
    }
  }

  public function correio()
  {

    $this->form_validation->set_rules('cep_origem', 'CEP Origem', 'required|trim');

    if ($this->form_validation->run() == TRUE) {

      $dados['cep_origem'] = str_replace("-", '', $this->input->post('cep_origem'));
      $dados['data_atualizacao'] = dataDiaDb();

      $this->config_model->doUpdateCorreio($dados);
      redirect('admin/config/correio', 'refresh');

    } else{
      $data['titulo'] = "Configuração Correio";
      $data['view'] = 'admin/config/correio';
      $data['query'] = $this->config_model->getConfigCorreio();

      $this->load->view('admin/template/index', $data);
    }



  }

}
