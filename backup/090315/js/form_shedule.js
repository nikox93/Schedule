/* Модуль заполнения времени и дней */

var days = ["","Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"];
var time_weekdays = ["",
"9:00 - 10.25", 
"10:35 - 12.00", 
"12:30 - 13.55", 
"14:05 - 15:30",
"15:35 - 16:55", 
"17:00 - 18.20", 
"18:30 - 19:55",
"20:10 - 21:35"
];
var time_weekend = ["",
"9:00 - 10.25", 
"10:35 - 12.00", 
"12:10 - 13.35", 
"13:45 - 15:25",
"15:20 - 16:45", 
"16:55 - 18.20", 
"18:30 - 19:55",
"20:10 - 21:35"
];
$("#11").html("Пара"); $("#11").css("background-color" , "#ccc");
$("#11").css("color", "#222");		
$("#11").css("width", "50px");	

$("#12").html("Время");  $("#12").css("background-color" , "#ccc");
$("#12").css("color", "#222");	
$("#12").css("width", "100px");	

for( var i=3; i<=9; i++) {
	/* $('#1'+i).html(days[i-2]);	*/
	$('#1'+i).css("background-color" , "#ccc");	
	$('#1'+i).css("color", "#222");	
	$('#1'+i).css("width", "275px");	
};
for( var j=2; j<=9; j++) {
	$('#'+j+'1').html(j-1);	
	$('#'+j+'2').html(time_weekdays[j-1]);
};

/* Делаем подсветку столбца сегодняшнего дня недели */
var date = new Date();
var num_day_today = date.getDay();
for( var k=3; k<=9; k++) {
	
	if((num_day_today+2) == k){
		for( var i=2; i<=9; i++) {
		$('#'+ String(i)+String(k)).css("background-color" , "rgba(200,40,60,0.2)");	
		}
	}
	
	if(num_day_today == 0) { //Если воскресенье
		for( var i=2; i<=9; i++) {
		$('#'+ String(i)+'9').css("background-color" , "rgba(200,40,60,0.2)");	
		}
		for( var j=2; j<=9; j++) {
		$('#'+j+'2').html(time_weekend[j-1]);
		};
	}
	
	if((num_day_today+2) > k) { //Для прошедших дней
		for( var i=2; i<=9; i++) {
		$('#'+ String(i)+String(k)).css("background-color" , "rgba(0,0,0,0.1)");	
		}
	}
};