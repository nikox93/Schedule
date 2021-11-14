<?php
/* --------------- Подмодуль вывода информации в ячейки таблицы ---------------- */
/* Дата 
if($l_date[$write] == null) goto m1;
echo "<p style=\"color:#DF0B27; font-weight: bold; margin: 1px;\">"; 
echo $l_date[$write]; 
echo "</p>";
*/
/* Должность преподавателя */
m1:
echo "<b>",$teacher_post[$write],"</b>","</br>"; 

/* Полное - сокращенное имя преподавателя */
echo "<p style=\"margin: 1px;\" title=\"$teacher_last_name[$write] $teacher_first_name[$write] $teacher_father_name[$write]\">";										
echo $teacher_last_name[$write]," ", substr($teacher_first_name[$write], 0, 2),".",substr($teacher_father_name[$write], 0, 2),"<br/>"; 
echo "</p>";

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
														