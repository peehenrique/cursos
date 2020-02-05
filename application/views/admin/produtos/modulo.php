<section class="content-header">
  <h1>
    <?php echo $titulo; ?>
  </h1>
  <ol class="breadcrumb">
    <?php
    if (isset($navegacao)) {
      echo '<li><a href="'. base_url($navegacao['link']). '">'. $navegacao['titulo'] .'</a></li>';
    }
    ?>
    <li class="active"><?php echo $titulo; ?></li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <div class="row mb-2">
        <div class="col-md-12 text-left">
          <a href="<?php echo base_url('admin/produtos'); ?>" class="btn btn-success"> <i class="fa fa-arrow-left"></i> Voltar</a>
        </div>
      </div>

      <form class="form-horizontal" action="<?php echo base_url('admin/produtos/core'); ?>" method="post">

        <?php
        errosValidacao();
        getMsg('msgCadastro');
        ?>

        <div class="form-group">
          <label class="col-sm-2 control-label">Nome</label>
          <div class="col-sm-7">
            <input type="text" name="nome_produto" class="form-control" placeholder="Nome produto" value="<?php echo ( $dados != NULL ? $dados->nome_produto : set_value('nome_produto')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Codigo do produto</label>
          <div class="col-sm-7">
            <input type="text" name="cod_produto" class="form-control" placeholder="Codigo do produto" value="<?php echo ( $dados != NULL ? $dados->cod_produto : set_value('cod_produto')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Valor do produto</label>
          <div class="col-sm-7">
            <input type="text" id="valor" name="valor" class="form-control" placeholder="Valor do produto" value="<?php echo ( $dados != NULL ? $dados->valor : set_value('valor')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Peso</label>
          <div class="col-sm-7">
            <input type="text" name="peso" class="form-control" placeholder="Peso" value="<?php echo ( $dados != NULL ? $dados->peso : set_value('peso')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Altura</label>
          <div class="col-sm-7">
            <input type="text" name="altura" class="form-control" placeholder="Altura" value="<?php echo ( $dados != NULL ? $dados->altura : set_value('altura')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Largura</label>
          <div class="col-sm-7">
            <input type="text" name="largura" class="form-control" placeholder="Largura" value="<?php echo ( $dados != NULL ? $dados->largura : set_value('largura')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Comprimento</label>
          <div class="col-sm-7">
            <input type="text" name="comprimento" class="form-control" placeholder="Comprimento" value="<?php echo ( $dados != NULL ? $dados->comprimento : set_value('comprimento')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Informacoes</label>
          <div class="col-sm-7">
            <textarea name="informacao" class="form-control" rows="8" cols="80"><?php echo ( $dados != NULL ? $dados->informacao : set_value('informacao')); ?></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Controlar Estoque</label>
          <div class="col-sm-4">
            <select class="form-control" name="controlar_estoque">
              <?php if($dados) { ?>
                <option value="0" <?= ($dados->controlar_estoque == 0 ? 'selected="selected"' : '') ?>>Nao</option>
                <option value="1" <?= ($dados->controlar_estoque == 1 ? 'selected="selected"' : '') ?>>Sim</option>
              <?php } else{ ?>
                <option value="0" >Nao</option>
                <option value="1">Sim</option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Estoque</label>
          <div class="col-sm-7">
            <input type="text" name="estoque" class="form-control" placeholder="Estoque" value="<?php echo ( $dados != NULL ? $dados->estoque : set_value('estoque')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Destaque</label>
          <div class="col-sm-4">
            <select class="form-control" name="destaque">
              <?php if($dados) { ?>
                <option value="0" <?= ($dados->destaque == 0 ? 'selected="selected"' : '') ?>>Nao</option>
                <option value="1" <?= ($dados->destaque == 1 ? 'selected="selected"' : '') ?>>Sim</option>
              <?php } else{ ?>
                <option value="0" >Nao</option>
                <option value="1">Sim</option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Marca</label>
          <div class="col-sm-4">
            <select class="form-control" name="id_marca">
              <option value="">Selecione uma marca</option>
              <?php foreach ($marcas as $marca): ?>
                <?php if($dados) { ?>
                  <option value="<?php echo $marca->id; ?>" <?= ($marca->id == $dados->id_marca ? 'selected="selected"' : '') ?>><?php echo $marca->nome_marca; ?></option>
                <?php } else{ ?>
                  <option value="<?php echo $marca->id; ?>"><?php echo $marca->nome_marca; ?></option>
                <?php } ?>
              <?php endforeach; ?>

            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Categoria</label>
          <div class="col-sm-4">
            <select class="form-control" name="id_categoria">
              <option value="">Selecione uma categoria</option>

              <?php foreach ($categorias as $categoria): ?>
                <?php if($dados) { ?>
                  <option value="<?php echo $categoria->id; ?>" <?= ($categoria->id == $dados->id_categoria ? 'selected="selected"' : '') ?>><?php echo $marca->nome_marca; ?></option>
                <?php } else{ ?>
                  <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nome; ?></option>
                <?php } ?>
              <?php endforeach; ?>

            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Produto ativo</label>
          <div class="col-sm-4">
            <select class="form-control" name="ativo">
              <?php if($dados) { ?>
                <option value="0" <?= ($dados->ativo == 0 ? 'selected="selected"' : '') ?>>Inativo</option>
                <option value="1" <?= ($dados->ativo == 1 ? 'selected="selected"' : '') ?>>Ativo</option>
              <?php } else{ ?>
                <option value="0" >Inativo</option>
                <option value="1" selected="selected">Ativo</option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Foto do produto</label>
          <div class="col-md-6">
            <div id="file_upload_fotos_produtos">Upload</div>
          </div>
        </div>

        <!-- CAMPO PARA UPLOAD PRODUTO -->
        <div class="form-group">
          <div class="col-md-10 retorno_fotos_produtos">

            <?php if ($fotos): ?>
              <?php foreach ($fotos as $foto): ?>
                <div class="col-sm-3 img_foto_produtos_view">
                  <img width="120px" src="<?= base_url('uploads/fotos_produtos/'.$foto->foto); ?>" />
                  <input type="hidden" value="<?php echo $foto->foto; ?>" name="foto_produto[]" />
                </div>
              <?php endforeach; ?>
            <?php endif; ?>

          </div>
        </div>

        <?php if ($dados) { ?>
          <input type="hidden" name="id_produto" value="<?= $dados->id; ?>">
        <?php  }  ?>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Salvar</button>
          </div>
        </div>

      </form>

    </div>
  </div>
</section>
