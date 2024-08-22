<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8' />
    <script src='<?= base_url(); ?>/node_modules/fullcalendar/index.global.min.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.3.0/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.3.0/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.3.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.3.0/main.min.js"></script>
</head>

<body>
    <div id='calendar'></div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            $.ajax({
                url: "<?= site_url('home/dinamis/load_events'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    data: "data"
                },
                beforeSend: function() {},
                complete: function() {},
                success: function(response) {
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        eventClick: function(info) {
                            var eventObj = info.event;

                            if (eventObj.url) {
                                alert(
                                    'Clicked ' + eventObj.title + '.\n' +
                                    'Will open ' + eventObj.url + ' in a new tab'
                                );

                                window.open(eventObj.url);

                                info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
                            } else {
                                alert('Clicked ' + eventObj.title);
                            }
                        },
                        timeZone: 'UTC',
                        initialView: 'dayGridMonth',
                        events: response.events,
                        editable: false,
                        selectable: true
                    });
                    calendar.render();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    </script>
</body>

</html>