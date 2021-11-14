<?php

// Конфигурация данного файла задает значения для работы с датами семестра (таблица semestr в БД)

$num_sem = 1; //номер-id семестра
$max_num_weeks = 18; // максимальное количество недель в семестре
$host = "localhost";
$login = "nikox93";
$pass = "z36l86";
$data_base = "nikox93";

/* ----- Извлекаем записи из таблицы семестров  для дальнейшей работы с ними ------ */

$connect = mysql_connect($host,$login,$pass) OR die("Unable to connect to the database");
mysql_select_db($data_base ,$connect) OR die("can not select the database $db");
mysql_query("SET NAMES 'utf8';",$connect); 
mysql_query("SET CHARACTER SET 'utf8';",$connect); 
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';",$connect);

$query = "SELECT semestr.s_date_year, semestr.e_date_year, semestr.s_date_sem, semestr.e_date_sem, type_sem.name_sem 
FROM semestr, type_sem 
WHERE semestr.id_sem = $num_sem AND semestr.id_type_sem =  type_sem.id_type_sem";
$sql = mysql_query($query,$connect);
while($row = mysql_fetch_array($sql)) {
	$semestr_date_start = $row['s_date_sem']; //дата начала семестра
	$semestr_date_end = $row['e_date_sem']; //дата конца семестра
	$year_date_start = $row['s_date_year']; //год начала обучения
	$year_date_end = $row['e_date_year']; //год конца обучения
	$name_sem = $row['name_sem']; //тип семестра
}
?>