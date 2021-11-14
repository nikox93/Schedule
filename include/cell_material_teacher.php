<?php
/* --------------- Подмодуль вывода информации в ячейки таблицы ---------------- */
/* Дата 
if($l_date[$write] == null) goto m1;
echo "<p style=\"color:#DF0B27; font-weight: bold; margin: 1px;\">"; 
echo $l_date[$write]; 
echo "</p>";
*/
/* Группа */
m1:
echo "<b>",$gr_name[$write],"</b>","</br>"; 

/* Аудитория*/
echo $cr[$write]," "; 
/* echo $podgr[$i],"<br/>"; */

/* Тип проводимого занятия */
switch($type[$write]) {
	case 1: /* Лекция */
		echo "<span style=\"color:#00A220; font-weight: bold; margin: 1px;\" title=\"$f_sub[$i]\">";
		echo $s_sub[$write];
		echo "</span>";
		break;
											
	case 2: /* Практика - семинар */
		echo "<span style=\"color:#FF8000; font-weight: bold; margin: 1px;\" title=\"$f_sub[$i]\">";
		echo $s_sub[$write];
		echo "</span>";
		break;
											
	case 3: /* Лабораторная работа */
		echo "<span style=\"color:#DF0B27; font-weight: bold; margin: 1px;\" title=\"$f_sub[$i]\">";
		echo $s_sub[$write];
		echo "</span>";
		break;
} /* end case of type */
?>
														