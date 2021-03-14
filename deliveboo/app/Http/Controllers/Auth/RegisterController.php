<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Register;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'piva'=>['required', 'string', 'min:11','max:11'],
            'business_name'=>['required', 'string', 'min:5' ,'max:60']
        ],
        [
            'name.required' => 'Campo obbligatorio',
            'email.required' => 'Campo obbligatorio',
            'email.email' => 'Inserire una email valida',
            'email.unique' => 'Email già utilizzata',
            'password.required' => 'Campo obbligatorio',
            'password.min' => 'La password inserita deve essere di almeno 8 caratteri',
            'piva.required' => 'Campo obbligatorio',
            'piva.min' => 'Il valore inserito deve avere almeno 11 cifre',
            'piva.max' => 'Il valore inserito deve avere massimo 11 cifre',
            'business_name' => 'Campo obbligatorio',
            'business_name.min' => 'Il valore inserito deve avere almeno 5 cifre',
            'business_name.max' => 'Il valore inserito deve avere massimo 60 cifre',
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'piva'=>$data['piva'],
            'business_name'=>$data['business_name'],
        ]);

        Mail::to($data['email'])->send(new Register($user));

        return $user;
    }
}
