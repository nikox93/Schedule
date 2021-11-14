<?php
class SelectList
{
    protected $conn;
 
        public function __construct()
        {
            $this->DbConnect();
        }
 
        protected function DbConnect()
        {
            include "db_config.php";
            $this->conn = mysql_connect($host,$user,$password) OR die("Unable to connect to the database");
            mysql_select_db($db,$this->conn) OR die("can not select the database $db");
			mysql_query("SET NAMES 'utf8';"); 
			mysql_query("SET CHARACTER SET 'utf8';"); 
			mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); 
            return TRUE;
        }
        public function ShowFac()
        {
            $sql = "SELECT * FROM fac";
            $res = mysql_query($sql,$this->conn);
            $fac = '<option value="0">Выберите...</option>';
            while($row = mysql_fetch_array($res))
            {
                $fac .= '<option value="' . $row['id_fac'] . '">' . $row['fac_name'] . '</option>';
            }
            return $fac;
        }
		
 		public function ShowKurs()
        {
            $sql = "SELECT * FROM kurs ORDER BY id_kurs DESC";
            $res = mysql_query($sql,$this->conn);
            $kurs = '<option value="0">Выберите...</option>';
            while($row = mysql_fetch_array($res))
            {
                $kurs .= '<option value="' . $row['id_kurs'] . '">' . $row['name_kurs'] . '</option>';
            }
            return $kurs;
        }
		
		public function ShowWeek()
        {
            $sql = "SELECT * FROM week";
            $res = mysql_query($sql,$this->conn);
            $week = '<option value="0">Выберите...</option>';
            while($row = mysql_fetch_array($res))
            {
                $week .= '<option value="' . $row['id_week'] . '">' . $row['name_week'] . '</option>';
            }
            return $week;
        }
		
        public function ShowGr()
        {
			$id_f = $_POST[id_f];
			$id_k = $_POST[id_k];
			
            $sql = "SELECT * FROM gr WHERE id_fac=$id_f AND id_kurs=$id_k";
            $res = mysql_query($sql,$this->conn);
            $gr = '<option value="0">Выберите...</option>';
            while($row = mysql_fetch_array($res))
            {
                $gr .= '<option value="' . $row['id_gr'] . '">' . $row['gr_name'] . '</option>';
            }
            return $gr;
        }
		
		public function GenShedule()
        {
		$n = 9;//Количество строк
		$m = 9;//Количество столбцов
		$id_gr = $_POST[id_gr]; //id группы
		$index_week = $_POST[id_week]; //id недели
		$date_today = date('d.m.Y'); //сегодняшняя дата
		
		/* ---------- Формирование запроса ----------------- */
		$query = "SELECT 
			rasp.id_gr, rasp.day, rasp.lesson, rasp.id_week, sub.s_name_sub, sub.f_name_sub, teach.last_name, teach.first_name, teach.father_name, teach.post, classroom.id_cr, type.id_type, DATE_FORMAT(rasp.s_date, '%d.%m.%Y') AS start_date, DATE_FORMAT(rasp.e_date, '%d.%m.%Y') AS end_date, rasp.podgr
		FROM 
			rasp, sub, teach, classroom, type
		WHERE 
			id_gr = $id_gr AND id_week = $index_week  AND sub.id_sub = rasp.id_sub AND teach.id_teach = rasp.id_teach AND classroom.id_cr = rasp.id_cr AND rasp.id_type = type.id_type	
		ORDER BY rasp.id_week ASC";
		
		$sql = mysql_query($query);
		$num_rows = mysql_num_rows($sql); //Количество записей в таблице, соответсвующие запросу
		
		/* --------------- Формируем массивы ---------------- */
		
		while($row = mysql_fetch_array($sql)) {	
			$day[] = $row['day']; $lesson[] = $row['lesson'];
			$cr[] = $row['id_cr'];
			$teacher_post[] = $row['post'];
  			$teacher_last_name[] = $row['last_name'];
			$teacher_first_name[] = $row['first_name']; 
			$teacher_father_name[] = $row['father_name'];
  			$s_sub[] = $row['s_name_sub'];
			$f_sub[] = $row['f_name_sub'];
			$type[] = $row['id_type'];
			$id_week[] = $row['id_week'];
			$start_date[] = $row['start_date'];
			$end_date[] = $row['end_date'];
			$podgr[] = $row['podgr'];
		}
		
		/* ---------- строим таблицу ---------------*/
		
		
		echo "<table border=\"1\" cellpadding=\"5\" id=\"shedule\">";
				for($r=1; $r <= $n; $r++) { // по строкам
					echo "<tr>";
					for($c=1; $c <= $m; $c++) {	// по столбцам
					
					/* Генерация заголовка таблицы */
						if($r == 1) {
						echo "<th id=\"$r$c\">"; 
						include('include/header_table_schedule.php');
						echo "</th>";
					/* Генерация остальное части таблицы */
						} else {
							echo "<td id=\"$r$c\">";
									// внутри каждой ячейки генерируется таблица, в которой будут выводится занятия
									echo "<table>";	
									echo "<tbody>";	
									
									/* ------ Распределяем расписание по дням ----------- */
									for ($i=0; $i<$num_rows; $i++){ //цикл по записям расписания группы
									
if(($day[$i]+2) == $c && ($lesson[$i]+1) == $r && 
strtotime($date_today) >= strtotime($start_date[$i]) && 
strtotime($date_today) <= strtotime($end_date[$i])) { // проверка соответствия трем параметрам - день, пара и временной интервал
																						
											if($podgr[$i] == 1) {
												
											/* ------ Распределяем расписание по неделям ----------- */					
												switch($id_week[$i]) {
										
												case 1: /* занятие по верхней неделе */
													
													echo "<td class=\"up_week_undergroup\">";
													include("include/cell_material.php");
													echo "</td>";	
													break;							
										
												case 2: /* занятие по нижней неделе */
													
													echo "<td class=\"low_week_undergroup\">";
													include("include/cell_material.php");
													echo "</td>";
													break;
										
												case 3: /* Еженедельное занятие */
													
													echo "<td>";				
													include("include/cell_material.php");
													echo "</td>";	
													break;
													
												} /* end case of id_week */												
												
											} else {
												
												switch($id_week[$i]) {
										
												case 1: /* занятие по верхней неделе */
													
													echo "<tr>";
													echo "<td class=\"up_week\" colspan=\"100%\">";
													include("include/cell_material.php");
													echo "</td>";	
													echo "</tr>";
													break;							
										
												case 2: /* занятие по нижней неделе */
													
													echo "<tr>";
													echo "<td class=\"low_week\" colspan=\"100%\">";
													include("include/cell_material.php");
													echo "</td>";
													echo "</tr>";
													break;
										
												case 3: /* Еженедельное занятие */
													
													echo "<tr>";
													echo "<td colspan=\"100%\">";				
													include("include/cell_material.php");
													echo "</td>";	
													echo "</tr>";
													break;
												
												} /* end case of id_week */		
											
											} /* end if-else of podgr */
											
										} 	/* end for if for days, lessons and time interval */	
					
								}  /* end cycle for num_rows */
								 
								echo "</tbody>";
								echo "</table>";
							echo "</td>";	
							} /* end else */
						} /* end cycle for c */
					echo "</tr>";
					}  /* end cycle for r */
				echo "</table>";
				
/*-------------------- Скрипт заполнения таблицы данными - днями и временем ----------------*/

echo "<script type=\"text/javascript\" src=\"js/form_shedule.js\"></script>";

        } /* End of GenShedule */

} /* End of SelectList */
 
$opt = new SelectList();
?>