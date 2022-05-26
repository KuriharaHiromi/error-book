<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>error-text</title>
    <link rel="stylesheet" href="{{ asset('css/errormenu.css') }}">
</head>

<body>
    <a href="/" class="top">Top</a>
    <a href="{{ url()->current() }}"><h1 class="menu">ErrorMenu</h1></a>

    <form method="GET" class= "form2" action="{{ route('error_menu', $languages_id) }}">
        @csrf
        <input type="search" placeholder="エラーをお探し？" name="search" value="@if (isset($search)) {{ $search }} @endif">
        <div>
            <button type="submit2">GO!</button>
        </div>
    </form>
    <hr>


    <section>

        @if( !empty($error_menu) )
        <!--$message_arrayの中身が空でなければ-->
        @foreach($error_menu as $error_lists)
        <!--$message_arrayから入力されたデータを取り出し$valueに入れる-->
        <article>
            <div class="info">
                <h4><?php echo $error_lists['error_name']; ?></h4>
                <!--<h2>でview_name(タイトル)を出力-->
            </div>
            <p class="overview"><?php echo nl2br($error_lists['overview']); ?></p>
            <!--<ｐ>でmessage(記事)を出力-->
            <a href="/error_menu/{{ $error_lists->languages_id }}/{{ $error_lists->error_id }}" class="answer">Answer</a>
            <!--記事の詳細のリンク作成、$valueのユニークidのキーを指定して個別のページに飛ぶように設定-->
            <hr class="hr">
            <!--下線部-->
        </article>
        @endforeach
        @endif

    </section>

    @if (Route::has('login'))
    @auth
    @if ($errors->any())
    <!-- $error_messageの中身が空でなければ(「タイトルは必須です。」または「記事は必須です。」が入ってれば) -->
    <ul class="error_message">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    <form method="POST" action="{{ route('error_save', $languages_id) }}" onsubmit="return ask()">
        @csrf
        <!--フォームの作成とmethodで通信方式の指定、今回はpost。onsubmit属性で送信時に関数ask()を呼び出し、ok(true)で投稿処理がされる。-->
        <div>
            <label for="error_name"></label>
            <!--タイトル部分のフォーム、view_nameの部分にタイトルで入力されたデータが入る-->
            <input id="error_name" type="text" class="feedback-input" name="error_name" placeholder="エラー文をコピペ(重複注意)" value="">
            <!--type属性で30字以内の1行のtextに指定、phpで受け取ったデータを引用するために名前をname属性に-->
        </div>
        <div>
            <label for="overview"></label>
            <!--記事のフォーム、messageに記事に入力されたデータが入る-->
            <textarea id="overview" class="feedback-input" name="overview" placeholder="エラー概要(起きた状況や原因)"></textarea>
            <!--textareaで複数行、10行50列に設定-->
            <input id="languages_id" type="hidden" name="languages_id" value="<?php echo $languages_id; ?>">
            <input id="user_id" type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
        </div>
        <button type="submit" name="btn_submit">GO!</button>
        <!--投稿ボタン-->
    </form>
    <hr>
    @endauth
    @endif

    <script>
        ask = () => { //関数の設定
            return confirm('投稿してよろしいですか？'); //確認ダイアログの出現
        }
    </script>
</body>

</html>