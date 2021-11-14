<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование семестров</title>
<style>
body {
margin: 0;
padding: 0;	
}
.menu {
width: 100%; display: block; position: relative; z-index:9999; border-bottom: 1px solid #000;
}
.p1, .p2 {
display: inline-block; width: 22%; margin: 2px; padding: 10px; background:#FFFFFF; 
}
.tab {
position: relative;	z-index:9998; padding-top: 20px;
}

.alarm {
	width:100%;
	text-align: center;
	font-weight: bold;
	font-size: 20px;
	color: #ff0000;
}
</style>
</head>
<body>
<?php
	include 'db_connect.php';
	
	$query = "SELECT semestr.id_sem, semestr.s_date_year, semestr.e_date_year, 
	semestr.s_date_sem, semestr.e_date_sem, semestr.id_type_sem	FROM semestr";


$sql = mysql_query($query,$dp);
$num_rows = mysql_num_rows($sql); //Количество записей в таблице, соответсвующие запросу

while($row = mysql_fetch_array($sql)) {	

			$id_sem[] = $row['id_sem']; // запись в таблице
			$s_date_year[] = $row['s_date_year']; // массив для дат начала учебного года
			$e_date_year[] = $row['e_date_year']; // массив для дат окончания учебного года
			$s_date_sem[] = $row['s_date_sem']; // массив для дат начала семестра
			$e_date_sem[] = $row['s_date_sem']; // массив для дат начала семестра
  			$id_type_sem[] = $row['id_type_sem']; // тип семестра			
		}

// Тип семестров
$type_sem = array(
  	1 => "Осенний",
	2 => "Весенний",
  ); 
  
/* ------------ MAIN MENU ----------- */ 
echo "<div class=\"menu\">";
echo "<div class=\"p1\">";
echo "<b>","Количество записей ","</b>",$num_rows,"<br/>";
echo "<p>","</p>";
echo "</div>";

echo "<div class=\"p2\">";
echo "<a href=\"..\">Вернуться в администрирование</a>";
echo "<p>","</p>";
echo "</div>";
echo "</div>";


/* ------------ VISUAL TABLE ----------- */ 
echo "<div class=\"tab\">";
echo "<table border=\"1\" cellpadding=\"10\" align=\"center\" style=\"font-size:12px;\">";	
echo "<tr>";
	echo "<th>","Запись","</th>";
	echo "<th>","Дата начала учебного года","</th>";
	echo "<th>","Дата окончания учебного года","</th>";
	echo "<th>","Дата начала учебного семестра","</th>";
	echo "<th>","Дата окончания учебного семестра","</th>";
	echo "<th>","Тип семестра","</th>";	
	echo "<th>","Работа с записью","</th>";
echo "</tr>";	
	
for($write = 0; $write < $num_rows; $write++) {
echo "<tr>";
	echo "<td>",$id_sem[$write],"</td>";
	echo "<td>",$s_date_year[$write],"</td>";
	echo "<td>",$e_date_year[$write],"</td>";
	echo "<td>",$s_date_sem[$write],"</td>";
	echo "<td>",$e_date_sem[$write],"</td>";
	echo "<td>",$type_sem[$id_type_sem[$write]],"</td>";	
	print '<td><form action="update.php" method="get">
	<input type="submit" name="action" value="Изменить">
	<input type="hidden" name="id" value='; echo $id_sem[$write]; print '>
	</form>
	</td>';	
echo "</tr>";	
}	
echo "<tr>";
	print '<td colspan="7">';
	$write = 0;
	$s1 = intval($id_type_sem[$write]);
	$s2 = intval($id_type_sem[$write+1]);
	
	if($s1 == $s2) echo "<div class=\"alarm\">ВНИМАНИЕ! Значения типов семестра совпадают! Измените одно из значений!</div>";
		
	echo "</td>";
echo "</tr>";

echo "</table>";
echo "</div>";	
?>
</body>
</html>
