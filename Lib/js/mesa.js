$(document).ready(function(){
$('.timepicker').timepicker({
  timeFormat: 'HH:mm p',
  interval: 30,
  minTime: '6:00am',
  maxTime: '11:00pm',
  // defaultTime: 'now',
  startTime: '6',
  dynamic: false,
  dropdown: true,
  scrollbar: true
});
});
