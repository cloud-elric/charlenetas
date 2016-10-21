
var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();

	var calendar = $('#calendar').fullCalendar({
        // put your options and callbacks here
		eventLimit: true,
        events: 'http://localhost/charlenetas/web/netas/anadir-citas',
	    
	    dayClick: function(date, jsEvent, view ){
			var view = $('#calendar').fullCalendar('getView');
			calendar.fullCalendar('gotoDate',date)
			calendar.fullCalendar('changeView','agendaDay')
			
			if(view.name == 'agendaDay'){
				var title = prompt('Title:');
				if (title) {
					start = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
					alert(start);
					end = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
					m = moment(date);
					m.add(1,'hours').hours();
					end = moment(m).format('YYYY-MM-DD HH:mm:ss');
					alert(end);
					$.ajax({
						url: 'agregar-citas',
						data: 'title='+ title+'&start='+ start +'&end='+ end ,
						type: 'POST',
						success: function(json) {
							alert('OK');
						}
					});
					calendar.fullCalendar('renderEvent',
					{
						title: title,
						start: start,
						end: end,
						allDay: allDay
					},
					true // make the event 'stick'
					);
				}
				calendar.fullCalendar('unselect');	
			}
		}
    });