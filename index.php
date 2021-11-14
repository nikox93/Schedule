<html>
<head>
<meta content="text/html; charset=utf-8"/>
<title>Мой дипломный проект</title>
<link type="text/css" rel="stylesheet" href="css/style.css"/>
<script type="text/javascript" src="js/lib/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>

<!-- Datepicker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
  <script src="js/lib/jquery.ui.datepicker-ru.js"> //русификатор </script> 
  <script>
  $(function() {
    $("#datepicker_1").datepicker();
	
	$("#datepicker_2").datepicker();
  });
  </script>
  
</head>
<body>
	<div id="wrapper">
    	<div id="header">
        
<!-- Отображение недели и времени -->

        	<div id="date">
            	<?php include('include/date_week.php'); // модуль расчёта номера и типа недели, получение значений семестра ?>
                <p><div id="full_date"> 
                <script>clock();</script>
                </div></p>
            </div><!-- end of date -->
            
<!-- Логотип сайта -->
            
            <div id="logo">
    			<a href="http://nikomydiplom.ru"><img src="logo.png"/></a>
                
<!-- Отображение семестра -->
                
                	<div id="sem">
						<?php 
						echo $name_sem," семестр ", 
						date('Y',strtotime($year_date_start)),
						" / ",
						date('Y',strtotime($year_date_end)),
						" гг.";
						?>
                	</div><!-- end of sem -->
            </div><!-- end of logo -->
            <div class="clear"></div>
            
<!-- Меню сайта -->

            <div>
            	<ul>
                	<li><a href="?type_rasp=1">Расписание для студента</a></li>
                    <li><a href="?type_rasp=2">Расписание для преподавателя</a></li>
                    <li><a href="?type_rasp=3">Расписание для аудитории</a></li>
                </ul>
            <div class="clear"></div> 
            </div><!--end of menu -->
            <div class="clear"></div>
            
    	</div><!--end of header -->

<!-- Форма генерации расписания -->  
 
    	<div id="generator_rasp"> 
    	<?php 
		// Выбор формы типа расписания
		$type_rasp = $_GET['type_rasp'];
		switch($type_rasp) {
		
			case 1: /* ---- Генерируем форму расписания для студента ---- */
				
				include 'select.class.student.php';
				echo "<script type=\"text/javascript\" src=\"js/select/student_choose.js\"></script>"; 
				
				print '
				<h2 align="center">Расписание для студента</h2>
            	<table align="center">
				<form id="select_form">
                	<tr>
                    	<th width="225" align="center">Выберите факультет:</th>
                        <th width="225" align="center">Выберите поток:</th>
                        <th width="225" align="center">Выберите группу:</th>
                    </tr>
                    <tr>
                    	<td width="225" align="center">
            			<select class="styled-select" id="fac" style="width: 200px;">';
 							 echo $optStudent->ShowFac();
            			print '</select>
                        </td> 
                        <td width="225" align="center">         
            			<select class="styled-select"  id="kurs" style="width: 200px;">
                			<option value="0">Выбрать...</option>
            			</select>
                        </td>
                        <td width="225" align="center">         
            			<select class="styled-select"  id="gr" name="gr" style="width: 200px;">
                			<option value="0">Выбрать...</option>
            			</select>
                        </td>
                		
                    </tr>
                    <tr>
                    	<td colspan="100%" align="center">
                        	<p>
                            <b>Дата начала расписания:</b> 
                            <input class="styled-select" type="text" name="start_date_rasp" id="datepicker_1">
                            <b> - </b>
							<b>Дата конца расписания:</b> 
                            <input class="styled-select" type="text" name="end_date_rasp" id="datepicker_2">
                            </p>
                        </td>
                    </tr>
                  </form>
                  </table>';
				  break;
			
			
			case 2: /* ---- Генерируем форму расписания для преподавателя ---- */
			
			include 'select.class.teacher.php'; 
			echo "<script type=\"text/javascript\" src=\"js/select/teacher_choose.js\"></script>"; 
			
			print '
			<h2 align="center">Расписание для преподавателя</h2>
            	<table align="center">
				<form id="select_form">
                	<tr>
                    	<th width="225" align="center">Выберите факультет:</th>
                        <th width="225" align="center">Выберите кафедру:</th>
                        <th width="225" align="center">Выберите преподавателя:</th>
                    </tr>
                    <tr>
                    	<td width="225" align="center">
            			<select class="styled-select" id="fac_teach" style="width: 200px;">';
 							 echo $optTeacher->ShowFacTeach();
            			print '</select>
                        </td> 
                        <td width="225" align="center">         
            			<select class="styled-select" id="kaf" style="width: 200px;">
                			<option value="0">Выбрать...</option>
            			</select>
                        </td>
                        <td width="225" align="center">         
            			<select class="styled-select" id="teach" name="gr" style="width: 200px;">
                			<option value="0">Выбрать...</option>
            			</select>
                        </td>
                		
                    </tr>
                    <tr>
                    	<td colspan="100%" align="center">
                        	<p>
                            <b>Дата начала расписания:</b> 
                            <input class="styled-select" type="text" name="start_date_rasp" id="datepicker_1">
                            <b> - </b>
							<b>Дата конца расписания:</b> 
                            <input class="styled-select" type="text" name="end_date_rasp" id="datepicker_2">
                            </p>
                        </td>
                    </tr>
                  </form>
                  </table>'; 
				  break;	
				  
				  case 3: /* ---- Генерируем форму расписания для аудиторий ---- */
				  
				  include 'select.class.classroom.php'; 
				  echo "<script type=\"text/javascript\" src=\"js/select/classroom_choose.js\"></script>"; 
				  
				  //echo 'Данный раздел находится в разработке';
						print '
						<h2 align="center">Расписание для аудитории</h2>
            			<table align="center">
						<form id="select_form">
                		<tr>
                    		<th width="225" align="center">Выберите аудиторию:</th>
                        	<th width="225" align="center">Дата начала расписания:</th>
                        	<th width="225" align="center">Дата конца расписания:</th>
                    	</tr>
                    	<tr>
                    		<td width="225" align="center">
            				<select class="styled-select" id="classroom" style="width: 200px;">';
 							 	echo $optCr->ShowNumberCr();
            			print '</select>
                        </td> 
                        <td width="225" align="center">         
            			<input class="styled-select" type="text" style="width: 180px;" name="start_date_rasp" id="datepicker_1">						
                        </td>
                        <td width="225" align="center">         
            			<input class="styled-select" type="text" style="width: 180px;" name="end_date_rasp" id="datepicker_2">						
                        </td>	
                    </tr>                    
                  </form>
                  </table>'; 
				  break;  
		} /* end of switch */
			?>
            
</div> <!-- end of generator_rasp -->
      	
        <div id="result">
        
        </div>
	</div><!-- end of wrapper -->
</body>
</html>