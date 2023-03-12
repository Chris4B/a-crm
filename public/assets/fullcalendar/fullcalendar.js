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

    })
   fetch ('http://a-crm.test/calendar/')
        .then(response =>response.json())
        .then(data =>console.log(data))
        .catch(error => console.error(error))

    calendar.render()
}