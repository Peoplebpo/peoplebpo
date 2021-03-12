$(document).ready(function () {

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

    // inicio habilitacion checkbox

    $('#btn_marca').on('change', function () {

        if ($(this).is(':checked')) {

            // Hacer algo si el checkbox ha sido seleccionado 

            console.log('on');

            $('#g-rrss').prop('checked',true);

        } else {

            // Hacer algo si el checkbox ha sido deseleccionado 

            console.log('off');
        }
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