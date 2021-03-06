<div class="row pedido_concluido"></div>

<div class="container checkout_loja">
  <div class="row">

    <div class="row">
      <div class="col-md-12">

        <table class="table table-bordered">
          <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Quantidade</th>
            <th>SubTotal</th>
          </thead>
          <tbody>

            <?php foreach ($carrinho as $indice => $linha): ?>
              <tr>
                <td><?php echo $linha['id'] ?></td>
                <td><?php echo $linha['nome'] ?></td>
                <td><?php echo formataMoedaReal($linha['valor'], 1) ?></td>
                <td>
                  <?php echo $linha['qtd'] ?>
                </td>
                <td><?php echo formataMoedaReal($linha['subtotal'], 1) ?></td>
              </tr>
            <?php endforeach; ?>

          </tbody>
          <tfoot>
            <tr>
              <td colspan="4" class="text-right">TOTAL PRODUTOS</td>
              <td> <?php echo formataMoedaReal($this->carrinhocompra->total(), 1); ?> </td>
            </tr>
            <tr class="linha-total-frete-carrinho hide">
              <td colspan="4" class="text-right">TOTAL FRETE</td>
              <td class="total-carrinho-frete"></td>
            </tr>
            <tr>
              <td colspan="4" class="text-right">TOTAL DA COMPRA</td>
              <td class="total-carrinho"> <?php echo formataMoedaReal($this->carrinhocompra->total(), 1); ?> </td>
            </tr>

          </tfoot>
        </table>

      </div>

    </div>

    <div class="erro_validacao hide alert alert-danger"></div>

    <form class="form_checkout_pagar" action="" method="post" accept-charset="utf-8">
      <input type="hidden" name="hash" value="" placeholder="Hash de pagamento">

      <div class="col-md-4">
        <h2><i class="fa fa-users" aria-hidden="true"></i> Comprador</h2>
        <p>Ja tem cadastro, <a href="<?php echo base_url('checkout/login') ?>">clique aqui para logar</a></p>

        <?php if ($this->ion_auth->logged_in()): ?>
          <input type="hidden" class="form-control" name="id_cliente" value="<?= $user->id_cliente ?>" id="id_cliente" placeholder="id_cliente">
        <?php endif; ?>

        <div class="form-group">
          <label for="nome">Nome Completo</label>
          <input type="text" class="form-control" name="nome" value="<?= ($usuario ? $usuario->nome : '') ?>" id="nome" placeholder="Nome Completo" required="">
        </div>
        <div class="form-group">
          <label for="cpf">CPF</label>
          <input type="text" class="form-control" name="cpf" value="<?= ($usuario ? $usuario->cpf : '') ?>" id="cpf" placeholder="CPF" required="">
        </div>
        <div class="form-group">
          <label for="telefone">Telefone</label>
          <input type="text" class="form-control" value="<?= ($usuario ? $usuario->telefone : '') ?>" name="telefone" id="telefone" placeholder="Telefone" required="">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" value="<?= ($this->ion_auth->logged_in() ? $user->email : '') ?>" id="email" placeholder="Email" required="">
        </div>
        <?php if(!$this->ion_auth->logged_in()){ ?>
        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required="">
        </div>
        <?php } ?>
      </div>
      <div class="col-md-4">
        <h2><i class="fa fa-paper-plane" aria-hidden="true"></i> Envio</h2>

        <div class="form-group">
          <label for="cep">CEP</label>
          <div class="input-group">
            <input type="text" class="form-control" name="cep" value="<?= ($usuario ? $usuario->cep : '') ?>" id="cep" placeholder="CEP">
            <span class="input-group-btn">
              <button class="btn btn-success btn-calcular-cep" type="button">Calcular</button>
            </span>
          </div>

          <div class="retorno_frete hide" style="margin-top:1em;"></div>

        </div>

        <div class="form-group">
          <label for="endereco">Endereco</label>
          <input type="text" class="form-control" value="<?= ($usuario ? $usuario->endereco : '') ?>" name="endereco" id="endereco" placeholder="Endereco">
        </div>

        <div class="form-group">
          <label for="numero">Numero</label>
          <input type="text" class="form-control" value="<?= ($usuario ? $usuario->numero : '') ?>" name="numero" id="numero" placeholder="Numero">
        </div>

        <div class="form-group">
          <label for="cc_numero">Bairro</label>
          <input type="text" class="form-control" value="<?= ($usuario ? $usuario->bairro : '') ?>" name="bairro" id="bairro" placeholder="Bairro">
        </div>

        <div class="form-group">
          <label for="cidade">Cidade</label>
          <input type="text" class="form-control" value="<?= ($usuario ? $usuario->cidade : '') ?>" name="cidade" id="cidade" placeholder="Cidade">
        </div>

        <div class="form-group">
          <label for="cidade">UF</label>
          <input type="text" class="form-control" value="<?= ($usuario ? $usuario->estado : '') ?>" name="uf" id="uf" placeholder="UF">
        </div>

      </div>

      <div class="col-md-4">
        <h2><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Pagamento</h2>

        <div class="form-group">
          <label for="forma_pagamento">Forma de pagamento</label>

          <select class="form-control forma_pagamento" name="forma_pagamento">
            <option value="1">Cartao de credito</option>
            <option value="2">Boleto bancario</option>
            <option value="3">Debito em conta bancaria</option>
          </select>
        </div>

        <div class="pagamento-cartao">

          <div class="form-group">
            <label for="cc_numero">Numero do cartao</label>
            <input type="text" class="form-control" id="cc_numero" placeholder="0000 0000 0000 0000">
          </div>

          <div class="form-group">
            <label for="cc_titular">Nome do titular</label>
            <input type="text" class="form-control" id="cc_titular" placeholder="Nome do titular">
          </div>

          <div class="form-group">
            <label for="cc_validade">Validade do cartao</label>
            <input type="text" class="form-control" id="cc_validade" placeholder="00/0000">
          </div>

          <div class="form-group">
            <label for="cc_codigo">Codigo de seguranca</label>
            <input type="text" class="form-control" id="cc_codigo" placeholder="000">
          </div>

          <input type="text" class="form-control" name="token_pagamento" id="token_pagamento" placeholder="Token de pagamento">

          <button type="button" class="btn btn-success btn-pagar-cartao">Pagar com cartao de credito</button>

        </div>

        <div class="pagamento-boleto hide">
          <div class="alert alert-info" role="alert">
            <button type="button" class="btn btn-success btn-pagar-boleto">Pagar com boleto</button>
          </div>
        </div>

        <div class="pagamento-transferencia hide">

          <div class="form-group">
            <label for="nome_banco">Selecione um banco</label>

            <select class="form-control nome_banco" name="nome_banco" placeholder="Banco" required="" disabled>
              <option></option>
              <option value="bradesco">Bradesco</option>
              <option value="itau">Itau</option>
              <option value="bancodobrasil">Banco do Brasil</option>
              <option value="banrisul">Banrisul</option>
            </select>
          </div>

          <div class="alert alert-info" role="alert">
            <p>Ao final da compra, vai poder acessar o ambiente seguro do seu banco</p> <br>
            <button type="button" class="btn btn-success btn-pagar-transferencia">Pagar com transferencia</button>
          </div>
        </div>

          <div class="msg_envio alert alert-warning hide">Enviando dados de pagamento, aguarde...</div>

      </div>

    </form>


  </div>

</div>
