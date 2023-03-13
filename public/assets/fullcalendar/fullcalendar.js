window.onload = () =>{
    let calendarElt = document.querySelector("#calendar")

    let calendar = new FullCalendar.Calendar(calendarElt, {

        initialView:'dayGridMonth',
        // defaultView: 'timeGridWeek',
        locale:'fr',
        timeZone: 'local',
        headerToolbar:{
            left:'dayGridMonth,timeGridWeek,timeGridDay',
            center:'title',
            end:'prevYear,prev,next,nextYear'
         },
        buttonText:{
            today: 'Aujourd\'hui',
            month: 'mois',
            week: 'semaine',
            day: 'journée',
            list: 'liste'
        },
        height: 'auto',
        navLinks:'true',
        droppable: 'true',
        editable: 'true',
        eventResizableFromStart: 'true',
        dragScroll:'true',
        eventSource:[
            {
                url: 'http://a-crm.test/calendar/api'
            }
        ]

    })
   fetch ('http://a-crm.test/calendar/api')
        .then(response =>response.json())
        .then(data =>{
            data.forEach(event =>{
                calendar.addEvent({
                    id: event.id,
                    title: event.title,
                    start: event.start,
                    end: event.end,
                    description: event.description,
                    backgroundColor: event.backgroundColor,
                    borderColor: event.borderColor,
                    textColor: event.textColor,
                })
            })
        })
       .then(data =>calendar.addEvent(data))
        .catch(error => console.error(error))
    calendar.on('eventchange',(e)=>{
        console.log(e);
    })
    calendar.render()




}