
    <!-- FullCalendar -->
    <h3 class="page-header page-header-top">FullCalendar</h3>

    <div id="example-fullcalendar"></div>
    <!-- END FullCalendar -->

<script>
//function calendar(){
    $(function() {
            /* Initialize FullCalendar */
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#example-fullcalendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                events: [
                    {
                        title: 'Relax Day',
                        start: new Date(y, m, 1)
                    },
                    {
                        title: 'Project #1',
                        start: new Date(y, m, 5),
                        end: new Date(y, m, 10)
                    },
                    {
                        id: 999,
                        title: 'Gym (repeated)',
                        start: new Date(y, m, d - 4, 18, 0),
                        allDay: false
                    },
                    {
                        id: 999,
                        title: 'Gym (repeated)',
                        start: new Date(y, m, d + 3, 18, 0),
                        allDay: false
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d, 13, 00),
                        allDay: false
                    },
                    {
                        title: 'Project #2',
                        start: new Date(y, m, d, 8, 0),
                        end: new Date(y, m, d, 13, 0),
                        allDay: false
                    },
                    {
                        title: 'Party',
                        start: new Date(y, m, d + 6, 19, 0),
                        end: new Date(y, m, d + 6, 22, 30),
                        allDay: false
                    },
                    {
                        title: 'Follow me on Twitter',
                        start: new Date(y, m, 26),
                        end: new Date(y, m, 26),
                        url: 'http://twitter.com/pixelcave'
                    }
                ]
            });

            /* Initialize FullCalendar with drag and drop events, Demo from http://arshaw.com/fullcalendar/ */
            $('#fc-external-events .fc-external-event').each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 100  //  original position after the drag
                });
            });
        });
//}
</script>