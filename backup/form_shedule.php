<script type="text/javascript">
/* Массивы дней и времени */
var days = ["","Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"];
var time = ["",
"8:00 - 9.30", 
"9:40 - 11.10", 
"11:20 - 12.50", 
"13:00 - 14:40",
"14:40 - 16:10", 
"16:20 - 17.50", 
"18:00 - 19:30",
"19:40 - 21:10"
];
$("#11").html("Пара"); $("#11").css("background-color" , "#ccc");
$("#11").css("color", "#555");	

$("#12").html("Время");  $("#12").css("background-color" , "#ccc");
$("#12").css("color", "#555");	

for( var i=3; i<=9; i++) {
	$('#1'+i).html(days[i-2]);	
	$('#1'+i).css("background-color" , "#ccc");	
	$('#1'+i).css("color", "#555");	
};
for( var j=2; j<=9; j++) {
	$('#'+j+'1').html(j-1);	
	$('#'+j+'2').html(time[j-1]);
};

</script>
<?php
			$n = 9;//Количество строк
			$m = 9;//Количество столбцов
		// строим таблицу	
		echo "<table border=\"1\" cellpadding=\"5\" id=\"shedule\">";
				for($r=1; $r <= $n; $r++) {
					echo "<tr>";
					for($c=1; $c <= $m; $c++) {
						echo "<td id=\"$r$c\">";
						echo "&nbsp&nbsp";
						echo "</td>";
						}
					echo "</tr>";
					}
				echo "</table>";
/* $query = "SELECT teach.last_name, sub.s_name_sub, classroom.id_cr, rasp.week, rasp.day, rasp.lesson FROM rasp,teach,sub,classroom WHERE rasp.id_rasp = $id_rasp AND rasp.id_sub = sub.id_sub AND rasp.id_teach = teach.id_teach AND rasp.id_cr = classroom.id_cr"; */

?>

