<?php
use SebastianBergmann\Comparator\DOMNodeComparator;
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagar extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('loja/pagar_model');
    $this->load->helper('string');
  }

  public function index()
  {
    redirect('/', 'refresh');
  }


  public function pg_session_id()
  {

    //PEGO AS CONFIGURACOES DO PAGSEGURO QUE ESTAO NO BANCO DE DADOS
    $query = $this->pagar_model->getConfigPagseguro();

    if ($query->ambiente == 1) {
      // AMBIENTE SANDBOX
      $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions';
    } else{
      //AMBIENTE PRODUCAO
      $url = 'https://ws.pagseguro.uol.com.br/v2/sessions';
    }

    $params['email'] = $query->email;
    $params['token'] = $query->token;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($params));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 45);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1');

    if ($query->ambiente == 1) {
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    }else{
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    }

    $result = curl_exec($ch);
    curl_close($ch);

    $xml = simplexml_load_string($result);
    $json = json_encode($xml);
    $std = json_decode($json);

    //VERIFICA SE PEGOU A SESSAO
    if (isset($std->id)) {
      $retorno = [
        'erro' => 0,
        'msg' => "Sucesso",
        'id_sessao' => $std->id
      ];

    } else{
      $retorno = [
        'erro' => 5000,
        'msg' => "Erro ao gerar sessao de pagamento, tente novamente"
      ];
    }

    header('Content-Type: application/json');
    echo json_encode($retorno);

  }

  public function pg_boleto()
  {
    $this->form_validation->set_rules('nome', 'Nome completo', 'required|trim');
    $this->form_validation->set_rules('cpf', 'CPF', 'required|trim|is_unique[clientes.cpf]', ['is_unique'=>'CPF ja cadastrado na loja, por favor informar outro CPF']);
    $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('senha', 'Senha', 'required|trim');

    if ($this->form_validation->run()) {

      //VERIFICA SE FOI PASSADO ID DO CLIENTE
      if ($this->input->post('id_cliente')) {
        // CLIENTE CADASTRADO, PEGAMOS DADOS NO BANCO
        $id_cliente = $this->input->post('id_cliente');

      } else{
        //NOVO CADASTRO DE CLIENTE
        $cliente = [
          'nome' => $this->input->post('nome'),
          'cpf' => $this->input->post('cpf'),
          'cep' => $this->input->post('cep'),
          'telefone' => $this->input->post('telefone'),
          'endereco' => $this->input->post('endereco'),
          'numero' => $this->input->post('numero'),
          'bairro' => $this->input->post('bairro'),
          'cidade' => $this->input->post('cidade'),
          'estado' => $this->input->post('uf')
        ];

        //GRAVA NO BANCO DE DADOS
        $this->pagar_model->doInsertCliente($cliente);
        //RECUPERA ID DO CLIENTE CADASTRADO
        $id_cliente = $this->session->userdata('last_id');

        // GRAVAMOS O USUARIO
        $username = $this->input->post('nome');
        $password = $this->input->post('senha');
        $email = $this->input->post('email');
        $additional_data = [
          'id_cliente' => $id_cliente
        ];
        $group = [2];
        $this->ion_auth->register($username, $password, $email, $additional_data, $group);

      }

      // PEGO OS DADOS
      $query = $this->pagar_model->getClienteId($id_cliente);

      //RETORNA ERRO SE NAO EXISTIR PELA ID
      if (!$query) {
        $retorno = [
          'erro' => 40,
          'msg' => "Erro, cliente nao foi localizado, verifique e tente novamente"
        ];
        echo json_encode($retorno);
        exit;
      }

      //DADOS DO CLIENTE DO CLIENTE COMPRADOR
      $id_cliente = $query->id;
      $nomeComprador = $query->nome;
      $cpfComprador = $query->cpf;
      $emailComprador = $query->email;
      // RECEBEMOS NO PADRAO (11) 99999-9999
      $telefoneComprador = explode(' ', $query->telefone);
      //DADOS DE ENTREGA
      $cepComprador = $query->cep;
      $enderecoComprador = $query->endereco;
      $numeroComprador = $query->numero;
      $bairroComprador = $query->bairro;
      $cidadeComprador = $query->cidade;
      $estadoComprador = $query->estado;

      // DADOS DE PAGAMENTO E ACESSO
      $config = $this->pagar_model->getConfigPagseguro();
      $pagarBoleto['email'] = $config->email;
      $pagarBoleto['token'] = $config->token;
      $pagarBoleto['paymentMode'] = 'default';
      $pagarBoleto['paymentMethod'] = 'boleto';
      $pagarBoleto['currency'] = 'BRL';
      $pagarBoleto['extraAmount'] = '';

      //NUMERO DO PEDIDO
      $ref_pedido = random_string('numeric', 8);
      $pagarBoleto['reference'] = 'Ref. [# '. $ref_pedido .']';

      //DADOS COMPRADOR
      $pagarBoleto['senderName'] = remove_acentos($nomeComprador);
      $pagarBoleto['senderCPF'] = limparString($cpfComprador);
      $pagarBoleto['senderAreaCode'] = limparString($telefoneComprador[0]);
      $pagarBoleto['senderPhone'] = limparString($telefoneComprador[1]);
      $pagarBoleto['senderEmail'] = ($config->ambiente == '1' ? 'c25695597217774926010@sandbox.pagseguro.com.br' : $emailComprador);
      $pagarBoleto['shippingAddressStreet'] = remove_acentos($enderecoComprador);
      $pagarBoleto['shippingAddressNumber'] = $numeroComprador;
      $pagarBoleto['shippingAddressDistrict'] = remove_acentos($bairroComprador);
      $pagarBoleto['shippingAddressPostalCode'] = limparString($cepComprador);
      $pagarBoleto['shippingAddressCity'] = remove_acentos($cidadeComprador);
      $pagarBoleto['shippingAddressState'] = $estadoComprador;
      $pagarBoleto['shippingAddressCountry'] = 'BRA';

      //DADOS FRETE
      $freteComprador = formatoDecimal($this->input->post('frete_carrinho'));
      $pagarBoleto['shippingType'] = '1';
      $pagarBoleto['shippingCost'] = $freteComprador;

      //DADOS TRANSACAO
      $pagarBoleto['senderHash'] = $this->input->post('hash');

      // ITENS DO CARRINHO
      $this->load->library('carrinhocompra');
      $carrinho = $this->carrinhocompra->listarProdutos();
      $contador = 1;
      foreach ($carrinho as $indice => $linha) {
        $pagarBoleto['itemId'.$contador] = $linha['id'];
        $pagarBoleto['itemDescription'.$contador] = remove_acentos($linha['nome']);
        $pagarBoleto['itemAmount'.$contador] = number_format($linha['valor'], 2, '.', '');
        $pagarBoleto['itemQuantity'.$contador] = $linha['qtd'];
        $contador++;
      }

      if ($config->ambiente == '1') {
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions';
      } else{
        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions';
      }

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, count($pagarBoleto));
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($pagarBoleto));
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 45);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1');

      if ($config->ambiente == 1) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      }else{
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
      }

      $result = curl_exec($ch);
      curl_close($ch);

      //PEGA O RETORNO E CONVERTE EM STRING - CONVERTE EM JSON E TRANFORMA EM OBJETO
      $xml = simplexml_load_string($result);
      $json = json_encode($xml);
      $std = json_decode($json);

      //ERRO DA API
      if (isset($std->error->code)) {
        erroPagSeguro($std->error->code);
      }

      // TRANSACAO REALIZADA COM SUCESSO
      if (isset($std->code)) {


        //GRAVA PEDIDO
        $pedido = [
          'id_cliente' => $id_cliente,
          'total_produto' => $this->carrinhocompra->total(),
          'total_frete' => $freteComprador,
          'total_pedido' => $this->carrinhocompra->total(),
          'data_cadastro' => dataDiaDb(),
          'ref' => $ref_pedido
        ];

        $this->pagar_model->doInsertPedido($pedido);
        $id_pedido = $this->session->userdata('last_id_pedido');

        // PRODUTOS DO PEDIDO
        foreach ($carrinho as $indice => $linha) {
          $produto = [
            'id_pedido' => $id_pedido,
            'id_produto' => $linha['id'],
            'qtd' => $linha['qtd'],
            'valor_unit' => number_format($linha['valor'], 2, '.', ''),
            'valor_total' => number_format($linha['subtotal'], 2, '.', '')
          ];
          $this->pagar_model->doInsertPedidoProdutos($produto);
        }

        // GRAVAR TRANSACAO
        $transacao = [
          'id_pedido' => $id_pedido,
          'id_cliente' => $id_cliente,
          'cod_transacao' => $std->code,
          'data' => dataDiaDb(),
          'tipo' => 1, //tipo 1 boleto, 2 cartao, 3 transferencia
          'status' => $std->status,
          't_parcela' => 1,
          'v_parcela' => $std->grossAmount,
          'url_boleto' => $std->paymentLink
        ];
        $this->pagar_model->doInsertPedidoTransacao($transacao);

        $retorno = [
          'erro' => 0,
          'msg' => 'Pedido realizado com sucesso',
          'status' => 'Aguardando pagamento',
          'url_boleto' => $std->paymentLink,
          'numero_pedido' => $ref_pedido,
          'cod_transacao' => $std->code
        ];
      }

    }else{

      $retorno = [
        'erro' => 10,
        'msg' => validation_errors()
      ];

    }

    echo json_encode($retorno);
  }


}
