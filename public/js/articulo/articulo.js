 function calculo() {
    var costoProducto = $('#costoProducto').val() * 1;
    var porcentaje = $('#porcentaje').val() * 1;
    var impuesto = $('#exento').val() * 1;
    var impuestodos = $('#cesc').val() * 1;
    var iva = $('#ivav').val() * 1;
    var cesc = $('#cescv').val() * 1
    var desc = ($('#descuento_art').val() /100); 
    var cyp = ((porcentaje / 100) * costoProducto) + costoProducto;
    var vp
    var utilidad = 0; 
    if (impuesto === 0 && impuestodos === 0) {
        vp = cyp;
    } else if (impuesto === 1 && impuestodos === 1) {
        vp = ((iva + cesc) * cyp) + cyp;

    } else if (impuesto === 1 && impuestodos === 0) {
        vp = (iva * cyp) + cyp;
    } else {
        vp = (cesc * cyp) + cyp;
    }

    $('#vCalculado').val(redondeo(vp, 2));

    if(desc != null && desc > 0 ){
        d = vp * desc; 
       vp = vp - d;
    }
    $('#vCalculadoDesc').val(redondeo(vp, 2));


    if (impuesto === 0 && impuestodos === 0) {
        utilidad =   vp - costoProducto;
    } else if (impuesto === 1 && impuestodos === 1) {
        utilidad =  (vp/(iva + cesc+1)) - costoProducto;
    } else if (impuesto === 1 && impuestodos === 0) {
        utilidad =  (vp/(iva+1) ) - costoProducto;
    } else {
       utilidad =  (vp/(cesc+1) ) - costoProducto;
    }

    $('#utilidad').val(redondeo(utilidad , 2));
   
} 


function calculo_beneficio() {
   
    delay(function () {
   
        var costoProducto = $('#costoProducto').val() * 1;
        var iva = $('#ivav').val() * 1;

        var vcalculado  = $('#vCalculado').val() * 1; 
        var vcalculado2 = $('#vCalculadoMayoreo').val() * 1; 
        var vcalculado3 = $('#vCalculadoMayoreo3').val() * 1; 

        var impuesto = $('#exento').val() * 1;

        if (impuesto == 1) {
            beneficio =  (((vcalculado  / (iva + 1))  - costoProducto) / costoProducto)
            beneficio2 =  (((vcalculado2  / (iva + 1))  - costoProducto) / costoProducto)
            beneficio3 =  (((vcalculado3  / (iva + 1))  - costoProducto) / costoProducto)
            
        } else {

            beneficio =   ((vcalculado     - costoProducto) / costoProducto)
            beneficio2 =  ((vcalculado2    - costoProducto) / costoProducto)
            beneficio3 =  ((vcalculado3    - costoProducto) / costoProducto)
            
        }
 
        $('#porcentaje').val(redondeo((beneficio *100), 2));
        $('#porcentaje2').val(redondeo((beneficio2 *100), 2));
        $('#porcentaje3').val(redondeo((beneficio3 *100), 2));

    }, 400);
 

    var impuesto = $('#exento').val() * 1;
    var impuestodos = $('#cesc').val() * 1;
    var costoProducto = $('#costoProducto').val() * 1;
    var iva = $('#ivav').val() * 1;

    var vp = $('#vCalculado').val() * 1;
    var vp2 = $('#vCalculadoMayoreo').val() * 1;
    var vp3 = $('#vCalculadoMayoreo3').val() * 1;
    var desc = ($('#descuento_art').val() /100); 


    if(desc != null && desc > 0 ){
        d = vp * desc; 
       vp = vp - d;
    }
    $('#vCalculadoDesc').val(redondeo(vp, 2));
 
    if (impuesto === 0 && impuestodos === 0) {
         utilidad  =   vp - costoProducto;
         utilidad2 =   vp2 - costoProducto;
         utilidad3 =   vp3 - costoProducto;
     } else if (impuesto === 1 && impuestodos === 1) {
         utilidad  =  (vp/(iva + cesc+1)) - costoProducto;
         utilidad2 =  (vp2/(iva + cesc+1)) - costoProducto;
         utilidad3 =  (vp3/(iva + cesc+1)) - costoProducto;
     } else if (impuesto === 1 && impuestodos === 0) {
         utilidad =  (vp/(iva+1)) - costoProducto;
         utilidad2 =  (vp2/(iva+1)) - costoProducto;
         utilidad3 =  (vp3/(iva+1)) - costoProducto;
     } else {
        utilidad =  (vp/(cesc+1) ) - costoProducto;
        utilidad2 =  (vp2/(cesc+1) ) - costoProducto;
        utilidad3 =  (vp3/(cesc+1) ) - costoProducto;
     }
 
     $('#utilidad').val(redondeo(utilidad , 2));
     $('#utilidad2').val(redondeo(utilidad2 , 2));
     $('#utilidad3').val(redondeo(utilidad3 , 2));
   
 }


