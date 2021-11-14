<?php
	include "../include/config/db_config.php";
	$dp = mysql_connect($host,$user,$password) OR die("Не удалось соединиться с базой данных");
	mysql_select_db($db,$dp) OR die("Не выбрана база $db");
	mysql_query("SET NAMES 'utf8';"); 
	mysql_query("SET CHARACTER SET 'utf8';"); 
	mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); 
?>