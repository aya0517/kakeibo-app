<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カレンダー</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css">
        <!-- FullCalendarのJavaScriptファイルを読み込む -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) {
                console.error("カレンダーの要素が見つかりません");
                return;
            }

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: function(fetchInfo, successCallback, failureCallback) {
                    fetch('/api/expenses')
                    .then(response => response.json())
                    .then(data => successCallback(data))
                    .catch(error => failureCallback(error));
                },
                dateClick: function(info) {
                    window.location.href = "/expenses/create?date=" + info.dateStr;
                }
            });

            calendar.render();
        });
    </script>
</head>

<body>
    <div class="container">
        <h1>カレンダー</h1>
        <div id="calendar"></div>
    </div>


</body>
</html>
