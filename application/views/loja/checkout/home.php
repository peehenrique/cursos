<div class="container">
  <div class="row">
    <form class="" action="index.html" method="post" accept-charset="utf-8">

      <div class="col-md-4">
        <h2><i class="fa fa-users" aria-hidden="true"></i> Comprador</h2>
        <p>Ja tem cadastro, <a href="<?php echo base_url('checkout/login') ?>">clique aqui para logar</a></p>


        <div class="form-group">
          <label for="nome">Nome Completo</label>
          <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome Completo">
        </div>
        <div class="form-group">
          <label for="cpf">CPF</label>
          <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF">
        </div>
        <div class="form-group">
          <label for="telefone">Telefone</label>
          <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
        </div>

        <button type="submit" class="btn btn-default">Enviar</button>

      </div>
      <div class="col-md-4">
        <h2><i class="fa fa-paper-plane" aria-hidden="true"></i> Envio</h2>

        <div class="form-group">
          <label for="cep">CEP</label>
          <div class="input-group">
            <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP">
            <span class="input-group-btn">
              <button class="btn btn-success btn-calcular-cep" type="button">Calcular</button>
            </span>
          </div>
        </div>

        <div class="form-group">
          <label for="endereco">Endereco</label>
          <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Endereco" disabled>
        </div>

        <div class="form-group">
          <label for="numero">Numero</label>
          <input type="text" class="form-control" name="numero" id="numero" placeholder="Numero">
        </div>

        <div class="form-group">
          <label for="cc_numero">Bairro</label>
          <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" disabled>
        </div>

        <div class="form-group">
          <label for="cidade">Cidade</label>
          <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" disabled>
        </div>

        <div class="form-group">
          <label for="cidade">UF</label>
          <input type="text" class="form-control" name="uf" id="uf" placeholder="UF" disabled>
        </div>

      </div>

      <div class="col-md-4">
        <h2><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Pagamento</h2>

        <div class="form-group">
          <label for="forma_pagamento">Forma de pagamento</label>

          <select class="form-control forma_pagamento" name="forma_pagamento">
            <option value="1">Cartao de credito</option>
            <option value="2">Boleto bancario</option>
            <option value="3">Transferencia bancaria</option>
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

        </div>

        <div class="pagamento-boleto hide">
          <div class="alert alert-info" role="alert">
            <p>voce poderar emitir o boleto bancario, ao final da compra</p>
          </div>
        </div>

        <div class="pagamento-transferencia hide">
          <div class="alert alert-info" role="alert">
            <p>voce ao final da compra, vai poder acessar o ambiente seguro do seu banco</p>
          </div>
        </div>

      </div>

    </form>


  </div>

</div>
