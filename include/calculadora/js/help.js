$(document).ready(function () {


    // inicio habilitacion checkbox


    $('#div_s-marca').hide();
    $('#div_s-call').hide();
    $('#div_s-ejecutivos').hide();
    $('#div_s-marketing').hide();
    $('#div_s-office').hide();
    $('#div_s-marketing').hide();
    $('#div_s-rrss').hide();
    $('#div_s-consultoria').hide();
    $('#div_s-ecommerce').hide();
    $('#div_s-sac').hide();
    $('#div_s-whatsapp').hide();

    $('#div_rrss').hide();
    $('#div_ivr').hide();
    $('#div_voximplant').hide();
    $('#div_ecommerce').hide();
    $('#div_crm').hide();
    $('#div_bpo').hide();
    $('#div_center').hide();
    $('#div_customer').hide();
    $('#div_c-colsultoria').hide();

    // inicio habilita botones recursos tecnologicos

    $('#btn_tecnologicos').on('change', function () {

        if ($(this).is(':checked')) {

            // Hacer algo si el checkbox ha sido seleccionado 

            console.log('on');

            $('#div_s-marca').show();
            $('#div_s-marketing').show();

        } else {

            // Hacer algo si el checkbox ha sido deseleccionado 

            console.log('off');

            $('#div_s-marca').hide();
            $('#div_s-marketing').hide();


        }
    });

    // inicio habilita botones recursos ejecucion

    $('#btn_ejecucion').on('change', function () {

        if ($(this).is(':checked')) {

            // Hacer algo si el checkbox ha sido seleccionado 

            console.log('on');

            $('#div_s-ecommerce').show();
            $('#div_s-call').show();
            $('#div_s-rrss').show();
            $('#div_s-whatsapp').show();

        } else {

            // Hacer algo si el checkbox ha sido deseleccionado 

            console.log('off');

            $('#div_s-ecommerce').hide();
            $('#div_s-call').hide();
            $('#div_s-rrss').hide();
            $('#div_s-whatsapp').hide();


        }
    });

    // inicio habilita botones recursos estrategicos

/*    $('#btn_estrategicos').on('change', function () {

        if ($(this).is(':checked')) {

            // Hacer algo si el checkbox ha sido seleccionado 

            console.log('on');

            $('#div_s-sac').show();
            $('#div_s-ejecutivos').show();
            $('#div_s-office').show();
            $('#div_s-consultoria').show();

        } else {

            // Hacer algo si el checkbox ha sido deseleccionado 

            console.log('off');

            $('#div_s-sac').hide();
            $('#div_s-ejecutivos').hide();
            $('#div_s-office').hide();
            $('#div_s-consultoria').hide();


        }
    });*/

    /*   $('#btn_ejecucion').on('change', function () {

           if ($(this).is(':checked')) {

               // Hacer algo si el checkbox ha sido seleccionado 

               console.log('on');

               $('#div_ivr').show();
               $('#div_voximplant').show();
               $('#div_ecommerce').show();
               $('#div_crm').show();
               $('#div_vacio1').hide();
               $('#div_vacio2').hide();
               $('#div_vacio3').hide();

               $('#ivr').prop('disabled', false);
               $('#voximplant').prop('disabled', false);
               $('#c-ecommerce').prop('disabled', false);
               $('#crm').prop('disabled', false);


           } else {

               // Hacer algo si el checkbox ha sido deseleccionado 

               console.log('off');
               $('#ivr').prop('disabled', true);
               $('#voximplant').prop('disabled', true);
               $('#c-ecommerce').prop('disabled', true);
               $('#crm').prop('disabled', true);

               $('#div_ivr').hide();
               $('#div_voximplant').hide();
               $('#div_ecommerce').hide();
               $('#div_crm').hide();


           }
       });*/



    /*  $('#btn_tecnologicos').on('change', function () {

          if ($(this).is(':checked')) {

              // Hacer algo si el checkbox ha sido seleccionado 

              console.log('on');

              $('#div_bpo').show();
              $('#div_center').show();
              $('#div_customer').show();
              $('#div_c-colsultoria').show();

              $('#c-consultoria').prop('disabled', false);
              $('#bpo').prop('disabled', false);
              $('#contact_center').prop('disabled', false);
              $('#customer_experience').prop('disabled', false);



          } else {

              // Hacer algo si el checkbox ha sido deseleccionado 

              console.log('off');

              $('#bpo').prop('disabled', true);
              $('#contact_center').prop('disabled', true);
              $('#customer_experience').prop('disabled', true);
              $('#c-consultoria').prop('disabled', true);

          }
      }); */

    /*   $('#btn_tecnologicos').on('change', function () {

        if ($(this).is(':checked')) {

            // Hacer algo si el checkbox ha sido seleccionado 

            console.log('on');

            $('#div_rrss').show();
            $('#div_vacio1').show();
            $('#div_vacio2').show();
            $('#div_vacio3').show();

            $('#g-rrss').prop('disabled', false);




        } else {

            // Hacer algo si el checkbox ha sido deseleccionado 

            console.log('off');

            $('#g-rrss').prop('disabled', true);

            $('#div_rrss').hide();

        }
    });

*/


    // inicio items help 

    $("#help_diseno_marca, #lb_diseno_marca").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Diseño Marca',
            text: 'Contenido Diseño marca',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_ecommerce, #lb_ecommerce").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'E-Commerce',
            text: 'Contenido E-Commerce',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_sac, #lb_sac").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'SAC',
            text: 'Contenido SAC',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_marketing, #lb_marketing").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Marketing',
            text: 'Contenido Marketing',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_call, #lb_call").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Click to Call',
            text: 'Contenido Click to Call',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_ejecutivos, #lb_ejecutivos").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Ejecutivos',
            text: 'Contenido Ejecutivos',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_office, #lb_office").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Back Office',
            text: 'Contenido Back Office',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_whatsapp, #lb_whatsapp").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Whatsapp',
            text: 'Contenido Whatsapp',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_rrss, #lb_rrss").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Redes Sociales',
            text: 'Contenido Redes Sociales',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_consultoria, #lb_consultoria").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Consultoria',
            text: 'Contenido Consultoria',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_grrss, #lb_grrss").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Gestión Redes Sociales',
            text: 'Contenido Gestión Redes Sociales',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_ivr, #lb_ivr").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'IVR',
            text: 'Contenido IVR',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_bpo, #lb_bpo").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'BPO',
            text: 'Contenido BPO',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_vox, #lb_vox").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Voximplant',
            text: 'Contenido Voximplant',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_center, #lb_center").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Contact Center',
            text: 'Contenido Contact Center',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_gecommerce, #lb_gecommerce").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'E-commerce',
            text: 'Contenido E-commerce',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_gcustomer, #lb_gcustomer").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Customer Experience',
            text: 'Contenido Customer Experience',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_gcrm, #lb_gcrm").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'CRM',
            text: 'Contenido CRM',
            footer: '<a href>Más Información</a>'
        })
    });

    $("#help_gconsultoria, #lb_gconsultoria").click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Consultoria',
            text: 'Contenido Consultoria',
            footer: '<a href>Más Información</a>'
        })
    });


    // inicio validacion aceptacion de condiciones y envio de correo

    $("#btn_enviar").click(function () {

        // inicio validar campos



        $('#principal').hide();

        Swal.fire({
            title: 'Condiciones Manejo de Datos',
            text: `Peoplebpo utilizara su información exclusivamente para enviar simulación de costos de servicio a través de Email. Recuerde que para enviar la simulación, debe Aceptar este aviso pulsando el botón de "Aceptar", o rechazar el uso de la información entregada pulsando "Rechazar".`,
            width: 800,
            showDenyButton: true,
            confirmButtonText: `Acepto`,
            denyButtonText: `Rechazar`,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Simulación Enviada', '', 'success'),
                    $('#btn_enviar').attr("disabled", true),
                    $('#principal').show();
            } else if (result.isDenied) {
                Swal.fire('No Acepto las Condiciones', '', 'info'),
                    $('#principal').show();
            }

        })


    });


});