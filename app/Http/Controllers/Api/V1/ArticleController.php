<?php

namespace App\Http\Controllers\Api\V1;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //
    public function index()
    {
        return Article::all();
    }
}
