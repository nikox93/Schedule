<?php
/* ------- MODULE FOR STUDENT -------- */
class SelectListStudent
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
                $fac .= '<option value="' . $row['id_fac'] . '" title="' . $row['f_name_fac'] . '">' . $row['s_name_fac'] . '</option>';
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

/* ---------- GENERATE MODULE STUDENT ---------------- */
		
		public function GenSheduleStudent()
        {
		
		$id_gr = $_POST[id_gr]; //id группы
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
  
  include('include/config.php');
  $start_date_sem = strtotime($semestr_date_start); // дата начала семестра из config.php
  $end_date_sem = strtotime($semestr_date_end); // дата конца семестра  из config.php
		
		/* ---------- Формирование запроса ----------------- */
		$query = "SELECT 
			rasp.id_gr, rasp.day, rasp.lesson, rasp.id_week, sub.s_name_sub, sub.f_name_sub, teach.last_name, teach.first_name, teach.father_name, teach.post, classroom.id_cr, type.id_type, DATE_FORMAT(rasp.s_date, '%d.%m.%Y') AS start_date, DATE_FORMAT(rasp.e_date, '%d.%m.%Y') AS end_date, rasp.podgr
		FROM 
			rasp, sub, teach, classroom, type
		WHERE 
			id_gr = $id_gr AND sub.id_sub = rasp.id_sub AND teach.id_teach = rasp.id_teach AND classroom.id_cr = rasp.id_cr AND rasp.id_type = type.id_type	
		ORDER BY rasp.id_week ASC";
		
		$sql = mysql_query($query, $this->conn);
		$num_rows = mysql_num_rows($sql); //Количество записей в таблице, соответсвующие запросу
		
		/* --------------- Формируем массивы ---------------- */
		
		while($row = mysql_fetch_array($sql)) {	
			$day[] = $row['day']; $lesson[] = $row['lesson']; //массив дней и пар
			$cr[] = $row['id_cr']; //массив для аудиторий
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
			$podgr[] = $row['podgr']; // массив для подгрупп
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
		  include('include/gen_student.php');  
	  } /* end else of empty */
	  
   } /* End of GenSheduleStudent */
   
} /* End of SelectListStudent */  

/* --------- MODULE FOR TEACHER ------------ */

class SelectListTeacher
{
		protected $conn_teach;
 
        public function __construct()
        {
            $this->DbConnect();
        }
 
        protected function DbConnect()
        {
            include "db_config.php";
            $this->conn_teach = mysql_connect($host,$user,$password) OR die("Unable to connect to the database");
            mysql_select_db($db,$this->conn_teach) OR die("can not select the database $db");
			mysql_query("SET NAMES 'utf8';"); 
			mysql_query("SET CHARACTER SET 'utf8';"); 
			mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); 
            return TRUE;
        }
		
		public function ShowFacTeach()
        {
            $sql = "SELECT * FROM fac";
            $res = mysql_query($sql,$this->conn_teach);
            $fac = '<option value="0">Выберите...</option>';
            while($row = mysql_fetch_array($res))
            {
                $fac .= '<option value="' . $row['id_fac'] . '" title="' . $row['f_name_fac'] . '">' . $row['s_name_fac'] . '</option>';
            }
            return $fac;
        }
		
		public function ShowKafTeach()
        {
			$id_fac_teach = $_POST[id_fac_teach];
            $sql = "SELECT * FROM kaf WHERE id_fac = $id_fac_teach";
            $res = mysql_query($sql,$this->conn_teach);
            $kaf = '<option value="0">Выберите...</option>';
            while($row = mysql_fetch_array($res))
            {
                $kaf .= '<option value="' . $row['id_kaf'] . '" value="' . $row['f_name_kaf'] . '">' . $row['s_name_kaf'] . '</option>';
            }
            return $kaf;
        }
		
		public function ShowTeachTeach()
        {
			$id_kaf = $_POST[id_kaf];
			
            $sql = "SELECT * FROM teach WHERE id_kaf=$id_kaf";
            $res = mysql_query($sql,$this->conn_teach);
            $teach = '<option value="0">Выберите...</option>';
            while($row = mysql_fetch_array($res))
            {
                $teach .= '<option value="' . $row['id_teach'] . '">' . $row['last_name'] . '</option>';
            }
            return $teach;
        }		

/* ---------- GENERATER MODULE TEACHER ---------------- */
		
		public function GenSheduleTeacher()
        {
		
		$id_teach = $_POST[id_teach]; //id преподавателя
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
  include('include/config.php');
  $start_date_sem = strtotime($semestr_date_start); // дата начала семестра config.php
  $end_date_sem = strtotime($semestr_date_end); // дата конца семестра config.php
		
		/* ---------- Формирование запроса ----------------- */
			$query = "SELECT 
			rasp.id_gr, rasp.day, rasp.lesson, rasp.id_week, sub.s_name_sub, sub.f_name_sub, classroom.id_cr, type.id_type, DATE_FORMAT(rasp.s_date, '%d.%m.%Y') AS start_date, DATE_FORMAT(rasp.e_date, '%d.%m.%Y') AS end_date, rasp.podgr, gr.gr_name
		FROM 
			rasp, sub, classroom, type, gr
		WHERE 
			rasp.id_teach = $id_teach AND sub.id_sub = rasp.id_sub AND classroom.id_cr = rasp.id_cr AND rasp.id_type = type.id_type AND rasp.id_gr = gr.id_gr
		ORDER BY rasp.id_week ASC";
		
		/* $query = "SELECT rasp.id_gr, rasp.day, rasp.lesson, rasp.id_week, rasp.id_sub, sub.s_name_sub FROM rasp, sub WHERE rasp.id_teach = $id_teach AND rasp.id_sub = sub.id_sub"; */
		
		$sql = mysql_query($query,$this->conn_teach);
		$num_rows = mysql_num_rows($sql); //Количество записей в таблице, соответсвующие запросу
		
		/* --------------- Формируем массивы ---------------- */
		
		while($row = mysql_fetch_array($sql)) {	
		
			// echo $row['day']," ",$row['lesson']," ",$row['id_week']," ",$row['s_name_sub'],"<br/>";
		
			$day[] = $row['day']; $lesson[] = $row['lesson']; //массив дней и пар
			$cr[] = $row['id_cr']; //массив для аудиторий
			$gr_name[] = $row['gr_name']; //массив для названий групп
  			$s_sub[] = $row['s_name_sub']; //массив для укороченного наименования предмета
			$f_sub[] = $row['f_name_sub']; //массив для полного наименования предмета
			$type[] = $row['id_type']; // массив для типа занятия (лекция, практика или лабораторная работа)
			$id_week[] = $row['id_week']; // массив для типа недели
			$start_date[] = $row['start_date']; // массив для даты начала занятия
			$end_date[] = $row['end_date']; // массив для даты конца занятия
			$podgr[] = $row['podgr']; // массив для подгрупп  
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
		  include('include/gen_teacher.php');  
	  } /* end else of empty */
	  
   } /* End of GenSheduleTeacher */
		
} /* End of SelectListTeacher */
    
$optStudent = new SelectListStudent();
$optTeacher = new SelectListTeacher();
?>