<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    public function createPostView(Request $request)
    {

        return view ('ask.index');
    }

}