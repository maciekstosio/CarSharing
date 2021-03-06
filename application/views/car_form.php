
    <?php echo form_open('car/add_car'); ?>
        <h3>New car</h3>
        <div class="uk-child-width-1-3" uk-grid>
            <div>
                <div class="uk-margin">
                    <input class="uk-input" type="text" name="plates" placeholder="Car plates">
                </div>
            </div>
            <div>
                <div class="uk-margin">
                    <select class="uk-select">
                    <option>Car</option>
                        <?php foreach($brand as $row): ?>
                            <option><?php echo $row->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div>
                <div class="uk-margin">
                    <input class="uk-input" type="number" min="0" max="999" name="price" placeholder="Price">
                </div>
            </div>
        </div>
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
                        businessHours: {
                            end: 0,
                            limitDisplay: false,
                            start: 0
                        },
                        height: function() {
                            return 500
                        },
                        eventRender : function(calEvent, $event) {
                            if (calEvent.start.getTime() < new Date().getTime()) {
                                $event.css('backgroundColor', '#aaa');
                                $event.find('.time').css({'backgroundColor': '#999', 'border':'1px solid #888'});
                            }
                            console.log(this)
                        },
                        eventNew: function(calEvent, $event) {
                            var ids = eventData.events.map(function(item){ return item.id})
                            var id = ids.length > 0 ? ids.reduce(function(a, b) { return Math.max(a, b); }) : 0
                            eventData.events.push({
                                id: id+1, 
                                start: new Date(calEvent.start),
                                end: new Date(calEvent.end),
                                title: "Available"
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
            <button class="uk-button uk-button-primary uk-margin-top" type="submit">Gotowe</button>
        </div>
    </form>