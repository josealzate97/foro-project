<?php

namespace App\Http\Controllers;

use App\Models\User;
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

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     *  Redireccion al home
    */
    public function home(Request $request)
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
            $user->id =  UuidV4::uuid4();
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
        
        // Buscamos si existe el usuario
        $user = User::where('username', $request->username)->first();
        
        if ($user) {

            // Validamos que la contraseña sea la misma
            $checkPassword = Hash::check($request->password, $user->password);

            if ($checkPassword == true) {

                // Colocamos la data del usuario en sesion
                $request->session()->put('user', $user);
                $request->session()->put('_token', $request->_token);

                // Login Ok - success
                return Response([ 'msg' => 'Logged OK', 'code' => 200 ]);

            } else {
                // Contraseña incorrecta - failed login
                return Response([ 'msg' => 'Invalid password', 'code' => 202 ]);
            }
        } else {
            // Usuario no valido o no encontrado - failed login
            return Response([ 'msg' => 'Invalid username', 'code' => 404 ]);
        }
    }

    /**
     * funcion encargada de validar un usuario por username o email
    */
    public function validateUser(Request $request)
    {
        try { 
            // Obtenemos los parametros en la variable params
            $params = $request->post();

            $sqlQuery = null;

            switch ($params['validate-type']) {
                
                case '1':
                    $sqlQuery = DB::table('users')->where('email', $params['data'])->first();
    
                    break;
                case '2':
                    $sqlQuery = DB::table('users')->where('username', $params['data'])->first();
    
                    break;    
            }

            $sqlQuery != null ? $code = 200 : $code = 202 ;

            // Response optimo
            return Response([ 
                'msg' => 'Usuario validado correctamente', 
                'code' => $code, 
                'data' => $sqlQuery 
            ]);
            
        } catch (\Exception $e) {
            // Response optimo
            return Response([ 
                'msg' => 'Error al validar un usuario',
                'code' => 404,
                'data' => 'NO DATA' 
            ]);
        }
    }

    public function logout(Request $request)
    {
        // Delete the actual session
        $request->session()->flush();

        return view('auth.login');
    }
}
