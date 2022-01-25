<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Support\Facades\Hash;


class CreateUser extends Controller
{

    public function createUser(Request $request){


       

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => $request['roleueberpruefung'],
        ]);
        return $request;

    }


    public function destroy($id){
        
        $user = User::find($id);


        if ($user == null) {
            dd("Konnte nicht gelöscht werden");
        } else {
            $user->delete();
            return redirect('/Registerpage');
        }
    }



    }
    

