<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('loja_model');
		$this->load->library('carrinhocompra');
		$this->load->model('loja/checkout_model');

	}

	public function index()
	{
		$query = $this->loja_model->getDadosLoja();
		$data['titulo'] = $query->titulo;
		$data['dados_loja'] = $query;
		$data['categorias'] = $this->loja_model->getCategorias();
		$data['carrinho'] = $this->carrinhocompra->listarProdutos();
		$data['view'] = 'loja/checkout/home';

		$this->load->model('loja/pagar_model');
		$data['pagseguro'] = $this->pagar_model->getAmbiente();

		$this->load->view('loja/template/index', $data);
	}

	public function login()
	{
		$query = $this->loja_model->getDadosLoja();
		$data['titulo'] = "Tela de login";
		$data['dados_loja'] = $query;
		$data['categorias'] = $this->loja_model->getCategorias();
		$data['view'] = 'loja/checkout/login';

		$this->load->view('loja/template/index', $data);
	}


	public function calculaFrete()
	{
		$this->form_validation->set_rules('cep', 'CEP', 'required|trim');
		if ($this->form_validation->run() == TRUE) {

			$cep = $this->input->post('cep');

			if (!preg_match('/[0-9]{5}-[0-9]{3}/', $cep)) {
				$retorno['erro'] = 15;
				$retorno['msg'] = "CEP invalido, por favor digite outro cep";
				echo json_encode($retorno);
				exit;
			}

			$this->load->model('loja/ajax_model');
			$config = $this->ajax_model->getParametrosEnvio();
			$maiorProduto = $this->carrinhocompra->getMaiorProduto();
			$totalPeso = $this->carrinhocompra->totalPeso();

			$cod_servico = "04014"; /* codigo do servico desejado 04014 = SEDEX / 04510 - PAC */
			$cep_origem = $config->cep_origem;  /* cep de origem, apenas numeros */
			$cep_destino = $cep; /* cep de destino, apenas numeros */
			$peso = $totalPeso;        /* valor dado em Kg incluindo a embalagem. 0.1, 0.3, 1, 2 ,3 , 4 */
			$altura = $maiorProduto['altura'];      /* altura do produto em cm incluindo a embalagem minimo 2 */
			$largura = $maiorProduto['largura'];   /* altura do produto em cm incluindo a embalagem minimo 11 */
			$comprimento = $maiorProduto['comprimento']; /* comprimento do produto incluindo embalagem em cm minimo 16 */
			$valor_declarado = "0"; /* indicar 0 caso nao queira o valor declarado */

			$url_correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=n&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";

			$xml = simplexml_load_file($url_correios);
			$xml = json_encode($xml);
			$consulta = json_decode($xml);

			$prazo_de_entrega = $consulta->cServico->PrazoEntrega + $config->somar_frete;
			$total_produtos = $this->carrinhocompra->total();
			$valor_frete_decimal = number_format(formatoDecimal($consulta->cServico->Valor),2, '.', '');
			$total_carrinho = $valor_frete_decimal + $total_produtos;

			$frete_retorno = "<div><input type='radio' name='frete_carrinho' id='".$consulta->cServico->Codigo."' value='".$consulta->cServico->Valor."' data-total-carrinho='".formataMoedaReal($total_carrinho, 1)."' > Correios ".($consulta->cServico->Codigo == '04014' ? "SEDEX" : "PAC").", R$ ".$consulta->cServico->Valor." - Prazo de entrega: ".$prazo_de_entrega." dias</div>";

			$retorno['valor_frete'] = $frete_retorno;
			$retorno['erro'] = 0;

			echo json_encode($retorno);

		} else{
			if (validation_errors()) {
				$retorno['erro'] = 16;
				$retorno['msg'] = validation_errors();
				echo json_encode($retorno);
			} else{
				redirect('/', 'refresh');
			}
		}

	}


}
