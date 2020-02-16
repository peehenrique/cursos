<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios_model extends CI_Model{

  public function getDadosLoja()
  {
    $this->db->select('config.empresa, config.telefone, config.email');
    $this->db->from('config');
    $this->db->where('id', 1);
    $this->db->limit(1);
    return $this->db->get()->row();
  }

  public function getPedido()
  {
    $this->db->where('data_cadastro', dataDb());
    return $this->db->get('pedidos')->result();
  }

  public function getRelatorioPedido($condicao=NULL)
  {
    if (is_array($condicao)) {
      $this->db->where($condicao);
      return $this->db->get('pedidos')->result();
    }
  }

  public function getProdutosMaisVendidos()
  {
    $this->db->select('produtos.cod_produto, produtos.nome_produto, produtos_mais_vendidos.quant_vendidos');
    $this->db->from('produtos');
    $this->db->join('produtos_mais_vendidos', 'produtos_mais_vendidos.id_produto = produtos.id');
    $this->db->where('produtos.ativo', 1);
    $this->db->order_by('produtos_mais_vendidos.quant_vendidos', 'desc');
    return $this->db->get()->result();

  }

}
