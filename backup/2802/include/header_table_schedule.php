<?php
/* ----------- Подмодуль вывода даты в заголовок таблицы ----------- */
$num_day_today = date("w"); //номер дня недели

$name_day = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$name_day_rus = array("Понедельник","Вторник","Среда","Четверг","Пятница","Суббота","Воскресенье");

$start_week = date('d.m.Y', strtotime($name_day[$c-3]));

$fp1 = fopen("../num_sem.txt","r+");    
$num_sem = fread($fp1, filesize("../num_sem.txt")); //номер-id семестра (также имеется в config.php)
fclose($fp1); 

$query = "SELECT DATE_FORMAT(s_date_sem, '%d.%m.%Y') AS s_date_sem, DATE_FORMAT(e_date_sem, '%d.%m.%Y') AS e_date_sem FROM semestr WHERE semestr.id_sem = $num_sem";
$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
$semestr_date_start = $row['s_date_sem'];
$semestr_date_end = $row['e_date_sem'];

if(strtotime($semestr_date_start) <= strtotime($start_week) && strtotime($start_week) <= strtotime($semestr_date_end)) {
//echo $start_week,"<br/>";
echo $name_day_rus[$c-3],"<br/>";
} else {
echo $name_day_rus[$c-3],"<br/>";	
}
?>