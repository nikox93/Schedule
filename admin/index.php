<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Администрирование расписания</title>
<style>
body {
margin: 0;
padding: 0;	
}
.menu {
width: 100%; display: block; position: relative; z-index:9999; border-bottom: 1px solid #000;
}
.p1, .p2, .p3, .p4 {
display: inline-block; width: 22%; margin: 2px; padding: 10px; background:#FFFFFF; 
}
.tab {
position: relative;	z-index:9998; padding-top: 20px;
}
</style>
</head>
<body>
<?php
	include 'db_connect.php';
	
	$query = "SELECT rasp.id_w,	rasp.day, rasp.lesson, rasp.id_week, rasp.id_cr, sub.s_name_sub, type.name_type, 
	DATE_FORMAT(rasp.s_date, '%d.%m.%Y') AS start_date, DATE_FORMAT(rasp.e_date, '%d.%m.%Y') AS end_date, teach.last_name, gr.gr_name
	FROM rasp, sub, type, gr, teach WHERE rasp.id_sub = sub.id_sub AND rasp.id_type = type.id_type AND rasp.id_gr = gr.id_gr AND 
	rasp.id_teach = teach.id_teach AND rasp.id_gr = gr.id_gr";


$sql = mysql_query($query,$dp);
$num_rows = mysql_num_rows($sql); //Количество записей в таблице, соответсвующие запросу

while($row = mysql_fetch_array($sql)) {	

			$id_w[] = $row['id_w']; // запись в таблице
			$id_week[] = $row['id_week']; // массив для типа недели
			$day[] = $row['day']; $lesson[] = $row['lesson']; //массив дней и пар
			$cr[] = $row['id_cr']; //массив для аудиторий
			$gr_name[] = $row['gr_name']; //массив для названий групп
  			$teacher_last_name[] = $row['last_name']; //массив для фамилии преподавателей
  			$s_sub[] = $row['s_name_sub']; //массив для укороченного наименования предмета
			$type[] = $row['name_type']; // массив для типа занятия (лекция, практика или лабораторная работа)
			$start_date[] = $row['start_date']; // массив для даты начала занятия
			$end_date[] = $row['end_date']; // массив для даты конца занятия
		}

// День недели
$name_day_of_week = array(
  	1 => "Пн",
	2 => "Вт",
	3 => "Ср",
	4 => "Чт",
	5 => "Пт",
	6 => "Сб",
	7 => "Вс"
  ); 
  
// Пара  
$header_lesson = array(
	1 => "9:00-10:25",
	2 => "10:35-12:00",
	3 => "12:30-13:55",
	4 => "14:05-15:30",
	5 => "15:35-16:55",
	6 => "17:00-18:20",
	7 => "18:30-19:55",
	8 => "20:10-21:35"
  ); 
 
// Тпи недели 
$header_type_week = array(
	0 => "Верхняя",
	1 => "Нижняя",
	2 => "Еженедельно"
  ); 
 
/* ------------ MAIN MENU ----------- */ 
echo "<div class=\"menu\">";
echo "<div class=\"p1\">";
echo "<b>","Количество записей ","</b>",$num_rows,"<br/>";
echo "<p>","</p>";
echo "</div>";

echo "<div class=\"p2\">";
echo "<a href=\"function/add.php\">Добавить новую запись в таблицу</a>";
echo "<p>","</p>";
echo "</div>";

echo "<div class=\"p3\">";
echo "<a href=\"..\">Вернуться на страницу расписания</a>";
echo "<p>","</p>";
echo "</div>";

echo "<div class=\"p4\">";
echo "<a href=\"semestr/index.php\">Задать параметры семестров</a>";
echo "<p>","</p>";
echo "</div>";
echo "</div>";


/* ------------ VISUAL TABLE ----------- */ 
echo "<div class=\"tab\">";
echo "<table border=\"1\" cellpadding=\"10\" align=\"center\" style=\"font-size:12px;\">";	
echo "<tr>";
	echo "<th>","Запись","</th>";
	echo "<th>","День","</th>";
	echo "<th>","Пара","</th>";
	echo "<th>","Неделя","</th>";
	echo "<th>","Преподаватель","</th>";
	echo "<th>","Предмет","</th>";
	echo "<th>","Аудитория","</th>";
	echo "<th>","Группа","</th>";
	echo "<th>","Тип занятия","</th>";
	echo "<th>","Дата начала занятия","</th>";
	echo "<th>","Дата конца занятия","</th>";
	echo "<th colspan=\"2\">","Работа с записью","</th>";
echo "</tr>";		
for($write = 0; $write < $num_rows; $write++) {
echo "<tr>";
	echo "<td>",$id_w[$write],"</td>";
	echo "<td>",$name_day_of_week[$day[$write]],"</td>";
	echo "<td>",$header_lesson[$lesson[$write]],"</td>";
	echo "<td>",$header_type_week[$id_week[$write]],"</td>";
	echo "<td>",$teacher_last_name[$write],"</td>";
	echo "<td>",$s_sub[$write],"</td>";
	echo "<td>",$cr[$write],"</td>";
	echo "<td>",$gr_name[$write],"</td>";
	echo "<td>",$type[$write],"</td>";
	echo "<td>",$start_date[$write],"</td>";
	echo "<td>",$end_date[$write],"</td>";
	print '<td><form action="function/update.php" method="get">
	<input type="submit" name="action" value="Изменить">
	<input type="hidden" name="id" value='; echo $id_w[$write]; print '>
	</form>
	</td>';
	print '<td><form action="function/delete.php" method="get">
	<input type="submit" name="action" value="Удалить">
	<input type="hidden" name="id" value='; echo $id_w[$write]; print '>
	</form>
	</td>';
echo "</tr>";	
}
echo "</table>";
echo "</div>";	
?>
</body>
</html>
