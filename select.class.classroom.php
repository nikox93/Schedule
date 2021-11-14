<?php
/* --------- MODULE FOR TEACHER ------------ */

class SelectListCr
{
		protected $conn_cr;
 
        public function __construct()
        {
            $this->DbConnect();
        }
 
        protected function DbConnect()
        {
            include "include\config\db_config.php";
            $this->conn_cr = mysql_connect($host,$user,$password) OR die("Unable to connect to the database");
            mysql_select_db($db,$this->conn_cr) OR die("can not select the database $db");
			mysql_query("SET NAMES 'utf8';"); 
			mysql_query("SET CHARACTER SET 'utf8';"); 
			mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); 
            return TRUE;
        }
		
		public function ShowNumberCr()
        {
            $sql = "SELECT * FROM classroom ORDER BY id_cr ASC";
            $res = mysql_query($sql,$this->conn_cr);
            $classroom = '<option value="0">Выберите...</option>';
            while($row = mysql_fetch_array($res))
            {
                $classroom .= '<option value="' . $row['id_cr'] . '">' 
				. $row['corp'] . '-' .  $row['floor'] . '-' . $row['number'] .
				'</option>';
            }
            return $classroom;
        }
		
		/* public function ShowFloorCr()
        {
			$id_corp = $_POST[id_corp];
            $sql = "SELECT floor FROM classroom WHERE corp = $id_corp GROUP BY floor ORDER BY floor ASC";
            $res = mysql_query($sql,$this->conn_teach);
            $floor = '<option value="0">Выберите...</option>';
            while($row = mysql_fetch_array($res))
            {
                $floor .= '<option value="' . $row['floor'] . '">' . $row['floor'] . '</option>';
            }
            return $floor;
        }
		
		public function ShowClassroomCr()
        {
			$id_floor = $_POST[id_floor];
			
            $sql = "SELECT id_cr, number FROM classroom WHERE floor = $id_floor GROUP BY number ORDER BY number ASC";
            $res = mysql_query($sql,$this->conn_teach);
            $classroom = '<option value="0">Выберите...</option>';
            while($row = mysql_fetch_array($res))
            {
                 $classroom .= '<option value="' . $row['id_cr'] . '">' . $row['number'] . '</option>';
            }
            return $classroom;
        } */		

/* ---------- GENERATER MODULE CLASSROOM ---------------- */
		
		public function GenSheduleCr()
        {
		
		$id_classroom = $_POST[id_cr]; //id преподавателя
		$start_date_rasp = strtotime($_POST[s_date_rasp]); //дата начала расписания
		$end_date_rasp = strtotime($_POST[e_date_rasp]); //дата окончания расписания
		$date_today = date('d.m.Y'); //сегодняшняя дата
		
$name_day_of_week = array(
  	1 => "Понедельник",
	2 => "Вторник",
	3 => "Среда",
	4 => "Четверг",
	5 => "Пятница",
	6 => "Суббота",
	7 => "Воскресенье"
  ); //Название дней недели
  
$header = array(
  	1 => "Дата",
	2 => "9:00-10:25",
	3 => "10:35-12:00",
	4 => "12:30-13:55",
	5 => "14:05-15:30",
	6 => "15:35-16:55",
	7 => "17:00-18:20",
	8 => "18:30-19:55",
	9 => "20:10-21:35"
  ); //Название для заголовка таблицы
  include('include/config/config.php');
  $start_date_sem = strtotime($semestr_date_start); // дата начала семестра config.php
  $end_date_sem = strtotime($semestr_date_end); // дата конца семестра config.php
		
		/* ---------- Формирование запроса ----------------- */
			$query = "SELECT 
			rasp.day, rasp.lesson, rasp.id_week, sub.s_name_sub, sub.f_name_sub, type.id_type, DATE_FORMAT(rasp.s_date, '%d.%m.%Y') AS start_date, DATE_FORMAT(rasp.e_date, '%d.%m.%Y') AS end_date, teach.last_name, teach.first_name, teach.father_name, teach.post, gr.gr_name
		FROM 
			rasp, sub, type, gr, teach
		WHERE 
			rasp.id_cr = $id_classroom AND sub.id_sub = rasp.id_sub AND rasp.id_type = type.id_type AND rasp.id_gr = gr.id_gr AND teach.id_teach = rasp.id_teach AND rasp.id_gr = gr.id_gr
		ORDER BY rasp.id_week ASC";
		
		/* $query = "SELECT rasp.id_gr, rasp.day, rasp.lesson, rasp.id_week, rasp.id_sub, sub.s_name_sub FROM rasp, sub WHERE rasp.id_teach = $id_teach AND rasp.id_sub = sub.id_sub"; */
		
		$sql = mysql_query($query,$this->conn_cr);
		$num_rows = mysql_num_rows($sql); //Количество записей в таблице, соответсвующие запросу
		
		/* --------------- Формируем массивы ---------------- */
		
		while($row = mysql_fetch_array($sql)) {	
		
			// echo $row['day']," ",$row['lesson']," ",$row['id_week']," ",$row['s_name_sub'],"<br/>";
		
			$day[] = $row['day']; $lesson[] = $row['lesson']; //массив дней и пар
			$gr_name[] = $row['gr_name']; //массив для названий групп
			$teacher_post[] = $row['post']; //массив для должности преподавателей
  			$teacher_last_name[] = $row['last_name']; //массив для фамилии преподавателей
			$teacher_first_name[] = $row['first_name'];  //массив для имени преподавателей
			$teacher_father_name[] = $row['father_name']; //массив для отчества преподавателей
  			$s_sub[] = $row['s_name_sub']; //массив для укороченного наименования предмета
			$f_sub[] = $row['f_name_sub']; //массив для полного наименования предмета
			$type[] = $row['id_type']; // массив для типа занятия (лекция, практика или лабораторная работа)
			$id_week[] = $row['id_week']; // массив для типа недели
			$start_date[] = $row['start_date']; // массив для даты начала занятия
			$end_date[] = $row['end_date']; // массив для даты конца занятия
			// $podgr[] = $row['podgr'];  массив для подгрупп  
		}
		
		/* ---------- строим таблицу ---------------*/		
		
	  if(empty($start_date_rasp) || empty($end_date_rasp) || ($start_date_sem - $start_date_rasp) > 0 || ($end_date_sem - $end_date_rasp) < 0 || 
	  $start_date_rasp > $end_date_rasp) {
		   
	      echo "Возможны вы допустили следующие ошибки:";
		  echo "<ul>";
		  echo "<li>Не заполнено какое-либо поле/поля,</li>";
		  echo "<li>Нужно выбрать даты в пределах: от ",date("d.m.Y",$start_date_sem)," до ",date("d.m.Y",$end_date_sem),".</li>";
		  echo "<li>Дата ОТ позже, чем дата ДО.</li>";
		  echo "</ul>";
	      exit();  
	  } else {	
		  include('include/gen_classroom.php');  
	  } /* end else of empty */
   } /* End of GenSheduleTeacher */
		
} /* End of SelectListTeacher */
    
$optCr = new SelectListCr();
?>