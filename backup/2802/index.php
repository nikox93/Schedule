<html>
<head>
<meta content="text/html; charset=utf-8"/>
<title>Мой дипломный проект</title>
<link type="text/css" rel="stylesheet" href="css/style.css"/>
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</head>
<body>
<?php include "select.class.php"; // модуль работы с id и генерации расписания ?>
	<div id="wrapper">
    	<div id="header">
        	<div id="date">
            	<?php include('include/date_week.php'); // модуль расчёта номера и типа недели, получение знаений семестра ?>
                <p><div id="full_date"> 
                <script>clock();</script>
                </div></p>
            </div><!-- end of date -->
            <div id="logo">
    			<a href="http://nikomydiplom.ru"><img src="logo.png"/></a>
                <div id="sem">
				<?php 
				echo $name_sem," семестр ", 
				date('Y',strtotime($year_date_start)),
				" / ",
				date('Y',strtotime($year_date_end)),
				" гг.";
				?>
                </div>
            </div><!-- end of logo -->
            <div class="clear"></div>
    	</div><!--end of header -->
    <!-- Сюда вставить меню из backup.txt --> 
			<h2 align="center">Расписание для студента на две недели</h2>
            	<table align="center">
				<form id="select_form">
                	<tr>
                    	<th width="225" align="center">Выберите факультет:</th>
                        <th width="225" align="center">Выберите поток:</th>
                        <th width="225" align="center">Выберите группу:</th>
                        <th width="225" align="center">Выберите неделю:</th>
                    </tr>
                    <tr>
                    	<td width="225" align="center">
            			<select class="styled-select" id="fac" style="width: 200px;">
 							<?php echo $opt->ShowFac(); ?>
            			</select>
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
                        </td>
                        <td width="225" align="center">         
            			<select class="styled-select"  id="week" name="week" style="width: 200px;">
                			<option value="0">Выбрать...</option>
            			</select>
                        </td>
                    </tr>
                  </form>
                  </table>
        <!-- <div id="result_1"></div> -->
        <div id="result"></div>
	</div><!-- end of wrapper -->
</body>
</html>