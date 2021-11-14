<html>
<head>
<meta content="text/html; charset=utf-8"/>
<title>Изменение выбранной записи</title>
<style type="text/css">
#updating {
	margin: auto; 
	border: 1px solid; padding: 20px;
}
#updating table td {
	padding: 10px;
}
#updating select {
	width: 100%;
}
</style>

<script type="text/javascript" src="../../js/lib/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="../../js/scripts.js"></script>

<!-- Datepicker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
  <script src="../../js/lib/jquery.ui.datepicker-ru.js"> //русификатор </script> 
  <script>
  $(function() {
    $("#datepicker_1").datepicker({ dateFormat: 'yy-mm-dd' }).val();
	
	$("#datepicker_2").datepicker({ dateFormat: 'yy-mm-dd' }).val();
  });
  </script>

</head>

<body>
	<div id="updating">
		<h1 align="center">Изменение выбранной записи</h1>
					
		<?php
		$id_w = $_GET['id']; /* запоминаем значение переменной из адресной строки */
		
		include 'db_connect.php';
	
		$query = "SELECT rasp.day, rasp.lesson, rasp.id_week, rasp.id_cr, sub.s_name_sub, type.name_type, 
		DATE_FORMAT(rasp.s_date, '%d.%m.%Y') AS start_date, DATE_FORMAT(rasp.e_date, '%d.%m.%Y') AS end_date, teach.last_name, gr.gr_name
		FROM rasp, sub, type, gr, teach WHERE rasp.id_w = $id_w AND rasp.id_sub = sub.id_sub AND rasp.id_type = type.id_type 
		AND rasp.id_gr = gr.id_gr AND rasp.id_teach = teach.id_teach AND rasp.id_gr = gr.id_gr";
		
		$sql = mysql_query($query,$dp);

		while($row = mysql_fetch_array($sql)) {	

			$id_week = $row['id_week']; // значение для типа недели
			$day = $row['day']; $lesson = $row['lesson']; //значение дней и пар
			$cr = $row['id_cr']; //значение для аудиторий
			$gr_name = $row['gr_name']; //значение для названий групп
  			$teacher = $row['last_name']; //значение для фамилии преподавателей
  			$sub = $row['s_name_sub']; //значение для укороченного наименования предмета
			$type = $row['name_type']; // значение для типа занятия (лекция, практика или лабораторная работа)
			$s_date = $row['start_date']; // значение для даты начала занятия
			$e_date = $row['end_date']; // значение для даты конца занятия
		}

// Массив для вывода дней недели
$name_day_of_week = array(
  	1 => "Пн",
	2 => "Вт",
	3 => "Ср",
	4 => "Чт",
	5 => "Пт",
	6 => "Сб",
	7 => "Вс"
  ); 
  
// Массив для вывода времени пар  
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
 
