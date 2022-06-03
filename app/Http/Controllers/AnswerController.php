<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Good;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\GoodRequest;
use App\Http\Requests\AnswerRequest;

class AnswerController extends Controller
{
    //
    public function answer_text($languages_id, $error_id)
    {
        $answer_texts = Answer::where('error_id', $error_id)->orderBy('answer_id', 'asc')->get();
        $user = Auth::user();
        return view('blade.answer')->with([
            'answer_menu' => $answer_texts,
            'error_id' => $error_id,
            'languages_id' => $languages_id,
            'user' => $user
        ]);
    }


    public function __construct()
    {
        // $this->middleware(['auth', 'verified'])->only(['good', 'ungood']);
    }

    public function good($id, GoodRequest $request)
    {   

        Good::create([
            'answer_id' => $id,
            'user_id' => Auth::id(),
            'ip' => \Request::ip()
        ]);

        session()->flash('success', 'You Liked the Reply.');
        return redirect()->back();
    }

    public function ungood($id)
    {
        $good = Good::where('answer_id', $id)->where('ip', \Request::ip())->and('user_id', Auth::id())->first();
        $good->delete();

        session()->flash('success', 'You Unliked the Reply.');

        return redirect()->back();
    }


    public function answer_save(AnswerRequest $request)
    { //関数の宣言と一緒にバリデーション(ArticleRequestを$requestに入れて)の設定

        $inputs = $request->all();
        $user = Auth::user();
        \DB::beginTransaction();
        try {
            Answer::create($inputs);
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return back();
    }
}
