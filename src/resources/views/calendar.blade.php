<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カレンダー</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
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
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                Household Expenses
            </a>
        </div>
        <nav>
            <ul class="header-nav">
                @if (Auth::check())
                <li class="header-nav__item">
                    <a class="header-nav__link" href="/mypage">my page</a>
                </li>
                <li class="header-nav__item">
                    <form class="form" action="/logout" method="post">
                        @csrf
                        <button class="header-nav__button">log out</button>
                    </form>
                </li>
                @endif
            </ul>
        </nav>
    </header>
</body>

<main>
    <div class="container">
        <h1></h1>
        <div id="calendar"></div>
    </div>
</main>

</html>