// Массив для вывода типов недели 
$header_type_week = array(
	0 => "Верхняя",
	1 => "Нижняя",
	2 => "Еженедельно"
  ); 
			print '
			<form name="update_form" action="" method="post">
			<table align="center" border=1px>
				<tr>					
					<td colspan="3">
							<p align="center">
								<a href="../">Вернуться на страницу администрирования</a>
							</p>
					</td>
				</tr>
			
				<tr>
					<td></td>
					<td>Исходное значение</td>
					<td>Конечное значение</td>
				</tr>
			
				<tr>
					<td>Номер изменяемой записи</td>
					<td colspan="2">'; echo $id_w; print '</td>
				</tr>
			
				<tr>
					<td>Введите день недели</td>
					<td><input type="text" name="day_1" value="'; echo $name_day_of_week[$day]; print '" readonly></td>
					<td>';
						/* Организуем цикл для выпадающего списока на вывод дней недели на основе массива name_day_of_week */
						print '<select name="day_2">';
							$i = 1;
							while ($i <= 7) {
							/* Условие - если день недели из списка совпадает с днём недели из записи, его будем по умолчанию считать выбранным*/
								if($name_day_of_week[$i] != $name_day_of_week[$day]){
									print '<option value="'; echo $i; print '">'; echo $name_day_of_week[$i]; print '</option>';
								} else {								
									print '<option selected value="'; echo $day; print '">'; echo $name_day_of_week[$day]; print '</option>';
								}
								$i=$i+1;
							}							
						print '</select>
					</td>
				</tr>
				
				<tr>
					<td>Введите время пары</td>
					<td><input type="text" name="lesson_1" value="'; echo $header_lesson[$lesson]; print '" readonly></td>
					<td>';
						/* Организуем цикл для выпадающего списока на вывод времени пар на основе массива header_lesson */
						print '<select name="lesson_2">';
								$i = 1;
								while ($i <= 8) {
								/* Условие - если время пары из списка совпадает с временем пары из записи, его будем по умолчанию считать выбранным */
									if($header_lesson[$i] != $header_lesson[$lesson]){
										print '<option value="'; echo $i; print '">'; echo $header_lesson[$i]; print '</option>';
									} else {
										print '<option selected value="'; echo $lesson; print '">'; echo $header_lesson[$lesson]; print '</option>';
									}									
									$i=$i+1;
								}							
							print '</select>
					</td>
				</tr>
				
				<tr>
					<td>Выберите неделю</td>
					<td><input type="text" name="week_1" value="'; echo $header_type_week[$id_week]; print '" readonly></td>
					<td>';
						/* Организуем цикл для выпадающего списока на вывод типа недели на основе массива header_type_week */
						print '<select name="week_2">';
								$i = 0;
								while ($i <= 2) {
								/* Условие - если тип недели из списка совпадает с типом недели из записи, его будем по умолчанию считать выбранным */
									if($header_type_week[$i] != $header_type_week[$id_week]){
										print '<option value="'; echo $i; print '">'; echo $header_type_week[$i]; print '</option>';
									} else {	
										print '<option selected value="'; echo $i; print '">'; echo $header_type_week[$i]; print '</option>';
									}
									$i=$i+1;
								}							
							print '</select>	
						</td>
				</tr>
				
				<tr>
					<td>Выберите преподавателя</td>
					<td><input type="text" name="teach_1" value="'; echo $teacher; print '" readonly></td>
					<td>';
					
					/* -----------Запрос в БД на id и фамилии преподавателей----------- */
					
					$query = "SELECT id_teach, last_name FROM teach ";
		
					$sql = mysql_query($query,$dp);

						while($row = mysql_fetch_array($sql)) {	
							$id_teach[] = $row['id_teach'];
							$last_name[] = $row['last_name'];
						}
													
					/* Выводим их в форму*/
					print '<select name="teach_2">';
						$i = 0;		
						while ($i < count($id_teach)) {
							if($last_name[$i] != $teacher){
								print '<option value="'; echo $id_teach[$i]; print '">'; echo $last_name[$i]; print '</option>';
							} else {
								print '<option selected value="'; echo $id_teach[$i]; print '">'; echo $last_name[$i]; print '</option>';
							}
							$i=$i+1;
						}
					print '</select>
					</td>
				</tr>
				
				<tr>
					<td>Выберите предмет</td>
					<td><input type="text" name="sub_1" value="'; echo $sub; print '" readonly></td>
					<td>';
					
					/* ----------Запрос в БД на id и наименование предметов----------- */
					
					$query = "SELECT id_sub, s_name_sub FROM sub ";
		
					$sql = mysql_query($query,$dp);

						while($row = mysql_fetch_array($sql)) {	
							$id_sub[] = $row['id_sub'];
							$s_name_sub[] = $row['s_name_sub'];
						}
						
					/* Выводим их в форму*/
					print '<select name="sub_2">';
						$i = 0;		
						while ($i < count($id_sub)) {
							if($s_name_sub[$i] != $sub){
								print '<option value="'; echo $id_sub[$i]; print '">'; echo $s_name_sub[$i]; print '</option>';
							} else {
								print '<option selected value="'; echo $id_sub[$i]; print '">'; echo $s_name_sub[$i]; print '</option>';
							}
							  $i=$i+1;
						}
					print '</select>
					</td>
				</tr>
				
				<tr>
					<td>Выберите аудиторию</td>
					<td><input type="text" name="cr_1" value="'; echo $cr; print '" readonly></td>
					<td>';
					
					/* ---------Запрос в БД на id и наименование аудиторий------------ */
					
					$query = "SELECT id_cr FROM classroom ";
		
					$sql = mysql_query($query,$dp);

						while($row = mysql_fetch_array($sql)) {	
							$id_cr[] = $row['id_cr'];							
						}
						
					/* Выводим их в форму*/
					print '<select name="cr_2">';
						$i = 0;		
						while ($i < count($id_cr)) {
							if($id_cr[$i] != $cr){
								print '<option value="'; echo $id_cr[$i]; print '">'; echo $id_cr[$i]; print '</option>';
							} else {
								print '<option selected value="'; echo $id_cr[$i]; print '">'; echo $id_cr[$i]; print '</option>';
							}
							$i=$i+1;
						}
					print '</select>
					</td>
				</tr>
				
				<tr>
					<td>Выберите группу</td>
					<td><input type="text" name="gr_1" value="'; echo $gr_name; print '" readonly></td>
					<td>';
					
					/* ----------- Запрос в БД на id и наименование групп ------------- */
					
					$query = "SELECT id_gr, gr_name FROM gr ";
		
					$sql = mysql_query($query,$dp);

						while($row = mysql_fetch_array($sql)) {	
							$id_gr[] = $row['id_gr'];
							$gr_name_a[] = $row['gr_name'];
						}
						
					/* Выводим их в форму*/
					print '<select name="gr_2">';
						$i = 0;		
						while ($i < count($id_gr)) {
							if($gr_name_a[$i] != $gr_name){
								print '<option value="'; echo $id_gr[$i]; print '">'; echo $gr_name_a[$i]; print '</option>';
							} else {
								print '<option selected value="'; echo $id_gr[$i]; print '">'; echo $gr_name_a[$i]; print '</option>';
							}							 
							$i=$i+1;
						}
					print '</select>
					</td>
				</tr>
				
				<tr>
					<td>Выберите тип занятия</td>
					<td><input type="text" name="type_1" value="'; echo $type; print '" readonly></td>
					<td>';
					
					/* ------------- Запрос в БД на id и наименование типа занятия -------------------*/
					
					$query = "SELECT id_type, name_type FROM type ";
		
					$sql = mysql_query($query,$dp);

						while($row = mysql_fetch_array($sql)) {	
							$id_type[] = $row['id_type'];
							$type_name[] = $row['name_type'];
						}
						
					/* Выводим их в форму*/
					print '<select name="type_2">';
						$i = 0;		
						while ($i < count($id_type)) {
							if($type_name[$i] != $type){
								print '<option value="'; echo $id_type[$i]; print '">'; echo $type_name[$i]; print '</option>';
							} else {
								print '<option selected value="'; echo $id_type[$i]; print '">'; echo $type_name[$i]; print '</option>';
							}
							$i=$i+1;
						}
					print '</select>
					</td>
				</tr>
				
				<tr>
					<td>Выберите дату начала занятия</td>
					<td><input type="text" name="s_date_1" value="'; echo $s_date; print '" readonly></td>
					<td><input type="text" name="s_date_2" id="datepicker_1" autocomplete="off"></td>
				</tr>
				
				<tr>
					<td>Выберите дату окончания занятия</td>
					<td><input type="text" name="e_date_1" value="'; echo $e_date; print '" readonly></td>
					<td><input type="text" name="e_date_2" id="datepicker_2" autocomplete="off"></td>
				</tr>';
			?>
				<tr>
					<td colspan="3">
						<p align="center">
						    <!-- Кнопка изменения записи -->
							<input type="submit" name="changer" id="changer"/>
						</p>
					</td>
				</tr>
				
			<?php
				/* Если нажата кнопка "Изменить" */
				if(isset($_POST['changer'])){
						$day_2 = $_POST['day_2'];
						$lesson_2 = $_POST['lesson_2'];
						$week_2 = $_POST['week_2'];
						$teach_2 = $_POST['teach_2'];
						$sub_2 = $_POST['sub_2'];
						$cr_2 = $_POST['cr_2'];
						$gr_2 = $_POST['gr_2'];
						$type_2 = $_POST['type_2'];
						
						$s_date_2 = trim($_POST['s_date_2']); 
						if(empty($s_date_2)) $s_date_2 = date('Y-m-d', strtotime($_POST['s_date_1'])); // если дата не менялась - оставляем прежнюю 
						else $s_date_2 = $_POST['s_date_2']; 					
						

						$e_date_2 = trim($_POST['e_date_2']);
						if(empty($e_date_2)) $e_date_2 = date('Y-m-d', strtotime($_POST['e_date_1'])); // та же песня, что и выше 
						else $e_date_2 = $_POST['e_date_2']; 
												
						$query = "UPDATE rasp SET rasp.day=$day_2, rasp.lesson=$lesson_2, rasp.id_week=$week_2, rasp.id_teach=$teach_2, 
						rasp.id_sub=$sub_2, rasp.id_cr=$cr_2, rasp.id_gr=$gr_2, rasp.id_type=$type_2,
						s_date='$s_date_2', e_date='$e_date_2' WHERE rasp.id_w=$id_w";
					
						$result = mysql_query($query) or die(mysql_error());
						
						/* после "внесены в БД" - $s_date_2 и $e_date_2 */
						
						echo "<script>alert('Изменения внесены в БД. Нажмите ОК для продолжения'); 					
						location.href='http://localhost/admin/';</script>";
				}
			?>			 				
			</table>
		
	</div>
</body>
</html>