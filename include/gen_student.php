<?php
echo "<table id=\"shedule\" width=\"100%\" border=\"1\" cellpadding=\"15\">";
			
	$type_of_week = (($start_date_rasp - $start_date_sem)/(86400*7))+1; /* Расчёт номера недели */
	$num_type_of_week = intval($type_of_week) - intval($type_of_week/2)*2; /* Расчёт типа недели - верхняя или нижняя */
	if($num_type_of_week == 0) {
			echo "<tr>";
			echo "<td colspan=\"100%\" class=\"header\" align=\"center\" style=\"padding-bottom: 0;\">",
			"<h3>","Неделя №", intval($type_of_week)," (Верхняя) ","</h3>",
			"</td>";
			echo "</tr>";
			
		} else {
			echo "<tr>";
			echo "<td colspan=\"100%\" class=\"header\" align=\"center\" style=\"padding-bottom: 0;\">",
			"<h3>","Неделя №", intval($type_of_week)," (Нижняя) ","</h3>",
			"</td>";		
			echo "</tr>";	
		}
	 for($i = 1; $i <= 9; $i++) {
				echo "<th class=\"header\">",$header[$i],"</th>";
			}
	 
			
  while( $start_date_rasp <= $end_date_rasp ) { // организация цикла по конечной и начальной дате
	echo "<tr>";
	
			
			$num_day_of_week = date("w",$start_date_rasp); //номер дня недели
		    if($num_day_of_week == 0) $num_day_of_week  = 7; //приравниваем воскресенье к 7
			
			if($num_day_of_week == 6 || $num_day_of_week == 7) { //если выходные
					

					if($date_today == date("d.m.Y",$start_date_rasp)) { //если сегодняшний день совпадает с датой
							echo "<td align=\"center\" style=\"background-color:rgba(0,255,0,0.2);\" ><font color=red>"; 
						} else {
							echo "<td align=\"center\" class=\"header\"><font color=red>";	
						}
					
					echo "<b>",date("d.m.Y",$start_date_rasp)," ","(",$name_day_of_week[$num_day_of_week],")","</b>";
					echo "</font></td>";
					
					for($i = 1; $i <= 8; $i++) {
						if($date_today == date("d.m.Y",$start_date_rasp)) { //если сегодняшний день совпадает с датой  
							echo "<td align=\"center\" style=\"background-color:rgba(0,255,0,0.2);\">";
							include('table_cell_student.php');
							echo "</td>";
						} else {
							echo "<td align=\"center\">";
							include('table_cell_student.php');
							echo "</td>";
						}
					}
					
			}  else {
					
					if($date_today == date("d.m.Y",$start_date_rasp)) { //если сегодняшний день совпадает с датой  
							echo "<td align=\"center\" style=\"background-color:rgba(0,255,0,0.2);\" >"; 
						} else {
							echo "<td align=\"center\" class=\"header\">";
						}
					
					echo "<b>",date("d.m.Y",$start_date_rasp)," ","(",$name_day_of_week[$num_day_of_week],")","</b>";
					echo "</td>";

					for($i = 1; $i <= 8; $i++) {
						if($date_today == date("d.m.Y",$start_date_rasp)) { //если сегодняшний день совпадает с датой  
							echo "<td align=\"center\"  style=\"background-color:rgba(0,255,0,0.2);\">";
							include('table_cell_student.php');
							echo "</td>";
						} else {
							echo "<td align=\"center\" >";
							include('table_cell_student.php');
							echo "</td>";
						}
					}
			}
		
		
			$start_date_rasp = $start_date_rasp + 86400;
					
	echo "</tr>";
	
	if($num_day_of_week == 7) { //Если неделя кончилась
		$type_of_week = (($start_date_rasp - $start_date_sem)/(86400*7))+1; /* Расчёт номера недели */
		$num_type_of_week = intval($type_of_week) - intval($type_of_week/2)*2; 
		if($num_type_of_week == 0) {
			echo "<tr>";
			echo "<td colspan=\"100%\" class=\"header\" align=\"center\" style=\"padding-bottom: 0;\">",
			"<h3>","Неделя №", intval($type_of_week)," (Верхняя) ","</h3>",
			"</td>";
			echo "</tr>";
			
		} else {
			echo "<tr>";
			echo "<td colspan=\"100%\" class=\"header\" align=\"center\" style=\"padding-bottom: 0;\">",
			"<h3>","Неделя №", intval($type_of_week)," (Нижняя) ","</h3>",
			"</td>";		
			echo "</tr>";	
		}
		for($i = 1; $i <= 9; $i++) {
				echo "<th class=\"header\">",$header[$i],"</th>";
			}
	} /*end of if num_day_of_week */
	
  } /* end of while */
  echo "</table>";
  //echo "<br/><br/>";
  //echo "<a class=\"ClickMe\" href=\"#print\" onclick=\"docprint();\"> Распечатать расписание </a>"
?>