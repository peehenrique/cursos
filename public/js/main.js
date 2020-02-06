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
  $('#valor').mask('000.000.000.000.000,00', {reverse: true});

  $('#cpf').mask('000.000.000-00', {reverse: true});

} );
