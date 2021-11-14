$(document).ready(function(){
	
			/* ------------------------- ALL PARAMETRS OF SYSTEM ----------------------- */
			
            $("select#gr").attr("disabled","disabled");
			$("select#kurs").attr("disabled","disabled");
			//main date of shedule
			$("input#datepicker_1").attr("disabled","disabled");
			$("input#datepicker_2").attr("disabled","disabled"); 
			
			var id_f, id_k, id_gr, s_date_rasp, e_date_rasp; // student var
			
/* ------------- MODULE FOR STUDENT ----------------- */

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
				}); /* ????? change(function()#fac */
						
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
			 			});/* end of function(data) */
				}); /* end of change(function())#kurs */	
								
			 	$("select#gr").change(function(){
						$("#result").empty();  //clear all
						$("input#datepicker_1").val('');
						$("input#datepicker_2").val('');
            			$("input#datepicker_1").attr("disabled","disabled");
						$("input#datepicker_2").attr("disabled","disabled"); 
						
			 			id_gr = $("select#gr option:selected").attr('value');	
					    $("input#datepicker_1").removeAttr("disabled");
				}); /* end of change(function()#gr */
				
				$("input#datepicker_1").change(function(){
						$("input#datepicker_2").val('');
			 			s_date_rasp = $("input#datepicker_1").val();
						$("input#datepicker_2").removeAttr("disabled");	
            			
				}); /* end of change(function()#input#datepicker_1 */
				
				$("input#datepicker_2").change(function(){
			 			e_date_rasp = $("input#datepicker_2").val();
            			$.post("include/select/student/gen_shedule_student.php", {id_gr:id_gr,s_date_rasp:s_date_rasp,e_date_rasp:e_date_rasp}, function(data){
                		$("#result").html(data);
			 			});/* end of function(data) */	
				}); /* end of change(function()#input#datepicker_2 */
				
}); /* end of main function */