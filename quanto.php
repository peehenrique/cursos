<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

  <form id="wf-form-receba-orcamento" name="wf-form-receba-orcamento" data-name="receba-orcamento" class="form-2">
    <div class="row-form">
      <img src="images/icone-quantoo.svg" alt="" class="icone-form">
      <label for="name" class="label-form">Quanto vale o seu sonho?</label>
    </div>
      <input type="tel" maxlength="256" name="valor-orcamento" data-name="valor-orcamento" id="valor-orcamento" required="" class="campo-form-2 w-input">
    <div class="row-form"><img src="images/icone-quantoo.svg" alt="" class="icone-form"><label for="name" class="label-form">Seu nome</label></div><input type="text" maxlength="256" name="nome-orcamento" data-name="nome-orcamento" id="nome-orcamento" required="" class="campo-form-2 w-input">
    <div class="row-form"><img src="images/icone-quantoo.svg" alt="" class="icone-form"><label for="name" class="label-form">Seu telefone</label></div><input type="tel" class="campo-form-2 w-input" maxlength="256" name="telefone-orcamento" data-name="telefone-orcamento" id="telefone-orcamento" required="">
    <div class="row-form"><img src="images/icone-quantoo.svg" alt="" class="icone-form"><label for="name" class="label-form">Seu e-mail</label></div><input type="email" class="campo-form-2 w-input" maxlength="256" name="email-orcamento" data-name="email-orcamento" id="email-orcamento" required=""><label class="w-checkbox checkbox-field"><div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox w--redirected-checked"></div><input type="checkbox" id="checkbox-2" name="checkbox-2" data-name="Checkbox 2" required="" checked="" style="opacity:0;position:absolute;z-index:-1">
      <span class="checkbox-label w-form-label">Aceito receber mensagens via WhatsApp da Quantoo: (xx) xxxx-xxxx</span></label>
  </form>

    <button type="button" class="btn-teste-clicar" name="button">CLICAR TESTE</button>

    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script type="text/javascript">



    $(document).on('click', '.btn-teste-clicar', function(){


      var valor_orcamento = $('[name=valor-orcamento]').val();


      $.ajax({
        type: "POST",
        url: "http://localhost/CURSOS/PAG_SEGURO/loja_virtual/admin/pedidos/mudarstatus/",
        data: {input_status: status, input_id: id_pedido} ,
        dataType: "json",
        success: function(res){

          if (res.erro == 0) {
            location.reload();
          } else{
            alert("Erro ao mudar o status");
          }
        },

        error: function(){
          alert("Erro ao atualizar o status");
        }

      })

    });

    });

  </script>





</body>
</html>
