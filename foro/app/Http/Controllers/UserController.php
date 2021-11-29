<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function userListView(Request $request)
    {

        return view ('user.index');

    }

    public function userInfoView(Request $request)
    {

        return view ('user.show');

    }

    public function userEditView($id)
    {
        dump($id);die();
        return view ('user.edit');

    }

}