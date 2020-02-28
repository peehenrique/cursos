<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if (!$this->ion_auth->logged_in())
    {
      redirect('admin/login');
    }

    $this->load->model('marcas_model');

  }

  public function index()
  {
    $data['titulo'] = "Lista de marcas";
    $data['view'] = 'admin/marcas/listar';
    $data['marcas'] = $this->marcas_model->getMarcas();

    $this->load->view('admin/template/index', $data);
  }


    public function modulo($id_marca=NULL)
    {
      $dados = NULL;

      if ($id_marca) {
        $data['titulo'] = "Atualizar marca";

        $dados = $this->marcas_model->getMarcaId($id_marca);

      } else{
        $data['titulo'] = "Nova marca";
      }

      $data['view'] = 'admin/marcas/modulo';
      $data['dados'] = $dados;

      $this->load->view('admin/template/index', $data);

    }

    public function core()
    {
      $this->form_validation->set_rules('nome_marca', 'Nome', 'required|trim');

      if ($this->form_validation->run() == TRUE) {

        $dadosCategorias['nome_marca'] = $this->input->post('nome_marca');
        $dadosCategorias['meta_link'] = slug($this->input->post('nome_marca'));
        $dadosCategorias['ativo'] = $this->input->post('ativo');

        if ($this->input->post('id_marca')) {

          $dadosCategorias['ultima_atualizacao'] = dataDiaDb();
          $id_marca = $this->input->post('id_marca');
          $this->marcas_model->doUpdate($dadosCategorias, $id_marca);
          redirect('admin/marcas', 'refresh');

        } else{
          $this->marcas_model->doInsert($dadosCategorias);
          redirect('admin/marcas/modulo', 'refresh');
        }

      } else{
        $this->modulo();
      }
    }

    public function del($id_marca=NULL)
    {
      if ($id_marca) {
        $this->marcas_model->doDelete($id_marca);
        redirect('admin/marcas', 'refresh');

      } else{
        redirect('admin/marcas', 'refresh');
      }
    }


}
