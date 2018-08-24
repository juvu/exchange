<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	//首页
    public function index(Request $request)
    {
    	//轮播图
    	$indexAdver = \App\Models\Adver::all();
    	//菜单导航
    	$daohang = \App\Models\Daohang::where(['status' => 1])->orderBy('addtime','desc')->get();

    	return view('home.index', compact('indexAdver', 'daohang'));
    }
}
