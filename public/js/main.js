$(document).ready( function () {

  // CODIGO PARA UPLOAD DE FOTOS DOS PRODUTOS
  $("#file_upload_fotos_produtos").uploadFile({
    url:"http://localhost/CURSOS/PAG_SEGURO/loja_virtual/admin/produtos/upload",
    fileName:"foto_produto",
    returnType: 'json',
    onSuccess: function(file, data){
      $('.ajax-file-upload-statusbar').hide();
      if (data.erro == 0) {

        $('.retorno_fotos_produtos').append('<div class="col-sm-3 img_foto_produtos_view"><img width="120px" src="http://localhost/CURSOS/PAG_SEGURO/loja_virtual/uploads/fotos_produtos/'+data.file_name+'" /><input type="hidden" value="'+data.file_name+'" name="foto_produto[]" /><a href="#" class="btn btn-danger btn-apagar-foto-produto"><i class="fa fa-trash"></i> </a></div>')

      } else{
        alert(data.msg);
      }
    },
    onError: function(files,status,errMsg,pd){
      alert(files + '<br>' + errMsg);
    }

  });

  // FUNCAO PARA APAGAR FOTO
  $(document).on('click', '.btn-apagar-foto-produto', function(){

    if (confirm("Deseja apagar essa foto?")) {

      $(this).parent().remove();

      return true;
    } else{
      return false;
    }
  });

  $('.btn-apagar-registro').on('click', function() {

    if (confirm("Deseja apagar esse cliente?")) {
      return true;
    } else{
      return false;
    }
  });

  // MUDAR STATUS DO PEDIDO
  $(document).on('click', '.btn-mudar-status-pedido', function(){

    var id = $(this).attr('data-id-pedido');

    var selectStatus = '<div class="form-group">'+
    '<label class="col-sm-4 control-label">Mudar o status do pedido</label>'+
    '<div class="col-sm-8">'+
    '<select class="form-control" name="status">'+
    '<option value="1">Aguardando Pagamento</option>'+
    '<option value="2">Pagamento confirmado</option>'+
    '<option value="3">Enviado</option>'+
    '<option value="4">Cancelado</option>'+
    '</select>'+
    '</div>'+
    '</div>';

    $.ajax({
      type: "GET",
      url: "http://localhost/CURSOS/PAG_SEGURO/loja_virtual/admin/pedidos/getPedido/"+ id + "",
      dataType: "json",
      success: function(res){
        if (res.erro == 0) {

          $('.modal_dinamico').append('<div class="modal fade" data-backdrop="static" id="modal_pedido'+id+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'+
        '<div class="modal-dialog" role="document">'+
          '<div class="modal-content">'+
              '<div class="modal-header">'+
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<h4 class="modal-title" id="myModalLabel">Mudar status do pedido ['+res.id_pedido+']</h4></div>'+
            '<div class="modal-body">'+
            '<p>Status Atual: <strong>'+res.status+'</strong></p>'+
            selectStatus +
            '</div>'+
            '<div class="modal-footer" style="margin-top:3em">'+
            '<button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>'+
            '<button type="button" class="btn btn-primary btn-atualizar-status-pedido" data-id-pedido="'+id+'">Atualizar</button>'+
            '</div></div></div></div>');

            $('#modal_pedido'+id+'').modal('show');
            $('#modal_pedido'+id+'').on('hidden.bs.modal', function(e){
              $(this).remove();
            });

        } else{
          alert(res.msg);
        }
      },
      error: function(){
        alert("Erro ao buscar pedido");
      }

    })


  });

  $(document).on('click', '.btn-atualizar-status-pedido', function(){

    var id_pedido = $(this).attr('data-id-pedido');
    var status = $('[name="status"]').val();

    


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

  $('.table_listar_data_table').DataTable({
    "language": {
      "sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      },
      "select": {
        "rows": {
          "_": "Selecionado %d linhas",
          "0": "Nenhuma linha selecionada",
          "1": "Selecionado 1 linha"
        }
      }
    }
  });

  $('.sidebar-menu').tree();

  $('#data_nascimento').mask('00/00/0000');
  $('#telefone').mask('(00) 0000-0000');
  $('#valor').mask('000.000.000.000.000,00', {reverse: false});

  $('#cpf').mask('000.000.000-00', {reverse: false});
  $('#cep_origem').mask('00000-000', {reverse: false});

} );
