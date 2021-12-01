<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends BaseController
{
    public function userListView(Request $request)
    {

        return view ('user.index');

    }

    public function userInfoView( Request $request)
    {
        $id = Session::get('user.id');
        $user = DB::table('users')->where('id', $id)->first();

        return view ('user.show')->with('user', $user);

    }

    public function userEditView($id)
    {
        dump($id);die();
        return view ('user.edit');

    }

}