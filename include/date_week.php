<?php
/*------ Подмодуль определения номера недели и названия недели */

// include('D:\Web\home\nikomydiplom.ru\www\include\config\config.php');
include('config\config.php');
	$num_weeks = floor( ((strtotime("now")-strtotime($semestr_date_start))/86400)/7 ); //YY-MM-DD - количество недель со стартовой даты
	
	if($num_weeks < $max_num_weeks) { //пока не прошло 18 недель - идет отображение номера недели и типа недели
		
		$num_weeks++; // т.к первая неделя равна нулю, делаем её как 1
		/* считаем остаток от вычисленной недели - четный или нечётный */
		$id_week = $num_weeks - intval($num_weeks/2)*2;
		if($id_week == 0) {
			echo "<p>","Название недели: ","<span>","Верхняя","</span>","</p>";	
		} else {
			echo "<p>","Название недели: ","<span>","Нижняя","</span>","</p>";
		}
			echo "<p>","Номер недели: ","<span>", $num_weeks,"</span>","</p>";
		
	} 

?>