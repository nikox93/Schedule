/* ---------------- Модуль функционирования select ----------------------------  
      
$(document).ready(function(){
	
			// ------------------------- ALL PARAMETRS OF SYSTEM ----------------------- 
			
            $("select#gr").attr("disabled","disabled");
			$("select#kurs").attr("disabled","disabled");
			//for teacher
			$("select#kaf").attr("disabled","disabled");
			$("select#teach").attr("disabled","disabled");
			//main date of shedule
			$("input#datepicker_1").attr("disabled","disabled");
			$("input#datepicker_2").attr("disabled","disabled"); 
			
			var id_f, s_date_rasp, e_date_rasp;// main - id of fac, start and end date of shedule
			var id_k, id_gr; // student - id of kurs, id of group
			var id_fac_teach,id_kaf, id_teach; // teacher - id of fac, id of kaf, id of teach
			
// ------------- MODULE FOR STUDENT ----------------- 

            	$("select#fac").change(function(){
					$("#result").empty();  //clear all
					$("input#datepicker_1").attr("disabled","disabled");
					$("input#datepicker_2").attr("disabled","disabled"); 
					$("select#kurs").attr("disabled","disabled");
            		$("select#kurs").html("<option>Подождите...</option>");
					$("select#gr").attr("disabled","disabled");
            		$("select#gr").html("<option>Выбрать...</option>");
					//memorize id of fac
            		id_f = $("select#fac option:selected").attr('value');
					$("select#kurs").load("include/select/student/select_kurs.php");
					$("select#kurs").removeAttr("disabled");
				}); // ????? change(function()#fac 
						
				//Select kurs...
				$("select#kurs").change(function() {
						$("#result").empty();  //clear all
						$("input#datepicker_1").attr("disabled","disabled");
						$("input#datepicker_2").attr("disabled","disabled"); 
            			$("select#gr").attr("disabled","disabled");
            			$("select#gr").html("<option>Подождите...</option>");
						//memorize id of kurs
            			id_k = $("select#kurs option:selected").attr('value');	
            			$.post("include/select/student/select_gr.php", {id_k:id_k, id_f:id_f}, function(data){
                		$("select#gr").removeAttr("disabled");
                		$("select#gr").html(data);
			 			}); // end of function(data) 
				}); // end of change(function())#kurs 	
								
			 	$("select#gr").change(function(){
						$("#result").empty();  //clear all
						$("input#datepicker_1").val('');
						$("input#datepicker_2").val('');
            			$("input#datepicker_1").attr("disabled","disabled");
						$("input#datepicker_2").attr("disabled","disabled"); 
						
			 			id_gr = $("select#gr option:selected").attr('value');	
					    $("input#datepicker_1").removeAttr("disabled");
				}); // end of change(function()#gr 
				
				$("input#datepicker_1").change(function(){
						$("input#datepicker_2").val('');
			 			s_date_rasp = $("input#datepicker_1").val();
						$("input#datepicker_2").removeAttr("disabled");	
            			
				}); // end of change(function()#input#datepicker_1 
				
				$("input#datepicker_2").change(function(){
			 			e_date_rasp = $("input#datepicker_2").val();
            			$.post("include/select/student/gen_shedule_student.php", {id_gr:id_gr,s_date_rasp:s_date_rasp,e_date_rasp:e_date_rasp}, function(data){
                		$("#result").html(data);
			 			});// end of function(data) 
				}); // end of change(function()#input#datepicker_2 

// ------------- MODULE FOR TEACHER ----------------- 

			$("select#fac_teach").change(function(){
					$("#result").empty();  //clear all
					$("input#datepicker_1").attr("disabled","disabled");
					$("input#datepicker_2").attr("disabled","disabled"); 
					$("select#kaf").attr("disabled","disabled");
            		$("select#kaf").html("<option>Подождите...</option>");
					$("select#teach").attr("disabled","disabled");
            		$("select#teach").html("<option>Выбрать...</option>");
					//memorize id of fac
            		id_fac_teach = $("select#fac_teach option:selected").attr('value');
					$.post("include/select/teacher/select_kaf.php", {id_fac_teach:id_fac_teach}, function(data){
                		$("select#kaf").removeAttr("disabled");
                		$("select#kaf").html(data);
			 			});// end of function(data) 
				}); // ????? change(function()#fac 
						
				//Select kafedra...
				$("select#kaf").change(function() {
						$("#result").empty();  //clear all
						$("input#datepicker_1").attr("disabled","disabled");
						$("input#datepicker_2").attr("disabled","disabled"); 
            			$("select#teach").attr("disabled","disabled");
            			$("select#teach").html("<option>Подождите...</option>");
						//memorize id of kaf
            			id_kaf = $("select#kaf option:selected").attr('value');	
            			$.post("include/select/teacher/select_teach.php", {id_kaf:id_kaf}, function(data){
                		$("select#teach").removeAttr("disabled");
                		$("select#teach").html(data);
			 			});// end of function(data) 
				}); // end of change(function())#kurs 
								
			 	$("select#teach").change(function(){
						$("#result").empty();  //clear all
						$("input#datepicker_1").val('');
						$("input#datepicker_2").val('');
            			$("input#datepicker_1").attr("disabled","disabled");
						$("input#datepicker_2").attr("disabled","disabled"); 
						
			 			id_teach = $("select#teach option:selected").attr('value');	
					    $("input#datepicker_1").removeAttr("disabled");
				}); // end of change(function()#gr 
				
				$("input#datepicker_1").change(function(){
						$("input#datepicker_2").val('');
			 			s_date_rasp = $("input#datepicker_1").val();
						$("input#datepicker_2").removeAttr("disabled");	
            			
				}); // end of change(function()#input#datepicker_1 
				
				$("input#datepicker_2").change(function(){
			 			e_date_rasp = $("input#datepicker_2").val();
            			$.post("include/select/teacher/gen_shedule_teach.php", {id_teach:id_teach, s_date_rasp:s_date_rasp, e_date_rasp:e_date_rasp}, function(data){
                		$("#result").html(data);
			 			});// end of function(data) 
				}); // end of change(function()#input#datepicker_2 
				
});  // end of main function 
*/
				
/* --------------------------- Дата и время ---------------------- */

function clock() {
var d = new Date();
var month_num = d.getMonth()
var day = d.getDate();
var hours = d.getHours();
var minutes = d.getMinutes();
var seconds = d.getSeconds();

month=new Array("января", "февраля", "марта", "апреля", "мая", "июня",
"июля", "августа", "сентября", "октября", "ноября", "декабря");

if (day <= 9) day = "0" + day;
if (hours <= 9) hours = "0" + hours;
if (minutes <= 9) minutes = "0" + minutes;
if (seconds <= 9) seconds = "0" + seconds;

date_time = "Сегодня - " + day + " " + month[month_num] + " " + d.getFullYear() + 
" г.<br> Текущее время - "+ hours + ":" + minutes + ":" + seconds;
if (document.layers) {
 document.layers.doc_time.document.write(date_time);
 document.layers.doc_time.document.close();
}
else document.getElementById("full_date").innerHTML = date_time;
 setTimeout("clock()", 1000);
}

/* --------------------------- Печать документа ---------------------- */
/* function docprint() {
	document.getElementById("header").style.display = "none";
	document.getElementById("generator_rasp").style.display = "none";
	print();
	document.getElementsByClassName("ClickMe").style.display = "none";
}; */