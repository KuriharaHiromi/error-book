<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>error-book</title>
    <link rel="stylesheet" href="{{ asset('css/answer.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <a href="/" class="top">Top</a>
    <h1 class="menu">AnswerMenu</h1>
    <hr>



    <section>
        @if( !empty($answer_menu) )
        <!--$message_arrayの中身が空でなければ-->
        @foreach($answer_menu as $answer_lists)
        <!--$message_arrayから入力されたデータを取り出し$valueに入れる-->
        <article>
            <div class="info">
                <a href="<?php echo $answer_lists['answer_name']; ?>" class="answer">URL</a>
                <!--<h2>でview_name(タイトル)を出力-->
            </div>
            <p class="overview"><?php echo nl2br($answer_lists['answer_overview']); ?></p>
            <!--<ｐ>でmessage(記事)を出力-->
            <div>
                @if($answer_lists->is_good_by_auth_user())
                <a href="/ungood/error_menu/{{$answer_lists->answer_id}}"><i class="bi bi-heart-fill"></i></a>
                <a href="/ungood/error_menu/{{$answer_lists->answer_id}}" class="btn-success">Good&nbsp;<span class="badge">{{ $answer_lists->goods->count() }}</span></a>
                @else
                <a href="/good/error_menu/{{$answer_lists->answer_id}}"><i class="bi bi-heart"></i></a>
                <a href="/good/error_menu/{{$answer_lists->answer_id}}" class="btn-secondary">Good&nbsp;<span class="badge">{{ $answer_lists->goods->count() }}</span></a>
                @endif
            </div>
            <hr>
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
    <form action="{{ url('/error_menu/{languages_id}/{error_id}')}}" method="POST" onsubmit="return ask()">
        @csrf
        <!--フォームの作成とmethodで通信方式の指定、今回はpost。onsubmit属性で送信時に関数ask()を呼び出し、ok(true)で投稿処理がされる。-->
        <div>
            <label for="answer_name"></label>
            <!--タイトル部分のフォーム、view_nameの部分にタイトルで入力されたデータが入る-->
            <input id="answer_name" type="text" class="feedback-input" name="answer_name" placeholder="URLをコピペ(重複注意)" value="">
            <!--type属性で30字以内の1行のtextに指定、phpで受け取ったデータを引用するために名前をname属性に-->
        </div>
        <div>
            <label for="answer_overview"></label>
            <!--記事のフォーム、messageに記事に入力されたデータが入る-->
            <textarea id="answer_overview" name="answer_overview" class="feedback-input" placeholder="このURLで解決できた事例"></textarea>
            <!--textareaで複数行、10行50列に設定-->
            <input id="error_id" type="hidden" name="error_id" value="<?php echo $error_id; ?>">
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
    <script src="js/answer.js"></script>
</body>

</html>