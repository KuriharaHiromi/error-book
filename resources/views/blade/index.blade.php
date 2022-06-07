<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>error-book</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>


<body>

    <sns>
        <a href="https://twitter.com/RC14RC14" class="flowbtn8 fl_tw2"><i class="fa-brands fa-twitter"></i></a>
    </sns>



    <div id="load">
        <div>E</div>
        <div>M</div>
        <div>O</div>
        <div>C</div>
        <div>L</div>
        <div>E</div>
        <div>W</div>
    </div>



    <header>
        <div class="container">
            @if (Route::has('login'))
            @auth
            <a href="/logout" class="login rotateback"><span>Logout</span><span class="loginbtn">GoodBye!</span></a>
            @else
            <a href="{{ route('login') }}" class="login rotateback"><span>Login & Signin</span><span class="loginbtn">ユーザーは投稿できます。</span></a>
            @endauth
            @endif
        </div>
    </header>

    <div class="title" id="elem">
        <h1>ErrorBook</h1>
    </div>



    <languages>
        @if( !empty($languages) )
        <!--$message_arrayの中身が空でなければ-->
        @foreach($languages as $languages_list)
        <div class="btn info">
            <a href="/error_menu/{{ $languages_list->languages_id }}">
                <h2><span><?php echo $languages_list['language_name']; ?></span></h2>
            </a>
        </div>
        @endforeach
        @endif

    </languages>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
    <script src="https://kit.fontawesome.com/90dc3e7ec5.js" crossorigin="anonymous"></script>
</body>

</html>