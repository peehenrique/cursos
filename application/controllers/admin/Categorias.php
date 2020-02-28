<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if (!$this->ion_auth->logged_in())
    {
      redirect('admin/login');
    }

    $this->load->model('categorias_model');

  }
  public function index()
  {
    $data['titulo'] = "Lista de categorias";
    $data['view'] = 'admin/categorias/listar';
    $data['categorias'] = $this->categorias_model->getCategorias();

    $this->load->view('admin/template/index', $data);
  }

  public function modulo($id_categoria=NULL)
  {
    $dados = NULL;

    if ($id_categoria) {
      $data['titulo'] = "Atualizar categoria";
      $dados = $this->categorias_model->getCategoriaId($id_categoria);
      if (!$dados) {
        setMsg("msgCadastro", "Categoria nao encontrada", "erro");
        redirect('admin/categorias', 'refresh');
      }


    } else{
      $data['titulo'] = "Nova categoria";
    }

    $data['view'] = 'admin/categorias/modulo';
    $data['dados'] = $dados;
    $data['cat_pai'] = $this->categorias_model->getCatPai();

    $this->load->view('admin/template/index', $data);

  }

  public function core()
  {
    $this->form_validation->set_rules('nome', 'Nome', 'required|trim');

    if ($this->form_validation->run() == TRUE) {

      $dadosCategorias['nome'] = $this->input->post('nome');
      $dadosCategorias['ativo'] = $this->input->post('ativo');
      $dadosCategorias['meta_link'] = slug($this->input->post('nome'));

      if ($this->input->post('id_cat_pai')) {
        $dadosCategorias['id_cat_pai'] = $this->input->post('id_cat_pai');
      } else{
        $dadosCategorias['id_cat_pai'] = NULL;
      }

      if ($this->input->post('id_categoria')) {

        $dadosCategorias['ultima_atualizacao'] = dataDiaDb();
        $id_categoria = $this->input->post('id_categoria');
        $this->categorias_model->doUpdate($dadosCategorias, $id_categoria);
        redirect('admin/categorias', 'refresh');

      } else{
        $this->categorias_model->doInsert($dadosCategorias);
        redirect('admin/categorias/modulo', 'refresh');
      }

    } else{
      $this->modulo();
    }
  }

  public function del($id_categoria=NULL)
  {
    if ($id_categoria) {

      if ($this->categorias_model->getSubCategoria($id_categoria)) {
        setMsg('msgCadastro', 'A categoria nao pode ser apagada', 'erro');
        redirect('admin/categorias', 'refresh');
      }

      $this->categorias_model->doDelete($id_categoria);
      redirect('admin/categorias', 'refresh');

    } else{
      redirect('admin/categorias', 'refresh');
    }
  }

}
