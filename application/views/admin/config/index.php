<section class="content-header">
  <h1><?php echo $titulo; ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo $titulo; ?></li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Salvar configuracoes</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form">
        <div class="box-body">
          <div class="form-group">
            <label>Titulo</label>
            <input type="text" class="form-control" name="titulo" placeholder="Titulo">
          </div>
          <div class="form-group">
            <label>Empresa</label>
            <input type="text" class="form-control" name="empresa" placeholder="Empresa">
          </div>
          <div class="form-group">
            <label>CEP</label>
            <input type="text" class="form-control" name="cep" placeholder="CEP">
          </div>
          <div class="form-group">
            <label>ENDERECO</label>
            <input type="text" class="form-control" name="endereco" placeholder="Endereco">
          </div>
          <div class="form-group">
            <label>Bairro</label>
            <input type="text" class="form-control" name="bairro" placeholder="Bairro">
          </div>
          <div class="form-group">
            <label>Cidade</label>
            <input type="text" class="form-control" name="cidade" placeholder="Cidade">
          </div>
          <div class="form-group">
            <label>Complemento</label>
            <input type="text" class="form-control" name="complemento" placeholder="Complemento">
          </div>
          <div class="form-group">
            <label>Estado</label>
            <input type="text" class="form-control" name="estado" placeholder="Estado">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label>Telefone</label>
            <input type="text" class="form-control" name="telefone" placeholder="Telefone">
          </div>
          <div class="form-group">
            <label>Produtos em destaque</label>
            <input type="text" class="form-control" name="p_destaque" placeholder="Produtos em destaque">
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</section>
