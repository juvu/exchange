<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{

   	//首页公告
    public function notice(){

    	$Articleaa = Article::where(array('type'=>'communique'))->orderBy('id','desc')->first();
    	$info['id']= $Articleaa['id'];
    	$info['title'] = $Articleaa['title'];
    	$info['url'] = '/Article/detail&id='.$info['id'];

    	return response()->json($info);
    }
}
