<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busca extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->model('loja_model');
    $this->load->model('loja/busca_model');

  }

  public function index($meta_link=NULL)
  {

    $this->form_validation->set_rules('query_busca', 'Buscar', 'required|trim');

    if ($this->form_validation->run() == TRUE) {

      // DADOS DA LOJA
      $query = $this->loja_model->getDadosLoja();

      //MENU TOPO
      $data['categorias'] = $this->loja_model->getCategorias();

      // INFORMACOES DA PAGINA
      $data['titulo'] = 'Busca por:';
      $data['dados_loja'] = $query;
      $data['view'] = 'loja/busca/index';

      $data['produtos'] = $this->busca_model->getBusca($this->input->post('query_busca'));

      $this->load->view('loja/template/index', $data);

    } else{
      redirect('/', 'refresh');
    }


  }

}
