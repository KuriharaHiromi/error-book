<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Language;//LanguageのModelを使用

class TopController extends Controller
{
    //トップ画面の表示
    public function show_top(){
        $user = Auth::user();
        $languages = Language::orderBy('languages_id', 'asc')->get();
        return view('blade.index')->with(['user' => $user, 'languages' => $languages]);
    }




}


