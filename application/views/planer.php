
    <?php echo form_open('car/add_car'); ?>
        <h3>Prepare your timetable</h3>
        <div class="uk-text-center uk-margin-top">
            <script type='text/javascript' src="<?php echo base_url("js/jquery-1.4.4.min.js"); ?>"></script>
            <script type='text/javascript' src="<?php echo base_url("js/jquery-ui-1.8.11.custom.min.js"); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url("js/date.js"); ?>"></script>
            <script type='text/javascript' src="<?php echo base_url("js/jquery.weekcalendar.js"); ?>"></script>
            <script type='text/javascript'>
                var year = new Date().getFullYear();
                var month = new Date().getMonth();
                var day = new Date().getDate();

                $(document).ready(function() {
                    console.log($('input#calendar_data').val().length === 0);
                    var eventData = $('input#calendar_data').val().length === 0
                                    ?  {events: []}
                                    :  JSON.parse($('input#calendar_data').val());

                    $('#calendar').weekCalendar({
                        timeslotsPerHour: 6,
                        timeslotHeigh: 30,
                        hourLine: true,
                        newEventText: "Available",
                        data: eventData,
                        height: function() {
                            return 500
                        },
                        eventRender : function(calEvent, $event) {
                            if (calEvent.start.getTime() < new Date().getTime()) {
                                $event.css('backgroundColor', '#aaa');
                                $event.find('.time').css({'backgroundColor': '#999', 'border':'1px solid #888'});
                            }
                        },
                        eventNew: function(calEvent, $event) {
                            var ids = eventData.events.map(function(item){ return item.id})
                            var id = ids.length > 0 ? ids.reduce(function(a, b) { return Math.max(a, b); }) : 0
                            eventData.events.push({
                                id: id+1, 
                                start: new Date(calEvent.start),
                                end: new Date(calEvent.end),
                                title: "Book"
                            })


                            $('input#calendar_data').val(JSON.stringify(eventData))
                        },
                        eventDrop: function(calEvent, $event) {},
                        eventResize: function(calEvent, $event) {},
                        eventClick: function(calEvent, $event) {
                            $event.remove();
                            eventData.events.filter(function(item){ return item.id === calEvent.id ? false : true })
                            $('input#calendar_data').val(JSON.stringify(eventData))
                        },
                        eventMouseover: function(calEvent, $event) {},
                        eventMouseout: function(calEvent, $event) {},
                        noEvents: function() {}
                    });
                });

            </script>
            <div id="calendar"></div>
            <input type="hidden" name="calendar" id="calendar_data" value=""/>
            <button class="uk-button uk-button-primary uk-margin-top" type="submit">Ready</button>
        </div>
    </form>