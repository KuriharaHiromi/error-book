<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Error_list;//Error_listのModelを使用
use App\Http\Requests\ErrorRequest;


class ErrorController extends Controller
{
    //
    public function error_text($id, Request $request){
        $error_texts = Error_list::where('languages_id', $id)->orderBy('error_id', 'asc')->get();
        $user = Auth::user();
        $errors = Error_list::where('languages_id', $id)->paginate(50);
        $search = $request->input('search');
        // クエリビルダ
        $query = Error_list::query();
        // もし検索フォームにキーワードが入力されたら
        if ($search){
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');
            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value) {
                $query->where('languages_id', $id)->where('error_name', 'like', '%'.$value.'%');
            }
            // 上記で取得した$queryをページネートにし、変数$usersに代入
            $errors = $query->paginate(50);
        }

        //errorsとsearchを変数として渡す
        return view('blade.error-text')->with(['error_menu' => $errors, 'languages_id' => $id, 'user' => $user, 'search' => $search,]);

    }



    public function error_save(ErrorRequest $request) {//関数の宣言と一緒にバリデーション(ArticleRequestを$requestに入れて)の設定
        $inputs = $request->all();

        \DB::beginTransaction();
        try{
            Error_list::create($inputs);
            \DB::commit();
        }catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return redirect(route('error_menu', [$inputs['languages_id']]));
        
    }





}
