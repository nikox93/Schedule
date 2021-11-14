/* Russian (UTF-8) initialisation for the jQuery UI time picker plugin. */
/* Written by Alex Disertinsky (www.disertinsky.com). */
jQuery(function($){
$.timepicker.regional['ru'] = {
		currentText: 'Сейчас',
		closeText: 'Готово',
		ampm: false,
		amNames: ['AM', 'A'],
		pmNames: ['PM', 'P'],
		timeFormat: 'hh:mm tt',
		timeSuffix: '',
		timeOnlyTitle: 'Выбор темы',
		timeText: 'Время',
		hourText: 'Часов',
		minuteText: 'Минут',
		secondText: 'Секунд',
		millisecText: 'Миллисекунд',
		timezoneText: 'Временная зона'
	};
	$.timepicker.setDefaults($.timepicker.regional['ru']);
});