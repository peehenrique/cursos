<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function setMsg($id, $msg, $tipo)
{
  $CI =& get_instance();
  switch ($tipo) {
    case 'erro':
    $CI->session->set_flashdata($id, '<div class="alert alert-danger" role="alert">'. $msg .'</div>');
    break;
    case 'sucesso':
    $CI->session->set_flashdata($id, '<div class="alert alert-success" role="alert">'. $msg .'</div>');
    break;
  }

  return FALSE;
}

function getMsg($id){
  $CI =& get_instance();
  if ($CI->session->flashdata($id)) {
    echo $CI->session->flashdata($id);
  }
}

function errosValidacao(){
  if (validation_errors()) {
    echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
  }
}

function dataDiaDb()
{
  date_default_timezone_set('America/Sao_Paulo');
  date_default_timezone_get();
  $formato = 'DATE_W3C';
  $hora = time();
  return standard_date($formato, $hora);
}

function dataDb()
{
  date_default_timezone_set('America/Sao_Paulo');
  date_default_timezone_get();
  $stringdedata = "%Y-%m-%d";
  $data = time();
  $data = mdate($stringdedata, $data);
  return $data;
}

function formataDataDb($data=NULL){
  if ($data) {
    $data = explode("/", $data);
    return $data[2] . '-' . $data[1] . '-' . $data[0];
  }
}

function formataDataView($data=NULL){
  if ($data) {
    $data = explode('-', $data);
    return $data[2] . '/' . $data[1] . '/' . $data[0];
  }
}


function formataMoedaReal($valor=NULL, $real=FALSE){
  if ($valor) {
    $valor = ($real == TRUE ? 'R$ ' : ''). number_format($valor, 2, ',', '.');
    return $valor;
  }
}

function formatoDecimal($valor=NULL){
  $valor = str_replace('.', '', $valor);
  $valor = str_replace(',', '.', $valor);
  return $valor;
}

function slug($string=NULL){
  $string = remove_acentos($string);
  return url_title($string, '-', TRUE);
}

function remove_acentos($string=NULL){
  $procurar    = array('À','Á','Ã','Â','É','Ê','Í','Ó','Õ','Ô','Ú','Ü','Ç','à','á','ã','â','é','ê','í','ó','õ','ô','ú','ü','ç');
  $substituir  = array('a','a','a','a','e','r','i','o','o','o','u','u','c','a','a','a','a','e','e','i','o','o','o','u','u','c');
  return str_replace($procurar, $substituir, $string);
}

function limparString($string=NULL)
{
  if ($string) {
    // return preg_replace("/[^0-9\s]/");
    return preg_replace('/[^0-9]+/', '', $string);
  }
}


function erroPagSeguro($cod = null)
{
  if ($cod) {
    $erro = [
      '53004' => 'Quantidade do item invalida',
      '10000' => 'Cartao de credito invalido',
      '53041' => 'Valor da parcela esta errado'
    ];

    if (isset($erro[$cod])) {
      $r = [
        'erro' => $cod,
        'msg' => $erro[$cod]
      ];
    } else{
      $r = [
        'erro' => $cod,
        'msg' => 'Erro nao catalogado'
      ];
    }

  } else{
    $r = [
      'erro' => 1038,
      'msg' => 'Erro nao catalogado'
    ];
  }

  echo json_encode($r);
  exit;
}
