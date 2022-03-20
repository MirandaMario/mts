$(document).ready(function(){
    
    (function($) {
        "use strict";

    jQuery.validator.addMethod('answercheck', function (value, element) {
        return this.optional(element) || /^\bcat\b$/.test(value)
    }, "type the correct answer -_-");

    $(function() {
   
        $('#contactForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                subject: {
                    required: true,
                    minlength: 4
                },
                number: {
                    required: false,
                    minlength: 8
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                name: {
                    required: "DEBES INGRESAR TU NOMBRE !!!",
                    minlength: "TU NOMBRE DEBE TENER  POR LO MENNOS 3 CARACTERES"
                },
                subject: {
                    required: "INGRESE UN ASUSTO PARA SU MENSAJE",
                    minlength: "SU ASUNTO DEBE TENER POR LO MENOS 4 CARACTERES"
                },
                number: {
                    required: "INGRESE UN NUMERO DE CONTACTO",
                    minlength: "SU NUMERO DEBE DE TERNER  POR LO MENOS 8 DIGITOS"
                },
                email: {
                    required: "DEBE INGRESAR CORREO"
                },
                message: {
                    required: "ESCRIBA SU MENSAJE",
                    minlength: "ESCRIBA SU MENSAJE"
                }
            }
        })
       
        //$("#contactForm").submit()holhola;
    })
        
 })(jQuery)
}); 