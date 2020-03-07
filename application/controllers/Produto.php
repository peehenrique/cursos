<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produto extends CI_Controller {

	public function __construct(){
    parent::__construct();

    $this->load->model('loja_model');
    $this->load->model('loja/produto_model');
		$this->load->library('carrinhocompra');


  }

	public function index($meta_link=NULL)
	{

    if (!$meta_link) {
      redirect('/', 'refresh');
    }

		$query = $this->loja_model->getDadosLoja();

    $produto = $this->produto_model->getProdutoMetaLink($meta_link);

    if (!$produto) {
      redirect('/', 'refresh');
    }

		$data['titulo'] = $produto->nome_produto;
		$data['dados_loja'] = $query;
		$data['categorias'] = $this->loja_model->getCategorias();
		$data['view'] = 'loja/produto/info';
    $data['produto'] = $produto;
    $data['fotos'] = $this->produto_model->getFotos($produto->id);

		$this->load->view('loja/template/index', $data);
	}


	public function calcularFrete()
	{
		$cod_servico = ""; /* codigo do servico desejado */
    $cep_origem = "";  /* cep de origem, apenas numeros */
    $cep_destino = ""; /* cep de destino, apenas numeros */
    $peso = "";        /* valor dado em Kg incluindo a embalagem. 0.1, 0.3, 1, 2 ,3 , 4 */
    $altur = "";      /* altura do produto em cm incluindo a embalagem */
    $largura = "";   /* altura do produto em cm incluindo a embalagem */
    $comprimento = ""; /* comprimento do produto incluindo embalagem em cm */
    $valor_declarado = ""; /* indicar 0 caso nao queira o valor declarado */
		$cod_servico = ""; /* codigo do servico, pac ou sedex */

		$correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=n&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";
	}

}
