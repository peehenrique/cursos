<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if (!$this->ion_auth->logged_in())
    {
      redirect('admin/login');
    }

    $this->load->model('clientes_model');
    $this->load->helper('form');

  }

  public function index()
  {
    $data['titulo'] = "Lista de clientes";
    $data['view'] = 'admin/clientes/listar';
    $data['clientes'] = $this->clientes_model->getClientes();
    $this->load->view('admin/template/index', $data);
  }

  public function modulo($id_cliente=NULL)
  {
    $dados = NULL;

    if ($id_cliente) {

      $dados = $this->clientes_model->getClientesId($id_cliente);

      if (!$dados) {
        setMsg('msgCadastro', 'Cliente nao econtrado', 'erro');
        redirect('admin/clientes', 'refresh');
      }

      $data['titulo'] = 'Atualizar cliente';
    } else{
      $data['titulo'] = 'Novo cliente';
    }

    $data['dados'] = $dados;
    $data['view'] = 'admin/clientes/modulo';
    $data['navegacao'] = array('titulo' => 'Lista clientes', 'link' => 'admin/clientes');

    $this->load->view('admin/template/index', $data);
  }

  public function core()
  {

    $this->form_validation->set_rules('nome', 'Nome', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

    if ($this->form_validation->run() == TRUE) {

      $dadosCliente['nome'] = $this->input->post('nome');
      $dadosCliente['cpf'] = $this->input->post('cpf');
      $dadosCliente['data_nascimento'] = formataDataDb($this->input->post('data_nascimento'));
      $dadosCliente['telefone'] = $this->input->post('telefone');
      $dadosCliente['email'] = $this->input->post('email');
      $dadosCliente['senha'] = $this->input->post('senha');
      $dadosCliente['ativo'] = $this->input->post('ativo');

      if ($this->input->post('id_cliente')) {
        $dadosCliente['ultima_atualizacao'] = dataDiaDb();
        $this->clientes_model->doUpdate($dadosCliente, $this->input->post('id_cliente'));
        redirect('admin/clientes', 'refresh');

      } else{
        $dadosCliente['data_cadastro'] = dataDiaDb();
        $this->clientes_model->doInsert($dadosCliente);
        redirect('admin/clientes/modulo', 'refresh');
      }

    } else{
      $this->modulo();
    }

  }

  public function del($id_cliente=NULL)
  {
    if ($id_cliente) {
      $this->clientes_model->doDelete($id_cliente);
      setMsg("msgCadastro", "Cliente deletado com sucesso", "sucesso");
      redirect('admin/clientes', 'refresh');

    } else{
      setMsg("msgCadastro", "Nao foi possivel deletar o cliente", "erro");
      redirect('admin/clientes', 'refresh');
    }
  }

}
