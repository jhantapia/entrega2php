<?php

namespace App\Http\Controllers;


use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{

    public function __construct()
    {
        return $this->middleware('guest', ['only' => ['showLogin','showSendPassword','showRecoveryPassword']]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1])) {
            $user = User::find(Auth::user()->id);
            $user->last_login_date = $user->actual_login_date;
            $user->actual_login_date = new \DateTime();
            $user->save();
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['email' => 'La combinación de usuario y contraseña es incorrecta.'])->withInput();
    }

    public function showLogin()
    {
        return view('access.login');
    }

    public function sendPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->recovery_pin = rand(1000, 9999);
            $user->save();

            Mail::send('emails.send-password', ['user' => $user], function ($m) use ($user) {
//            $m->from('mantenedorcontenidobrainy@gmail.com', 'Mantenedor Brainy');
                $m->to($user->email, $user->firstname)->subject('Código para restablecer contraseña');
            });
        }

        session()->flash('success', 'Te hemos enviado un correo electrónico con un código para restablecer tu contraseña.');
        return redirect()->route('login.show-recovery-password');

    }

    public function showSendPassword()
    {
        return view('access.send_password');
    }

    public function recoveryPassword(Request $request)
    {
        $this->validate($request, [
            'pin' => 'required|numeric|max:10000',
            'email' => 'email|required|string',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {

            if($user->recovery_pin == $request->pin){
                $user->password = bcrypt($request->password);
                $user->recovery_pin = null;
                $user->save();

                if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1])) {
                    return redirect()->route('dashboard');
                }

                session()->flash('success', 'Se ha modificado correctamente tu contraseña. ahora puedes iniciar sesión');
                return redirect()->route('login.show');
            }
            return back()->withErrors(['pin' => 'El código pin no coincide.'])->withInput();
        }

        session()->flash('success', 'Se ha modificado correctamente tu contraseña');
        return redirect()->route('login.show');


    }

    public function showRecoveryPassword()
    {
        return view('access.recovery_password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


}
