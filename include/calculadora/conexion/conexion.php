<?php


	$conn = new mysqli("92.204.221.86","referidos","413471*Iio","web_calculadora"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos

 	mysqli_set_charset($conn,"utf8");


	if(mysqli_connect_errno()){

		echo 'Conexion Fallida : ', mysqli_connect_error();

		exit();

	}



?>