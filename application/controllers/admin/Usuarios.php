<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if (!$this->ion_auth->logged_in())
    {
      redirect('admin/login');
    }
    $this->load->library('form_validation');

  }

  public function index()
  {
    $data['titulo'] = "Lista de usuarios";
    $data['view'] = 'admin/usuarios/listar';
    $data['usuarios'] = $this->ion_auth->users()->result(); // get all users

    $this->load->view('admin/template/index', $data);
  }

  public function modulo($id=NULL)
  {
    $dados = NULL;

    if ($id) {

      $dados = $this->ion_auth->user($id)->row();

      if (!$dados) {
        setMsg('msgCadastro', 'Usuario nao econtrado', 'erro');
        redirect('admin/usuarios', 'refresh');
      }

      $data['titulo'] = 'Atualizar cadastro';
    } else{
      $data['titulo'] = 'Novo cadastro';
    }

    $data['dados'] = $dados;
    $data['view'] = 'admin/usuarios/modulo';
    $data['navegacao'] = array('titulo' => 'Lista usuarios', 'link' => 'admin/usuarios');

    $this->load->view('admin/template/index', $data);
  }

  public function core()
  {
    $this->form_validation->set_rules('nome', 'Nome', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    if (!$id = $this->input->post('id_usuario')) {
      // code...
      $this->form_validation->set_rules('senha', 'Senha', 'required|trim');
    }

    if ($this->form_validation->run() == TRUE) {
      $username = $this->input->post('nome');
      $password = $this->input->post('senha');
      $email =  $this->input->post('email');
      $additional_data = NULL;
      $group = array('1'); // Sets user to admin

      if ($this->input->post('id_usuario')) {

        // atualizar usuario

        $id = $this->input->post('id_usuario');
        $data['username'] = $this->input->post('nome');
        $data['email'] = $this->input->post('email');
        $data['active'] = $this->input->post('ativo');

        if ($this->input->post('senha')) {
          $data['password'] = $this->input->post('senha');
        }

        if ($this->ion_auth->update($id, $data)) {
          // code...
          setMsg('msgCadastro', 'Atualizado com sucesso', 'sucesso');
          redirect('admin/usuarios', 'refresh');
        } else{
          setMsg('msgCadastro', 'Nao foi possivel atualizar o usuario', 'erro');
          redirect('admin/usuarios', 'refresh');
        }

      } else{
        // cadastrar novo usuario
        if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {

          setMsg('msgCadastro', 'Usuario cadastrado com sucesso', 'sucesso');
          redirect('admin/usuarios/modulo', 'refresh');
        } else{
          setMsg('msgCadastro', 'Nao foi possivel cadastrar o usuario', 'erro');
          redirect('admin/usuarios', 'refresh');
        }
      }

    } else{
      $this->modulo();
    }
  }


  public function del($id_usuario=NULL)
  {
    if ($id_usuario) {
      // code...
      if ($id_usuario == 1) {
        setMsg('msgCadastro', 'Nao foi possivel apagar o admin', 'erro');
        redirect('admin/usuarios', 'refresh');
      }

      if ($id_usuario == $this->session->userdata('user_id')) {
        setMsg('msgCadastro', 'Voce nao pode apagar o seu usuario', 'erro');
        redirect('admin/usuarios', 'refresh');
      }

      if ($this->ion_auth->delete_user($id_usuario)) {
        // code...
        setMsg('msgCadastro', 'Usuario apagado com sucesso', 'sucesso');
        redirect('admin/usuarios/', 'refresh');
      } else{
        setMsg('msgCadastro', 'Erro ao apagar o usuario', 'erro');
        redirect('admin/usuarios', 'refresh');
      }

    } else{
      setMsg('msgCadastro', 'Voce precisa selecionar um usuario', 'erro');
      redirect('admin/usuarios', 'refresh');
    }

  }


}
