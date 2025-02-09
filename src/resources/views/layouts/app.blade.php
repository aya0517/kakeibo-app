<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kakeibo-app</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                Household Expenses
            </a>
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
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>