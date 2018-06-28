<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateProfile(Request $request){

        $this->validate($request, [
            'email' => 'required|email|max:150|min:3|unique:users,id,'. $request->id,
        ]);

        try{
            $user = User::find($request->id);
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->second_lastname = $request->second_lastname;
            $user->email = $request->email;


            if ($request->hasFile('avatar')) {

//                if($user->avatar != 'public/avatars/user-default.png'){
//
//                    Storage::delete($user->avatar);
//                }

                $user->avatar = $request->file('avatar')->store('public/avatars');
            }

            $user->save();
        }catch(\Exception $ex){
            return back()->withErrors(['error' => $ex->getMessage()]);
        }

        session()->flash('success', 'Perfil Actualizado');
        return redirect()->route('profile');
    }

    public function changePassword(Request $request){

        $this->validate($request, [
            'actual' => 'required|min:4',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4'
        ]);

        $user = User::find($request->id);

        if( $request->actual == $user->password){
            $user->password = bcrypt($request->password);
            $user->save();

            session()->flash('success', 'Se ha modificado correctamente tu contraseña');
            return redirect()->route('profile');
        }
        return back()->withErrors(['actual' => 'la contraseña es incorrecta'])->withInput();


    }
}
