<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth, Mail, Str;
use App\Models\User;

class ConnectController extends Controller
{
    public function __construct() 
    {
        $this->middleware('guest')->except(['getLogout']);
    }
    
    public function getLogin()
    {
        return view('connect.login');
    }

    public function postLogin(Request $request) 
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];

        $messages = [
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'El formato del correo no es valido.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.'
        ]; 

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->with('message', 'Se ha producido un error')
                    ->with('typealert', 'danger');
        } 
        else {
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {
                if (Auth::user()->status == "100") {
                    return redirect('/logout');
                }
                else {
                    return redirect('/');
                }
            } else {
                return back()
                    ->with('message', 'Correo o contraseña incorrectos')
                    ->with('typealert', 'danger');
            }
            
        }
    }

    public function getRegister() 
    {
        return view('connect.register');
    }

    public function postRegister(Request $request) 
    {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];

        $messages = [
            'name.required' => 'Su nombre es requerido.',
            'lastname.required' => 'Los apellidos son requeridos.',
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'El formato del correo no es valido.',
            'email.unique' => 'Este correo ya esta registrado.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'cpassword.required' => 'Es necesario confirmar la contraseña.',
            'cpassword.min' => 'La confirmación de la contraseña debe tener al menos 8 caracteres.',
            'cpassword.same' => 'Las contraseñas no coinciden.'
        ]; 

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) 
        {
            return back()
                    ->withErrors($validator)
                    ->with('message', 'Se ha producido un error')
                    ->with('typealert', 'danger');
        } 
        else {
            $user = new User();
            $user->name = e($request->input('name')); // e es para no guardar scripts dañinos en la BD
            $user->lastname = e($request->input('lastname')); 
            $user->email = e($request->input('email')); 
            $user->password = Hash::make($request->input('password')); //Hash Encriptar

            if ($user->save()) {
                return redirect('/login')
                    ->with('message', 'El usuario ha sido creado con éxito')
                    ->with('typealert', 'success');
            }
        }
        
    }

    public function getLogout()
    {
        Auth::logout();
       
        return redirect('/');
    }
}
