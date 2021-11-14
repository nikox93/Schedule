/* ---------------- Модуль функционирования select ---------------------------- */  
      
		$(document).ready(function(){
            $("select#gr").attr("disabled","disabled");
			$("select#kurs").attr("disabled","disabled");
			$("select#week").attr("disabled","disabled");
			
			var id_f, id_k, id_gr, id_week;//id of fac, id of kurs, id of group
				//select fac...
            	$("select#fac").change(function(){
					$("#result").empty();  //clear all
					$("select#kurs").attr("disabled","disabled");
            		$("select#kurs").html("<option>Подождите...</option>");
					$("select#gr").attr("disabled","disabled");
            		$("select#gr").html("<option>Выбрать...</option>");
					//memorize id of fac
            		id_f = $("select#fac option:selected").attr('value');
					$("select#kurs").load("include/select_kurs.php");
					$("select#kurs").removeAttr("disabled");
				}); /* ????? change(function()#fac */
						
				//Select kurs...
				$("select#kurs").change(function() {
						$("#result").empty();  //clear all
            			$("select#gr").attr("disabled","disabled");
            			$("select#gr").html("<option>Подождите...</option>");
						//memorize id of kurs
            			id_k = $("select#kurs option:selected").attr('value');	
            			$.post("include/select_gr.php", {id_k:id_k, id_f:id_f}, function(data){
                		$("select#gr").removeAttr("disabled");
                		$("select#gr").html(data);
			 			});/* end of function(data) */
				}); /* end of change(function())#kurs */	
								
			 	$("select#gr").change(function(){
			 			id_gr = $("select#gr option:selected").attr('value');	
						$("select#week").load("include/select_week.php");
					    $("select#week").removeAttr("disabled");
						/*
            			$.post("include/select_week.php", {id_gr:id_gr}, function(data){
						$("select#week").removeAttr("disabled");
                		$("select#week").html(data);
			 			}); end of function(data) */	
				}); /* end of change(function()#gr */
				
				$("select#week").change(function(){
			 			id_week = $("select#week option:selected").attr('value');	
            			$.post("include/gen_shedule.php", {id_gr:id_gr,id_week:id_week}, function(data){
                		$("#result").html(data);
			 			});/* end of function(data) */	
				}); /* end of change(function()#gr */

  		});

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