$('#vCalculado , #vCalculadoMayoreo , #costoProducto,  #vCalculadoMayoreo3 , #descuento_art , #porcentaje').keyup(function () {
    calculo_beneficio()
 });


$('#cesc , #exento').change(function () {
    calculo_beneficio()
});


$('#porcentaje').keyup(function () {
    calculo()
});

function redondeo(num, dec) {
    return Number(num.toFixed(dec));
}


//EDIT
$('#idMarca').change(function () {
    var query = $(this).val();
    if (query != '') {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "../../porModelo",
            method: "POST",
            data: { query: query, _token: _token },
            success: function (data) {
                var producto_select = ''
                for (var i = 0; i < data.length; i++)
                    producto_select += '<option value="' + data[i].idModelo + '">' + data[i].nombreModelo + '</option>'
                $("#idModelo").html(producto_select);
            }
        });
    }
    
});


//CREATE

$('#marcas').change(function(){
    $('#gitmodelo').html('Un momento, por favor...  <img src="./../img/loader.gif" style="position: absolute;"/>');
var query = $(this).val();
if(query != '')
delay(function () {
{
 var _token = $('input[name="_token"]').val();
 $.ajax({
  //url:"{{route('modelo.porModelo')}}",
  url: "../porModelo",
  method:"POST",
  data:{query:query, _token: _token},
  success:function(data){
    var producto_select = ''
      for (var i=0; i<data.length;i++)
        producto_select+='<option value="'+data[i].idModelo+'">'+data[i].nombreModelo+'</option>'
    $("#idModelo").html(producto_select);
    $('#gitmodelo').html('Modelo');
  }
 });
}
},100);
}); 

function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img').remove();
            $('#uploadForm + img').remove();
            $('#uploadForm').after('<img src="' + e.target.result + '"width="200" height="200"/>');
        }
    }
}

function filePreview2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img2').remove();
            $('#uploadForm2 + img').remove();
            $('#uploadForm2').after('<img src="' + e.target.result + '"width="200" height="200"/>');
        }
    }
}

function filePreview3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img3').remove();
            $('#uploadForm3 + img').remove();
            $('#uploadForm3').after('<img src="' + e.target.result + '"width="200" height="200"/>');
        }
    }
}

function filePreview4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img4').remove();
            $('#uploadForm4 + img').remove();
            $('#uploadForm4').after('<img src="' + e.target.result + '"width="200" height="200"/>');
        }
    }
}


function filePreview5(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img5').remove();
            $('#uploadForm5 + img').remove();
            $('#uploadForm5').after('<img src="' + e.target.result + '"width="200" height="200"/>');
        }
    }
}

$("#imagen1").change(function () {
    filePreview(this);
});

$("#imagen2").change(function () {
    filePreview2(this);
});

$("#imagen3").change(function () {
    filePreview3(this);
});

$("#imagen4").change(function () {
    filePreview4(this);
});

$("#imagen5").change(function () {
    filePreview5(this);
});


$(function(){
  $('#obtener').click(function(){
     strslug =  $('#name').val() +' '+ $('#tamano').val() +' '+  $('#color').val() +' '+  $('#idioma').val() +' '+ 
     $('select[name="marcas"] option:selected').text() +' ' + 
     $('select[name="idModelo"] option:selected').text(); 
     
    $('#obtener').val(strslug)
    codigo = $('#codigo').val()

    console.log(codigo);
    {delay(function()
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url: "../comprobar_slug_codigo",  
          method:"POST",
          data:{    query : strslug,
                    query2 : codigo,
                    _token: _token},
          success:function(data){

            if(data.slug){
                $("#obtener").css("background-color", "orange");  
                $("#botones").css("display" , "none")
                
            }else{
                $("#obtener").css("background-color", "transparent");
            }

            if(data.codigo){
                $("#codigo").css("background-color", "orange");  
                $("#botones").css("display" , "none")
            }else{
                $("#codigo").css("background-color", "transparent");
            }

            if(data.slug == null && data.codigo == null){
                $("#botones").css("display" , "block")
            }
        
          }
         });
        },700);   }


  });
});


var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

function validarImagen(obj){
    var uploadFile = obj.files[0];

    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|jpeg|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen valida');
        //$('#uploadForm').remove();
        $('#imagen1').val("");
      //  $('#uploadForm').after('');
    }
    else {
        var img = new Image();
        img.onload = function () {
          if (uploadFile.size > 5000000)
            {
                alert('El peso de la imagen no puede exceder los 5mb')
                $('#imagen1').val("");
                //$('#imagen1').remove();
            }
            else {
                alert('Imagen correcta :)')                
            }
        };
      //  img.src = URL.createObjectURL(uploadFile);
    }                 
}

$(document).ready(function(){
    $('#mf').keypress(function(e){   
    if(e == 13){
      return false;
    }
  });

  $('input').keypress(function(e){
    if(e.which == 13){
      return false;
    }
  });

    $("#articulos").css("background-color", "orange");    
});