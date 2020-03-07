<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->model('loja/ajax_model');

  }

  public function index()
  {
  }


  public function calcularFrete()
  {

    $this->form_validation->set_rules('cep', 'CEP', 'required|trim');
    $this->form_validation->set_rules('id', 'Produto', 'required|trim');

    if ($this->form_validation->run() == TRUE) {

      $cep = $this->input->post('cep');
      $id = $this->input->post('id');

      if (!preg_match('/[0-9]{5}-[0-9]{3}/', $cep)) {
        $retorno['erro'] = 15;
        $retorno['msg'] = "CEP invalido, por favor digite outro cep";
        echo json_encode($retorno);
        exit;
      }

      $config = $this->ajax_model->getParametrosEnvio();

      $cod_servico = "04014"; /* codigo do servico desejado 04014 = SEDEX / 04510 - PAC */
      $cep_origem = $config->cep_origem;  /* cep de origem, apenas numeros */
      $cep_destino = "04741010"; /* cep de destino, apenas numeros */
      $peso = "1";        /* valor dado em Kg incluindo a embalagem. 0.1, 0.3, 1, 2 ,3 , 4 */
      $altura = "2";      /* altura do produto em cm incluindo a embalagem */
      $largura = "11";   /* altura do produto em cm incluindo a embalagem */
      $comprimento = "16"; /* comprimento do produto incluindo embalagem em cm */
      $valor_declarado = "0"; /* indicar 0 caso nao queira o valor declarado */

      $url_correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=n&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";

      $xml = simplexml_load_file($url_correios);
      $xml = json_encode($xml);
      $consulta = json_decode($xml);

      // echo "<pre>";
      // print_r($consulta);

      $frete_retorno = "<div>Correios ".($consulta->cServico->Codigo == '04014' ? "SEDEX" : "PAC").", R$ ".$consulta->cServico->Valor." - Prazo de entrega: ".$consulta->cServico->PrazoEntrega."</div>";

      $retorno['valor_frete'] = $frete_retorno;
      $retorno['erro'] = 0;

      echo json_encode($retorno);

      // foreach ($consulta->cServico as $f) {
      //  echo "<div>Correios <strong>".$f->Codigo."</strong>, R$ ".$f->Valor." - Prazo de entrega: ".$f->PrazoEntrega."</div>";
      // }

    } else{
      $retorno['erro'] = 16;
      $retorno['msg'] = validation_errors();

      echo json_encode($retorno);
    }

  }

}
