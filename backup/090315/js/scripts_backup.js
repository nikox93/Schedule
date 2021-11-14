/* Модуль функционирования select */        
		$(document).ready(function(){
            $("select#gr").attr("disabled","disabled");
			$("select#kurs").attr("disabled","disabled");
			$("select#fo").attr("disabled","disabled");
			$("select#week").attr("disabled","disabled");
				//select fac...
            	$("select#fac").change(function(){
					//clear all
					$("#result").empty();  
					$("#result_1").css("display","none");
					$("select#kurs").attr("disabled","disabled");
            		$("select#kurs").html("<option>Подождите...</option>");
					$("select#gr").attr("disabled","disabled");
            		$("select#gr").html("<option>Выбрать...</option>");
					//memorize id of fac
            		var id_f = $("select#fac option:selected").attr('value');
					$("select#kurs").load("select_kurs.php");
					$("select#kurs").removeAttr("disabled");
						//Select kurs...
						$("select#kurs").change(function() {
            			 	$("select#gr").attr("disabled","disabled");
            				$("select#gr").html("<option>Подождите...</option>");
							//memorize id of kurs
            				var id_k = $("select#kurs option:selected").attr('value');	
            				$.post("select_gr.php", {id_k:id_k, id_f:id_f}, function(data){
                			$("select#gr").removeAttr("disabled");
                			$("select#gr").html(data);
			 				});/* end of function(data) */
								
			 				$("select#gr").change(function(){
			 					var id_gr = $("select#gr option:selected").attr('value');	
            					$.post("gen_shedule.php", {id_gr:id_gr}, function(data){
                				$("#result").html(data);
			 					});/* ????? function(data) */	
							}); /* ????? change(function()#gr */
			
				/* backup 11 */
        				}); /* ????? change(function())#kurs */	
				}); /* ????? change(function()#fac */
		
        		/* backup 12 */
    	});