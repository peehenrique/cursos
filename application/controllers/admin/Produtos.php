<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if (!$this->ion_auth->logged_in())
    {
      redirect('admin/login');
    }

    $this->load->model('produtos_model');
  }

  public function index()
  {
    $data['titulo'] = "Produtos";
    $data['view'] = 'admin/produtos/listar';
    $data['produtos'] = $this->produtos_model->getProdutos();

    $this->load->view('admin/template/index', $data);
  }

  public function modulo($id_produto=NULL)
  {
    $dados  = NULL;
    if ($id_produto) {
      $data['titulo'] = "Atualizar produto";
    } else{
      $data['titulo'] = "Novo produto";
    }

    $data['dados'] = $dados;
    $data['view'] = 'admin/produtos/modulo';
    $data['navegacao'] = array('titulo' => 'Lista de produtos', 'link' => 'admin/produtos');
    $data['marcas'] = $this->produtos_model->getMarcas();
    $data['categorias'] = $this->produtos_model->getCategorias();

    $this->load->view('admin/template/index', $data);
  }


  public function core()
  {
    $this->form_validation->set_rules('nome_produto', 'Nome Produto', 'required|trim');
    $this->form_validation->set_rules('valor', 'Valor', 'required|trim');

    if ($this->form_validation->run() == TRUE) {

      $dadosProdutos['nome_produto'] = $this->input->post('nome_produto');
      $dadosProdutos['cod_produto'] = $this->input->post('cod_produto');
      $dadosProdutos['valor'] =  formatoDecimal($this->input->post('valor'));
      $dadosProdutos['peso'] = $this->input->post('peso');
      $dadosProdutos['altura'] = $this->input->post('altura');
      $dadosProdutos['largura'] = $this->input->post('largura');
      $dadosProdutos['comprimento'] = $this->input->post('comprimento');
      $dadosProdutos['informacao'] = $this->input->post('informacao');
      $dadosProdutos['controlar_estoque'] = $this->input->post('controlar_estoque');
      $dadosProdutos['estoque'] = $this->input->post('estoque');
      $dadosProdutos['destaque'] = $this->input->post('destaque');
      $dadosProdutos['ativo'] = $this->input->post('ativo');

      if ($this->input->post('id_marca')) {
        $dadosProdutos['id_marca'] = $this->input->post('id_marca');
      } else{
        $dadosProdutos['id_marca'] = NULL;
      }
      if ($this->input->post('id_categoria')) {
        $dadosProdutos['id_categoria'] = $this->input->post('id_categoria');
      } else{
        $dadosProdutos['id_categoria'] = NULL;
      }

      $this->produtos_model->doInsert($dadosProdutos);
      redirect('admin/produtos/modulo', 'refresh');

    } else{
      $this->modulo();
    }
  }

}
