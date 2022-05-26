<html lang="ja">
<head>
<meta charset="UTF-8">
<title>languages</title>
</head>
<body>
<a href="">Top</a>
<a href="">ログイン&新規作成</a>
<h1></h1>
@if ($errors->any())<!-- $error_messageの中身が空でなければ(「タイトルは必須です。」または「記事は必須です。」が入ってれば) -->
	<ul class="error_message">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach 
	</ul>
@endif   
<form method="POST" action="{{ route('article_save') }}" onsubmit="return ask()">
     @csrf<!--フォームの作成とmethodで通信方式の指定、今回はpost。onsubmit属性で送信時に関数ask()を呼び出し、ok(true)で投稿処理がされる。-->
    <div>
        <label for="title">タイトル</label><!--タイトル部分のフォーム、view_nameの部分にタイトルで入力されたデータが入る-->
        <input id="title" type="text" name="title" value=""><!--type属性で30字以内の1行のtextに指定、phpで受け取ったデータを引用するために名前をname属性に-->
    </div>
    <div>
        <label for="article">記事</label><!--記事のフォーム、messageに記事に入力されたデータが入る-->
        <textarea id="article" name="article" cols="50" rows="10"></textarea><!--textareaで複数行、10行50列に設定-->
    </div>
    <button type="submit" name="btn_submit">投稿</button><!--投稿ボタン-->   
</form>
<hr>
<section>
@if( !empty($articles) )<!--$message_arrayの中身が空でなければ-->
    @foreach($articles as $article_list)
<!--$message_arrayから入力されたデータを取り出し$valueに入れる-->
        <article>
        <div class="info">
            <h2><?php echo $article_list['title']; ?></h2><!--<h2>でview_name(タイトル)を出力-->
        </div>
        <p><?php echo nl2br($article_list['article']); ?></p><!--<ｐ>でmessage(記事)を出力-->
        <a href="/detail/{{ $article_list->id }}">記事全文・コメントを見る</a><!--記事の詳細のリンク作成、$valueのユニークidのキーを指定して個別のページに飛ぶように設定-->
        <hr><!--下線部-->
        </article>
    @endforeach
@endif  
</section>
<script>
    ask = () => {//関数の設定
        return confirm('投稿してよろしいですか？');//確認ダイアログの出現
    }
</script>
</body>
</html>