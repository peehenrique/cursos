<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

    if (!$this->ion_auth->logged_in())
    {
      redirect('admin/login');
    }

    $this->load->model('relatorios_model');
    $this->load->helper('form');

  }

  public function index()
  {
    redirect('admin', 'refresh');
  }

  public function periodo()
  {
    // $this->form_validation->set_rules('data_inicial', 'Data Inicial', 'required|trim');
    // $this->form_validation->set_rules('data_final', 'Data Final', 'required|trim');
    //
    // if ($this->form_validation->run() == TRUE) {
    //   $data_inicial = formataDataDb($this->input->post('data_inicial'));
    //   $data_final = formataDataDb($this->input->post('data_final'));
    //
    //   $query = $this->relatorios_model->getRelatorioPedido([
    //     'data_cadastro >=' => $data_inicial,
    //     'data_cadastro <=' => $data_final
    //   ]);
    //   $this->view_relatorio($query);
    // 
    // } else{
    //
    //   $data['titulo'] = "Relatorio de pedidos por periodo";
    //   $data['view'] = 'admin/relatorios/periodo';
    //
    //   $this->load->view('admin/template/index', $data);
    // }

      $data_inicial = formataDataDb("10/02/2020");
      $data_final = formataDataDb("14/02/2020");

      $query = $this->relatorios_model->getRelatorioPedido([
        'data_cadastro >=' => $data_inicial,
        'data_cadastro <=' => $data_final
      ]);

      $this->view_relatorio($query);
  }

  public function view_relatorio($dados=NULL)
  {
    if ($dados) {
      $data['titulo'] = "Relatorio de pedidos por periodo";
      $data['view'] = 'admin/relatorios/view';
      $data['pedidos'] = $dados;

      $this->load->view('admin/template/index', $data);
    }
  }

  public function diario()
  {
    $data['titulo'] = "Relatórios";
    $data['view'] = 'admin/relatorios/diario';
    $data['config'] = $this->relatorios_model->getDadosLoja();
    $data['dados'] = $this->relatorios_model->getPedido();

    $this->load->view('admin/pedidos/imprimir', $data);
  }

  public function mais_vendidos()
  {
    $data['titulo'] = "Pedidos mais Vendidos";
    $data['view'] = 'admin/relatorios/mais_vendidos';
    $data['config'] = $this->relatorios_model->getDadosLoja();
    $data['produtos'] = $this->relatorios_model->getProdutosMaisVendidos();

    $this->load->view('admin/pedidos/imprimir', $data);
  }

}
