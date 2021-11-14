$(document).ready(function(){
	
			/* ------------------------- ALL PARAMETRS OF SYSTEM ----------------------- */
			
			//for teacher
			$("select#kaf").attr("disabled","disabled");
			$("select#teach").attr("disabled","disabled");
			//main date of shedule
			$("input#datepicker_1").attr("disabled","disabled");
			$("input#datepicker_2").attr("disabled","disabled"); 
		
			var id_fac_teach,id_kaf, id_teach, s_date_rasp, e_date_rasp; // teacher var

/* ------------- MODULE FOR TEACHER ----------------- */

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
			 			});/* end of function(data) */
				}); /* ????? change(function()#fac_teach */
						
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
			 			});/* end of function(data) */
				}); /* end of change(function())#kaf */	
								
			 	$("select#teach").change(function(){
						$("#result").empty();  //clear all
						$("input#datepicker_1").val('');
						$("input#datepicker_2").val('');
            			$("input#datepicker_1").attr("disabled","disabled");
						$("input#datepicker_2").attr("disabled","disabled"); 
						
			 			id_teach = $("select#teach option:selected").attr('value');	
					    $("input#datepicker_1").removeAttr("disabled");
				}); /* end of change(function()#teach */
				
				$("input#datepicker_1").change(function(){
						$("input#datepicker_2").val('');
			 			s_date_rasp = $("input#datepicker_1").val();
						$("input#datepicker_2").removeAttr("disabled");	
            			
				}); /* end of change(function()#input#datepicker_1 */
				
				$("input#datepicker_2").change(function(){
			 			e_date_rasp = $("input#datepicker_2").val();
            			$.post("include/select/teacher/gen_shedule_teach.php", {id_teach:id_teach, s_date_rasp:s_date_rasp, e_date_rasp:e_date_rasp}, function(data){
                		$("#result").html(data);
			 			});/* end of function(data) */	
				}); /* end of change(function()#input#datepicker_2 */
				
}); /* end of main function */