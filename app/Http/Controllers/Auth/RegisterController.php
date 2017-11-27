<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/usuarioRegistrado';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function registrarUsuario()
     {
       return view('registroUsuario');
     }

     public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        // $this->guard()->login($user);
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'documento' => 'required|string|max:999999999999999|unique:users',
            'telefono' => 'required|string|max:999999999999999',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {

        // {{dd($data['rol']);}}

        $user = User::create([
          'nombre' => ucfirst(strtolower($data['nombre'])),
          'apellido' => ucfirst(strtolower($data['apellido'])),
          'documento' => $data['documento'],
          'telefono' => $data['telefono'],
          'email' => strtolower($data['email']),
          'password' => bcrypt($data['password']),
          'rol' => $data['rol'],
        ]);

        if ($data['rol'] == 'administrador') {

          $user->assignRole('Administrador');

        }

        if ($data['rol'] == 'cliente') {

          $user->assignRole('Cliente');

        }

          return $user;

    }

    public function usuarioRegistrado()
    {
      $usuarioCreado = ("El nuevo usuario se ha creado correctamente.");

      return view('registroUsuario', compact('usuarioCreado'));
    }

}
