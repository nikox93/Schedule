<?php
/* --------------- Подмодуль вывода информации в ячейки таблицы ---------------- */
/* Дата 
if($l_date[$write] == null) goto m1;
echo "<p style=\"color:#DF0B27; font-weight: bold; margin: 1px;\">"; 
echo $l_date[$write]; 
echo "</p>";
*/
/* Преподаватель */
m1:
echo "<p style=\"margin: 1px;\" title=\"$teacher_last_name[$write] $teacher_first_name[$write] $teacher_father_name[$write]\">";
echo "<b>";										
echo $teacher_last_name[$write]," ", substr($teacher_first_name[$write], 0, 2),".",substr($teacher_father_name[$write], 0, 2); 
echo "</b>";	
echo "</p>";

/* Группа */
echo "<b>",$gr_name[$write],"</b>","<br/>"; 
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
														