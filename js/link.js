$(document).ready(function () {

    $("#btn_calculadora").click(function () {
        $('#ifr_calculadora').attr('src', "include/calculadora/index.html");
    });

    $("#cerrar").click(function () {
        location.reload();
    });

    


});