<?php
echo "<table>";
for ($write=0; $write<$num_rows; $write++){ //цикл по записям расписания группы
			
	// проверка соответствия параметрам - день, пара, тип недели (исключение для 2 - еженедельно)					
	if(
	$day[$write] == $num_day_of_week &&
	$lesson[$write] == $i && 
	($id_week[$write] == $num_type_of_week || $id_week[$write] == 2) &&
	($start_date_rasp >= strtotime($start_date[$write]) && $start_date_rasp <= strtotime($end_date[$write]))
	){ 
	echo "<tr>";				
			echo "<td align=\"center\">";
			include("cell_material_student.php");
			echo "</td>";
	echo "</tr>";																				
	}
	
}  /* end cycle for num_rows */
								
echo "</table>";								
?>