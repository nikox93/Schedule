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
	
	$("#datepicker_3").datepicker({ dateFormat: 'yy-mm-dd' }).val();
	
	$("#datepicker_4").datepicker({ dateFormat: 'yy-mm-dd' }).val();
  });
  </script>

</head>

<body>
	<div id="updating">
		<h1 align="center">Изменение выбранной записи</h1>
					
		<?php
		$id_sem = $_GET['id']; /* запоминаем значение переменной из адресной строки */
		
		include 'db_connect.php';
	
		$query = "SELECT semestr.id_sem, semestr.s_date_year, semestr.e_date_year, 
		semestr.s_date_sem, semestr.e_date_sem, semestr.id_type_sem	FROM semestr WHERE semestr.id_sem = $id_sem";
		
		$sql = mysql_query($query,$dp);

		while($row = mysql_fetch_array($sql)) {	

			$id_sem = $row['id_sem']; // запись в таблице
			$s_date_year = $row['s_date_year']; // массив для дат начала учебного года
			$e_date_year = $row['e_date_year']; // массив для дат окончания учебного года
			$s_date_sem = $row['s_date_sem']; // массив для дат начала семестра
			$e_date_sem = $row['s_date_sem']; // массив для дат начала семестра
  			$id_type_sem = $row['id_type_sem']; // тип семестра
		}

// Тип семестров
$type_sem = array(
  	1 => "Осенний",
	2 => "Весенний",
  ); 
			print '
			<form name="update_form" action="" method="post">
			<table align="center" border=1px>
				<tr>					
					<td colspan="3">
							<p align="center">
								<a href="http://localhost/admin/semestr/index.php">Вернуться на страницу семестров</a>
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
					<td colspan="2">'; echo $id_sem; print '</td>
				</tr>					
								
				<tr>
					<td>Выберите дату начала учебного года</td>
					<td><input type="text" name="s_date_year" value="'; echo $s_date_year; print '" readonly></td>
					<td><input type="text" name="s_date_year" id="datepicker_1" autocomplete="off"></td>
				</tr>
				
				<tr>
					<td>Выберите дату окончания учебного года</td>
					<td><input type="text" name="e_date_year" value="'; echo $e_date_year; print '" readonly></td>
					<td><input type="text" name="e_date_year" id="datepicker_2" autocomplete="off"></td>
				</tr>
				
					<tr>
					<td>Выберите дату начала семестра</td>
					<td><input type="text" name="s_date_sem" value="'; echo $s_date_sem; print '" readonly></td>
					<td><input type="text" name="s_date_sem" id="datepicker_3" autocomplete="off"></td>
				</tr>
				
				<tr>
					<td>Выберите дату окончания семестра</td>
					<td><input type="text" name="e_date_sem" value="'; echo $e_date_sem; print '" readonly></td>
					<td><input type="text" name="e_date_sem" id="datepicker_4" autocomplete="off"></td>
				</tr>
				
				<tr>
					<td>Введите тип семестра</td>
					<td><input type="text" name="type_sem_1" value="'; echo $type_sem[$id_type_sem]; print '" readonly></td>
					<td>';
						/* Организуем цикл для выпадающего списока на вывод типов семестра на основе массива type_sem */
						print '<select name="type_sem_2">';
							$i = 1;
							while ($i <= 2) {
							/* Условие - если тип семестра из списка совпадает с типом семестра из записи, его будем по умолчанию считать выбранным*/
								if($type_sem[$i] != $type_sem[$id_type_sem]){
									print '<option value="'; echo $i; print '">'; echo $type_sem[$i]; print '</option>';
								} else {								
									print '<option selected value="'; echo $day; print '">'; echo $type_sem[$id_type_sem]; print '</option>';
								}
								$i=$i+1;
							}						
							
						print '</select>
					</td>
				</tr>			
				
				<tr>
					<td colspan="3">
						<p align="center">
						    <!-- Кнопка изменения записи -->
							<input type="submit" name="changer" id="changer"/>
						</p>
					</td>
				</tr>'; ?>
				
			<?php
				/* Если нажата кнопка "Изменить" */
				if(isset($_POST['changer'])){
						$s_date_year = trim($_POST['s_date_year']); 
						if(empty($s_date_year)) $s_date_year = date('Y-m-d', strtotime($_POST['s_date_year'])); // если дата не менялась - оставляем прежнюю 
						else $s_date_year = $_POST['s_date_year']; 

						$s_date_2 = trim($_POST['e_date_year']); 
						if(empty($e_date_year)) $e_date_year = date('Y-m-d', strtotime($_POST['e_date_year'])); // если дата не менялась - оставляем прежнюю 
						else $e_date_year = $_POST['e_date_year']; 						
						
						$s_date_2 = trim($_POST['s_date_sem']); 
						if(empty($s_date_sem)) $s_date_sem = date('Y-m-d', strtotime($_POST['s_date_sem'])); // если дата не менялась - оставляем прежнюю 
						else $s_date_sem = $_POST['s_date_sem']; 					
						

						$e_date_2 = trim($_POST['e_date_sem']);
						if(empty($e_date_sem)) $e_date_sem = date('Y-m-d', strtotime($_POST['e_date_sem'])); // та же песня, что и выше 
						else $e_date_sem = $_POST['e_date_sem']; 
						
						$type_sem_2 = $_POST['type_sem_2'];
												
						$query = "UPDATE semestr SET s_date_year='$s_date_year', e_date_year='$e_date_year', 
						s_date_sem='$s_date_sem', e_date_sem='$e_date_sem', id_type_sem='$type_sem_2' WHERE id_sem='$id_sem'";
					
						$result = mysql_query($query) or die(mysql_error());
												
						echo "<script>alert('Изменения внесены в БД. Нажмите ОК для продолжения'); 					
						location.href='http://localhost/admin/semestr/index.php';</script>";
				}
			?>			 				
			</table>
		
	</div>
</body>
</html>