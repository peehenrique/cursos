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
    $fotos = NULL;
    if ($id_produto) {
      $data['titulo'] = "Atualizar produto";
      $query = $this->produtos_model->getProdutosId($id_produto);

      if ($query) {
        $dados = $query;
        $fotos = $this->produtos_model->getFotosProduto($query->id);

      } else{
        setMsg('msgCadastro', 'Produto nao encontrado , tente novamente', 'erro');
        redirect('admin/produtos', 'refresh');
      }


    } else{
      $data['titulo'] = "Novo produto";
    }

    $data['dados'] = $dados;
    $data['view'] = 'admin/produtos/modulo';
    $data['navegacao'] = array('titulo' => 'Lista de produtos', 'link' => 'admin/produtos');
    $data['marcas'] = $this->produtos_model->getMarcas();
    $data['categorias'] = $this->produtos_model->getCategorias();
    $data['fotos'] = $fotos;

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

      if ($this->input->post('id_produto')) {

        //PEGANDO O ID DO PRODUTO VIA POST
        $id_produto = $this->input->post('id_produto');

        $dadosProdutos['ultima_atualizacao'] = dataDiaDb();
        $this->produtos_model->doUpdate($dadosProdutos, $id_produto);

        //APAGAR FOTOS ANTIGAS
        $this->produtos_model->doDeleteFotoProduto($id_produto);

      } else{
        $dadosProdutos['data_cadastro'] = dataDiaDb();
        //CADASTRO NOVO PRODUTO
        $this->produtos_model->doInsert($dadosProdutos);
        //PEGO O ID PRODUTO ADICIONADO NO BANCO DE DADOS
        $id_produto = $this->session->userdata('last_id');
      }

      // CADASTRAR FOTO PRODUTO
      $foto_produto = $this->input->post('foto_produto');
      $t_foto = count($foto_produto);

      for ($i=0; $i < $t_foto ; $i++) {
        $foto['id_produto'] = $id_produto;
        $foto['foto'] = $foto_produto[$i];
        $this->produtos_model->doInsertFoto($foto);
      }

      //FIM CADASTRAR NOVA FOTO PRODUTO

      if ($this->input->post('id_produto')) {
        redirect('admin/produtos', 'refresh');
      } else{
        redirect('admin/produtos/modulo', 'refresh');
      }


    } else{
      $this->modulo();
    }
  }

  public function upload()
  {

    //PASTA PARA ARMAZENAR OS ARQUIVOS DOS PRODUTOS
    $pasta = 'C:/xampp/htdocs/CURSOS/PAG_SEGURO/loja_virtual/uploads/fotos_produtos/';

    //SETAR AS CONFIGURACOES DA BIBLIOTECA
    $config['upload_path'] = $pasta;
    $config['allowed_types'] = 'jpg|png|gif';
    $config['max_size'] = 2048;
    $config['encrypt_name'] = TRUE;

    //CARREGADO A BIBLIOTECA DE UPLOAD E PASSSA AS CONFIGURACOES
    $this->load->library('upload', $config);

    //VERIFICA SE TEM UM ENVIO DE FOTO
    if ($this->upload->do_upload('foto_produto')) {

      //SE TIVER PEGAMOS OS DADOS DO ARQUIVOS ENVIADO
      $retorno['file_name'] = $this->upload->data('file_name');
      $retorno['msg'] = 'Foto enviada com sucesso!';
      $retorno['erro'] = 0;

    } else{
      //ERRO NO ENVIO RETORNAMOS O ERRO
      $retorno['msg'] = $this->upload->display_errors();
      $retorno['erro'] = 25;
    }

    // TRANSFORMAMOS NOSSA ARRAY EM JSON
    echo json_encode($retorno);

  }

  public function del($id=NULL)
  {
    if ($id) {
      $this->produtos_model->doDelete($id);
      redirect('admin/produtos', 'refresh');
    } else{
      redirect('admin/produtos', 'refresh');
    }
  }



}
