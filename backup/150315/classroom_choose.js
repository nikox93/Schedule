$(document).ready(function(){
	
			/* ------------------------- ALL PARAMETRS OF SYSTEM ----------------------- */
			
			//for classroom
			$("select#floor").attr("disabled","disabled");
			$("select#cr").attr("disabled","disabled");
			//main date of shedule
			$("input#datepicker_1").attr("disabled","disabled");
			$("input#datepicker_2").attr("disabled","disabled"); 
		
			var id_corp, id_floor, id_cr, s_date_rasp, e_date_rasp; // classroom var

/* ------------- MODULE FOR CLASSROOM ----------------- */

			$("select#corp").change(function(){
					$("#result").empty();  //clear all
					$("input#datepicker_1").attr("disabled","disabled");
					$("input#datepicker_2").attr("disabled","disabled"); 
					$("select#floor").attr("disabled","disabled");
            		$("select#floor").html("<option>Подождите...</option>");
					$("select#cr").attr("disabled","disabled");
            		$("select#cr").html("<option>Выбрать...</option>");
					//memorize id of fac
            		id_corp = $("select#corp option:selected").attr('value');
					$.post("include/select/classroom/select_floor.php", {id_corp:id_corp}, function(data){
                		$("select#floor").removeAttr("disabled");
                		$("select#floor").html(data);
			 			});/* end of function(data) */
				}); /* ????? change(function()#corp */
						
				//Select floor...
				$("select#floor").change(function() {
						$("#result").empty();  //clear all
						$("input#datepicker_1").attr("disabled","disabled");
						$("input#datepicker_2").attr("disabled","disabled"); 
            			$("select#cr").attr("disabled","disabled");
            			$("select#cr").html("<option>Подождите...</option>");
						//memorize id of kaf
            			id_floor = $("select#floor option:selected").attr('value');	
            			$.post("include/select/classroom/select_cr.php", {id_floor:id_floor}, function(data){
                		$("select#cr").removeAttr("disabled");
                		$("select#cr").html(data);
			 			});/* end of function(data) */
				}); /* end of change(function())#floor */	
								
			 	$("select#cr").change(function(){
						$("#result").empty();  //clear all
						$("input#datepicker_1").val('');
						$("input#datepicker_2").val('');
            			$("input#datepicker_1").attr("disabled","disabled");
						$("input#datepicker_2").attr("disabled","disabled"); 
						
			 			id_cr = $("select#cr option:selected").attr('value');	
					    $("input#datepicker_1").removeAttr("disabled");
				}); /* end of change(function()#gr */
				
				$("input#datepicker_1").change(function(){
						$("input#datepicker_2").val('');
			 			s_date_rasp = $("input#datepicker_1").val();
						$("input#datepicker_2").removeAttr("disabled");	
            			
				}); /* end of change(function()#input#datepicker_1 */
				
				$("input#datepicker_2").change(function(){
			 			e_date_rasp = $("input#datepicker_2").val();
            			$.post("include/select/classroom/gen_shedule_cr.php", {id_cr:id_cr, s_date_rasp:s_date_rasp, e_date_rasp:e_date_rasp}, function(data){
                		$("#result").html(data);
			 			});/* end of function(data) */	
				}); /* end of change(function()#input#datepicker_2 */
				
}); /* end of main function */