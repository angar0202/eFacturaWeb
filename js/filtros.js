
$(document).ready(function () {
  ajax_facturas();
  ajax_retenciones();
  ajax_nota_credito();
  ajax_nota_debito();
  ajax_guia_remision();
  ajax_all();
});
 
function ajax_facturas() {
    var base_url=window.location.pathname;
    $('.facturas').click(function () {
    $("#TipoDocumentoSeleccionado").text("01");
    var FechaInicial = $("#dtpFechaInicial :input").val();    
    var FechaFinal = $("#dtpFechaFinal :input").val();    
    var TipoDocumento=$("#TipoDocumentoSeleccionado").text();    
    $.ajax({
      url: base_url+"/filtrar",
      async: false,
      type: "POST",
      data: ({ tipo_documento : TipoDocumento, fecha_inicial : FechaInicial, fecha_final: FechaFinal }),
      dataType: "html",
      success: function(data) {
        $('#documentos').html(data);
      }
    })
  }); 
}
function ajax_nota_credito() {
    var base_url=window.location.pathname;
    
    $('.notas_credito').click(function () {
    $("#TipoDocumentoSeleccionado").text("04");
    var FechaInicial = $("#dtpFechaInicial :input").val();
    var FechaFinal = $("#dtpFechaFinal :input").val();    
    var TipoDocumento=$("#TipoDocumentoSeleccionado").text();
    $.ajax({
      url: base_url+"/filtrar",
      async: false,
      type: "POST",
      data: ({ tipo_documento : TipoDocumento, fecha_inicial : FechaInicial, fecha_final: FechaFinal }),
      dataType: "html",
      success: function(data) {
        $('#documentos').html(data);
      }
    })
  });   
}
function ajax_retenciones() {
    var base_url=window.location.pathname;
    $('.retenciones').click(function () {
    $("#TipoDocumentoSeleccionado").text("07");
    var FechaInicial = $("#dtpFechaInicial :input").val();
    var FechaFinal = $("#dtpFechaFinal :input").val();    
    var TipoDocumento=$("#TipoDocumentoSeleccionado").text();
    $.ajax({
      url: base_url+"/filtrar",
      async: false,
      type: "POST",
      data: ({ tipo_documento : TipoDocumento, fecha_inicial : FechaInicial, fecha_final: FechaFinal }),
      dataType: "html",
      success: function(data) {
        $('#documentos').html(data);
      }
    })
  });   
}
function ajax_nota_debito() {
    var base_url=window.location.pathname;
    $('.nota_debito').click(function () {
    $("#TipoDocumentoSeleccionado").text("05");
    var FechaInicial = $("#dtpFechaInicial :input").val();
    var FechaFinal = $("#dtpFechaFinal :input").val();    
    var TipoDocumento=$("#TipoDocumentoSeleccionado").text();
    $.ajax({
      url: base_url+"/filtrar",
      async: false,
      type: "POST",
      data: ({ tipo_documento : TipoDocumento, fecha_inicial : FechaInicial, fecha_final: FechaFinal }),
      dataType: "html",
      success: function(data) {
        $('#documentos').html(data);
      }
    })
  });   
}
function ajax_guia_remision() {
    var base_url=window.location.pathname;
    $('.guia_remision').click(function () {
    $("#TipoDocumentoSeleccionado").text("06");
    var FechaInicial = $("#dtpFechaInicial :input").val();
    var FechaFinal = $("#dtpFechaFinal :input").val();    
    var TipoDocumento=$("#TipoDocumentoSeleccionado").text();
    $.ajax({
      url: base_url+"/filtrar",
      async: false,
      type: "POST",
      data: ({ tipo_documento : TipoDocumento, fecha_inicial : FechaInicial, fecha_final: FechaFinal }),
      dataType: "html",
      success: function(data) {
        $('#documentos').html(data);
      }
    })
  }); 
}

function ajax_all(){
    var base_url=window.location.pathname;    
    $('.limpiar').click(function(){      
    $("#TipoDocumentoSeleccionado").text("0");
    $("#dtpFechaInicial :input").val("");
    $("#dtpFechaFinal :input").val("");
    var FechaInicial = $("#dtpFechaInicial :input").val();
    var FechaFinal = $("#dtpFechaFinal :input").val();    
    var TipoDocumento=$("#TipoDocumentoSeleccionado").text();
      $.ajax({
        url: base_url+"/filtrar",
        async: false,
        type: "POST",
        data: ({ tipo_documento : TipoDocumento, fecha_inicial : FechaInicial, fecha_final: FechaFinal }),
        dataType: "html",
        success: function(data){
          $("#documentos").html(data);
      }
    })
    });
}  