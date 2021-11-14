$(document).ready(function(){
	
			/* ------------------------- ALL PARAMETRS OF SYSTEM ----------------------- */
			
			//for classroom
			var id_cr, s_date_rasp, e_date_rasp; // classroom var
			//main date of shedule
			$("input#datepicker_1").attr("disabled","disabled");
			$("input#datepicker_2").attr("disabled","disabled"); 

/* ------------- MODULE FOR CLASSROOM ----------------- */

			$("select#classroom").change(function(){
					$("#result").empty();  //clear all
					$("input#datepicker_1").attr("disabled","disabled");
					$("input#datepicker_2").attr("disabled","disabled"); 
					//memorize id of classroom
            		id_cr = $("select#classroom option:selected").attr('value');
					$("input#datepicker_1").removeAttr("disabled");
				}); /* ????? change(function()#corp */
										
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