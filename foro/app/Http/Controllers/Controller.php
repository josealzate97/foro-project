<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     *  Redireccion al home
    */
    public function home()
    {
        return view('home');
    }

    /**
     *  Redireccion al formulario de login
    */
    public function login()
    {
        return view('auth.login');
    }

    /**
     *  Redireccion al formulario de registro
    */
    public function register() 
    {
        return view('auth.register');
    }

    /**
     *  Redireccion al formulario de restablecer contraseña
    */
    public function resetPassword()
    {
        return view('auth.reset');
    }

    /**
     *  funcion encargada de registrar un usuario
    */
    public function registerUser(Request $request)
    {
        $this->validate(request(),[
            //put fields to be validated here
            'name','lastname','email','alias','password'
        ]);

        // Obtenemos los parametros en la variable params
        $params = $request->post();
        
        try {
            
            $user = new User();
            $user->id = Str::uuid();
            $user->name = $params['name'];
            $user->lastname = $params['lastname'];
            $user->email = $params['email'];
            $user->username = $params['alias'];
            $user->password = Hash::make($params['password']);
            $user->rol = User::ROLE_USER;
            $user->status = User::STATUS_ACTIVE;

            $user->save();
            
            // Response optimo
            return Response(['msg' => 'Created successfully', 'code' => 200]);

        } catch (\Exception $e) {
            // Response con error
            return Response(['msg' => 'Internal Error', 'code' => 404]);
        }
    }

    /**
     *  funcion encargada de logear un usuario
    */
    public function loginUser(Request $request)
    {
        $this->validate(request(),[
            //put fields to be validated here
            'email','password'
        ]);

        // Obtenemos los parametros en la variable params
        $params = $request->post();
    }
}
